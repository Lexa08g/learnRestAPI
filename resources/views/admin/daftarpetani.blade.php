<x-admin-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ $title }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">Manajemen data petani dan kelompok tani binaan.</p>
        </div>
        <div>
            <a href="{{ route('petani.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                <i class="fas fa-plus mr-2"></i> Tambah Petani
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg flex items-center justify-between">
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <form action="{{ route('petani.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                <div class="md:col-span-5">
                    <label for="kelompok" class="sr-only">Kelompok Tani</label>
                    <select id="kelompok" name="id_kelompok" onchange="this.form.submit()" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                        <option value="">-- Semua Kelompok Tani --</option>
                        @foreach ($kelompoks as $item)
                            <option value="{{ $item->id_kelompok_tani }}" {{ request('id_kelompok') == $item->id_kelompok_tani ? 'selected' : '' }}>
                                {{ $item->nama_kelompok }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-7 flex">
                    <input type="text" name="s" value="{{ request('s') }}" placeholder="Cari nama petani..." class="w-full px-3 py-2 border border-gray-300 rounded-l-lg text-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                    <button type="submit" class="px-4 py-2 border border-l-0 border-emerald-600 bg-emerald-600 text-white text-sm font-medium rounded-r-lg hover:bg-emerald-700 transition flex items-center">
                        <i class="fas fa-search mr-1.5"></i> Cari
                    </button>
                    @if(request()->filled('s') || request()->filled('id_kelompok'))
                        <a href="{{ route('petani.index') }}" class="ml-2 px-3 py-2 border border-gray-300 bg-white text-gray-600 text-sm rounded-lg hover:bg-gray-100 flex items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Petani
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Kontak & Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Kelompok Tani
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($petanis as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if ($item->foto && file_exists(public_path('storage/' . $item->foto)))
                                            <img class="h-10 w-10 rounded-full object-cover border" src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                                        @elseif ($item->foto && file_exists(public_path($item->foto)))
                                            <img class="h-10 w-10 rounded-full object-cover border" src="{{ asset($item->foto) }}" alt="{{ $item->nama }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">
                                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $item->nama }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            NIK: {{ $item->nik }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">{{ $item->telp }}</div>
                                <div class="text-xs text-gray-500 max-w-xs truncate">{{ $item->alamat ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($item->kelompoktani)
                                    <a href="{{ route('petani.kelompok', $item->kelompoktani->id_kelompok_tani) }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 hover:bg-emerald-200 transition">
                                        <i class="fas fa-users mr-1"></i> {{ $item->kelompoktani->nama_kelompok }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">Belum Ada Kelompok</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($item->status == 'Y')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800">
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="inline-flex items-center space-x-2">
                                    <a href="{{ route('petani.edit', $item->id_penjual) }}" class="text-emerald-700 hover:text-emerald-900 px-2 py-1 bg-emerald-50 hover:bg-emerald-100 rounded text-xs font-semibold transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('petani.destroy', $item->id_penjual) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data petani ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-900 px-2 py-1 bg-rose-50 hover:bg-rose-100 rounded text-xs font-semibold transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-user-slash text-gray-300 text-3xl mb-2"></i>
                                    <p>Tidak ada data petani yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($petanis instanceof \Illuminate\Pagination\LengthAwarePaginator && $petanis->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $petanis->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>