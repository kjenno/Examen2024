<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geen Toegang</title>
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap"/>
    <style>
        
        /* General styling */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1a2b50; /* Dark blue background */
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        
        /* Top navigation bar */
        .navbar {
            background-color: #000; /* Black background for nav */
            width: 100%;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            top: 0;
        }
        
        .navbar .logo {
            margin-left: 20px;
            font-size: 24px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        
        .navbar .menu {
            margin-right: 20px;
        }
        
        .navbar .menu a {
            color: #b89cf1; /* Light purple links */
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }
        
        .navbar .menu a:hover {
            text-decoration: underline;
        }
        
        /* Main content */
        .content {
            margin-top: 80px;
            max-width: 600px;
        }
        
        .content h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .content p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        
        .back-button {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .back-button:hover {
            background-color: #b89cf1;
            color: #1a2b50;
        }
    </style>
</head>
<body>

    <!-- Navigation bar -->
    <div class="navbar-67">
        <header class="content74">
          <div class="content75">
            <a href="./index.php">
              <img class="color-dark19" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
            </a>

            <nav class="column20">
              <a href="over-ons.php" class="link-text36">Over Ons</a>
              <a href="diensten.php" class="link-text37">Diensten</a>
              <a href="projecten.php" class="link-text38">Projecten</a>
              <a href="planning.php" class="link-text38">Planning</a>
            </nav>
        </div>

          <a href="login.php" class="stylesecondary-smalltrue-a18">
            <div class="button30">Inloggen</div>
          </a>
        </header>
    </div>

    <!-- Main content -->
    <div class="content">
        <h1>Geen Toegang</h1>
        <p>Je hebt geen rechten om deze pagina te bekijken.</p>
        <p>Neem contact op met de beheerder als je denkt dat dit een vergissing is.</p>
        <a href="/" class="back-button">Terug naar Home</a>
    </div>

</body>
</html>
