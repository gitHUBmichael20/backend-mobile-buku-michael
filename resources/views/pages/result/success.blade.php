<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpan Berhasil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        .centered-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 8px; Tailwind */
            border: 1px solid red; border-red-600 */
        }

        weight */
        .heading {
            text-align: center;
            font-size: 1.5rem; */
            font-weight: 600;
        }
        video {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="centered-container">
        <video loop autoplay muted>
            <source src="{{ asset('assets/success.webm') }}">
        </video>
        <h1 class="heading">Simpan Berhasil !!</h1>
    </div>
</body>
</html>
