<!--

GET NURSE INFO FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: This file displays a nurse's information given their nurse ID, as well as displaying
the number of hours they have worked for each doctor they work for, and displaying their total
number of hours worked and their supervisor's name.

-->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Nurse Information</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
  // connect to the database
  include 'connectdatabase.php';
  ?>

  <h1>Nurse Information</h1><br>

  <?php

  // check if the user selected a nurse
  if (isset($_POST['nurseid'])) {

    $nurseid = $_POST["nurseid"];

    // get the nurses firstname, lastname, and nurse ID
    $query = 'SELECT nurse.firstname, nurse.lastname FROM nurse WHERE nurse.nurseid = "' . $nurseid . '"';

    $result = mysqli_query($connection, $query);

    if (!$result) {
      die("Database query failed.");
    }

    $row = mysqli_fetch_assoc($result);

    echo '<h3>';
    echo 'Nurse: ' . $row["firstname"] . ' ' . $row["lastname"];
    echo '</h3>';


    // get the doctors the nurse works for and the number of hours they worked for the doctor
    $query = 'SELECT doctor.firstname, doctor.lastname, workingfor.hours 
    FROM workingfor INNER JOIN doctor ON workingfor.docid=doctor.docid WHERE workingfor.nurseid = "' . $nurseid . '"';

    $result = mysqli_query($connection, $query);

    if (!$result) {
      die("Database query failed.");
    }

    // keep track of the total number of hours the nurse worked for all the doctors
    $totalHours = 0;
    echo '<ul>';

    // list all doctors and the total number of hours worked for them
    while ($row = mysqli_fetch_assoc($result)) {

      echo '<li>';
      echo 'Doctor: ' . $row["firstname"] . ' ' . $row["lastname"] . ' (Hours worked for doctor: ' . $row["hours"] . ')';
      echo '</li>';
      $totalHours += $row["hours"];
    }

    echo '</ul><br>';
    // display the total number of hours the nurse has worked
    echo 'Total hours worked: ' . $totalHours . ' hours<br>';


    // get the nurse's supervisor name
    $query = 'SELECT nurse.firstname, nurse.lastname FROM nurse WHERE nurse.nurseid IN 
    (SELECT reporttonurseid FROM nurse WHERE nurse.nurseid = "' . $nurseid . '")';

    $result = mysqli_query($connection, $query);

    if (!$result) {
      die("Database query failed.");
    }

    if (mysqli_num_rows($result) == 0) {
      echo 'This nurse has no supervisor.';
    } else {
      $row = mysqli_fetch_assoc($result);
      echo 'Nurse supervisor: ' . $row["firstname"] . ' ' . $row["lastname"];
    }

    mysqli_free_result($result);
  } else {
    echo 'Field empty. Please type a Nurse ID.';
  }

  mysqli_close($connection);
  ?>

  <br><button onclick="location.href='mainmenu.php'">Main Menu</button><br>

</body>

</html>