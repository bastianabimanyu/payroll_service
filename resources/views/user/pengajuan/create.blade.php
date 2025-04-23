<x-app-layout>
  <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md mt-10">

    <!-- Judul -->
    <h2 class="text-2xl font-bold mb-6 text-center">Form Pengajuan Baru</h2>

    <!-- Form Pengajuan -->
    <form action="{{ route('pengajuanstore') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label for="namapengaju" class="block font-medium">Nama Karyawan</label>
        <input type="text" name="namapengaju" id="namapengaju" class="w-full border border-gray-300 p-2 rounded" required>
      </div>
      <div>
        <label for="judul" class="block font-medium">Judul Pengajuan</label>
        <input type="text" name="judul" id="judul" class="w-full border border-gray-300 p-2 rounded" required>
      </div>
      <div>
        <label for="deskripsi" class="block font-medium">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="w-full border border-gray-300 p-2 rounded" rows="3" required></textarea>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kirim Pengajuan
      </button>
    </form>

    <!-- Riwayat Pengajuan -->
    <h2 class="text-xl font-semibold mt-10 mb-4 text-center">Riwayat Pengajuan Karyawan</h2>
    <table class="min-w-full table-auto border border-gray-300 text-sm">
      <thead class="bg-gray-200">
        <tr>  
          <th class="px-4 py-2 border">Nama karyawan</th>
          <th class="px-4 py-2 border">Judul</th>
          <th class="px-4 py-2 border">Deskripsi</th>
          <th class="px-4 py-2 border">Status</th>
          <th class="px-4 py-2 border">Tanggal</th>
        </tr>
      </thead>
      <tbody>
            @foreach ( $pengajuan as $pengajuans )
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $pengajuans->nama_pengaju }}</td>
                    <td class="px-4 py-2 border">{{ $pengajuans->judul }}</td>
                    <td class="px-4 py-2 border">{{ $pengajuans->deskripsi }}</td>
                    <td class="px-4 py-2 border font-semibold text-center 
                        {{ 
                            $pengajuans->status == 'diterima' ? 'text-green-600' : 
                            ($pengajuans->status == 'ditolak' ? 'text-red-600' : 'text-yellow-500') 
                        }}">
                        {{ $pengajuans->status }}
                    </td>
                    <td class="px-4 py-2 border">{{ $pengajuans->tanggal_pengajuan }}</td>
                </tr>
            @endforeach
      </tbody>
    </table>

  </div>
</x-app-layout>
