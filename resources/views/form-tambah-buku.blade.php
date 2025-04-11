<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    @include('navbar')

    <div class="container mx-auto px-4 my-6 max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Tambah Buku Baru</h1>

        <!-- Form -->
        <form action="{{ route('buku.store') }}" method="POST"
            class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            @csrf
            <div class="mb-4">
                <label for="judul_buku" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul
                    Buku</label>
                <input type="text" id="judul_buku" name="judul_buku" required
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
            </div>
            <div class="mb-4">
                <label for="penulis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penulis</label>
                <input type="text" id="penulis" name="penulis" required
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
            </div>
            <div class="mb-4">
                <label for="deskripsi_buku"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="deskripsi_buku" name="deskripsi_buku" rows="4"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
            </div>
            <div class="mb-4">
                <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun
                    Terbit</label>
                <input type="number" id="tahun_terbit" name="tahun_terbit" required
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
            </div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg py-2 px-4 hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition-all duration-200">
                Simpan Buku
            </button>
        </form>
    </div>

    <!-- SweetAlert2 for Success/Error -->
    <script>
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
    </script>
</body>

</html>
