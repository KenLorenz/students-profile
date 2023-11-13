<?php
include_once("../db.php");
include_once("../town_city.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $db = new Database();
    $town = new TownCity($db);
    $townData = $town->read($id);

    if ($townData) {

    } else {
        echo "City not found.";
    }
} else {
    echo "Town City ID not provided.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST['town_name'],
    ];

    $db = new Database();
    $town = new TownCity($db);

    if ($town->update($id, $data)) {
        echo "Record updated successfully.";
    } else {
        echo "Failed to update the record.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Edit Town City</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2>Edit Town City Information</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $townData['id']; ?>">
        
        <label for="town_name">Town Name:</label>
        <input type="text" name="town_name" id="town_name" value="<?php echo $townData['name']; ?>">
        
        <input type="submit" value="Update">
    </form>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
