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
					<li class="active"><a href="<?php echo  base_url('/'); ?>">Home</a></li>
					<li><a href="<?php echo  base_url('/Employees/AddEmployee'); ?>">Add Employee</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="container">
		<div ng-app="mainApp" ng-controller="mainController">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Sr</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Gender</th>
						<th>Date Of Birth</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="employee in employees">
						<td>{{ employee.id }}</td>
						<td>{{ employee.firstName }}</td>
						<td>{{ employee.lastName }}</td>
						<td>{{ employee.gender }}</td>
						<td>{{ employee.dateOfBirth }}</td>
						<td>{{ employee.email }}</td>
						<td>{{ employee.phone }}</td>
						<td>
							<a class="btn btn-warning" data-toggle="modal" data-target="#editModal" ng-click="editEmployee(employee.id)">Edit</a>
							<a class="btn btn-danger" ng-click="deleteEmployee(employee.id)">Delete</a>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- Modal -->
			<div id="editModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
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
									<input type="text" class="form-control" name="dateOfBirth" ng-model="employee.dateOfBirth">
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
									<label class="checkbox-inline"><input type="checkbox" ng-model="employee.c" ng-checked="employee.c == '1'">C</label>
									<label class="checkbox-inline"><input type="checkbox" ng-model="employee.php" ng-checked="employee.php == '1'">PHP</label>
									<label class="checkbox-inline"><input type="checkbox" ng-model="employee.javascript" ng-checked="employee.javascript == '1'">JavaScript</label>
								</div> -->
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	angular.module("mainApp", []).
	controller("mainController", function($scope, $http) {
		$http({
			method : "GET",
			url : "<?php echo  base_url('Employees/getEmployee'); ?>",
			data: "",
		}).then(function success(res) {
			if (res.data.status == "success") {
				$scope.employees = res.data.data;
			} else {
				console.log(res.data);
			}
		}, function error(err) {
			console.log(err);
		});

		$scope.editEmployee = function ($obj) {
			$http({
				method : "POST",
				url : "<?php echo  base_url('Employees/getEmployeeById'); ?>",
				data: { id : $obj },
			}).then(function success(res) {
				if (res.data.status == "success") {
					$scope.employee = res.data.data[0];
				} else {
					console.log(res.data);
				}
			}, function error(err) {
				console.log(err);
			});
		}

		$scope.submitEmployeeForm = function () {
			$http({
				method : "POST",
				url : "<?php echo  base_url('Employees/updateEmployee'); ?>",
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
		}

		$scope.deleteEmployee = function ($obj) {
			$http({
				method : "POST",
				url : "<?php echo  base_url('Employees/deleteEmployee'); ?>",
				data: { id : $obj },
			}).then(function success(res) {
				if (res.data.status == "success") {
					location.href = '<?php echo  base_url("/"); ?>';
				} else {
					console.log(res.data);
				}
			}, function error(err) {
				console.log(err);
			});
		}
	});
</script>
</html>