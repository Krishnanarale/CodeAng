<!DOCTYPE html>
<html>
<head>
	<title>CodeAng</title>
	<link rel="stylesheet" type="text/css" href="<?php echo  base_url('assets/bootstrap/css/bootstrap.css'); ?>">
	<script type="text/javascript" src="<?php echo  base_url('assets/jquery/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo  base_url('assets/bootstrap/js/bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo  base_url('assets/angular/angular.js'); ?>"></script>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo  base_url('/'); ?>">CodeAng</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo  base_url('/'); ?>">Home</a></li>
					<li class="active"><a href="<?php echo  base_url('/Employees/AddEmployee'); ?>">Add Employee</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="container">
		<div ng-app="mainApp" ng-controller="mainController">
			<form ng-submit="submitEmployeeForm()">
				<div class="form-group">
					<label for="firstName">First Name:</label>
					<input type="text" class="form-control" name="firstName" ng-model="employee.firstName">
				</div>
				<div class="form-group">
					<label for="lastName">Last Name:</label>
					<input type="text" class="form-control" name="lastName" ng-model="employee.lastName">
				</div>
				<div class="form-group">
					<label for="gender">Gender:</label>
					<label class="radio-inline"><input type="radio" name="gender" value="Male" ng-model="employee.gender" id="gender">Male</label>
					<label class="radio-inline"><input type="radio" name="gender" value="Female" ng-model="employee.gender">Female</label>
				</div>
				<div class="form-group">
					<label for="dateOfBirth">Date Of Birth:</label>
					<input type="date" class="form-control" name="dateOfBirth" ng-model="employee.dateOfBirth">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" name="email" ng-model="employee.email">
				</div>
				<div class="form-group">
					<label for="phone">Phone:</label>
					<input type="text" class="form-control" name="phone" ng-model="employee.phone">
				</div>
				<!-- <div class="form-group">
					<label for="languages">Languages:</label>
					<label class="checkbox-inline"><input type="checkbox" ng-model="employee.c">C</label>
					<label class="checkbox-inline"><input type="checkbox" ng-model="employee.php">PHP</label>
					<label class="checkbox-inline"><input type="checkbox" ng-model="employee.javascript">JavaScript</label>
				</div> -->
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
	angular.module("mainApp", []).
	controller("mainController", function($scope, $http) {
		$scope.submitEmployeeForm = function () {
			$http({
				method : "POST",
				url : "<?php echo  base_url('Employees/store'); ?>",
				data: $scope.employee,
			}).then(function success(res) {
				if (res.data.status == "success") {
					location.href = '<?php echo  base_url("/"); ?>';
				} else {
					console.log(res.data);
				}
			}, function error(err) {
				console.log(err);
			});
		};
	});
</script>
</html>