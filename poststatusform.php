<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css" />
  <title>Post Status</title>
</head>
<body class="bg-gray-200">
  <?php date_default_timezone_set("Pacific/Auckland") ?>
  <p class="mt-3 text-center font-sansation text-2xl font-bold">Status Posting System</p>
  <form action="./poststatusprocess.php" method="post">
    <div class="font-lato m-10 md:mx-auto md:max-w-2xl flex flex-col space-y-5">
      <div class="flex items-center mr-5">
        <label for="code" class="mr-4 w-1/3">Status Code: </label>
        <input type="text" name="stcode" required pattern="^S\d{4}$"
          title="Status code must start with 'S' followed by 4 digits (e.g., S0001)"
          class="border-2 rounded-lg p-1 w-2/3" />
      </div>
      <div class="flex items-center mr-5">
        <label for="status" class="mr-4 w-1/3">Status: </label>
        <input type="text" name="st" required pattern="^(?!\s*$)[a-zA-Z0-9,.!? ]+$"
          title="Status can only contain alphanumericals, comma, period, exclamation mark, and question mark. Cannot be empty or just space."
          class="border-2 rounded-lg p-1 w-2/3" />
      </div>

      <div class="flex items-center mr-5">
        <label for="share" class="mr-4 w-1/3">Share: </label>
        <div class="flex justify-between w-2/3">
          <label>
            <input type="radio" name="share" value="University" required />
            University
          </label>
          <label>
            <input type="radio" name="share" value="Class" required />
            Class
          </label>
          <label>
            <input type="radio" name="share" value="Private" required />
            Private
          </label>
        </div>
      </div>

      <div class="flex items-center mr-5">
        <label for="date" class="mr-4 w-1/3">Date: </label>
        <input type="date" name="date" required
          class="border-2 rounded-lg p-1 w-2/3" value="<?php echo date('Y-m-d');?>"/>
      </div>

      <div class="flex items-center mr-5">
        <label for="share" class="mr-4 w-1/3">Share: </label>
        <div class="flex justify-between w-2/3">
          <label>
            <input type="checkbox" name="permission" value="like"/>
            Allow Like
          </label>
          <label>
            <input type="checkbox" name="permission" value="comment"/>
            Allow Comments
          </label>
          <label>
            <input type="checkbox" name="permission" value="share"/>
            Allow Share
          </label> 
        </div>
    </div>

    <div class="flex items-center mr-5">
      <button type="submit" class="w-1/3 mr-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Submit</button>
      <a href="./index.html" class="text-center w-1/3 ml-auto border-1 rounded-xl shadow-2xs p-2 border-black bg-amber-100 hover:scale-110 font-lato hover:font-bold  hover:text-blue-800">Return to Home Page</a>
    </div>
  </form>
  
</body>
</html>