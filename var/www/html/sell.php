<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>About Us</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
	<?php include_once("template_header.php"); ?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="radio" name="category" value="landscape" checked> Landscape<br>
    <input type="radio" name="category" value="macro"> Macro<br>
    <input type="radio" name="category" value="street"> Street<br>
    <input type="submit" value="Upload Image" name="submit">
</form>

	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>
