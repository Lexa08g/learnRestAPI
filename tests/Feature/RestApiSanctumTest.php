<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RestApiSanctumTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Pastikan ada kategori musik untuk pengujian
        Category::firstOrCreate(
            ['category_id' => 1],
            ['category' => 'Indie Rock']
        );
    }

    public function test_register_berhasil()
    {
        $response = $this->postJson('/api/register', [
            'name'     => 'Agus Seputra',
            'email'    => 'agus_' . time() . '@test.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user' => ['id', 'name', 'email'],
            ]);
    }

    public function test_login_dan_dapatkan_bearer_token()
    {
        $email = 'user_' . time() . '@test.com';
        User::create([
            'name'     => 'User Test',
            'email'    => $email,
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email'    => $email,
            'password' => 'secret123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token',
                'token_type',
            ]);
    }

    public function test_login_gagal_kredensial_salah()
    {
        $response = $this->postJson('/api/login', [
            'email'    => 'nonexistent@test.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_akses_products_tanpa_token_menghasilkan_401_unauthorized()
    {
        $response = $this->getJson('/api/products');
        $response->assertStatus(401);
    }

    public function test_akses_products_dengan_bearer_token_berhasil()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'links',
                'meta',
            ]);
    }

    public function test_tambah_produk_musik_dan_token()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/products', [
            'name'        => 'OK Computer',
            'artist'      => 'Radiohead',
            'format'      => 'Vinyl LP (180g)',
            'description' => 'Album legendaris Radiohead tahun 1997',
            'category_id' => 1,
            'price'       => 520000,
            'stock'       => 5,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'OK Computer')
            ->assertJsonPath('data.artist', 'Radiohead');
    }

    public function test_lihat_detail_produk_spesifik()
    {
        $user = User::factory()->create();
        $product = Product::first();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/products/' . $product->product_id);

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $product->product_id);
    }

    public function test_profile_dan_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test_token')->plainTextToken;

        // Cek profile dengan bearer token
        $profileResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/profile');

        $profileResponse->assertStatus(200)
            ->assertJsonPath('email', $user->email);

        // Logout
        $logoutResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/logout');

        $logoutResponse->assertStatus(200)
            ->assertJson(['message' => 'Logout success']);
    }
}
