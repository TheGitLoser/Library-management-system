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
                            </span> Book management
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Books in library</h4>
                                    <div class="table-responsive">
                <table  class="table">
                <tr>
                    <th>Book Title</th>
                    <th>Author Name</th>
                    <th>Publisher Name</th>
                    <th>Publisher Address</th>
                    <th>Book Type</th>
                    <th>Book Published Year</th>
                    <th>Price</th>
                    <th>ISBN</th>
                    <th>E-Book</th>
                    <th>Available</th>
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

                    $sql = "SELECT * FROM BookInventory b, Publisher p, Author a, BookType t WHERE b.PubId = p.PubId AND b.AuthorId = a.AuthorId AND b.TypeId = t.TypeId
                                ORDER BY b.BookTitle";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)){
                        ($row['Ebook']==1)?($ebook='Have Ebook'):($ebook='No Ebook');
                        ($row['Available']==1)?($Available='YES'):($Available='No');
                        echo "<tr>
                            <td>$row[BookTitle]</td>
                            <td>$row[AuthorName]</td>
                            <td>$row[PubName]</td>
                            <td>$row[PubAddress]</td>
                            <td>$row[TypeName]</td>
                            <td>$row[BookPublishedYear]</td>
                            <td>$row[Price]</td>
                            <td>$row[ISBN]</td>
                            <td>$ebook</td>
                            <td>$Available</td>
                            <td>
                                <a href=\"/pages/admin/updateBook.php?BookId=$row[BookId]\"><button type=\"button\" style=\"width: 100px;\">Update</button></a>
                            </td>
                            <td>
                                <a href=\"/php/dbDeleteBook.php?BookId=$row[BookId]\"><button type=\"button\" style=\"width: 100px;\">Delete</button></a>
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