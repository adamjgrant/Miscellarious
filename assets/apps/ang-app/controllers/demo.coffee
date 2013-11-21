define ['./module'], (controllers) ->
	controllers.controller 'DemoCtrl', ['$scope', 'angularFire', 'ngProgress', ($scope, angularFire, ngProgress) ->
		$scope.fName = ' '
		$scope.lName = ' '
		$scope.fullName = () ->
			$scope.fName + ' ' + $scope.lName
	]