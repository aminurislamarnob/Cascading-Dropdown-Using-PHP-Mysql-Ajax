<?php
$link = mysqli_connect('localhost', 'root', '', 'select_city_ajax');

//Get Country from database
$countryQuery = "SELECT * FROM country";
$countrySql = mysqli_query($link, $countryQuery);
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

</head>
<body>

<form action="select.php" id="carform" method="post">
  <div>
  	<label for="country">Country</label>
  	<select id="country" name="country">
	  <option disabled="" selected="">Select Country</option>
	  <?php while( $countryRow = mysqli_fetch_assoc($countrySql) ){ ?>
	  <option value="<?php echo $countryRow['countryId'];?>" id="<?php echo $countryRow['countryId'];?>"><?php echo $countryRow['countryName'];?></option>
	<?php } ?>
	</select>
	<hr>
	<label for="city">City</label>
	<select id="city" name="city">
		<option disabled="" selected="">Select City</option>
	</select>
	<hr>
	<label for="district">District</label>
	<select id="district" name="district">
	 <option disabled="" selected="">Select District</option>
	</select>
  </div>
<input type="submit" value="Sudmit">
</form>



<script>
	$(document).ready(function(){

		//country selection
		$("#country").change(function(){
			var cid = $("#country").val();
			//alert(cid);
			$.ajax({
				url: 'select.php',
				method: 'post',
				data: 'cid='+cid
			}).done(function(countries){
				//console.log(countries);
				countries = JSON.parse(countries);
				//console.log(countries);
				$('#city').empty(); //empty dropdown to select new country
				$('#city').append('<option disabled="" selected="">Select City</option>'); //add default option after empty full option list.
				countries.forEach(function(country){
					//console.log(country.cityName);
					$('#city').append('<option value="'+country.cityId+'" id="'+country.cityId+'">'+ country.cityName +'</option>');
				})
			})
		});


		//City Selection
		$("#city").change(function(){
			var cityId = $("#city").val();
			$.ajax({
				url: 'select.php',
				method: 'post',
				data: 'ctId='+cityId
			}).done(function(districts){
				//console.log(cities);
				districts = JSON.parse(districts);
				$('#district').empty();
				$('#district').append('<option disabled="" selected="">Select District</option>');
				districts.forEach(function(district){
					$('#district').append('<option value="'+district.districtId+'" id="'+district.districtId+'">'+district.districtName+'</option>');
				})
			})

		});

	});
</script>
</body>
</html>