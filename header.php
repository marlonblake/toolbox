<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Toolbox</title>
        <link rel="icon" type="image/x-icon" href="toolbox.ico">
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php require("connection.php"); ?>

<!-- page common header -->
<div class="header">
  <!-- logo -->
  <a href="index.php" class="logo">TOOLBOX</a>
  <!-- search bar -->
  <div class="searchBar">
    <form action="search.php" method="GET">
      <input type="text" placeholder="Search in items" id="search" name="search" required>
      <button type="submit">Search</button>
    </form>
  </div>
</div>
<!-- navigation bar -->
<div class="nav">
  <a href="index.php">Home</a>
  <a href="insert.php">Add Item</a>
</div> 

    <script src="script.js"></script>

</body>
</html>