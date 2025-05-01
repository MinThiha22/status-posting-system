<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Database</title>
  <link rel="stylesheet" href="./style.css" />
</head>
<body class="bg-[#ddefff]">
  <p class="mt-5 text-center font-sansation text-2xl font-extrabold">Reset Database</p>
  <div class="font-lato m-5 md:mx-auto md:max-w-3xl flex flex-col space-y-5 border-2 rounded-xl shadow-xl p-10">
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
        // Drop table
        $drop_query = "DROP TABLE IF EXISTS STATUS";
        $result = mysqli_query($conn, $drop_query);
        if($result){
          echo "<p>Status table is dropped successfully!</p>";
        } else {
          echo "<p>Failed to reset table!" . mysqli_error($conn) ."</p>";
        }
        
      }
      
    ?>
    <!-- Navigation buttons -->
    <div class="flex items-center">
      <a href="./about.html" class="text-center w-1/3 mr-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Back to About Assignment</a>
      <a href="./index.html" class="text-center w-1/3 ml-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Return to Home Page</a>
    </div>
  </div>
</body>
</html>