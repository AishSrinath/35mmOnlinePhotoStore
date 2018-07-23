<?php
require 'functions.php';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>About Us</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<style>
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
.responsive {
    width: 100%;
    max-width: 400px;
    height: auto;
}

</style>
</head>
<body>
<div align="center" id="mainWrapper">
    <?php include_once("template_header.php");?>
    <div class="tab">
    <button class="tablinks" onclick="openCat(event, 'Landscape')" id="defaultOpen">Landscape</button>
    <button class="tablinks" onclick="openCat(event, 'Macro')">Macro</button>
    <button class="tablinks" onclick="openCat(event, 'Street')">Street</button>
    </div>
    <div id="Landscape" class="tabcontent">
    <table>
    <?php
    $i=0;
    $category = landscape;
    $result = Getimagedetail($category);
    while($row = mysqli_fetch_assoc($result)) {
        if($i%3 == 0) {
            echo "<tr>";
        }
        echo"<td><img src='images/landscape/{$row['image_name']}.jpg' alt={$row['image_title']} class='responsive' width='600' height='400'</td>";
        if($i%3 == 2) {
            echo "</tr>";
        }
        $i++;
    }
    ?>
    </table>
    </div>
    <div id="Macro" class="tabcontent">
    <table>
    <?php
    $i=0;
    $category = macro;
    $result = Getimagedetail($category);
    while($row = mysqli_fetch_assoc($result)) {
        if($i%3 == 0) {
            echo "<tr>";
        }
        echo"<td><img src='images/macro/{$row['image_name']}.jpg' alt={$row['image_title']} class='responsive' width='600' height='400'</td>";
        if($i%3 == 2) {
            echo "</tr>";
        }
        $i++;
    }
    ?>
    </table>
    </div>
    <div id="Street" class="tabcontent">
    <table>
    <?php
    $i=0;
    $category = street;
    $result = Getimagedetail($category);
    while($row = mysqli_fetch_assoc($result)) {
        if($i%3 == 0) {
            echo "<tr>";
        }
        echo"<td><img src='images/street/{$row['image_name']}.jpg' alt={$row['image_title']} class='responsive' width='600' height='400'</td>";
        if($i%3 == 2) {
            echo "</tr>";
        }
        $i++;
    }
    ?>
    </table>
    </div>
<script>
function openCat(evt, catName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(catName).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
    <?php include_once("template_footer.php"); ?>
</div>
</body>
</html>
