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
           
            
            <div class="content_report_bd">
                <h2>Birthday Chart</h2>
                <canvas id="birthday_chart"></canvas>

                <?php
                
                $sql = "select date_format(birthday, '%M') as month, count(date_format(birthday, '%M')) as student_qty from students group by month;";
                $stmt = $db->getConnection()->prepare($sql);
                $stmt->execute();

                $total_rows = $stmt->rowCount();
                if($total_rows > 0){
                    
                    $bd_data = array();
                    $bd_label = array();
                
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $x){
                        $bd_data[] = $x['student_qty'];
                        $bd_label[] = $x['month'];

                    }
                } else {
                    echo "No records found. Check query.";
                }
                
                $stmt->closeCursor();
                ?>
                <script defer>
                    
                    const bd_data = <?php echo json_encode($bd_data); ?>;
                    const bd_label = <?php echo json_encode($bd_label); ?>;

                    const config_style = {
                        labels: bd_label,
                        datasets: [{
                            //label:
                            data: bd_data,
                            backgroundColor: [
                                'rgb(255,165,0)',
                                'rgb(54,162,235)',
                            ],
                            hoverOffset: 4
                        }]
                        
                    };

                    const config_type = {
                        type: 'bar',
                        data: config_style,
                        options: {
                            plugins:{
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    };
                    const birthday_chart = new Chart (
                        document.getElementById('birthday_chart'),
                        config_type
                    );
                </script>
            </div>
        </div>

    </body>
</html>