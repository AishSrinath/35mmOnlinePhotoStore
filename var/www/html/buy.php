<!DOCTYPE html>
<html>
<head>
<title>HTML attributes example</title>
<style>
* {
    box-sizing: border-box;
}

.column {
    float: left;
    width: 33.33%;
    padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
    content: "";
    clear: both;
    display: table;
}
</style>
</head>
<body>
   <h1>Photos</h1> 
   <h4><center> For the Artist in you </h4>
   <h1 style="font-size:20px; color:orange">
        Categories:</h1><br>
  <div class="row">
 	 <div class="column">
    <figure>
  	<figcaption> Scenaries </figcaption><form action="scenaries.htm">
 	<input type="image"src="https://jooinn.com/images/scenary-5.jpg" alt="Could not load" alt="Could not load" width="100" height="100"class="inline" name="pay" value="babies">
</form>
 	</figure>
  	</div> 
 	<div class="column">
    <figure>
  	<figcaption> babies</figcaption>
	
	<form action="babies.htm">
 	<input type="image" src="https://i.dailymail.co.uk/i/pix/2016/04/05/13/07063347000005DC-3524180-image-a-68_1459859102231.jpg" alt="Could not load" width="100" height="100"class="inline" name="pay" value="babies">
</form>
</figure>
  </div>

<div class="row">
  <div class="column">
    <figure>
  <figcaption> Couples </figcaption>
<form action="couples.htm">
 <input type="image" src="http://legacymagazineng.com/wp-content/uploads/2017/11/couples-images-3.jpg"width="100" height="100"class="inline" name="pay" value="Couples"> 
</form>
</figure> 

  </div>
<div class="row">
  <div class="column">
    <figure>
  <figcaption> Art</figcaption>
  <form action="art.htm">
 <input type="image" src="https://images.fineartamerica.com/images/artworkimages/mediumlarge/1/unicorn-rainbow-watercolor-olga-shvartsur.jpg"width="100" height="100"class="inline" name="pay" value="Couples"> 
</form>
 
</figure>
  </div>
   
</body>
</html>
