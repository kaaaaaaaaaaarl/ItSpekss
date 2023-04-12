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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');
  </style>
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
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="setUsername" value="Set Username to 'john'">
  </form>
      </div>
    </section>
  </header>




  <div class="mainPage">
    

    <div class="vakancez">
      <h1>Vakances</h1>


      
        <?php
        
          $servername = "localhost:3307"; 
          $username = "root"; 
          $password = ""; 
          $dbname = "pps"; 
          $conn = mysqli_connect($servername, $username, $password, $dbname);
         if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }

          $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
          $limit = 10;

         $sql = "SELECT * FROM ziņas ORDER BY id DESC LIMIT $offset, $limit";
          $result = mysqli_query($conn, $sql);

          ob_start();
      
         while($row = mysqli_fetch_assoc($result)) {
          if (isset($_SESSION['user'])) {
            $id = $row['ID'];
            echo  '<a href="pievienot.php?id='. $id .'&VVZ=V&Edit=E"> <button name="Edit">Edit</button></a>';
            }
           echo '<div class="item">';
           echo '<img src="https://via.placeholder.com/600x400" alt="Image 3">';
           echo  '<div class="text">';
           echo "<h2>" . $row["Tituls"] . "</h2>";
           echo "<p>" . $row["GalvenaisTeksts"] . "</p>";
           echo "<h2><a style='font-size: 20px;' href='PieteiktiesVak.php' class='pieteikties'>Pieteikties</a></h2>";
           echo '</div>
          </div>';
          
           if(ob_get_length() > 1024 * 1024) {
             ob_flush();
              ob_start();
           }
          }
      
          // send the remaining output to the browser
         ob_end_flush();
      
          mysqli_close($conn);
          ?>
      
      
    </div>


  </div>


  <footer id="Kontakti">
    <div class="social-media-icons">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>
    <div class="contact-us">
      <h3>Kontakti</h3>
      <p>Ē-pasts: ITspeks@gmail.com</p>
      <p>Telefon Nummurs: 555-555-5555</p>
    </div>
  </footer>
</body>
</html>