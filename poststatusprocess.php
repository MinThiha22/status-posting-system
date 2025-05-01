<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css" />
  <title>Process Status</title>
</head>
<body class="bg-[#ddefff]">
  <div class="font-lato m-5 md:mx-auto md:max-w-3xl flex flex-col space-y-5 border-2 rounded-xl shadow-xl p-10">
    <p class="text-center font-sansation text-2xl font-extrabold">Processing status . . .</p>
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
        $create_table_query = "
        CREATE TABLE IF NOT EXISTS STATUS (
          stcode VARCHAR(5) PRIMARY KEY,
          st TEXT,
          share VARCHAR(10) NOT NULL,
          date DATE NOT NULL,
          permissions VARCHAR(60)
        );";

        echo (mysqli_query($conn,$create_table_query)) ?
          "<p>Status table is ready in database!</p>" :
          "<p>Something wrong!" . mysqli_error($conn) . "</p>";
        
        // Validating input data
        $valid_inputs = true;

        // Checking Status Code
        if (empty($_POST['stcode'])){
          $valid_inputs = false;
          echo "<p>Status code cannot be empty</p>";
        } elseif(!preg_match("/^S\d{4}$/",$_POST['stcode'])){
          $valid_inputs = false;
          echo "<p>Wrong Format! Status code must start with 'S' followed by 4 digits (e.g., S0001)</p>";
        } else {
          $stcode = mysqli_real_escape_string($conn, $_POST['stcode']); // 
          $unique_stcode_check = "
            SELECT stcode FROM STATUS WHERE stcode = '$stcode'
          ";
          $result = mysqli_query($conn, $unique_stcode_check); 
          if (mysqli_num_rows($result) > 0) {
            $valid_inputs = false;
            echo "<p>Status code '$stcode' already exists in the database. Please use a different code.</p>";
          }
        }

        // Checking Status
        if (empty($_POST['st'])){
          $valid_inputs = false;
          echo "<p>Status cannot be empty</p>";
        } elseif(!preg_match("/^(?!\s*$)[a-zA-Z0-9,.!? ]+$/",$_POST['st'])){
          $valid_inputs = false;
          echo "<p>Wrong Format! Status can only contain alphabets, numbers, spaces, comma, period, exclamation point and question mark and cannot be blank or just space! </p>";
        }

        // Checking Date
        if (empty($_POST['date'])){
          $valid_inputs = false;
          echo "<p>Date cannot be empty</p>";
        } else {
          $date = mysqli_real_escape_string($conn, $_POST['date']);
          $date_parts = explode('-',$full_date);
          $year = (int)$date_parts[0];
          $month = (int)$date_parts[1];
          $day = (int)$date_parts[2];
          if(checkdate($month,$day,$year)){
            $valid_inputs = false;
            echo "<p>Wrong date format! Date shoud be in dd/mm/yyyy.</p>";
          }
        }

        // If all inputs are vaild, insert to database
        if($valid_inputs){
          $stcode = mysqli_real_escape_string($conn, $_POST['stcode']);
          $status = mysqli_real_escape_string($conn, $_POST['st']);
          $share = mysqli_real_escape_string($conn, $_POST['share']);
          $date = mysqli_real_escape_string($conn, $_POST['date']);
          $permissions = mysqli_real_escape_string($conn, implode(", ",$_POST['permissions']));
          $upload_query = "
            INSERT INTO STATUS (stcode, st, share, date, permissions)
            VALUES ('$stcode', '$status', '$share', '$date', '$permissions')
          ";
          if (mysqli_query($conn, $upload_query)) {
            echo '<p class="text-green-700 font-extrabold">Congratulations! The status has been posted and stored in the database.</p>';
          } else {
            echo "<p>Error inserting data: " . mysqli_error($conn) . "</p>";
          }
        } else {
          echo '<p class="text-red-500 text-lg font-extrabold">Some or all inputs are not valid, Please Try Again!</p>';
        }
      }
    ?>
    <!-- Nav buttons -->
    <div class="flex items-center">
      <a href="./poststatusform.php" class="text-center w-1/3 mr-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Post New Status</a>
      <a href="./index.html" class="text-center w-1/3 ml-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Return to Home Page</a>
    </div>
  </div>
</body>
</html>
