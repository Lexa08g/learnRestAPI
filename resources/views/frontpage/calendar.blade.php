<div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLgLabel">
        Cek Jadwal Penyuluhan Pertanian
    </h5>
    <button type="button"
        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
        data-bs-dismiss="modal" aria-label="Close">
        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>

<div class="modal-body relative p-6">
    <div class="mb-4">
        <label for="checkDate" class="block text-sm font-medium text-gray-700 mb-2">Pilih Tanggal Kegiatan</label>
        <input type="date" id="checkDate" name="check_date" 
            value="{{ date('Y-m-d') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
    </div>

    <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 mb-4">
        <div class="flex items-center justify-between">
            <div>
                <h6 class="font-semibold text-emerald-900">Sesi Pagi: Penyuluhan Pupuk Organik</h6>
                <p class="text-xs text-emerald-700">09:00 - 11:30 WITA | Balai Desa Singapadu</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                Kuota Terbuka
            </span>
        </div>
    </div>

    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <h6 class="font-semibold text-gray-800">Sesi Siang: Temu Wicara Kelompok Tani</h6>
                <p class="text-xs text-gray-500">14:00 - 16:00 WITA | Balai Subak Tegalalang</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                Terbuka
            </span>
        </div>
    </div>
</div>

<div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md space-x-2">
    <button type="button"
        class="px-5 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded shadow hover:bg-gray-300 transition"
        data-bs-dismiss="modal">
        Tutup
    </button>
</div>
