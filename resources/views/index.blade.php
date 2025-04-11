<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    @include('navbar')


    @if (session('success'))
        Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
        });
    @endif

    @if (session('error'))
        Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
        });
    @endif

    <!-- Container -->
    <div class="container mx-auto px-4 py-8 my-6">
        <!-- Table Section -->
        <div class="mt-8 max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Judul Buku</th>
                            <th scope="col" class="px-6 py-3">Penulis</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-6 py-3">Tahun Terbit</th>
                            <th scope="col" class="px-6 py-3">Baca Buku</th>
                            <th scope="col" class="px-6 py-3">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{{ $item->id_buku }}</td>
                                <td class="px-6 py-4">{{ $item->judul_buku }}</td>
                                <td class="px-6 py-4">{{ $item->penulis }}</td>
                                <td class="px-6 py-4">{{ $item->deskripsi_buku }}</td>
                                <td class="px-6 py-4">{{ $item->tahun_terbit }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('buku.baca', $item->id_buku) }}" target="_blank">
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Baca Buku
                                        </button>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <button type="button"
                                        class="edit-button focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                                        data-id="{{ $item->id_buku }}" data-judul="{{ $item->judul_buku }}"
                                        data-penulis="{{ $item->penulis }}"
                                        data-deskripsi="{{ $item->deskripsi_buku }}"
                                        data-tahun="{{ $item->tahun_terbit }}">Edit</button>
                                    <form action="{{ route('buku.destroy', ['id_buku' => $item->id_buku]) }}"
                                        method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk edit buku -->
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Buku</h3>
                                <div class="mt-2">
                                    <input type="hidden" id="editId" name="id_buku">
                                    <div class="mb-4">
                                        <label for="editJudul" class="block text-sm font-medium text-gray-700">Judul
                                            Buku</label>
                                        <input type="text" id="editJudul" name="judul_buku"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="editPenulis"
                                            class="block text-sm font-medium text-gray-700">Penulis</label>
                                        <input type="text" id="editPenulis" name="penulis"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="editDeskripsi"
                                            class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea id="editDeskripsi" name="deskripsi_buku" rows="3"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="editTahun" class="block text-sm font-medium text-gray-700">Tahun
                                            Terbit</label>
                                        <input type="number" id="editTahun" name="tahun_terbit"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                        <button type="button" id="closeModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Buku ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editModal');
            const editForm = document.getElementById('editForm');
            const closeModal = document.getElementById('closeModal');


            function openEditModal(id, judul, penulis, deskripsi, tahun) {
                document.getElementById('editId').value = id;
                document.getElementById('editJudul').value = judul;
                document.getElementById('editPenulis').value = penulis;
                document.getElementById('editDeskripsi').value = deskripsi;
                document.getElementById('editTahun').value = tahun;
                editModal.classList.remove('hidden');
            }


            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const judul = this.getAttribute('data-judul');
                    const penulis = this.getAttribute('data-penulis');
                    const deskripsi = this.getAttribute('data-deskripsi');
                    const tahun = this.getAttribute('data-tahun');
                    openEditModal(id, judul, penulis, deskripsi, tahun);
                });
            });


            closeModal.addEventListener('click', function() {
                editModal.classList.add('hidden');
            });


            editForm.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data buku akan diubah!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const id = document.getElementById('editId').value;
                        editForm.action = `/buku/update/${id}`;
                        editForm.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
