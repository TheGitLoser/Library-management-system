<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT count(*) FROM User";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $member = $row["count(*)"];

    $sql = "SELECT count(*) FROM BookInventory";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $book = $row["count(*)"];

    $sql = "SELECT count(*) FROM message";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $message = $row["count(*)"];
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/header.php"; ?>
    <title><?php echo TITLE;?></title>
</head>

<body>
    <div class="container-scroller">
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/adminNavbar.php"; ?>
        
        <div class="container-fluid page-body-wrapper">
            <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/adminSidebar.php"; ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> Admin Dashboard
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-danger card-img-holder text-white">
                                <div class="card-body">
                                    <img src="/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Number of Members <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5"><?php echo "<td>".$member."</td>";?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <img src="/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Number of Books <i
                                            class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5"><?php echo "<td>".$book."</td>";?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-success card-img-holder text-white">
                                <div class="card-body">
                                    <img src="/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Number of Message <i class="mdi mdi-diamond mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5"><?php echo "<td>".$message."</td>";?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Message broad </h4>
                                    <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Date</th>
                    <th>Message</th>
                </tr>
                <?php
                    // Create connection
                    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
                    // Check connection
                    if (!$conn) {
                        die("<br>Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM message ORDER BY MessageId DESC";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                            <td>$row[MessageDate]</td>
                            <td>$row[Message]</td>
                            </tr>";
                    }
                    mysqli_close($conn);
                 ?>

            </table>
            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/footer.php"; ?>
                
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/endScript.php"; ?>
</body>

</html>