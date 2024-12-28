<!--

MODIFY PAGE FILE
=================

CS3319 Assignment 3
Programmer Name: 11

Description: This file takes in user input for the patient they want to modify as well as the 
weight of the patient they want to change. They may input pounds or kilograms.

-->

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Modify Patient</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <h1>Modify Patient</h1><br>

  <!-- Form that posts the patients ohip and their new weight to the modifypatient.php file -->
  <form action="modifypatient.php" method="post">

    Patient OHIP: <input type="text" name="ohip" pattern="\d{9}" required><br>

    <h2>Modify patient weight:</h2>

    New Patient Weight [whole number]: <input type="number" name="weight" required><br><br>

    <input type="radio" name="weightType" value="pounds" required>Pounds (lbs)
    <input type="radio" name="weightType" value="kilograms">Kilograms (Kgs)<br>

    <br><input type="submit" value="Update Patient">


  </form>

  <button onclick="location.href='mainmenu.php'">Main Menu</button><br>

</body>

</html>