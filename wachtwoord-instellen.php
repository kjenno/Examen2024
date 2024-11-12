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
            <input type="hidden" name="action" value="reset_password">
            <label for="code">Voer uw code in:</label>
            <input type="text" name="code" id="code" required /><br />
            
            <label for="password">Nieuw wachtwoord:</label>
            <input type="password" name="password" id="password" required /><br />
            
            <label for="password_confirm">Bevestig wachtwoord:</label>
            <input type="password" name="password_confirm" id="password_confirm" required /><br />
            
            <button type="submit" name="submit">Verzenden</button>
        </form>
        <?php
          $Message = $_GET['message'] ?? null;
          if (!empty($Message)) {
              echo "<p style='color: red; text-align: center;'>$Message</p>";
          }
        ?>
        </div>
      </section>
    </main>
  </body>
</html>
