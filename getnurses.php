<!--

GET NURSES FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: Gets all nurses from the database and makes them options for the findnursepage.php file
when the user wants to get information for a nurse.

-->

<?php
// connect to the database
include 'connectdatabase.php';
?>

<?php

// get all nurses's nurse ID, and first and last name
$query = 'SELECT nurse.nurseid, nurse.firstname, nurse.lastname FROM nurse';
$result = mysqli_query($connection, $query);

if (!$result) {
  die("Database query failed.");
}

// make each nurse a select option
while ($row = mysqli_fetch_assoc($result)) {
  echo '<option value="' . $row["nurseid"] . '">' . $row["firstname"] . ' ' . $row["lastname"] . '</option>';
}

mysqli_free_result($result);
?>

<?php
mysqli_close($connection);
?>