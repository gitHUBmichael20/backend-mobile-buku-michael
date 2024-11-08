<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page Sederhana</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: system-ui, -apple-system, sans-serif;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
    }

    .login-box {
      max-width: 28rem;
      margin: 0 auto;
      background-color: white;
      border-radius: 1.5rem;
      padding: 1.5rem 2rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .video-container {
      position: relative;
      left: 50%;
      transform: translateX(-50%);
    }

    form {
      margin-top: 1.5rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.25rem;
    }

    input, select {
      width: 100%;
      padding: 0.25rem;
      margin-top: 0.25rem;
      border: 1px solid #D1D5DB;
      border-radius: 0.375rem;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      font-size: 0.875rem;
      box-sizing: border-box;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #EF4444;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }

    button {
      width: 100%;
      background-color: #EF4444;
      color: white;
      padding: 0.5rem;
      border: none;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      cursor: pointer;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    button:hover {
      background-color: #DC2626;
    }

    button:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }

    #delete-button {
      margin-top: 1em;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <video loop autoplay muted class="video-container">
        <source src="{{ asset('assets/hello-animation.webm') }}">
      </video>
      <form action="{{ route('buku.simpan') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="judul_buku">Judul Buku</label>
            <input type="text" id="judul_buku" name="judul_buku" required />
        </div>
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" id="penulis" name="penulis" required />
        </div>
        <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="date" id="tahun_terbit" name="tahun_terbit" required />
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>