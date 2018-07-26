<?php
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Store Administrator</title>
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/aladin:n4:default.js" type="text/javascript"></script>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
  <?php include_once("../template_header.php"); ?>
	<div id="pageContent"></div>
	<?php include_once("../template_footer.php"); ?>
</div>
</body>
</html>