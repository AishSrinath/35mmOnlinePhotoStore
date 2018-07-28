<?php
  ob_start();
  session_start();
 error_reporting(E_ALL);
 include_once ("storescripts/connect_to_mysql.php");
ini_set('display_errors', '0');
if(!isset($_SESSION['login_id']))
{
    header("Location:login.php");
}
$user_id      = $_SESSION['login_id']; 
$sql_admin="select * from user where id='$user_id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query);
$_SESSION['uid'] = $user_id;
  if (strlen($_SESSION['uid'])<=0)
  {
 	 header("location:login.php?action=checkout");
 	 exit;
  } 	

  if (isset($_POST['submit']))
  {
  	
	$fname=str_replace("'", "''", $_POST['fname']);
	$lname=str_replace("'", "''", $_POST['lname']);
	$adr1=str_replace("'", "''", $_POST['adr1']);
	$adr2=str_replace("'", "''", $_POST['adr2']);
	$city=str_replace("'", "''", $_POST['city']);
	$county=str_replace("'", "''", $_POST['county']);
	$pcode=str_replace("'", "''", $_POST['pcode']);
	$phone=str_replace("'", "''", $_POST['phone']);
	$country=str_replace("'", "''", $_POST['country']);
	$email=str_replace("'", "''", $_POST['email']);
	$sql="select * from tbl_ship where ship_oid='".session_id()."'";
	//echo $sql;
	$result_user=mysqli_query($db_connect,$sql)or die(mysql_error());
	if (mysqli_affected_rows($db_connect)<=0)	
		$sql="INSERT INTO `tbl_ship` (`ship_fname`, `ship_lname`, `ship_adr1`, `ship_adr2`, `ship_city`, `ship_county`, `ship_pcode`,`ship_country`,ship_phone,`ship_email`,ship_oid) VALUES ('$fname', '$lname', '$adr1', '$adr2', '$city', '$county', '$pcode', '$country','$phone','$email','".session_id()."')";
	else
		$sql="update tbl_ship set ship_fname='$fname',ship_lname='$lname',ship_adr1='$adr1',ship_adr2='$adr2',ship_city='$city',ship_county='$county',ship_country='$country',ship_pcode='$pcode',ship_phone='$phone',ship_email='$email' where ship_oid='".session_id()."'";
		//echo $sql;
	mysqli_query($db_connect,$sql) or die(mysql_error());
		$_SESSION['country']=$country;
}	
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Product</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
    <div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
<a href="index.php"><img src="http://35.198.90.129/style/logo.jpg" width="75" height="60" alt="logo" align="left"/><br />
<p align="left"><i>For the artist in you</i></p><br />
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="about_us.php">About Us</a>
  <a href="discover.php">Discover</a>
  <div class="dropdown">
    <button class="dropbtn">My Account
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>
      
  </div>
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
</div>
  </tr>
  </tbody>
  </table>
</div>
 <?php
	   
  	
	$_SESSION['country']=$country;
 
	  
		  $tot=0;
		  $items=0;
		  $sql="select * from tbl_cart where cart_sessionid='".session_id()."'";
		  $result=mysqli_query($db_connect,$sql);
		  if (mysqli_affected_rows($db_connect)<=0)
		  {
			header('location:basket-empty.php');
		  }	
		?>     
    

<div id="tbl_container_demo_grid1" class="table-responsive">
   <div class="basketOuter">
           
           <h4>Order Summary</h4>
        <?   
           while($row=mysqli_fetch_array($result))
		   {
		      $tot=$tot+$row['cart_qty']*($row['cart_price']);
	   ?>	   
            <p><?=$row['cart_qty'] ?> x <?=$row['cart_pname']?> (<img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack" /><?php echo number_format($row['cart_qty']*$row['cart_price'],2)?>)</p>
       <?
	   		}
			$sql="SELECT * FROM tbl_vat WHERE now( ) >= vat_startdate AND now( ) <= vat_enddate";
			$resultvat=mysqli_query($db_connect,$sql);
			$rowvat=mysqli_fetch_array($resultvat);
			$status=0;
			if (isset($_SESSION['country']) && trim($_SESSION['country'])=='United Kingdom')
			{	 
				$sql="select * from  tbl_cart_delivery where cart_delivery_cart_id='".session_id()."'";
				$result_cart_delivery=mysqli_query($db_connect,$sql) or die(mysql_error());
				if (mysqli_affected_rows($db_connect))
				{
					$row_cart_delivery=mysqli_fetch_assoc($result_cart_delivery);
					$status=$row_cart_delivery['cart_delivery_dstatus'];
				
				}	
				
				 if ($status==1)
				 {
					$sel='checked="checked"';
					$ship=SPECIAL_POSTAGE;
				}	
				else if($tot>POSTAGE_LIMIT)
					$ship=0;
					
				else
					$ship=POSTAGE_CHARGE;  
			}
			else
				$ship=NONUK_POSTAGE;
			$vat=(($tot+$ship)*$rowvat['vat_rate'])/100;   
                        
                        
                        
		?>	     
           
<p><a href="basket.php">Edit your Order </a></p>
            <p class="postageTotal"><span>Subtotal:</span><img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack" /><?php echo number_format($tot,2) ?></p>
            <p class="postageTotal"><span>Postage:</span> <img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack" /><?php echo number_format($ship,2) ?></p>
             <p class="postageTotal"><span>VAT:</span><img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack" /><?php echo number_format($vat,2) ?></p>
            <p class="orderTotal"><span>Total:</span> <img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack1" /> <?php echo number_format(($tot+$vat+$ship),2) ?>
               
                
                
                
              <span id="adrchange" style="display:block">     
      
        <h4>Add Delivery Address</h4>
                    <table cellpadding="0" cellspacing="0" class="createAccTbl">
                    	
                        <tr>
                        	<td>First Name *</td>
                            <td colspan="2"><input  type="text" class="inputFields" name="fname" value=""/></td>
                        </tr>
                        <tr>
                        	<td>Last Name *</td>
                            <td colspan="2"><input  type="text" class="inputFields" name="lname"  value="<?=$lname ?>"/></td>
                        </tr>
                        <tr>
                        	<td>Address1 *</td>
                            <td colspan="2"><input  type="text" class="inputFields" name="adr1"  value="<?=$adr1?>" /></td>
                        </tr>
                        <tr>
                        	<td>Address2</td>
                            <td colspan="2"><input  type="text" class="inputFields" name="adr2"  value="<?=$adr2?>"/></td>
                        </tr>
                        <tr>
                        	<td>City *</td>
                            <td colspan="2"><input  type="text" class="inputFields"  name="city"  value="<?=$city?>"/></td>
                        </tr>
                        <tr>
                        	<td>State *</td>
                            <td colspan="2"><input  type="text" class="inputFields"  name="county"  value="<?=$county?>"/></td>
                        </tr>
                        <tr>
                        	<td>Country *</td>
                            <td colspan="2">
                              <select name="country" id="country"> 
                              
                                <option value="United States">United States</option> 
                                <option value="United Kingdom">United Kingdom</option> 
                                <option value="Afghanistan">Afghanistan</option> 
                                <option value="Albania">Albania</option> 
                                <option value="Algeria">Algeria</option> 
                                <option value="American Samoa">American Samoa</option> 
                                <option value="Andorra">Andorra</option> 
                                <option value="Angola">Angola</option> 
                                <option value="Anguilla">Anguilla</option> 
                                <option value="Antarctica">Antarctica</option> 
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
                                <option value="Argentina">Argentina</option> 
                                <option value="Armenia">Armenia</option> 
                                <option value="Aruba">Aruba</option> 
                                <option value="Australia">Australia</option> 
                                <option value="Austria">Austria</option> 
                                <option value="Azerbaijan">Azerbaijan</option> 
                                <option value="Bahamas">Bahamas</option> 
                                <option value="Bahrain">Bahrain</option> 
                                <option value="Bangladesh">Bangladesh</option> 
                                <option value="Barbados">Barbados</option> 
                                <option value="Belarus">Belarus</option> 
                                <option value="Belgium">Belgium</option> 
                                <option value="Belize">Belize</option> 
                                <option value="Benin">Benin</option> 
                                <option value="Bermuda">Bermuda</option> 
                                <option value="Bhutan">Bhutan</option> 
                                <option value="Bolivia">Bolivia</option> 
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
                                <option value="Botswana">Botswana</option> 
                                <option value="Bouvet Island">Bouvet Island</option> 
                                <option value="Brazil">Brazil</option> 
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
                                <option value="Brunei Darussalam">Brunei Darussalam</option> 
                                <option value="Bulgaria">Bulgaria</option> 
                                <option value="Burkina Faso">Burkina Faso</option> 
                                <option value="Burundi">Burundi</option> 
                                <option value="Cambodia">Cambodia</option> 
                                <option value="Cameroon">Cameroon</option> 
                                <option value="Canada">Canada</option> 
                                <option value="Cape Verde">Cape Verde</option> 
                                <option value="Cayman Islands">Cayman Islands</option> 
                                <option value="Central African Republic">Central African Republic</option> 
                                <option value="Chad">Chad</option> 
                                <option value="Chile">Chile</option> 
                                <option value="China">China</option> 
                                <option value="Christmas Island">Christmas Island</option> 
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
                                <option value="Colombia">Colombia</option> 
                                <option value="Comoros">Comoros</option> 
                                <option value="Congo">Congo</option> 
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
                                <option value="Cook Islands">Cook Islands</option> 
                                <option value="Costa Rica">Costa Rica</option> 
                                <option value="Cote D'ivoire">Cote D'ivoire</option> 
                                <option value="Croatia">Croatia</option> 
                                <option value="Cuba">Cuba</option> 
                                <option value="Cyprus">Cyprus</option> 
                                <option value="Czech Republic">Czech Republic</option> 
                                <option value="Denmark">Denmark</option> 
                                <option value="Djibouti">Djibouti</option> 
                                <option value="Dominica">Dominica</option> 
                                <option value="Dominican Republic">Dominican Republic</option> 
                                <option value="Ecuador">Ecuador</option> 
                                <option value="Egypt">Egypt</option> 
                                <option value="El Salvador">El Salvador</option> 
                                <option value="Equatorial Guinea">Equatorial Guinea</option> 
                                <option value="Eritrea">Eritrea</option> 
                                <option value="Estonia">Estonia</option> 
                                <option value="Ethiopia">Ethiopia</option> 
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
                                <option value="Faroe Islands">Faroe Islands</option> 
                                <option value="Fiji">Fiji</option> 
                                <option value="Finland">Finland</option> 
                                <option value="France">France</option> 
                                <option value="French Guiana">French Guiana</option> 
                                <option value="French Polynesia">French Polynesia</option> 
                                <option value="French Southern Territories">French Southern Territories</option> 
                                <option value="Gabon">Gabon</option> 
                                <option value="Gambia">Gambia</option> 
                                <option value="Georgia">Georgia</option> 
                                <option value="Germany">Germany</option> 
                                <option value="Ghana">Ghana</option> 
                                <option value="Gibraltar">Gibraltar</option> 
                                <option value="Greece">Greece</option> 
                                <option value="Greenland">Greenland</option> 
                                <option value="Grenada">Grenada</option> 
                                <option value="Guadeloupe">Guadeloupe</option> 
                                <option value="Guam">Guam</option> 
                                <option value="Guatemala">Guatemala</option> 
                                <option value="Guinea">Guinea</option> 
                                <option value="Guinea-bissau">Guinea-bissau</option> 
                                <option value="Guyana">Guyana</option> 
                                <option value="Haiti">Haiti</option> 
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
                                <option value="Honduras">Honduras</option> 
                                <option value="Hong Kong">Hong Kong</option> 
                                <option value="Hungary">Hungary</option> 
                                <option value="Iceland">Iceland</option> 
                                <option value="India">India</option> 
                                <option value="Indonesia">Indonesia</option> 
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
                                <option value="Iraq">Iraq</option> 
                                <option value="Ireland">Ireland</option> 
                                <option value="Israel">Israel</option> 
                                <option value="Italy">Italy</option> 
                                <option value="Jamaica">Jamaica</option> 
                                <option value="Japan">Japan</option> 
                                <option value="Jordan">Jordan</option> 
                                <option value="Kazakhstan">Kazakhstan</option> 
                                <option value="Kenya">Kenya</option> 
                                <option value="Kiribati">Kiribati</option> 
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
                                <option value="Korea, Republic of">Korea, Republic of</option> 
                                <option value="Kuwait">Kuwait</option> 
                                <option value="Kyrgyzstan">Kyrgyzstan</option> 
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
                                <option value="Latvia">Latvia</option> 
                                <option value="Lebanon">Lebanon</option> 
                                <option value="Lesotho">Lesotho</option> 
                                <option value="Liberia">Liberia</option> 
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
                                <option value="Liechtenstein">Liechtenstein</option> 
                                <option value="Lithuania">Lithuania</option> 
                                <option value="Luxembourg">Luxembourg</option> 
                                <option value="Macao">Macao</option> 
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
                                <option value="Madagascar">Madagascar</option> 
                                <option value="Malawi">Malawi</option> 
                                <option value="Malaysia">Malaysia</option> 
                                <option value="Maldives">Maldives</option> 
                                <option value="Mali">Mali</option> 
                                <option value="Malta">Malta</option> 
                                <option value="Marshall Islands">Marshall Islands</option> 
                                <option value="Martinique">Martinique</option> 
                                <option value="Mauritania">Mauritania</option> 
                                <option value="Mauritius">Mauritius</option> 
                                <option value="Mayotte">Mayotte</option> 
                                <option value="Mexico">Mexico</option> 
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
                                <option value="Moldova, Republic of">Moldova, Republic of</option> 
                                <option value="Monaco">Monaco</option> 
                                <option value="Mongolia">Mongolia</option> 
                                <option value="Montserrat">Montserrat</option> 
                                <option value="Morocco">Morocco</option> 
                                <option value="Mozambique">Mozambique</option> 
                                <option value="Myanmar">Myanmar</option> 
                                <option value="Namibia">Namibia</option> 
                                <option value="Nauru">Nauru</option> 
                                <option value="Nepal">Nepal</option> 
                                <option value="Netherlands">Netherlands</option> 
                                <option value="Netherlands Antilles">Netherlands Antilles</option> 
                                <option value="New Caledonia">New Caledonia</option> 
                                <option value="New Zealand">New Zealand</option> 
                                <option value="Nicaragua">Nicaragua</option> 
                                <option value="Niger">Niger</option> 
                                <option value="Nigeria">Nigeria</option> 
                                <option value="Niue">Niue</option> 
                                <option value="Norfolk Island">Norfolk Island</option> 
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
                                <option value="Norway">Norway</option> 
                                <option value="Oman">Oman</option> 
                                <option value="Pakistan">Pakistan</option> 
                                <option value="Palau">Palau</option> 
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
                                <option value="Panama">Panama</option> 
                                <option value="Papua New Guinea">Papua New Guinea</option> 
                                <option value="Paraguay">Paraguay</option> 
                                <option value="Peru">Peru</option> 
                                <option value="Philippines">Philippines</option> 
                                <option value="Pitcairn">Pitcairn</option> 
                                <option value="Poland">Poland</option> 
                                <option value="Portugal">Portugal</option> 
                                <option value="Puerto Rico">Puerto Rico</option> 
                                <option value="Qatar">Qatar</option> 
                                <option value="Reunion">Reunion</option> 
                                <option value="Romania">Romania</option> 
                                <option value="Russian Federation">Russian Federation</option> 
                                <option value="Rwanda">Rwanda</option> 
                                <option value="Saint Helena">Saint Helena</option> 
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                <option value="Saint Lucia">Saint Lucia</option> 
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
                                <option value="Samoa">Samoa</option> 
                                <option value="San Marino">San Marino</option> 
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                <option value="Saudi Arabia">Saudi Arabia</option> 
                                <option value="Senegal">Senegal</option> 
                                <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
                                <option value="Seychelles">Seychelles</option> 
                                <option value="Sierra Leone">Sierra Leone</option> 
                                <option value="Singapore">Singapore</option> 
                                <option value="Slovakia">Slovakia</option> 
                                <option value="Slovenia">Slovenia</option> 
                                <option value="Solomon Islands">Solomon Islands</option> 
                                <option value="Somalia">Somalia</option> 
                                <option value="South Africa">South Africa</option> 
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
                                <option value="Spain">Spain</option> 
                                <option value="Sri Lanka">Sri Lanka</option> 
                                <option value="Sudan">Sudan</option> 
                                <option value="Suriname">Suriname</option> 
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
                                <option value="Swaziland">Swaziland</option> 
                                <option value="Sweden">Sweden</option> 
                                <option value="Switzerland">Switzerland</option> 
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
                                <option value="Tajikistan">Tajikistan</option> 
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
                                <option value="Thailand">Thailand</option> 
                                <option value="Timor-leste">Timor-leste</option> 
                                <option value="Togo">Togo</option> 
                                <option value="Tokelau">Tokelau</option> 
                                <option value="Tonga">Tonga</option> 
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
                                <option value="Tunisia">Tunisia</option> 
                                <option value="Turkey">Turkey</option> 
                                <option value="Turkmenistan">Turkmenistan</option> 
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
                                <option value="Tuvalu">Tuvalu</option> 
                                <option value="Uganda">Uganda</option> 
                                <option value="Ukraine">Ukraine</option> 
                                <option value="United Arab Emirates">United Arab Emirates</option> 
                                <option value="United Kingdom" selected="selected">United Kingdom</option> 
                                <option value="United States">United States</option> 
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
                                <option value="Uruguay">Uruguay</option> 
                                <option value="Uzbekistan">Uzbekistan</option> 
                                <option value="Vanuatu">Vanuatu</option> 
                                <option value="Venezuela">Venezuela</option> 
                                <option value="Viet Nam">Viet Nam</option> 
                                <option value="Virgin Islands, British">Virgin Islands, British</option> 
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
                                <option value="Wallis and Futuna">Wallis and Futuna</option> 
                                <option value="Western Sahara">Western Sahara</option> 
                                <option value="Yemen">Yemen</option> 
                                <option value="Zambia">Zambia</option> 
                                <option value="Zimbabwe">Zimbabwe</option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                        	<td>Post Code *</td>
                            <td colspan="2"><input  type="text" class="inputFields"  name="pcode"  value="<?=$pcode?>"/></td>
                        </tr>
                        <tr>
                        	<td>Phone *</td>
                            <td colspan="2"><input  type="text" class="inputFields"  name="phone"  value="<?=$phone?>"/></td>
                        </tr>
                         <tr>
                        	<td>Email *</td>
                            <td colspan="2"><input  type="text" class="inputFields"  name="email" id="email"  value="<?=$email?>"/></td>
                        </tr>
                        
                    </table>
                   
              </form> 	
      </span>   
                
                <form name="shipform" id="shipform" action="paypal.php" method="post">
                <input type="submit" name="placeorder" value="Place Order">
            
            </p>
           
      
        
        </div>
</div>    
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>
