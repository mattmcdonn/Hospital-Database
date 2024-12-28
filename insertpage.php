<!--

INSERT PAGE FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: This file takes in the user's input in order to add a new patient to
the database. It then gives this new patient info to the addpatient.php file to add
to the database.

-->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Insert Patient</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <h1>Insert New Patient</h1><br>

  <!-- Form that allows the addpatient.php file to see the new patient's info to add it to the database -->
  <form action="addpatient.php" method="post">

    <!-- Prompt the user for all the new patient's info -->
    Patient OHIP [9-digits]: <input type="text" name="ohip" pattern="\d{9}" required><br><br>
    Patient First Name: <input type="text" name="firstname" required><br><br>
    Patient Last Name: <input type="text" name="lastname" required><br><br>
    Weight (Kg) [whole number]: <input type="number" name="weight" min="1" irequired><br><br>
    Birthdate [YYYY-MM-DD]: <input type="date" name="birthdate" min="1900-01-01" required><br><br>
    Height (Meters): <input type="number" name="height" step="0.01" min="0.01" max="9.99" required><br><br>
    Patient Doctor: <select name="doctorid" required>
      <?php
      // get all the doctors from the database
      include 'getdoctors.php';
      ?>
    </select><br><br>

    <input type="submit" value="Add Patient">

  </form>

  <button onclick="location.href='mainmenu.php'">Main Menu</button><br>

</body>

</html>