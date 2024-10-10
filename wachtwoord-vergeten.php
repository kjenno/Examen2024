<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="wachtwoord-vergeten.css" />
    <title>wachtwoord vergeten</title>
  </head>
  <body>
    <main>
      <header class="header-651">
        <h1>verander hier je wachtwoord</h1>
      </header>

      <section class="scrollable-container">
        <div class="wv-container">
        <form action="B_wachtwoord-vergeten.php" method="POST">
            <input type="hidden" name="action" value="request_code">
            <label for="email">Voer uw e-mailadres in:</label>
            <input type="email" name="email" id="email" placeholder="bijvoorbeeld@example.com" required /><br />
            <button type="submit" name="submit">Verzenden</button>
        </form>

        </div>
      </section>
    </main>
  </body>
</html>
