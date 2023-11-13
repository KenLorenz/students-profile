<?php
include_once("../db.php");
include_once("../student.php");
include_once("../student_details.php");
$db = new Database();
$connection = $db->getConnection();
$student = new Student($db);
$student_details = new StudentDetails($db); # temporary

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <!-- Include the header -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2>Student Records</h2>
    <table class="orange-theme">
        <thead>
            <tr> <!-- Amalmagation of students & student_detail tables -->

                <!-- Student Table -->
                <th>Student Number</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <!-- Student Details Table -->
                <th>Contact Number</th>
                <th>Street</th>
                <th>Town City</th>
                <th>Province</th>
                <th>Zip Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- You'll need to dynamically generate these rows with data from your database -->
       
            
            
            <?php
            $studentData = $student->displayAll(); 
            
            foreach ($studentData as $x) {
            ?>
            <tr>
                <td><?php echo $x['student_number']; ?></td>
                <td><?php echo $x['first_name']; ?></td>
                <td><?php echo $x['middle_name']; ?></td>
                <td><?php echo $x['last_name']; ?></td>
                <td><?php echo $x['gender'] == 1 ? 'F' : 'M'; ?></td>
                <td><?php echo $x['birthday']; ?></td>
                

                <!-- student_details table -->

                <?php
                    $y = $student_details->studentSearch($x['id']);
                    echo "<td>". $y['contact_number'] ."</td>";
                    echo "<td>". $y['street'] ."</td>";
                    echo "<td>". $y['town_city'] ."</td>";
                    echo "<td>". $y['province'] ."</td>";
                    echo "<td>". $y['zip_code'] ."</td>";
                ?>


                <td>
                    <a href="student_edit.php?id=<?php echo $x['id']; ?>">Edit</a>
                    <br>
                    <a href="student_delete.php?id=<?php echo $x['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>

           
        </tbody>
    </table>
        
    <a class="button-link" href="student_add.php">Add New Record</a>

        </div>
        
        <!-- Include the header -->
  
    <?php include('../templates/footer.html'); ?>


    <p></p>
</body>
</html>
