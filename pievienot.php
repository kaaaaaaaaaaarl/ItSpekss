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

<div class="container">
    <?php
        
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $servername = "localhost:3307";
        $username = "root";
        $password = ""; 
        $dbname = "pps"; 
        $conn = mysqli_connect($servername, $username, $password, $dbname);
       if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $edit= $_GET['Edit'];
        $VorZ= $_GET['VVZ'];
      
        if($edit=='E'){
          if($VorZ=='Z'){
        if(isset($_GET['id'])){
        $id= $_GET['id'];}

       $sql = "SELECT * FROM ziņas WHERE id in ($id)";
        $result = mysqli_query($conn, $sql);

        ob_start();
        while($row = mysqli_fetch_assoc($result)) {
          $title=$row['Tituls'];
          $mainText = $row['GalvenaisTeksts'];
          $sources= $row['Avoti'];
          

        }}else if($VorZ=='V'){
          
          if(isset($_GET['id'])){
            $id= $_GET['id'];}
    
            $sql = "SELECT * FROM vakances WHERE id in ($id)";
            $result = mysqli_query($conn, $sql);
            ob_start();
            while($row = mysqli_fetch_assoc($result)) {
              $title=$row['Tituls'];
              $mainText = $row['GalvenaisTeksts'];
              $sources= $row['Avoti'];
              if($row['Piejamība']==true){
                $piejamiba=true;
              }else{
                $piejamiba=false;
              }
            }

        }
      
      }else{
          $title = $mainText= $sources= "";
        }
    ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">
<div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
    </div>
    <div class="form-group">
        <label for="main-text">Main Text:</label>
        <textarea class="form-control" id="main-text" name="main-text" rows="10" required><?php echo $mainText; ?></textarea>
    </div>
    <div class="form-group">
        <label for="sources">Sources:</label>
        <input type="text" class="form-control" id="sources" name="sources" value="<?php echo $sources; ?>" required>
    </div>
    <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control-file" id="photo" name="photo">
    </div>
      <?php
      if($edit=='E'){
      if($VorZ=='V'){
       echo '<div class="form-group">';
       echo ' <label for="photo">Piejama:</label>';
       if($piejamiba==true){
        echo ' <input type="checkbox" class="form-control-file"  name="Piejams" checked="wtgyusevb" >';
       }else{
       echo ' <input type="checkbox" class="form-control-file"  name="Piejams">';}
       echo ' </div>';
      }}
      ?>

    <input type="submit" name="EditOrPost" class="btn btn-primary" value="Submit"></input>
</form>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['EditOrPost'])) {

  if($edit=='E'){
<<<<<<< HEAD
    
=======
    if($VorZ=='Z'){
      $newtitle=$_POST['title'];
      $newsources=$_POST['sources'];
      $newmaintext= $_POST['main-text'];
      
    $sql = "UPDATE ziņas SET Tituls='$newtitle', Avoti='$newsources', GalvenaisTeksts='$newmaintext' WHERE id in ($id)";

    if ($conn->query($sql) === TRUE) {
      header("Refresh:0");
    } else {
      echo "Error updating record: " . $conn->error;
    }
$conn->close();
    }  
}else if($VorZ=='V'){
  $newtitle=$_POST['title'];
  $newsources=$_POST['sources'];
  $newmaintext= $_POST['main-text'];
  
  if(Piejams == 'checked')
{
  $sql = "UPDATE vakances SET Tituls='$newtitle', Avoti='$newsources', GalvenaisTeksts='$newmaintext' piejamiba=true WHERE id in ($id)";
}else{
$sql = "UPDATE vakances SET Tituls='$newtitle', Avoti='$newsources', GalvenaisTeksts='$newmaintext' piejamiba=false WHERE id in ($id)";
}
if ($conn->query($sql) === TRUE) {
  header("Refresh:0");
} else {
  echo "Error updating record: " . $conn->error;
}
$conn->close();
}  
else if($edit=='C'){
  if($VorZ=='Z'){
    $newtitle=$_POST['title'];
    $newsources=$_POST['sources'];
    $newmaintext= $_POST['main-text'];

  $sql = "INSERT INTO ziņas (id, Tituls, Avoti, GalvenaisTeksts, VeidotājaLietotājvārds, AdminID, FotoID)
  VALUES ((SELECT COUNT(*)), '$newtitle', '$newsources', '$newmaintext', 'fake', 1, 1);";
  if ($conn->query($sql) === TRUE) {

    header("Refresh:0");
  } else {
    echo "Error updating record: " . $conn->error;
>>>>>>> 8692edef70bb06bf35ba9014561f8f8e95fb47fc
  }
$conn->close();
    
  
  }else if($VorZ=='V'){
    $newtitle=$_POST['title'];
    $newsources=$_POST['sources'];
    $newmaintext= $_POST['main-text'];

  $sql = "INSERT INTO Vakances (id, Tituls, Avoti, GalvenaisTeksts, VeidotājaLietotājvārds, AdminID, FotoID, piejamība)
  VALUES ((SELECT COUNT(*)), '$newtitle', '$newsources', '$newmaintext', 'fake', 1, 1, true);";
  if ($conn->query($sql) === TRUE) {

    header("Refresh:0");
  } else {
    echo "Error updating record: " . $conn->error;
  }
$conn->close();
    


  }
}
}
?>

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