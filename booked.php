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

			$output1 .= '<div style="padding-top:20px;padding-left:50px;border-style: solid;border-color: #fdc204;">
                         ISBN-13: ' .$isbn13. ' ' .$output2.
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
	<title>Search</title>
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
	<form action="index.php" method="post">
		<input type="button" value="Go Back to Jameslack.com" class="btn btn-success btn-lg btn-block" onclick="window.location.href='index.html'" />
        <input type="button" value="List New Book" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='newBook.php'" />
		<input type="text" name="search" class="form-control form-control-lg" placeholder="Search for books....">
		<input type="submit" value="Search Now" class="btn btn-primary btn-lg btn-block">
	</form>

	<?php 	print("$output1");
			/*print("$output2");
			print("$output3");
			print("$output4");
			print("$output5");
			print("$output6");
			print("$output7");*/
	 ?>
</body>
</html>