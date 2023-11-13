<?php
include_once("../db.php");
include_once("../town_city.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [    
    'name' => $_POST['town_name']
    ];

    $db = new Database();
    $town = new TownCity($db);
    $townData = $town->create($data);
    if($townData){
        echo "add successful.";
    } else {
        echo "add unsuccessful.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>Add Town City Data</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h1>Add Town City Data</h1>
    <form action="" method="post" class="centered-form">

        <label for="town_name">Name:</label>
        <input type="text" name="town_name" id="town_name" required>

        <input type="submit" value="Add Town City">
    </form>
    </div>
    
    <?php include('../templates/footer.html'); ?>
</body>
</html>
