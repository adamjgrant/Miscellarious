define ['./module', 'jquery'], (controllers, $) ->
	controllers.controller 'NotesCtrl', ['$scope', 'angularFire', 'ngProgress', ($scope, angularFire, ngProgress) ->
		$scope.init = () ->
			ngProgress.start()

		$scope.notes = []
		notes = new Firebase "https://#{k$.settings.firebaseName}.firebaseio.com/notes/"
		promise = angularFire notes, $scope, 'notes'
		promise.then (unbind) ->
			$scope.unbindNotes = unbind
			ngProgress.complete()
			$scope.setSelectedNote $scope.notes[0]

		# CRUD
		$scope.create 		= () ->
			note = 
				id: Math.floor(Math.random() * 100000000)
				posx: 300
				posy: 300
				text: ''
				color: 1
			$scope.notes.push note
		$scope.read 		= () -> 
		$scope.update 		= () ->
		$scope.delete 		= () ->

		$scope.setSelectedNote = (note) ->
			$scope.selectedNote = note

		$scope.setPos = (note) ->
			console.log 'setpos called'
			$scope.setSelectedNote note
			$scope.selectedNote.posx = window.noteX
			$scope.selectedNote.posy = window.noteY

	]

	$('.container').on 'mousemove', '.movebar', ->
		$('.uikit-note')
			.draggable
				handle: '.movebar'
				drag: (e) ->
					window.noteX = e.clientX
					window.noteY = e.clientY
			.mousedown (e) ->
				window.noteX = e.clientX
				window.noteY = e.clientY