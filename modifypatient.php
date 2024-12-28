<!--

MODIFY PATIENT FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: This file modifies the given patient's weight after receiving the patients info
from the modifypage.php file.

-->

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Modify Patient</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
  // connect to the database
  include 'connectdatabase.php';
  ?>

  <h1>Modify Patient</h1><br>

  <?php

  // check if all the required fields are filled out
  if (isset($_POST['ohip']) && isset($_POST['weight']) && isset($_POST['weightType'])) {
    $ohip = $_POST["ohip"];
    $weight = $_POST["weight"];
    $weightType = $_POST["weightType"];

    // check if the patient with the given ohip number exists
    $query = 'SELECT * FROM patient WHERE ohip = "' . $ohip . '"';
    $result = mysqli_query($connection, $query);

    if (!$result) {
      die("Database query failed.");
    }

    if (mysqli_num_rows($result) == 0) {
      echo 'Patient with that ohip number does not exist.';
    } else {

      // if the weight is given pounds, store the weight as kilograms
      if ($weightType == "pounds") {
        $weight = $weight * 0.453592;
        $weight = round($weight);
      }

      // update the patient information
      $query = 'UPDATE patient SET weight = ' . $weight . ' WHERE ohip = "' . $ohip . '"';
      $result2 = mysqli_query($connection, $query);

      if (!$result2) {
        die("Database query failed.");
      } else {
        echo 'Patient weight has been updated.';
      }
    }

    mysqli_free_result($result);
  } else {
    echo 'Please ensure all fields are filled out.';
  }

  mysqli_close($connection);
  ?>

  <br><button onclick="location.href='mainmenu.php'">Main Menu</button><br>

</body>

</html>