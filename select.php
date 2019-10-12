<?php
$link = mysqli_connect('localhost', 'root', '', 'select_city_ajax');

//city query
if(isset($_POST['cid'])){
	$cityQuery = "SELECT * FROM city WHERE CountryId = ".$_POST['cid'];
	$citySql = mysqli_query($link, $cityQuery);
	$cityArray = [];
	while( $cityRow = mysqli_fetch_assoc($citySql) ){
		$cityArray[] = $cityRow;
	}
	//var_dump($cityArray);
	echo json_encode($cityArray);
}

//district query
if( isset($_POST['ctId']) ){
	$districtQuery = "SELECT * FROM district WHERE cityId =".$_POST['ctId'];
	$districtSql = mysqli_query($link, $districtQuery);
	$districtArray = [];
	while( $districtRow = mysqli_fetch_assoc($districtSql) ){
		$districtArray[] = $districtRow;
	}
	echo json_encode($districtArray);
}