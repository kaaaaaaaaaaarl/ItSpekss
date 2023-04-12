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
          <button id="loginButton">Login</button>


          <php
          session_start();
          ?>
<script>
  // testēšanas poga
  var loginButton = document.getElementById('loginButton');
  loginButton.addEventListener('click', function() {
    $_SESSION['username'] = 'JohnDoe';
    $_SESSION['isLoggedIn'] = true;
    
  });
</script>

        </form>
      </div>
    </section>
  </header>
  <div class="mainPage">
    

    <div class="pnews">
      <h1>Jaunumi</h1>
      







        <?php
        $servername = "localhost:3307"; // replace with your server name
        $username = "root"; // replace with your MySQL username
        $password = ""; // replace with your MySQL password
        $dbname = "pps"; // replace with your database name
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
        $limit = 10;
      
        // query your database for the news articles
        $sql = "SELECT * FROM ziņas ORDER BY id DESC LIMIT $offset, $limit";
        $result = mysqli_query($conn, $sql);
      
        // start output buffering
        ob_start();
      
        // loop through the results and generate the HTML for each article
        while($row = mysqli_fetch_assoc($result)) {
          if (!isset($_SESSION['username'])) {
            if (isset($_POST['set_value'])) {
              $_SESSION['my_value'] = 'hello';
            }
            echo '
            <a href="pievienot.php"><button name="set_value">Set value</button></a>';
          }
          echo '<div class="item">';
          echo '<img src="https://via.placeholder.com/600x400" alt="Image 3">';
          echo  '<div class="text">';
          echo "<h2>" . $row["Tituls"] . "</h2>";
          echo "<p>" . $row["GalvenaisTeksts"] . "</p>";
          echo '</div> </div>';
          // flush the output buffer if it exceeds 1MB
          if(ob_get_length() > 1024 * 1024) {
            ob_flush();
            ob_start();
          }
        }
      
        // send the remaining output to the browser
        ob_end_flush();
      
        
        // Close the connection
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