<x-home-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden p-8 md:p-12">
                <span class="text-xs font-semibold tracking-wider uppercase text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">
                    Sistem Informasi Pertanian
                </span>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-4 mb-6">Tentang SIM Petani</h1>

                <div class="space-y-4 text-slate-600 leading-relaxed text-sm md:text-base">
                    <p>
                        Sistem Informasi Manajemen Kelompok Tani (SIM Petani) dikembangkan sebagai solusi digital terintegrasi untuk mendukung pendataan, verifikasi, serta pengawasan aktivitas kelompok tani dan para anggotanya.
                    </p>
                    <p>
                        Dengan sistem ini, pengelola dan penyuluh pertanian dapat dengan mudah memetakan sebaran petani, mengelompokkan berdasarkan subak atau desa adat, serta mengelola data administrasi kependudukan (NIK) dan kontak secara tertib dan aman.
                    </p>
                    <p>
                        Fokus utama dari sistem ini mencakup:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-slate-700">
                        <li>Pendataan anggota petani terverifikasi dengan relasi kelompok tani yang jelas (1-to-N).</li>
                        <li>Operasi CRUD data petani secara real-time dengan pengunggahan dokumen dan foto profil.</li>
                        <li>Penyediaan layanan RESTful API aman berbasis token (Laravel Sanctum) untuk integrasi aplikasi mobile dan frontend.</li>
                        <li>Proteksi transaksi basis data dengan Transaction Control Language (DB::transaction) dan otorisasi berbasis peran (RBAC).</li>
                    </ul>
                </div>

                <div class="mt-10 pt-8 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                    <div class="p-5 bg-slate-50 rounded-2xl">
                        <div class="text-3xl font-extrabold text-emerald-600">{{ $totalPetani }}</div>
                        <div class="text-xs text-slate-500 mt-1 uppercase font-semibold">Total Petani Terdaftar</div>
                    </div>
                    <div class="p-5 bg-slate-50 rounded-2xl">
                        <div class="text-3xl font-extrabold text-teal-600">{{ $totalKelompok }}</div>
                        <div class="text-xs text-slate-500 mt-1 uppercase font-semibold">Kelompok Tani Binaan</div>
                    </div>
                    <div class="p-5 bg-slate-50 rounded-2xl">
                        <div class="text-3xl font-extrabold text-indigo-600">Sanctum API</div>
                        <div class="text-xs text-slate-500 mt-1 uppercase font-semibold">Token Security & REST</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
