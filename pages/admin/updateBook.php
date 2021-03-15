<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
    $BookId = $_GET['BookId'];
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM BookInventory b, Publisher p, Author a, BookType t
            WHERE b.PubId = p.PubId AND b.AuthorId = a.AuthorId AND b.TypeId = t.TypeId AND b.BookId='$BookId' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

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
                            </span> Update book information
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-description"> </p>
                                    <form name="login" action="/php/dbUpdateBook.php?BookId=<?php echo $BookId;?>" method="post" class="forms-sample" onsubmit="return(validate());">
                                        <div class="form-group">
                                            <label>Book Title</label>
                                            <input type="text" name="bookTitle" class="form-control" value="<?php echo $row["BookTitle"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Author Name</label>
                                            <input type="text" name="authorName" class="form-control" value="<?php echo $row["AuthorName"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher Name</label>
                                            <input type="text" name="publisherName" class="form-control" value="<?php echo $row["PubName"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher Address(optional)</label>
                                            <textarea name="publisherAddress" class="form-control"><?php echo $row["PubAddress"];?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Type</label>
                                            <input type="text" name="type" class="form-control" value="<?php echo $row["TypeName"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Book published year(optional)</label>
                                            <input type="text" name="publishedYear" class="form-control" value="<?php echo $row["BookPublishedYear"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Price(optional)</label>
                                            <input type="text" name="price" class="form-control" value="<?php echo $row["Price"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input type="text" name="isbn" class="form-control" value="<?php echo $row["ISBN"];?>">
                                        </div>                                         
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" name="ebook" value="True" class="form-check-input" <?php if ($row["Ebook"]) echo "checked"; ?>> Have Ebook
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" name="ebook" value="False" class="form-check-input" <?php if (!$row["Ebook"]) echo "checked"; ?>> No Ebook
                                                </label>
                                            </div>
                                        </div> 
                                        
                                        <input type="submit" name="submit" value="Add Book" class="btn btn-gradient-primary mr-2"/>
                                    </form>
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
    <script type="text/javascript">
    function validate()
    {
    //bookTitle validation
     if( document.login.bookTitle.value == "" || document.login.bookTitle.value.length >255)
     {
     alert( "Please provide a correct Book Title. (length = 1 - 255)" );
     document.login.bookTitle.focus() ;
     return false; }

    //authorName validation
     if( document.login.authorName.value == "" ||document.login.authorName.value.length >55)
     {
     alert( "Please provide a correct Name. (length = 1 - 55)" );
     document.login.authorName.focus() ;
     return false; }
     else if (!document.login.authorName.value.match(/^[A-Za-z ]+$/))
     { alert("Please provide a correct name. (only alphabetic characters, A ~ Z, and white space are acceptable.)");
    	document.login.authorName.focus() ;
       return false;
     }



     //publisherName validation
     if( document.login.publisherName.value == "" ||document.login.publisherName.value.length >55)
     {
     alert( "Please provide a correct Publisher Name. (length = 1 - 55)");
     document.login.publisherName.focus() ;
     return false; }
      else if (!document.login.publisherName.value.match(/^[A-Za-z ]+$/))
      { alert("Please provide a correct Publisher Name. (only alphabetic characters, A ~ Z, and white space are acceptable.)")
     	document.login.publisherName.focus() ;
        return false;
      }
      //publisherAddress validation
       if(document.login.publisherAddress.value.length>255)
       {
       alert( "Please provide a correct Publisher Address. (length = 1 - 255)" );
       document.login.publisherAddress.focus() ;
       return false; }

       //book type validation
        if( document.login.type.value == "" ||document.login.type.value.length >55)
        {
        alert( "Please provide a correct Book Type. (length = 1 - 55)" );
        document.login.type.focus() ;
        return false; }

        //published year validation
        if(document.login.publishedYear.value.length >4)
        {
        alert( "Please provide a correct Published Year.");
        document.login.publishedYear.focus() ;
        return false; }
        if(!/^\d+$/.test(document.login.publishedYear.value)&&document.login.publishedYear.value.length >=1){
        alert( "Please provide a correct Published Year.(In numbers)");
        document.login.publishedYear.focus() ;
        return false;
        }

        //price validation
        if(document.login.price.value.length >8)
        {
        alert( "Please provide a correct Price.");
        document.login.price.focus() ;
        return false; }
        if(!/^\d+$/.test(document.login.price.value)&&document.login.price.value.length >=1){
        alert( "Please provide a correct Price.(In numbers)");
        document.login.price.focus() ;
        return false;
        }

        //ISBN validation
        var isbnNo = document.login.isbn.value.replace(/[^\dX]/gi, '');
        if(isbnNo.length == 10) {
                var chars = isbnNo.split('');
                if(chars[9].toUpperCase() == 'X') {
                        chars[9] = 10;
                }
                var sum = 0;
                for(var i = 0; i < chars.length; i++) {
                        sum += ((10-i) * parseInt(chars[i]));
                }if((sum % 11) != 0){
                    alert( "Please provide a correct ISBN." );
                    document.login.isbn.focus() ;
                    return false;
                }
        } else if(isbnNo.length == 13) {
                var chars = isbnNo.split('');
                var sum = 0;
                for (var i = 0; i < chars.length; i++) {
                        if(i % 2 == 0) {
                                sum += parseInt(chars[i]);
                        } else {
                                sum += parseInt(chars[i]) * 3;
                        }
                }if((sum % 10) != 0){
                    alert( "Please provide a correct ISBN." );
                    document.login.isbn.focus() ;
                    return false;
                }
        } else {
                alert( "Please provide a correct ISBN." );
                document.login.isbn.focus() ;
                return false;
        }
    return( true );
    }
    </script>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/pages/layout/endScript.php"; ?>
</body>

</html>