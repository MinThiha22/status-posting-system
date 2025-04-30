<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css" />
  <title>Post Status</title>
</head>
<body class="bg-[#ddefff]">
  <?php date_default_timezone_set("Pacific/Auckland") ?>

  <p class="mt-5 text-center font-sansation text-2xl font-extrabold">Status Posting System</p>

  <!-- Status Form -->
  <form action="./poststatusprocess.php" method="post">
    <div class="font-lato m-5 md:mx-auto md:max-w-3xl flex flex-col space-y-5 border-2 rounded-xl shadow-xl p-10">
      <div class="flex items-center">
        <label for="code" class="mr-5 w-1/4">Status Code: </label>
        <input type="text" name="stcode" 
          title="Status code must start with 'S' followed by 4 digits (e.g., S0001)"
          class="border-2 rounded-lg p-1 flex-1" />
      </div>
      <div class="flex items-center">
        <label for="status" class="mr-5 w-1/4">Status: </label>
        <input type="text" name="st" 
          title="Status can only contain alphanumericals, comma, period, exclamation mark, and question mark. Cannot be empty or just space."
          class="border-2 rounded-lg p-1 flex-1" />
      </div>

      <div class="flex items-center">
        <label for="share" class="mr-5 w-1/4">Share: </label>
        <div class="flex justify-between flex-1">
          <label>
            <input type="radio" name="share" value="University"/>
            University
          </label>
          <label>
            <input type="radio" name="share" value="Class"/>
            Class
          </label>
          <label>
            <input type="radio" name="share" value="Private"/>
            Private
          </label>
        </div>
      </div>

      <div class="flex items-center">
        <label for="date" class="mr-5 w-1/4">Date: </label>
        <input type="date" name="date" required
          class="border-2 rounded-lg p-1 flex-1" value="<?php echo date('Y-m-d');?>"/>
      </div>

      <div class="flex items-center">
        <label for="share" class="mr-5 w-1/4">Share: </label>
        <div class="flex justify-between flex-1">
          <label>
            <input type="checkbox" name="permissions[]" value="Allow Like"/>
            Allow Like
          </label>
          <label>
            <input type="checkbox" name="permissions[]" value="Allow Comment"/>
            Allow Comments
          </label>
          <label>
            <input type="checkbox" name="permissions[]" value="Allow Share"/>
            Allow Share
          </label> 
        </div>
      </div>
      
      <div class="flex items-center">
        <button type="submit" class="w-1/3 mr-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Submit</button>
        <a href="./index.html" class="text-center w-1/3 ml-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Return to Home Page</a>
      </div>
    </div> 
  </form>
  
</body>
</html>