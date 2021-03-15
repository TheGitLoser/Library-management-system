<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    #Create Table
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }

    //check duplicate
    $sql = "SELECT count(*) FROM BookInventory WHERE ISBN = '$_POST[isbn]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row["count(*)"] >= 1) {
        echo"<br>This book already exists";
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('This book already exists.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }

    //insert sql
    $sql = "INSERT INTO BookInventory (BookTitle, BookPublishedYear, Price, ISBN, Ebook, Available) VALUES
            ('$_POST[bookTitle]','$_POST[bookPublishedYear]', '$_POST[price]', '$_POST[isbn]', $_POST[ebook], True)";
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT BookId FROM BookInventory WHERE ISBN = '$_POST[isbn]'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $bookId = $row["BookId"];
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
                            window.alert('Unsuccesful added book.');
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
                            window.alert('Unsuccesful added book.');
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
                            window.alert('Unsuccesful added book.');
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
                window.alert('Succesfully added book.');
                window.location.href='/pages/admin/main.php';
                </SCRIPT>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        echo "<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Unsuccesful added book.');
                window.location.href='javascript:history.back()';
                </SCRIPT>";
    }
?>
