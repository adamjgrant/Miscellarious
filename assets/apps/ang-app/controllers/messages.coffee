define ['./module'], (controllers) ->
	controllers.controller 'MessagesCtrl', ['$scope', 'angularFire', 'ngProgress', ($scope, angularFire, ngProgress) ->
		ngProgress.start()
		$scope.allThreads = []
		threads = new Firebase "https://#{k$.settings.firebaseName}.firebaseio.com/threads/"
		promise = angularFire threads, $scope, 'allThreads'

		$scope.allThreads = []
		contacts = new Firebase "https://#{k$.settings.firebaseName}.firebaseio.com/contacts/"
		promise = angularFire contacts, $scope, 'contacts'
		promise.then ->
			ngProgress.complete()

		$scope.contactForId = (id) ->
			contactIndex = 0
			$.grep($scope.contacts, (e, i) -> contactIndex = i if e.id == id )
			$scope.contacts[contactIndex]
		$scope.selectedThread = $scope.allThreads[0]
		$scope.setSelectedThread = (thread) ->
			$scope.selectedThread = thread
	]