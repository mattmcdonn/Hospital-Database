<!--

GET DOCTORS FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: Gets all doctors from the database and makes them options for the insertpage.php file
when the user wants to select which doctor to assign to the new patient.

-->

<?php
// connect to the database
include 'connectdatabase.php';
?>

<?php

// get all doctor's doctor ID, and first and last name
$query = 'SELECT doctor.docid, doctor.firstname, doctor.lastname FROM doctor';
$result = mysqli_query($connection, $query);

if (!$result) {
  die("Database query failed.");
}

// make each doctor a select option
while ($row = mysqli_fetch_assoc($result)) {
  echo '<option value="' . $row["docid"] . '">' . $row["firstname"] . ' ' . $row["lastname"] . '</option>';
}

mysqli_free_result($result);
?>

<?php
mysqli_close($connection);
?>