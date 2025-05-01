<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Result</title>
  <link rel="stylesheet" href="./style.css" />
</head>
<body class="bg-[#ddefff]">
  <p class="mt-5 text-center font-sansation text-2xl font-extrabold">Status Information</p>
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
        // Checking Status
        if (empty($_GET['Search'])){
          $empty_search = true;
          echo "<p>Search String cannot be empty. Please enter a keyword to search!</p>";
        } else {
          $check_table = "SHOW TABLES LIKE 'STATUS'";
          $table_result = mysqli_query($conn, $check_table);
          if(!$table_result || mysqli_num_rows($table_result)==0){
            // No status table created
            $no_table = true;
            echo "<p>Status table is not found. Please input status first!</p>";
          } else {
            $search = mysqli_real_escape_string($conn, $_GET['Search']);
            $search_query = "
              SELECT * FROM STATUS WHERE st like '%$search%'
            ";
            $results = mysqli_query($conn, $search_query);
            // Result not found
            if(mysqli_num_rows($results)<=0){
              $not_found = true;
              echo "<p>Status, \"$search\" is not found. Please try a   different keyword!</p>";
            } else {
              // Output result 
              while($row = mysqli_fetch_assoc($results)){
                $formattedDate = date('F j, Y', strtotime($row['date']));
                echo '<div class="flex flex-col border rounded-lg shadow-md p-5 bg-white space-y-2">';
                echo "<p><strong>Status:</strong> " . htmlspecialchars($row['st']) . "</p>";
                echo "<p><strong>Status Code:</strong> " . htmlspecialchars($row['stcode']) . "</p>";
                echo "<p><strong>Share:</strong> " . htmlspecialchars($row['share']) . "</p>";
                echo "<p><strong>Date Posted:</strong> " . $formattedDate . "</p>";
                echo "<p><strong>Permission:</strong> " . htmlspecialchars($row['permissions']) . "</p>";
                echo '</div>';
              }
              
            }
          }
        }
      }
    ?>
    <!-- Change Nav buttons according to search result -->
    <div class="flex items-center">
      <?php
        if($empty_search || $not_found){
          echo '
            <a href="./searchstatusform.html" class="text-center w-1/3 mr-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Search Status Again
            </a>';
        } elseif
        ($no_table){
          echo '
            <a href="./poststatusform.php" class="text-center w-1/3 mr-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Post a new status
            </a>';
        } else {
          echo '
            <a href="./searchstatusform.html" class="text-center w-1/3 mr-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Search for another status
            </a>';
        }
      ?>
      <a href="./index.html" class="text-center w-1/3 ml-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Return to Home Page</a>
    </div>
  </div>
</body>
</html>