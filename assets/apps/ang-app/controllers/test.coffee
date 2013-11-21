define ['./module'], (controllers) ->
	controllers.controller 'TestsCtrl', ['$scope', 'angularFire', 'ngProgress', ($scope, angularFire, ngProgress) ->
		ref = new Firebase "https://#{k$.settings.firebaseName}.firebaseio.com/tests/"
		angularFire(ref, $scope, 'tests').then ->
	]