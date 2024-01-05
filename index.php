<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #2c2727;
        }

        .hero {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 800 400'%3E%3Cdefs%3E%3CradialGradient id='a' cx='396' cy='281' r='514' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%230E2ADD'/%3E%3Cstop offset='1' stop-color='%23253333'/%3E%3C/radialGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='400' y1='148' x2='400' y2='333'%3E%3Cstop offset='0' stop-color='%2338FFEA' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%2338FFEA' stop-opacity='0.5'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='800' height='400'/%3E%3Cg fill-opacity='0.4'%3E%3Ccircle fill='url(%23b)' cx='267.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='532.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='400' cy='30' r='300'/%3E%3C/g%3E%3C/svg%3E");
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
            /* padding: 100px 20px; */
            /* Updated padding for vertical and horizontal spacing */
        }

        .hero h1 {
            font-size: 3.5em;
            margin-bottom: 0px;
            /* Added margin bottom for spacing */
        }

        .hero p {
            font-size: 1.5em;
            margin-bottom: 35px;
            /* Added margin bottom for spacing */
        }

        .hero .cta-button {
            padding: 15px 30px;
            font-size: 1.2em;
        }

        .features {
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
        }
    </style>
</head>

<body>
    <section class="hero">
        <h1>Your Catchy Headline Here</h1>
        <p>A compelling description of your product or service.</p>
        <a href="register.php" class="cta-button">Get Started</a>
    </section>
    <section class="features">
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
        <!-- Add more features as needed -->
    </section>
</body>

</html>