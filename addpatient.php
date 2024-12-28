<!--

ADD PATIENT FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: This file handles adding the user's new patient info to the
database after being given the info from the insertpage.php.

-->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Insert Patient</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
  // connect to the database
  include 'connectdatabase.php';


  // check if all required fields for the new patient are filled out
  if (
    isset($_POST['ohip']) && isset($_POST['firstname']) && isset($_POST['lastname'])
    && isset($_POST['weight']) && isset($_POST['birthdate']) && isset($_POST['height']) && isset($_POST['doctorid'])
  ) {

    $ohip = $_POST["ohip"];
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $weight = $_POST["weight"];
    $birthdate = $_POST["birthdate"];
    $height = $_POST["height"];
    $doctorID = $_POST["doctorid"];

    // correctly format the patient height to avoid errors
    $height = number_format((float)$height, 2, '.', '');

    // check if the ohip number already exists in the database
    $ohipCheck = 'SELECT * FROM patient WHERE ohip = "' . $ohip . '"';
    $ohipCheckResult = mysqli_query($connection, $ohipCheck);

    if (!$ohipCheckResult) {
      die("addpatient.php: Database query failed.");
    }

    // check if any rows were returned after checking if any patient has the given ohip number
    if (mysqli_num_rows($ohipCheckResult) == 0) {

      // insert the new patient info
      $query = 'INSERT INTO patient (ohip, firstname, lastname, weight, birthdate, height, treatsdocid) 
      VALUES ("' . $ohip . '", "' . $firstName . '", "' . $lastName . '", ' . $weight . ', "' . $birthdate . '", ' . $height . ', "' . $doctorID . '")';

      // check if the query was sucessful
      if (!mysqli_query($connection, $query)) {
        die("addpatient.php: Database query failed.");
      } else {
        echo 'Patient added.';
      }
    } else {
      echo 'OHIP number already in use.';
    }

    mysqli_free_result($ohipCheckResult);
  } else {
    echo 'Please fill all fields before adding the patient.';
  }

  mysqli_close($connection);
  ?>

  <br><button onclick="location.href='mainmenu.php'">Main Menu</button><br>

</body>

</html>