<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    $bookId = $_GET["BookId"] ;
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }

    //insert sql
    $sql = "UPDATE BookInventory SET
                BookTitle='$_POST[bookTitle]',
                BookPublishedYear='$_POST[publishedYear]',
                Price='$_POST[price]',
                ISBN='$_POST[isbn]',
                Ebook=$_POST[ebook] WHERE BookId='$bookId'";

    if (mysqli_query($conn, $sql)) {
        #Publisher
            $sql = "SELECT count(*), PubId FROM Publisher WHERE PubName='$_POST[publisherName]' AND PubAddress='$_POST[publisherAddress]'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            //exists publisher
            if($row["count(*)"] >= 1){
                $sql = "UPDATE BookInventory SET PubId='$row[PubId]' WHERE BookId = '$bookId'";
                mysqli_query($conn, $sql);
            }else{  //new publisher
                $sql = "INSERT INTO Publisher (PubName, PubAddress) VALUES
                        ('$_POST[publisherName]','$_POST[publisherAddress]')";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error updating record: " . mysqli_error($conn);
                    mysqli_close($conn);
                    echo "<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('Unsuccesful updated book.');
                            window.location.href='javascript:history.back()';
                            </SCRIPT>";
                }
                $sql = "SELECT PubId FROM Publisher WHERE PubName='$_POST[publisherName]' AND PubAddress='$_POST[publisherAddress]'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $sql = "UPDATE BookInventory SET PubId='$row[PubId]' WHERE BookId = '$bookId'";
                mysqli_query($conn, $sql);
            }

        #Author
            $sql = "SELECT count(*), AuthorId FROM Author WHERE AuthorName='$_POST[authorName]'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            //exists author
            if($row["count(*)"] >= 1){
                $sql = "UPDATE BookInventory SET AuthorId='$row[AuthorId]' WHERE BookId = '$bookId'";
                mysqli_query($conn, $sql);
            }else{  //new author
                $sql = "INSERT INTO Author (AuthorName) VALUES ('$_POST[authorName]')";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error updating record: " . mysqli_error($conn);
                    mysqli_close($conn);
                    echo "<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('Unsuccesful updated book.');
                            window.location.href='javascript:history.back()';
                            </SCRIPT>";
                }
                $sql = "SELECT AuthorId FROM Author WHERE AuthorName='$_POST[authorName]'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $sql = "UPDATE BookInventory SET AuthorId='$row[AuthorId]' WHERE BookId = '$bookId'";
                mysqli_query($conn, $sql);
            }

        #BookType
            $sql = "SELECT count(*), TypeId FROM BookType WHERE TypeName='$_POST[type]'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            //exists BookType
            if($row["count(*)"] >= 1){
                $sql = "UPDATE BookInventory SET TypeId='$row[TypeId]' WHERE BookId = '$bookId'";
                mysqli_query($conn, $sql);
            }else{  //new BookType
                $sql = "INSERT INTO BookType (TypeName) VALUES ('$_POST[type]')";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error updating record: " . mysqli_error($conn);
                    mysqli_close($conn);
                    echo "<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('Unsuccesful updated book.');
                            window.location.href='javascript:history.back()';
                            </SCRIPT>";
                }
                $sql = "SELECT TypeId FROM BookType WHERE TypeName='$_POST[type]'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $sql = "UPDATE BookInventory SET TypeId='$row[TypeId]' WHERE BookId = '$bookId'";
                mysqli_query($conn, $sql);
            }

        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Succesfully updated book.');
                window.location.href='/pages/admin/manageBook.php';
                </SCRIPT>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful updated book.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }
?>
