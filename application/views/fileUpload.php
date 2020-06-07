<!DOCTYPE html>
<html>
<head>
	<title>CodeAng</title>
	<link rel="stylesheet" type="text/css" href="<?php echo  base_url('assets/bootstrap/css/bootstrap.css'); ?>">
	<script type="text/javascript" src="<?php echo  base_url('assets/jquery/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo  base_url('assets/bootstrap/js/bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo  base_url('assets/angular/angular.js'); ?>"></script>
</head>
<body ng-app="mainApp" ng-controller="mainController">
	<form>
		<input type='test' name='name' ><br/>
		<input type='file' name='file' id='file'><br/>
		<input type='button' value='Upload' id='upload' ng-click='upload()' >
	</form>
</body>
<script type="text/javascript">
	var upload = angular.module('mainApp', []);
	upload.controller('mainController', ['$scope', '$http', function ($scope, $http) {
		$scope.upload = function(){
			var fd = new FormData();
			var files = document.getElementById('file').files[0];
			fd.append('file',files);
			$http({
				method: 'post',
				url: '<?php echo base_url("Employees/file"); ?>',
				data: fd,
				headers: {'Content-Type': 'multipart/form-data'},
			}).then(function successCallback(response) { 
			});
		}
	}]);
</script>
</html>