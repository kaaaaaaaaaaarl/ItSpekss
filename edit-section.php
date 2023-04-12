<?php
// fetch the original section content from the database
$sql = "SELECT * FROM section_content WHERE id = 1"; // replace 1 with the actual section ID
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// display the edit form with the current section content
echo '<form method="post">';
echo "<label>Title:</label><br>";
echo "<input type='text' name='title' value='{$row['title']}'><br>";
echo "<label>Content:</label><br>";
echo "<textarea name='content'>{$row['content']}</textarea><br>";
echo '<button type="submit">Save Changes</button>';
echo '</form>';

// update the original section content table and insert a new row into the change log table
if (isset($_POST['title']) && isset($_POST['content'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $sectionId = 1; // replace 1 with the actual section ID

  // update the original section content
  $sql = "UPDATE section_content SET title = '$title', content = '$content' WHERE id = $sectionId";
  mysqli_query($conn, $sql);

  // insert a new row into the change log
  $sql = "INSERT INTO section_changes (section_id, title, content) VALUES ($sectionId, '$title', '$content')";
  mysqli_query($conn, $sql);
}
?>