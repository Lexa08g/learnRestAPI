<x-home-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between pb-8 border-b border-slate-200 mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Direktori Anggota Petani</h1>
                    <p class="mt-2 text-slate-600">Daftar lengkap seluruh petani yang tergabung dalam kelompok tani binaan.</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-2">
                    <a href="{{ route('petani.index') }}" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition">
                        <i class="fas fa-cog mr-2"></i> Kelola di Admin
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($petanis as $petani)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                        <div class="p-5">
                            <div class="h-40 bg-slate-100 rounded-xl overflow-hidden mb-4 flex items-center justify-center">
                                @if ($petani->foto && file_exists(public_path('storage/' . $petani->foto)))
                                    <img src="{{ asset('storage/' . $petani->foto) }}" alt="{{ $petani->nama }}" class="w-full h-full object-cover">
                                @elseif ($petani->foto && file_exists(public_path($petani->foto)))
                                    <img src="{{ asset($petani->foto) }}" alt="{{ $petani->nama }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-emerald-50 text-emerald-700">
                                        <i class="fas fa-user text-4xl mb-1 text-emerald-300"></i>
                                        <span class="text-xs font-bold uppercase">{{ $petani->nama }}</span>
                                    </div>
                                @endif
                            </div>
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 mb-2">
                                {{ $petani->kelompoktani?->nama_kelompok ?? 'Umum' }}
                            </span>
                            <h3 class="font-bold text-slate-900 text-base mb-1">{{ $petani->nama }}</h3>
                            <p class="text-xs text-slate-500 mb-2">NIK: {{ $petani->nik }}</p>
                            <p class="text-xs text-slate-600 line-clamp-2">{{ $petani->alamat ?? 'Alamat belum diisi' }}</p>
                        </div>
                        <div class="p-5 pt-0 border-t border-slate-100 flex items-center justify-between mt-2">
                            <span class="text-xs text-slate-500 flex items-center">
                                <i class="fas fa-phone mr-1.5 text-emerald-600"></i> {{ $petani->telp }}
                            </span>
                            <a href="{{ route('petani.kelompok', $petani->id_kelompok_tani) }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-800">
                                Kelompok
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12 bg-white rounded-2xl border border-slate-200">
                        <p class="text-slate-500 text-sm">Tidak ada data petani yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            @if ($petanis->hasPages())
                <div class="mt-8">
                    {{ $petanis->links() }}
                </div>
            @endif
        </div>
    </div>
</x-home-layout>
