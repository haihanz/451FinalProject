<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>


<!DOCTYPE html>
<html lang="en" class="no-js">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Crafty+Girls"/>
  
  <title>Welcome to Duck's Pet Store</title>
<body>

</body>

<!-- nav bar -->
<h1>Your Pet In Our Motel</h1>

<nav id="nav" role="navigation"> <a href="#nav" title="Show navigation">Show navigation</a> <a href="#" title="Hide navigation">Hide navigation</a>
  <ul class="clearfix">
<li><a href="homepage.html">Home</a></li>
<li> <a href=""><span>Customer</span></a>
      <ul>
    <li><a href="pet.html">Pet</a></li>
    <li><a href="receipt.html">Receipt</a></li>
  </ul>
    </li>
<li> <a href=""><span>Employee</span></a>
      <ul>
    <li><a href="owner.html">Owner Infomation</a></li>
    <li><a href="petInfo.html">Pet Information</a></li>
  </ul>
    </li>
<li><a href="index.html">Welcome</a></li>
</ul>
</nav>
<!-- end nav -->

<!-- <h1>한</h1> -->
<!-- <img src="./images/homepagecat.jpg" alt="homepagecat"> -->

<!-- introduction -->
<br>
<br>
<br>
<div class="jumbotron min-vh-100">
    <p>Please Input Your Name and Your Pet Name</p>
    <form method="POST" action="pet.php">
        <input type="text" name="ownerID"> 
        <br>
        <input type="submit" value="submit">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $owner_number= $_POST['ownerID'];

      $owner_number = mysqli_real_escape_string($conn, $owner_number);
      // this is a small attempt to avoid SQL injection
      // better to use prepared statements

      $query = "SELECT fname, lname
      FROM owner
      WHERE owner_number = ";
      $query = $query."".$owner_number."";

      print "$query";

      $res = mysql_query($conn, $query)
      or die(mysqli_error($conn));

      // print "$res";
      while($row = mysql_fetch_array($res)){
        // echo "<br><p1><b>First Name:  </b></b>", $row['fname'], "</p1>";
        print "$row[fname]  $row[lname]";
      }
      mysqli_free_result($result);

      mysqli_close($conn);
    }
?>
</div>

<!-- footer -->
<footer class="py-4 text-black-50">
	<div class="container text-center">
    <a href="index.html">
      <img
        style="padding-bottom:6px; width:8%; height:auto; border-radius: 50%;"
        src="./images/logo.JPG"
        id="footer_logo"
      />
    </a>
    
    <a class="footer_icons" href="#">
      <i
        style="color:black; font-size:24px; padding-right:5px;"
        class="fa fa-facebook-official"
      ></i>
    </a>
    <a class="footer_icons" href="#"
      ><i
        style="color:black; font-size:24px; padding-right:5px;"
        class="fa fa-instagram"
      ></i
    ></a>
    <a class="footer_icons" href="#"
      ><i
        style="color:black; font-size:24px; padding-right:5px;"
        class="fa fa-twitter"
      ></i
    ></a>
    <small>University of Oregon &copy; Duck's Pet Motel</small>
  </div>
</footer>
</body>

<!-- Js code -->
<script
src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
crossorigin="anonymous"
></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
crossorigin="anonymous"
></script>
<script
src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
crossorigin="anonymous"
></script>
<script type="text/javascript" src="jquery-3.0.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://osvaldas.info/examples/main.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>

<script src="http://osvaldas.info/examples/drop-down-navigation-touch-friendly-and-responsive/doubletaptogo.js"></script> 

<script>
$( function()
{
$( '#nav li:has(ul)' ).doubleTapToGo();
});
</script>

</html>
