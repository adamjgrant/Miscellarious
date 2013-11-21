define ['./module', 'jquery'], (controllers, $) ->
	controllers.controller 'NotesCtrl', ['$scope', 'angularFire', 'ngProgress', '$location', '$sce', ($scope, angularFire, ngProgress, $location, $sce) ->
		$scope.init = () ->
			ngProgress.start()

		# CRUD
		$scope.create 		= () ->
			d = new Date()
			note = 
				id: Math.floor(Math.random() * 100000000)
				posx: 300
				posy: 300
				text: ''
				color: 1
				timestamp: d.getTime()
			$scope.notes.push note
			$scope.setSelectedNote note
		$scope.read 		= () -> 
			$scope.unbindNotes() if typeof $scope.unbindNotes == 'function'
			$scope.notes = []
			$scope.roomSlug = ($location.path().substr(1,$location.path().length)|| 'home')
			notes = new Firebase "https://#{k$.settings.firebaseName}.firebaseio.com/room/#{$scope.roomSlug}/notes/"
			promise = angularFire notes, $scope, 'notes'
			promise.then (unbind) ->
				$scope.unbindNotes = unbind
				ngProgress.complete()
				$scope.setSelectedNote $scope.notes[0]
		$scope.update 		= () ->
		$scope.delete 		= () ->


		$scope.read()

		$scope.$on '$locationChangeSuccess', () ->
			$scope.roomSlug = ($location.path().substr(1,$location.path().length) || 'home')
			if (typeof $scope.unbindNotes == 'function')
				console.log 'Yes, it is a function'
				$scope.unbindNotes()
				$scope.notes = []
				$scope.read()

		shortcodes = [
			scode: 'img:troll'
			replacement: '<img src="/img/troll.png">'
		]
		$scope.format = (text) ->
			return ''
			console.log text
			text = text.replace sc.scode, sc.replacement for sc in shortcodes
			text = $sce.trustAsHtml text


		$scope.setSelectedNote = (note) ->
			$scope.selectedNote = note

		$scope.toggleInstructions = () ->
			$scope.instructions = !$scope.instructions

	]