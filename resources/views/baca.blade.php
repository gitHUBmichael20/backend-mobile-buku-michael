<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baca {{ $buku->judul_buku }}</title>
    @vite('resources/css/app.css')

</head>
<body>
    <div class=" bg-gray-100 dark:bg-gray-900">
        <div class="flex items-center justify-center  min-h-screen">
            <div class="max-w-4xl w-full sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                    <!-- Content Section -->
                    <div class="p-6">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $buku->judul_buku }}</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            By <span class="font-medium text-gray-800 dark:text-gray-200">{{ $buku->penulis }}</span>
                        </p>
                        <div class="mt-6 text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $buku->deskripsi_buku }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
