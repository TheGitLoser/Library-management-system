<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/header.php"; ?>
<title><?php echo TITLE;?></title>
</head>

<body>
    <div class="container-scroller">
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/navbar.php"; ?>
        
        <div class="container-fluid page-body-wrapper">
            <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/sidebar.php"; ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> History
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Book Borrowed</h4>
                                    <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Borrowed Date</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Publisher Address</th>
                    <th>BookType</th>
                    <th>Published Year</th>
                    <th>Price</th>
                    <th>ISBN</th>
                    <th>Ebook</th>
                    <th>Status</th>
                </tr>
                <?php
                    // Create connection
                    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
                    // Check connection
                    if (!$conn) {
                        die("<br>Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM BookInventory b, Publisher p, Author a, BookType t, BorrowedBook bor
                            WHERE b.PubId = p.PubId AND b.AuthorId = a.AuthorId AND b.TypeId = t.TypeId
                                    AND bor.UserId = '$_SESSION[UserId]' AND bor.BookId = b.bookId
                            ORDER BY bor.BorrowDate DESC";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        ($row['Ebook']==1)?($ebook='Have Ebook'):($ebook='No Ebook');
                        ($row['Available']==1)?($Available='YES'):($Available='No');
                        echo "<tr>
                            <td>$row[BorrowDate]</td>
                            <td>$row[BookTitle]</td>
                            <td>$row[AuthorName]</td>
                            <td>$row[PubName]</td>
                            <td>$row[PubAddress]</td>
                            <td>$row[TypeName]</td>
                            <td>$row[BookPublishedYear]</td>
                            <td>$row[Price]</td>
                            <td>$row[ISBN]</td>
                            <td>$ebook</td>
                            <td>";
                            if ($row['BorrowCompleted']==0)
                                echo "<a href=\"/php/dbReturnBook.php?BorrowId=$row[BorrowId]&BookId=$row[BookId]\"><button type=\"button\" style=\"width: 100px;\">Return</button></a>";
                            else
                                echo "Returned";

                        echo "</td>
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

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Book Reserved</h4>
                                    <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Reserved Date</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Publisher Address</th>
                    <th>BookType</th>
                    <th>Published Year</th>
                    <th>Price</th>
                    <th>ISBN</th>
                    <th>Ebook</th>
                    <th>Status</th>
                </tr>
                <?php

                    // Create connection
                    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
                    // Check connection
                    if (!$conn) {
                        die("<br>Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM BookInventory b, Publisher p, Author a, BookType t, Reservation rev
                            WHERE b.PubId = p.PubId AND b.AuthorId = a.AuthorId AND b.TypeId = t.TypeId
                                    AND rev.UserId = '$_SESSION[UserId]' AND rev.BookId = b.bookId
                            ORDER BY rev.RevDate DESC";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        ($row['Ebook']==1)?($ebook='Have Ebook'):($ebook='No Ebook');
                        ($row['Available']==1)?($Available='YES'):($Available='No');
                        echo "<tr>
                            <td>$row[RevDate]</td>
                            <td>$row[BookTitle]</td>
                            <td>$row[AuthorName]</td>
                            <td>$row[PubName]</td>
                            <td>$row[PubAddress]</td>
                            <td>$row[TypeName]</td>
                            <td>$row[BookPublishedYear]</td>
                            <td>$row[Price]</td>
                            <td>$row[ISBN]</td>
                            <td>$ebook</td>
                            <td>";
                            if ($row['RevCompleted']==0){
                                $sql = "SELECT count(*) FROM Reservation rev, BorrowedBook bor
                                        WHERE rev.RevId = '$row[RevId]' AND rev.BookId = bor.bookId AND bor.BorrowCompleted = False";
                                $result = mysqli_query($conn, $sql);
                                $row2 = mysqli_fetch_assoc($result);
                                if ($row2['count(*)'] == 0){
                                    echo "<a href=\"/php/dbBorrowReservedBook.php?RevId=$row[RevId]&BookId=$row[BookId]\"><button type=\"button\" style=\"width: 100px;\">Borrow</button></a>";
                                }else{
                                    echo "wait";
                                }
                            } else
                                echo "Completed";

                        echo "</td>
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