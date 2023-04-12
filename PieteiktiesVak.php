<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['setUsername'])) {
  $_SESSION['user'] = 'john';
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majaslapa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style_main.css">
</head>
<body>
    <header>
      <section class="sect1">
        <a href="index.php" class="pageS1"> <div class="pageS"><p>Sakums</p></div> </a>
        <a href="News.php" class="pageS1">  <div class="pageS"><p>Jaunumi</p></div> </a>
        <a href="Vakances.php" class="pageS1"> <div class="pageS"><p>Vakances</p></div></a>
        <a href="#Kontakti" class="pageS1">  <div class="pageS"><p>Kontakti</p></div></a>
      </section>

      <section class="sect2">
        <a href="#popup" class="pageS1">  <div class="pageS"><p>Ielogoties</p></div></a>
  
        <div class="popup" id="popup">
          <a href="#" class="close">Aizvert</a>
          <h2>Ielogoties</h2>
          <form class="form2">
            <label for="username">Lietotajvārds:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Parole:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Submit">
          </form>
        </div>
      </section>
    </header>
    <form>
        <label for="vards">Vārds:</label>
        <input type="text" id="vards" name="vards">
        <br>
        <label for="vards">Uzvārds:</label>
        <input type="text" id="vards" name="vards">
        <br>
        <label for="vards">Telefon Nummurs:</label>
        <input type="text" id="vards" name="vards">
        <br>

        <label for="email">Ē-pasts:</label>
        <input type="email" id="email" name="email">
        <br>
        <label for="file">CV:</label>
        <input type="file" id="file" name="file">
        <br>
        <label for="message">Papildus ziņa:</label>
        <textarea id="message" name="message" rows="8"></textarea>
        <br>
        <input type="submit" value="Submit">
      </form>


      <footer id="Kontakti">
        <div class="social-media-icons">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
        <div class="contact-us">
            <h3>Kontakti</h3>
            <p>E-pasts: ITspeks@gmail.com</p>
            <p>Telefon Nummurs: 555-555-5555</p>
        </div>
      </footer>
</body>
</html>