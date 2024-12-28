<!--

GET PATIENTS FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: This file retrieves and displays all patient's data from the database
sorted and in the order that was specified by the user in the patientlistpage.php file.

-->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Patient List</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
  // connect to the database
  include 'connectdatabase.php';
  ?>

  <h1>Patient List</h1><br>

  <?php

  // check if the user selected an option for both required fields 
  if (isset($_POST['orderby']) && isset($_POST['ordertype'])) {

    $orderBy = $_POST["orderby"];
    $orderType = $_POST["ordertype"];

    // get all the patient data in the file ordered and sorted by the user's preferences
    $query = 'SELECT patient.*, doctor.firstname AS doctor_firstname, doctor.lastname AS doctor_lastname FROM patient
      JOIN doctor ON patient.treatsdocid = doctor.docid
      ORDER BY patient.' . $orderBy . ' ' . $orderType;

    $result = mysqli_query($connection, $query);

    if (!$result) {
      die("getpatients.php: Database query failed.");
    }

    // loop through each row of the result and display the patient and their information
    while ($row = mysqli_fetch_assoc($result)) {

      // get the patient's weight in pounds
      $patientInPounds = round($row["weight"] * 2.20462);

      // get the patient's height in feet and inches
      $heightInFeet = $row["height"] * 3.28084;
      $patientFeet = floor($heightInFeet);
      $patientInches = round(($heightInFeet - $patientFeet) * 12);

      echo '<h3>Patient: ' . $row["firstname"] . ' ' . $row["lastname"] . '</h3><br>';
      echo '<ul>';
      echo '<li>OHIP number: ' . $row["ohip"] . '</li><br>';
      echo '<li>Weight: ' . $row["weight"] . ' kg (' . $patientInPounds . ' lbs)' . '</li><br>';
      echo '<li>Height: ' . $row["height"] . ' m (' . $patientFeet . ' ft ' . $patientInches . ' inches)' . '</li><br>';
      echo '<li>Birthdate: ' . $row["birthdate"] . '</li><br>';
      echo '<li>Patient doctor: ' . $row["doctor_firstname"] . ' ' . $row["doctor_lastname"] . '</li><br>';
      echo '</ul>';
    }

    mysqli_free_result($result);
  } else {
    echo 'Please fill out all required fields.';
  }
  ?>

  <?php
  // close connection to the database
  mysqli_close($connection);
  ?>

  <br><button onclick="location.href='mainmenu.php'">Main Menu</button><br>

</body>

</html>