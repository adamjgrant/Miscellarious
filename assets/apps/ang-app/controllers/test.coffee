define ['./module'], (controllers) ->
	controllers.controller 'TestsCtrl', ['$scope', 'angularFire', 'ngProgress', ($scope, angularFire, ngProgress) ->
		$scope.tests = []
		ref = new Firebase "https://#{k$.settings.firebaseName}.firebaseio.com/tests/"
		promise = angularFire ref, $scope, 'tests'
		promise.then (unbind) ->
			$scope.unbindTests = unbind
	]