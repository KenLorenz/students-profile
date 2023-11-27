<?php
include_once("../db.php");
include_once("../province.php");
include_once("../student.php");

$db = new Database();
$connection = $db->getConnection();
$prov = new Student($db);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chart Report</title>
        <script
            src="/js/chart.js"> // REQUIRED
        </script>
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <?php include('../templates/header.html'); ?>
        <?php include('../includes/navbar.php'); ?>

        <div class="chart_div">
           
            
            <div class="content_report">
                <h2>Gender Percentage Pie Chart</h2>
                <canvas id="gender_chart"></canvas>

                <?php
                
                $sql = "SELECT DISTINCT (SELECT count(gender) FROM students WHERE gender = 0) as Male, (SELECT count(gender) FROM students WHERE gender = 1) as Female FROM students;";
                $stmt = $db->getConnection()->prepare($sql);
                $stmt->execute();

                $total_rows = $stmt->rowCount();
                if($total_rows > 0){
                    $x = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
                    # var_dump($x); TRUE
                    $gender_data = [$x['Male'],$x['Female']];
                    $gender_label = ['Male','Female'];
                    // print_r($data); TRUE
                } else {
                    echo "No records found. Check query.";
                }
                
                $stmt->closeCursor();
                ?>
                <script defer>
                    
                    const gender_data = <?php echo json_encode($gender_data); ?>;
                    const gender_label = <?php echo json_encode($gender_label); ?>;
                    // console.debug(sql_data); TRUE
                    const config_style = {
                        labels: gender_label,
                        datasets: [{
                            data: gender_data,
                            backgroundColor: [
                                'rgb(255,165,0)',
                                'rgb(54,162,235)',
                            ],
                            hoverOffset: 4
                        }]
                        
                    };

                    const config_type = {
                        type: 'pie',
                        data: config_style,
                    };
                    const gender_chart = new Chart (
                        document.getElementById('gender_chart'),
                        config_type
                    );
                </script>
            </div>
        </div>

    </body>
</html>