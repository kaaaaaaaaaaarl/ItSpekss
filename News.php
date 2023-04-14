<?php
session_start();
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
<php
  session_start();
?>
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
          <form class="form2" method="post">
            <label for="username">Lietotajvārds:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Parole:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Submit" name="Submit">
            <input type="submit" value="Logout" name="Logout">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Submit'])){
            require("connect_db.php");
            $lietotajvards = $_POST['username'];
            $parole = $_POST['password'];
            $sql = "SELECT * FROM admin WHERE Lietotājvārds = '$lietotajvards' AND Parole = '$parole' ";
            $result = $savienojums-> query($sql);
            if($result->num_rows > 0){
              $_SESSION['user'] = $lietotajvards;
            }else{
              echo "Nepareiz lietotajvards vai parole!";
            }}
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Logout'])){
              if(isset($_SESSION['user'] )){
                unset($_SESSION['user']);
              }else{
                echo "tu neesi ielogojies";
              }
            }
            ?>
          </form>
        </div>
      </section>
  </header>
  <div class="mainPage">
    

    <div class="pnews">
      <h1>Jaunumi</h1>
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
      
        // start output buffering
        ob_start();
        if (isset($_SESSION['user'])) {
          echo  '<a href="pievienot.php?VVZ=Z&Edit=C"> <button name="Edit">Add</button></a>';
          }
        // loop through the results and generate the HTML for each article
        while($row = mysqli_fetch_assoc($result)) {
          if (isset($_SESSION['user'])) {
            $id = $row['ID'];
            echo  '<a href="pievienot.php?id='. $id .'&VVZ=Z&Edit=E"> <button name="Edit">Edit</button></a>';
            }
        
          echo '<div class="item">';
          echo '<img src="https://via.placeholder.com/600x400" alt="Image 3">';
          echo  '<div class="text">';
          echo "<h2>" . $row["Tituls"] . "</h2>";
          echo "<p>" . $row["GalvenaisTeksts"] . "</p>";
          echo '</div> </div>';
          if(ob_get_length() > 1024 * 1024) {
            ob_flush();
            ob_start();
          }
        }

        ob_end_flush();

        mysqli_close($conn);
        ?>
        </div>
      </div>
      
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
      <p>E-pasts: ITspeks@gmail.com</p>
      <p>Telefon Nummurs: 555-555-5555</p>
    </div>
  </footer>
</body>
</html>