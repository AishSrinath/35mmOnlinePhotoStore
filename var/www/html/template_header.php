<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {margin:0;}

.navbar {
  overflow: hidden;
  background-color: #333;  
  position: fixed;
  
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background-color: #ddd;
  color: black;
}

.navbar a.active {
  background-color: #4CAF50;
  color: white;
}

.navbar .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .navbar a:not(:first-child) {display: none;}
  .navbar a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .navbar.responsive .icon {
    position: absolute;
    right: 0;
    bottom:0;
  }
  .navbar.responsive a {
    float: none;
    display: block;
    text-align: left;
  }

}
</style>
</head>
<body>

<div class="navbar" id="myNavbar">
  <a href="#home" class="active">Home</a>
  <div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
  <tbody>
    <tr>
      <td width="14%"><a href="index.php"><img src="style/logo.jpg" width="75" height="60" alt="logo"/></td>
      <td width="86%">For the artist in you :)</td>
      </tr>
    <tr>
    
    
      <td bgcolor="#000000" colspan="2"><a href="index.php">Home</a> <a href="intro.php">About us</a> <a href="marketplace.php">Discover</a> <a href="myaccount.php">My Account</a>
      
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
      </td>
      </tr>
  </tbody>
	</table>
</div>
  
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>



<script>
function myFunction() {
    var x = document.getElementById("myNavbar");
    if (x.className === "navbar") {
        x.className += " responsive";
    } else {
        x.className = "navbar";
    }
}
</script>

</body>
</html>

