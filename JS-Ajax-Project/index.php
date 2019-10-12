<?php
$link = mysqli_connect('localhost','root','','select_city_ajax');
if (!$link) {
    die('Could not connect: ' . mysqli_error($con));
}

$countryQuery = "SELECT * FROM country";
$countrySql = mysqli_query($link, $countryQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cascading Dropdown by JS Ajax</title>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
	  <div class="row">
	    <div class="column column-50 column-offset-25">
	    	<h1>cascading dropdown in php mysql ajax</h1>
	    	<form>
			  <fieldset>
			    <label for="selectCountry">Country</label>
			    <select id="selectCountry" onchange="showCity(this.value)">
			      <option value="" selected="" disabled="">Select Your Country</option>
			      <?php while($countryRow = mysqli_fetch_assoc($countrySql) ){ ?>
			      <option value="<?php echo $countryRow['countryId'];?>"><?php echo $countryRow['countryName'];?></option>
			  	  <?php } ?>
			    </select>
			    <label for="selectCity">City</label>
			    <select id="selectCity" onchange="showDistrict(this.value)">
			      <option selected="" disabled="">No City Available</option>
			    </select>
			    <label for="selectDistrict">District</label>
			    <select id="selectDistrict">
			      <option selected="" disabled="">No District Available</option>
			    </select>
			    <input class="button-primary" type="submit" value="Send">
			  </fieldset>
			</form>
	    </div>
	  </div>
	</div>


	<script>
	//show city by ajax	
	function showCity(str) {
	    if (str == "") {
	        document.getElementById("selectCity").innerHTML = "";
	        return;
	    } else {
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("selectCity").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","functions.php?cid="+str,true);
	        xmlhttp.send();
	    }
	}


	//show district by ajax	
	function showDistrict(str) {
	    if (str == "") {
	        document.getElementById("selectDistrict").innerHTML = "";
	        return;
	    } else {
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("selectDistrict").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","functions.php?cityId="+str,true);
	        xmlhttp.send();
	    }
	}
	</script>
</body>
</html>