<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <script src="https://kit.fontawesome.com/f3eccbebbf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-eFJ5Z2IE5LlSVqf3+LyS/xA2T3cQj6zF3yZ5P7VfBmVfSrxcs6h3K9u7f8Z7f8wG" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        section {
            padding: 50px;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
        }

        p {
            font-size: 1.2em;
        }

        .cta-button {
            padding: 10px 20px;
            background-color: #3057c8;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #396bff;
        }

        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 10)), url("./img/24720446_6907178.svg");
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            padding: 0px 0px;
            /* Updated padding for vertical and horizontal spacing */
        }

        .hero h1 {
            font-size: 3.5em;
            margin-bottom: 0px;
            /* Added margin bottom for spacing */
        }

        .hero p {
            font-size: 1.5m;
            margin-bottom: 35px;
            /* Added margin bottom for spacing */
        }

        .hero .cta-button {
            padding: 15px 30px;
            font-size: 1.2em;
        }

        /* .features {
            background-color: #f9f9f9;
            padding: 50px 0;
            text-align: center;
        }

        .feature {
            margin-bottom: 30px;
        }

        .feature img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .feature h3 {
            margin-bottom: 10px;
        }

        .feature p {
            font-size: 1.1em;
        } */
    </style>
</head>

<body>
    <section class="hero">
        <h1>Perhatikan Kesehatan Mental Anda</h1>
        <p>Temukan dukungan kesehatan mental melalui platform ini dengan alat penilaian yang ramah pengguna</p>
        <a href="register.php" class="cta-button">
            Mulai Tes
            <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
        </a>
    </section>
    <!-- <section class="features">
        <div class="feature">
            <img src="./uploads/msib.png" alt="Feature 1">
            <h3>Feature 1</h3>
            <p>Description of feature 1.</p>
        </div>
        <div class="feature">
            <img src="./uploads/msib.png" alt="Feature 2">
            <h3>Feature 2</h3>
            <p>Description of feature 2.</p>
        </div>
    </section> -->
</body>

</html>