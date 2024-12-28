<!--

DELETE PATIENT FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: This file removes a patient from the database given their ohip number and 
the confirmation that the user is sure they want to remove them from the database, otherwise
the patient is not deleted if the patient does not want to remove them.

-->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Delete Patient</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
  // connect to the database
  include 'connectdatabase.php';

  // check if the user chose that if they wanted to delete the patient
  if (isset($_POST['confirmDelete'])) {

    $ohip = $_POST['ohip'];

    // remove the patient from the database
    $query = 'DELETE FROM patient WHERE ohip = "' . $ohip . '"';

    if (!mysqli_query($connection, $query)) {
      echo 'deletepatient.php: Database query failed.';
    } else {
      echo 'Patient deleted.';
    }

    // check if the user chose to cancel the decision to delete the user from the database
  } else if (isset($_POST['cancelDelete'])) {
    echo 'Cancelled. Patient was not deleted.';
  } else {
    echo 'Please chose an option to confirm that you want to remove the patient or not.';
  }

  mysqli_close($connection);
  ?>

  <br><button onclick="location.href='mainmenu.php'">Main Menu</button><br>

</body>

</html>