<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";

    // get the parameter from URL
    $name= $_REQUEST["name"];

    $output = $name;

    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM BookInventory b, Publisher p, Author a, BookType t
            WHERE (b.BookTitle LIKE '%$name%' OR
                    a.AuthorName LIKE '%$name%' OR
                    p.PubName LIKE '%$name%' OR
                    p.pubAddress LIKE '%$name%' OR
                    t.typeName LIKE '%$name%' OR
                    b.BookPublishedYear LIKE '%$name%' OR
                    b.price LIKE '%$name%' OR
                    b.ISBN  LIKE '%$name%') AND
            b.PubId = p.PubId AND b.AuthorId = a.AuthorId AND b.TypeId = t.TypeId ORDER BY b.BookTitle";
    $result = mysqli_query($conn, $sql);
    echo"<table>
        <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Publisher Address</th>
            <th>BookType</th>
            <th>Published Year</th>
            <th>Price</th>
            <th>ISBN</th>
            <th>Ebook</th>
            <th>Available</th>
            <th>Borrow / Reserve</th>
        </tr>
        ";

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
            <td>";
                if ($Available=='YES'){
                    echo "<a href=\"/php/dbBorrowBook.php?BookId=$row[BookId]\"><button type=\"button\" style=\"width: 100px;\">Borrow</button></a>";
                }else{
                    echo "<a href=\"/php/dbReserveBook.php?BookId=$row[BookId]\"><button type=\"button\" style=\"width: 100px;\">Reserve</button></a>";
                }
        echo "</td>
            </tr>";

    }echo"</table>";
    mysqli_close($conn);


?>
