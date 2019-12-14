<?php

include('connectionData.txt');

$conn1 = mysqli_connect($server, $user, $pass, $dbname, $port)
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
    table, td, th, tr {
    border: 1px solid black;
    }

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
<h1>Customer Receipt</h1>

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
<!-- end nav -->

<!-- <h1>한</h1> -->
<!-- <img src="./images/homepagecat.jpg" alt="homepagecat"> -->

<!-- introduction -->
<br>
<br>
<br>
<div class="jumbotron min-vh-100">
    <form method="POST" action="receipt.php">
        <input type="text" name="ownerID" class = "un" placeholder="Customer Number eg.1-15" align="center">

        <br>
        <input type="submit" value="submit" class = "sub">
        <br>
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $owner_number= $_POST['ownerID'];

      $owner_number = mysqli_real_escape_string($conn1, $owner_number);
      // this is a small attempt to avoid SQL injection
      // better to use prepared statements

      //customer name
      $query1 = "SELECT *
      FROM owner
      WHERE owner_number = ";
      $query1 = $query1."'".$owner_number."'";

      $result1 = mysqli_query($conn1, $query1)
      or die(mysqli_error($conn1));

      while($row = mysqli_fetch_array($result1, MYSQLI_BOTH)){
        echo "<br>";
        echo "$row[fname] $row[lname]'s receipt";
        echo "<br>";
      }
      mysqli_free_result($result1);

      // room information
      $query1 = "SELECT DISTINCT room_number, size, price_per_day, drop_off_time , pick_up_time 
      FROM owner join pet using (owner_number) join room using (room_number) join records on
      pet.pet_number = records.pet_num
      where owner_number = ";
      $query1 = $query1."'".$owner_number."'";
      print "Room Fee\n";
      $result1 = mysqli_query($conn1, $query1)
      or die(mysqli_error($conn1));
      print "$res";
      print "<pre>";
      echo "<table border='7' class='stats' cellspacing='0'>
      <tr>
      <td class='hed' colspan='8'></td>
        </tr>
      <tr>
      <th>Room Size   </th>
      <th>Room Number   </th>
      <th>Price/Day   </th>
      <th>From         </th>
      <th>To             </th>
      <th>Days   </th>
      <th>Total Price   </th>

      </tr>";
      while($row = mysqli_fetch_array($result1, MYSQLI_BOTH)){
        echo "<tr>";
        echo "<td>$row[size]</td>";
        echo "<td>$row[room_number]</td>";
        echo "<td>$row[price_per_day]</td>";
        echo "<td>$row[drop_off_time]</td>";
        echo "<td>$row[pick_up_time]</td>";
        $start_date = strtotime($row[drop_off_time]);
        $end_date = strtotime($row[pick_up_time]);
        $day = ($end_date - $start_date)/60/60/24;
        echo "<td>$day</td>";
        $total = $day * $row[price_per_day];
        echo "<td>$$total</td>";
        echo "</tr>\n";

      }
      echo "</table>";
      print "</pre>";
      mysqli_free_result($result1);
      echo "------------------------------------------------------------------------------------";
      echo "<br>";
      // activity information
      $query2 = "SELECT pet_name, activity_name, price, activity_time, activity_time*price AS total
      FROM owner join pet using (owner_number) join records on
      pet.pet_number = records.pet_num
      join activity using (activity_name)
      where owner_number = ";
      $query2 = $query2."'".$owner_number."'";
      print "Activity Fee\n";
      $result2 = mysqli_query($conn1, $query2)
      or die(mysqli_error($conn1));
      print "$res";
      print "<pre>";
      echo "<table border='7' class='stats' cellspacing='0'>
      <tr>
      <td class='hed' colspan='8'></td>
        </tr>
      <tr>
      <th>Pet Name   </th>
      <th>Activity   </th>
      <th>Price/Once   </th>
      <th>Time        </th>
      <th>Total             </th>

      </tr>";
      while($row = mysqli_fetch_array($result2, MYSQLI_BOTH)){
        echo "<tr>";
        echo "<td>$row[pet_name]</td>";
        echo "<td>$row[activity_name]</td>";
        echo "<td>$row[price]</td>";
        echo "<td>$row[activity_time]</td>";
        echo "<td>$$row[total]</td>";
        echo "</tr>\n";

      }
      echo "</table>";
      print "</pre>";
      mysqli_free_result($result2);
      echo "------------------------------------------------------------------------------------";
      echo "<br>";

      // sale items
      $query3 = "SELECT item_name, price, time, price*time AS total
      from orders join owner using (owner_number) join sale using (item_num)
      where owner_number = ";
      $query3 = $query3."'".$owner_number."'";
      print "Item Fee\n";
      $result3 = mysqli_query($conn1, $query3)
      or die(mysqli_error($conn1));
      print "$res";
      print "<pre>";
      echo "<table border='7' class='stats' cellspacing='0'>
      <tr>
      <td class='hed' colspan='8'></td>
        </tr>
      <tr>
      <th>Item   </th>
      <th>Price   </th>
      <th>How Many?   </th>
      <th>Total   </th>

      </tr>";
      while($row = mysqli_fetch_array($result3, MYSQLI_BOTH)){
        echo "<tr>";
        echo "<td>$row[item_name]</td>";
        echo "<td>$row[price]</td>";
        echo "<td>$row[time]</td>";
        echo "<td>$$row[total]</td>";
        echo "</tr>\n";

      }
      echo "</table>";
      print "</pre>";
      mysqli_free_result($result3);
      echo "------------------------------------------------------------------------------------";
      echo "<br>";

      // final receipt
      $query4 = "SELECT SUM(built_in.total) AS activity_sum from 
      (SELECT pet_name, activity_name, price, activity_time, activity_time*price AS total
      FROM owner join pet using (owner_number) join records on
      pet.pet_number = records.pet_num
      join activity using (activity_name)
      where owner_number = $owner_number) as built_in";

      $query5 = "SELECT SUM(item_table.total_) AS item_fee 
      FROM(
      SELECT item_name, price, time as time_, price*time AS total_
      from orders join owner using (owner_number) join sale using (item_num)
      where owner_number = $owner_number) as item_table";

      print "Final Receipt";
      $result4 = mysqli_query($conn1, $query4)
      or die(mysqli_error($conn1));
      $result5 = mysqli_query($conn1, $query5)
      or die(mysqli_error($conn1));
      print "$res";
      print "<pre>";
      echo "<table border='7' class='stats' cellspacing='0'>
      <tr>
      <td class='hed' colspan='8'></td>
        </tr>
      <tr>
      <th>Room Fee  </th>
      <th>Activity Fee   </th>
      <th>Item Fee   </th>
      <th>Total   </th>

      </tr>";
      $row2 = mysqli_fetch_array($result4, MYSQLI_BOTH);
      $row3 = mysqli_fetch_array($result5, MYSQLI_BOTH);
        echo "<tr>";
        echo "<td>$$total</td>";
        echo "<td>$$row2[activity_sum]</td>";
        echo "<td>$$row3[item_fee]</td>";
        $final_receipt = $total + $row2[activity_sum] + $row3[item_fee];
        echo "<td>$$final_receipt</td>";
        echo "</tr>\n";
      echo "</table>";
      print "</pre>";
      mysqli_free_result($result4);
      mysqli_free_result($result5);
      echo "------------------------------------------------------------------------------------";
      echo "<br>";

      mysqli_close($conn1);
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
