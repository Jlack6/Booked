<?php

mysql_connect("","","","");// or die("Could not connect");
mysql_select_db("booked");// or die("Could not find db!");
error_reporting(E_ALL ^ E_DEPRECATED);
$output1 = '';
$output2 = '<br>';
/*$output2 = '';
$output3 = '';
$output4 = '';
$output5 = '';
$output6 = '';
$output7 = '';*/
//collect

if(isset($_POST['search'])) {
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

    $query = mysql_query("SELECT * FROM bookedData WHERE isbn10 LIKE '%$searchq%' OR isbn13 LIKE '%$searchq%'OR bookname LIKE '%$searchq%' ");// or die("could not search!");
    $count = mysql_num_rows($query);
    if($count == 0){
        $output = 'There was no search results!';
    }
    else{
        while($row = mysql_fetch_array($query)){
            //$fname = $row['firstname'];
            //$lname = $row['lastname'];
            $isbn13 = $row['isbn13'];
            $isbn10 = $row['isbn10'];
            $author = $row['author'];
            $bookname = $row['bookname'];
            $edition = $row['edition'];
            $email = $row['email'];
            $price = $row['price'];
            //$datePosted = $row['datePosted'];
            $id = $row['id'];

            $output1 .= '<div> ISBN-13: ' .$isbn13. ' ' .$output2.
                         ' ISBN-10: ' .$isbn10. ' ' .$output2.
                         ' Author: ' .$author. ' ' .$output2.
                         ' Book Name: ' .$bookname. ' ' .$output2.
                        ' Edition: ' .$edition. ' ' .$output2.
                        ' E-mail: ' .$email. ' ' .$output2.
                        ' Price (USD): ' .$price. ' ' .$output2. ' ' .$output2. '</div>';
                        //' Date Posted: ' .$datePosted. '</div>';
        }
    }
}
?>

<?php 
$msg = "";
if(isset($_POST["upload"])){

    $db = mysqli_connect("","","","");
    //$firstname = $_POST['firstname'];
    //$lastname = $_POST['lastname'];
    $isbn13 = $_POST['isbn13'];
    $isbn10 = $_POST['isbn10'];
    $author = $_POST['author'];
    $bookname = $_POST['bookname'];
    $edition = $_POST['edition'];
    $email = $_POST['email'];
    $price = $_POST['price'];


    $sql = "INSERT INTO bookedData (isbn13,isbn10,author,bookname,edition,email,price)
     VALUES ('$isbn13','$isbn10','$author','$bookname','$edition','$email','$price')";
    mysqli_query($db,$sql);
}

 ?>

<!DOCTYPE html>
<html>
<head>
    <title>New Listing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <img src="bookedLogoUA.png" alt="BOOKED UA LOGO" style="display: block;margin-left: auto;margin-right: auto;width: 80%;">
    </div>
    <div id="content">
            <form method="post" action="booked.php" enctype="multipart/form-data">
                <input type="button" value="Go to Search" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='booked.php'" />
                <input type="hidden" name="size" value="1000000">
                <!-- <div>
                    <textarea name="firstname" cols="40" rows="1" placeholder="firstname" class="form-control"></textarea>
                </div>
                <div>
                    <textarea name="lastname" cols="40" rows="1" placeholder="lastname" class="form-control"></textarea>
                </div> -->
                <div>
                    <textarea name="isbn13" cols="40" rows="1" placeholder="isbn13" class="form-control form-control-lg"></textarea>
                </div>
                <div>
                    <textarea name="isbn10" cols="40" rows="1" placeholder="isbn10" class="form-control form-control-lg"></textarea>
                </div>
                <div>
                    <textarea name="author" cols="40" rows="1" placeholder="author" class="form-control form-control-lg"></textarea>
                </div>
                <div>
                    <textarea name="bookname" cols="40" rows="1" placeholder="bookname" class="form-control form-control-lg"></textarea>
                </div>
                <div>
                    <textarea name="edition" cols="40" rows="1" placeholder="edition" class="form-control form-control-lg"></textarea>
                </div>
                <div>
                    <textarea name="email" cols="40" rows="1" placeholder="email" class="form-control form-control-lg"></textarea>
                </div>
                <div>
                    <textarea name="price" cols="40" rows="1" placeholder="price" class="form-control form-control-lg"></textarea>
                </div>
                <div>
                    <button type="submit" name="upload" value="Upload Image"  class="btn btn-primary btn-lg btn-block">Submit Name</button>
                </div>
            </form>
    </div>
</body>
</html>