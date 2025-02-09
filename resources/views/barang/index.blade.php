<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stok Gudang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p class="text-2xl">Data Barang</p>

                <div class="mt-4 mb-4">
                    {{ $barangs->links() }}
                </div>

                @if (session('success'))
                    <div class="bg-green-400 p-3 rounded-sm w-1/4 text-black mt-4 mb-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full bg-white dark:bg-gray-700 rounded">
                    <thead class="bg-gray-50 dark:bg-gray-600">
                        <tr>
                            @foreach ([
                                'Nama Barang', 'Jumlah Barang', 'Satuan', 'Waktu Masuk', 'Pembaruan Terakhir', 'Aksi'
                            ] as $header)
                                <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $header }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <td class="py-3 px-4 border-b border-gray-300">{{ $barang->nama_barang }}</td>
                                <td class="py-3 px-4 border-b border-gray-300">{{ $barang->jumlah }}</td>
                                <td class="py-3 px-4 border-b border-gray-300">{{ $barang->satuan }}</td>
                                <td class="py-3 px-4 border-b border-gray-300">{{ $barang->created_at }}</td>
                                <td class="py-3 px-4 border-b border-gray-300">{{ $barang->updated_at }}</td>
                                <td class="py-3 px-4 border-b border-gray-300 flex space-x-2">
                                    <a href="{{ route('barang.edit', $barang->id_barang) }}" class="bg-green-500 hover:bg-green-600 text-black py-1 px-3 rounded">
                                        <i class='fas fa-edit'></i>
                                    </a>
                                    <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-black py-1 px-3 rounded">
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </form>
                                    <button onclick="showModal({{ $barang->id_barang }})" class="p-2 bg-yellow-500 hover:bg-yellow-700 text-black rounded">
                                        <i class="fas fa-cart-shopping"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-700 rounded-lg p-6 w-1/3">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Ambil Barang</h3>
            <form id="modal-form" action="" method="POST">
                @csrf
                <input type="number" name="jumlah_ambil" placeholder="Jumlah ambil" required class="w-full p-2 border border-gray-300 rounded mb-4">
                <div class="flex justify-end">
                    <button type="submit" class="p-2 bg-green-500 hover:bg-green-700 text-white rounded mr-2">Konfirmasi</button>
                    <button type="button" onclick="hideModal()" class="p-2 bg-red-500 hover:bg-red-700 text-white rounded">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/ambil.js') }}"></script>
</x-app-layout>
