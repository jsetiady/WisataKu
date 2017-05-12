<?php
	$ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
	
	
	require_once("{$base_dir}config{$ds}Connection.php");
	include_once("{$base_dir}model{$ds}LocationModel.php");
	include_once("{$base_dir}model{$ds}StatusModel.php");
	include_once("{$base_dir}model{$ds}TourItineraryModel.php");
	include_once("{$base_dir}model{$ds}TourPackageModel.php");
// 	include_once("{$base_dir}model{$ds}TransactionRentVehicleModel.php");
// 	include_once("{$base_dir}model{$ds}TransactionSouvenirModel.php");
// 	include_once("{$base_dir}model{$ds}TransactionTourModel.php");
 	include_once("{$base_dir}model{$ds}UserModel.php");
?>