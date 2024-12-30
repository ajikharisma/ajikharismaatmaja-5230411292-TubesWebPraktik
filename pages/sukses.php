<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Sukses</title>
    <style>
        /* Reset dan dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .success-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .success-container h1 {
            color: #2c3e50;
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .success-container p {
            margin-bottom: 20px;
            color: #555;
            font-size: 1em;
        }

        .success-container .home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .success-container .home-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Selamat!</h1>
        <p>Pendaftaran Anda Telah Sukses.<br>Untuk Info Lebih Lanjut Akan Kami Hubungi Melalui SMS atau WhatsApp.</p>
        <a href="home.php" class="home-button">Kembali ke Home</a>
    </div>
</body>
</html>
