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
<style>

.un {
width: 60%;
color: rgb(38, 50, 56);
font-weight: 700;
font-size: 14px;
letter-spacing: 1px;
background: rgba(136, 126, 126, 0.04);
padding: 10px 20px;
border: none;
border-radius: 20px;
outline: none;
box-sizing: border-box;
border: 2px solid rgba(0, 0, 0, 0.02);
margin-bottom: 50px;
text-align: left;
margin-bottom: 27px;
font-family: 'Ubuntu', sans-serif;
}

.un:focus{
    border: 2px solid rgba(0, 0, 0, 0.18) !important;
}
.sub {
    cursor: pointer;
    border-radius: 5em;
    color: #fff;
    background: linear-gradient(to right, rgba(255, 115, 0, 0.89), rgba(251, 139, 64, 0.842));
    border: 0;
    padding-left: 40px;
    padding-right: 40px;
    padding-bottom: 10px;
    padding-top: 10px;
    font-family: 'Ubuntu', sans-serif;
    font-size: 13px;
    box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
}

</style>

<body>

</body>

<!-- nav bar -->
<h1>Your Pet In Our Motel</h1>

<nav id="nav" role="navigation"> <a href="#nav" title="Show navigation">Show navigation</a> <a href="#" title="Hide navigation">Hide navigation</a>
  <ul class="clearfix">
<li><a href="homepage.html">Home</a></li>
<li> <a href=""><span>Customer</span></a>
      <ul>
    <li><a href="pet.php">Pet</a></li>
    <li><a href="receipt.php">Receipt</a></li>
  </ul>
    </li>
<li> <a href=""><span>Employee</span></a>
      <ul>
    <li><a href="owner.html">Owner Infomation</a></li>
    <li><a href="petInfo.php">Pet Information</a></li>
    <li><a href="empInfo.php">Employee Information</a></li>
  </ul>
    </li>
<li><a href="index.html">Welcome</a></li>
</ul>
</nav>

<br>
<br>
<br>
<!-- application1 -->
<!-- customer name and pet name -->
<div class="jumbotron min-vh-100">
    <form class = "form1" method="POST" action="pet.php">
        <input class = "un"type="text" name="ownerID" placeholder="Customer Number eg.1-15" align="center">

        <br>
        <input class = "sub" type="submit" value="submit">
        <br>
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $owner_number= $_POST['ownerID'];

      $owner_number = mysqli_real_escape_string($conn, $owner_number);
      // this is a small attempt to avoid SQL injection
      // better to use prepared statements

      //select customer name
      $query1 = "SELECT *
      FROM owner
      WHERE owner_number = ";
      $query1 = $query1."'".$owner_number."'";

      $result1 = mysqli_query($conn, $query1)
      or die(mysqli_error($conn));

      while($row = mysqli_fetch_array($result1, MYSQLI_BOTH)){
        echo "<br>";
        echo "Dear customer $row[fname]  $row[lname]";
        echo "<br>";
      }
      mysqli_free_result($result1);

      // select pet information
      $query = "SELECT owner.fname, owner.lname, pet.pet_name, drop_off_time, pick_up_time, pet.room_number
      FROM owner JOIN pet USING (owner_number) 
      JOIN records
      on pet.pet_number = records.pet_num
      WHERE owner_number = ";
      $query = $query."'".$owner_number."'";

      $result = mysqli_query($conn, $query)
      or die(mysqli_error($conn));

      while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        // echo "<br><p1><b>First Name:  </b></b>", $row['fname'], "</p1>";
        echo "<br>";
        echo "Your pet $row[pet_name]";
        echo "<br>";
        echo "Have a great time in our pet motel during $row[drop_off_time] to $row[pick_up_time]";
        echo "<br>";
        echo "Live in room $row[room_number]";
        echo "<br>";
      }
      echo "------------------------------------------------------------------------------------";
      mysqli_free_result($result);

      // select employee who take care of your pet
      $query2 = "SELECT employee.fname, employee.lname, pet.pet_name, employee.tel_number
      FROM owner join pet using (owner_number) join employee on 
      e_ssn = SSN
      WHERE owner_number = ";
      $query2 = $query2."'".$owner_number."'";

      $result2 = mysqli_query($conn, $query2)
      or die(mysqli_error($conn));

      while($row = mysqli_fetch_array($result2, MYSQLI_BOTH)){
        echo "<br>";
        echo "Our empoyee $row[fname]  $row[lname] will take care of your pet $row[pet_name]";
        echo "<br>"; 
        echo "Phone Number: $row[tel_number]";
        echo "<br>"; 
      }
      echo "------------------------------------------------------------------------------------";
      mysqli_free_result($result2);

      // pet activity
      $query3 = "SELECT pet_name, activity_name, activity_time
      FROM owner join pet using (owner_number) join records on 
      pet.pet_number = records.pet_num
      where owner_number = ";
      $query3 = $query3."'".$owner_number."'";

      $result3 = mysqli_query($conn, $query3)
      or die(mysqli_error($conn));

      while($row = mysqli_fetch_array($result3, MYSQLI_BOTH)){
        echo "<br>";
        echo "Your pet $row[pet_name] take activity '$row[activity_name]' $row[activity_time] times";
        echo "<br>"; 
      }
      echo "------------------------------------------------------------------------------------";
      mysqli_free_result($result3);

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
