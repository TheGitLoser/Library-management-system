<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    $UserId = $_SESSION["UserId"] ;
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
                            </span> User management
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Registered user</h4>
                                    <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Login Id</th>
                    <th>Guardian Name</th>
                    <th>Date of Birth</th>
                    <th>phone 1</th>
                    <th>phone 2</th>
                    <th>E-mail</th>
                    <th>Gender</th>
                    <th>Total Borrowed</th>
                    <th>Joining Date</th>
                    <th>Address</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>

                <?php
                    // Create connection
                    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
                    // Check connection
                    if (!$conn) {
                        die("<br>Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM Login l, User u WHERE l.UserId = u.UserId AND l.UserType='user'
                            ORDER BY u.UserFirstName";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                            <td>$row[UserFirstName]</td>
                            <td>$row[UserLastName]</td>
                            <td>$row[UserLoginId]</td>
                            <td>$row[UserGuardianName]</td>
                            <td>$row[UserDateOfBirth]</td>
                            <td>$row[UserPhone1]</td>
                            <td>$row[UserPhone2]</td>
                            <td>$row[UserEmail]</td>
                            <td>$row[UserGender]</td>
                            <td>$row[UserTotalBorrow]</td>
                            <td>$row[UserJoiningDate]</td>
                            <td>$row[UserAddress]</td>
                            <td>
                                <a href=\"/pages/admin/updateUser.php?UserId=$row[UserId]\"><button type=\"button\" style=\"width: 100px;\">Update</button></a>
                            </td>
                            <td>
                                <a href=\"/php/dbDeleteUser.php?UserId=$row[UserId]\"><button type=\"button\" style=\"width: 100px;\">Delete</button></a>
                            </td>
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