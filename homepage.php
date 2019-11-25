<!DOCTYPE html>
<html>
<body>
<title>Welcome to Duck's Pet Store</title>

<style>
h1{
	text-align:center;}

h4{
	text-align:center;}

ul{
	list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a , .dropbtn{
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover, .dropbtn{
    background-color: #111;
}

.dropdown{
    display:inline-block;}
  
.dropdown-content{
	display:none;
	position:absolute;
	background-color:#f9f9f9;
	min-width:160px;
	box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a{
color:black;
padding:12px 16px;
text-decoration:none;
display:block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content
{
display:block;
}

</style>

</head>


<ul>
<li><a href="#owner">Owner</a></li>
<li><a href="#pet">Pet</a></li>
<li><a href="#room">Room</a></li>
<li><a href="#employee">Employee</a></li>
<li><a href="#dep">Department</a></li>
<li><a href="#price_rec">Price Record</a></li>
<div class="dropdown">
    <li><a href="#_sale" class="dropbtn">Sale</a></li>
    <div class="dropdown-content">
      <a href="#sale_item">Sale Item</a>
      <a href="#sale_item_rate">Sale Item Rate</a>
    </div>
  </div>
 <li style="float:right"><a class="active" href="#about">About</a></li>
</ul>

<h1>한</h1>
<h4>Experience The Difference</h4>
<img src="./images/homepagecat.jpg" alt="homepagecat">
</body>
</html>