<x-home-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-emerald-800 to-green-700 rounded-3xl p-8 md:p-12 text-white shadow-xl mb-12 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-emerald-100 uppercase tracking-wider mb-4">
                        Sistem Informasi Pertanian Terpadu
                    </span>
                    <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
                        Pemberdayaan & Manajemen Kelompok Tani Modern
                    </h1>
                    <p class="mt-4 text-emerald-100 text-base md:text-lg leading-relaxed">
                        Platform pendataan anggota petani, pengelolaan kelompok tani terintegrasi, serta monitoring bantuan sarana produksi pertanian secara transparan.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('katalog') }}" class="px-6 py-3 rounded-xl bg-white text-emerald-800 font-bold text-sm shadow hover:bg-emerald-50 transition">
                            Lihat Anggota Petani
                        </a>
                        <a href="{{ route('petani.index') }}" class="px-6 py-3 rounded-xl bg-emerald-900/60 border border-emerald-400 text-white font-semibold text-sm hover:bg-emerald-900 transition">
                            Kelola Data Petani
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full md:w-auto">
                    <div class="p-6 bg-white/10 backdrop-blur-md rounded-2xl text-center border border-white/10">
                        <div class="text-4xl font-extrabold text-white">{{ $petanis->count() }}</div>
                        <div class="text-xs text-emerald-200 mt-1 uppercase font-semibold">Petani Aktif</div>
                    </div>
                    <div class="p-6 bg-white/10 backdrop-blur-md rounded-2xl text-center border border-white/10">
                        <div class="text-4xl font-extrabold text-white">{{ $kelompoks->count() }}</div>
                        <div class="text-xs text-emerald-200 mt-1 uppercase font-semibold">Kelompok Tani</div>
                    </div>
                </div>
            </div>

            <div class="mb-8 flex items-baseline justify-between border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">Petani Binaan Unggulan</h2>
                    <p class="text-sm text-slate-500 mt-1">Daftar petani aktif yang terdaftar dalam kelompok tani binaan.</p>
                </div>
                <a href="{{ route('katalog') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-800">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($petanis as $petani)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                        <div class="p-6">
                            <div class="flex items-center space-x-4 mb-4">
                                @if ($petani->foto && file_exists(public_path('storage/' . $petani->foto)))
                                    <img class="h-16 w-16 rounded-2xl object-cover border-2 border-emerald-500" src="{{ asset('storage/' . $petani->foto) }}" alt="{{ $petani->nama }}">
                                @elseif ($petani->foto && file_exists(public_path($petani->foto)))
                                    <img class="h-16 w-16 rounded-2xl object-cover border-2 border-emerald-500" src="{{ asset($petani->foto) }}" alt="{{ $petani->nama }}">
                                @else
                                    <div class="h-16 w-16 rounded-2xl bg-emerald-100 text-emerald-700 font-extrabold text-xl flex items-center justify-center border-2 border-emerald-300">
                                        {{ strtoupper(substr($petani->nama, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-bold text-slate-900 text-lg leading-snug">{{ $petani->nama }}</h3>
                                    <p class="text-xs text-slate-500">NIK: {{ $petani->nik }}</p>
                                    @if ($petani->kelompoktani)
                                        <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                                            {{ $petani->kelompoktani->nama_kelompok }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2 text-xs text-slate-600 pt-3 border-t border-slate-100">
                                <div class="flex items-center text-slate-500">
                                    <i class="fas fa-phone-alt w-5 text-emerald-600"></i>
                                    <span>{{ $petani->telp }}</span>
                                </div>
                                <div class="flex items-center text-slate-500">
                                    <i class="fas fa-map-marker-alt w-5 text-emerald-600"></i>
                                    <span class="truncate">{{ $petani->alamat ?? 'Belum ada alamat' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-semibold {{ $petani->status === 'Y' ? 'text-emerald-700' : 'text-slate-400' }}">
                                {{ $petani->status === 'Y' ? '● Anggota Aktif' : '○ Non-Aktif' }}
                            </span>
                            <a href="{{ route('petani.index', ['s' => $petani->nama]) }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-800">
                                Detail Profil
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-slate-200">
                        <p class="text-slate-500 text-sm">Belum ada data petani yang terdaftar.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16 bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                <div class="text-center max-w-xl mx-auto mb-8">
                    <h2 class="text-2xl font-bold text-slate-900">Kelompok Tani Binaan</h2>
                    <p class="text-slate-500 text-sm mt-1">Gabungan kelompok tani yang terkoordinasi dalam sistem binaan terpadu.</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach ($kelompoks as $kelompok)
                        <a href="{{ route('petani.kelompok', $kelompok->id_kelompok_tani) }}" class="p-5 rounded-2xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-100 text-center transition group">
                            <i class="fas fa-users text-emerald-600 text-2xl mb-2 group-hover:scale-110 transition"></i>
                            <div class="font-bold text-slate-900 text-sm">{{ $kelompok->nama_kelompok }}</div>
                            <div class="text-xs text-emerald-700 mt-1">{{ $kelompok->petanis_count ?? $kelompok->petanis->count() }} Anggota Petani</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-home-layout>