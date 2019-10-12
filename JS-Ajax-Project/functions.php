<?php
$link = mysqli_connect('localhost','root','','select_city_ajax');
if (!$link) {
    die('Could not connect: ' . mysqli_error($con));
}

//show city names by country id
if(isset($_REQUEST['cid'])){
	$cityQuery = "SELECT * FROM city WHERE CountryId = ".$_REQUEST['cid'];
	$citySql = mysqli_query($link, $cityQuery);
	echo '<option selected="" disabled="">Select Your City</option>';
	while( $cityRow = mysqli_fetch_assoc($citySql) ){
		echo '<option value="'.$cityRow['cityId'].'">'.$cityRow['cityName'].'</option>';
	}
}

//show district names by city id
if(isset($_REQUEST['cityId'])){
	$districtQuery = "SELECT * FROM district WHERE cityId = ".$_REQUEST['cityId'];
	$districtSql = mysqli_query($link, $districtQuery);
	echo '<option selected="" disabled="">Select Your District</option>';
	while( $districtRow = mysqli_fetch_assoc($districtSql) ){
		echo '<option value="'.$districtRow['districtId'].'">'.$districtRow['districtName'].'</option>';
	}
}