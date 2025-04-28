<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css" />
  <title>Status Process</title>
</head>
<body>
  <?php
    require_once('../../files/sqlinfo.inc.php');
    $conn = @mysqli_connect($sql_host,
      $sql_user,
      $sql_pass,
      $sql_db
    );
    if(!$conn){
      echo "<p>Database connection failed!</p>";
    } else {

      $stcode = $_POST['stcode'];
      echo "<p>Code: $stcode</p>";
    }

  ?>
</body>
</html>
