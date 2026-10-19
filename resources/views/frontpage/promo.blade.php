<x-home-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-emerald-700 to-teal-800 rounded-3xl p-8 md:p-12 text-white shadow-xl mb-10">
                <span class="inline-block py-1 px-3 rounded-full bg-white/20 text-xs font-semibold tracking-wider uppercase mb-3">Program Binaan</span>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Program Pemberdayaan Petani</h1>
                <p class="mt-3 text-emerald-100 text-base md:text-lg max-w-2xl">
                    Inisiatif bantuan benih unggul, pupuk bersubsidi, dan pelatihan agrikultur bagi seluruh anggota kelompok tani terdaftar.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition">
                    <div class="h-44 bg-gradient-to-br from-emerald-500 to-green-600 p-6 flex flex-col justify-between text-white">
                        <span class="bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold w-fit">PRIORITAS</span>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-100">Bantuan Sarana</p>
                            <h3 class="text-2xl font-bold">Bibit Unggul & Pupuk Organik</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-600 text-sm mb-4">Penyaluran bibit padi varietas tahan hama serta pupuk kompos berkualitas untuk kelompok tani Jaya Mula & Tani Maju.</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-semibold text-emerald-700">Tersedia Setiap Musim</span>
                            <a href="{{ route('petani.index') }}" class="px-4 py-2 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-700 transition">Lihat Penerima</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition">
                    <div class="h-44 bg-gradient-to-br from-teal-500 to-cyan-600 p-6 flex flex-col justify-between text-white">
                        <span class="bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold w-fit">PELATIHAN</span>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-teal-100">Penyuluhan Tani</p>
                            <h3 class="text-2xl font-bold">Modern Smart Farming</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-600 text-sm mb-4">Workshop pemanfaatan sistem irigasi hemat air, pengendalian hama ramah lingkungan, dan pencatatan panen digital.</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-semibold text-teal-700">Setiap Akhir Bulan</span>
                            <a href="{{ route('petani.index') }}" class="px-4 py-2 bg-teal-600 text-white text-xs font-semibold rounded-lg hover:bg-teal-700 transition">Daftar Jadwal</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition">
                    <div class="h-44 bg-gradient-to-br from-amber-500 to-orange-600 p-6 flex flex-col justify-between text-white">
                        <span class="bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold w-fit">KEMITRAAN</span>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-amber-100">Akses Pasar</p>
                            <h3 class="text-2xl font-bold">Pemasaran Hasil Panen</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-600 text-sm mb-4">Jaringan distribusi hasil tani langsung ke pasar grosir, hotel, dan restoran di wilayah Gianyar dan Badung.</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-semibold text-amber-700">Kerjasama BUMDes</span>
                            <a href="{{ route('tentang') }}" class="px-4 py-2 bg-amber-600 text-white text-xs font-semibold rounded-lg hover:bg-amber-700 transition">Pelajari Mitra</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
