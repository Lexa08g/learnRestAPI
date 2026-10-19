<x-admin-layout>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ $title }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">Formulir input dan pembaruan data anggota petani.</p>
        </div>
        <a href="{{ route('petani.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
    </div>

    @if (session('error'))
        <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-lg text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form enctype="multipart/form-data" action="{{ isset($petani) ? route('petani.update', $petani->id_penjual) : route('petani.store') }}" method="POST">
            @csrf
            @if(isset($petani))
                @method('PUT')
            @endif

            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" placeholder="Contoh: I Wayan Sudarma" required
                            value="{{ isset($petani) ? $petani->nama : old('nama') }}"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nama') border-red-500 @else border-gray-300 @enderror">
                        @error('nama')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nik" class="block text-sm font-semibold text-gray-700 mb-1">NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span></label>
                        <input type="number" id="nik" name="nik" placeholder="16 Digit NIK" required
                            value="{{ isset($petani) ? $petani->nik : old('nik') }}"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nik') border-red-500 @else border-gray-300 @enderror">
                        @error('nik')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telp" class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" id="telp" name="telp" placeholder="081234567890" required
                            value="{{ isset($petani) ? $petani->telp : old('telp') }}"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('telp') border-red-500 @else border-gray-300 @enderror">
                        @error('telp')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_kelompok_tani" class="block text-sm font-semibold text-gray-700 mb-1">Kelompok Tani <span class="text-red-500">*</span></label>
                        <select id="id_kelompok_tani" name="id_kelompok_tani" required
                            class="w-full px-4 py-2 border rounded-lg text-sm bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('id_kelompok_tani') border-red-500 @else border-gray-300 @enderror">
                            <option value="">-- Pilih Kelompok Tani --</option>
                            @foreach ($kelompoks as $item)
                                <option value="{{ $item->id_kelompok_tani }}"
                                    {{ ((isset($petani) && $petani->id_kelompok_tani == $item->id_kelompok_tani) || old('id_kelompok_tani') == $item->id_kelompok_tani) ? 'selected' : '' }}>
                                    {{ $item->nama_kelompok }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kelompok_tani')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">
                            Foto Petani {{ isset($petani) ? '(Kosongkan jika tidak diubah)' : '*' }}
                        </label>
                        <input type="file" id="foto" name="foto" {{ isset($petani) ? '' : 'required' }}
                            accept="image/png,image/jpeg,image/jpg"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-300 rounded-lg p-1">
                        @if (isset($petani) && $petani->foto)
                            <div class="mt-2 flex items-center space-x-2">
                                <span class="text-xs text-gray-500">Foto saat ini:</span>
                                <img src="{{ asset('storage/' . $petani->foto) }}" alt="Preview" class="h-10 w-10 rounded-full object-cover border">
                            </div>
                        @endif
                        @error('foto')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Petani</label>
                        <div class="flex items-center space-x-6 mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="Y"
                                    {{ ((isset($petani) && $petani->status == 'Y') || old('status', 'Y') == 'Y') ? 'checked' : '' }}
                                    class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700 font-medium">Aktif</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="N"
                                    {{ ((isset($petani) && $petani->status == 'N') || old('status') == 'N') ? 'checked' : '' }}
                                    class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300">
                                <span class="ml-2 text-sm text-gray-700 font-medium">Non-Aktif</span>
                            </label>
                        </div>
                        @error('status')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat domisili petani..."
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 border-gray-300">{{ isset($petani) ? $petani->alamat : old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3">
                <a href="{{ route('petani.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow-sm transition flex items-center">
                    <i class="fas fa-save mr-2"></i> {{ isset($petani) ? 'Simpan Perubahan' : 'Simpan Data Petani' }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
