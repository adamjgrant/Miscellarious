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

	# DRAG EVENTS

	handleDragStart = (e) ->
		this.style.opacity = '0'
	handleDragOver = (e) ->
		this.style.opacity = '1'
		console.log e.clientX
		e.preventDefault() if e.preventDefault
		e.stopPropagation() if e.stopPropagation
		# e.dataTransfer.dropEffect = 'move'
		false

	$('body').on('drag', '.uikit-note', handleDragStart)
	$('body').on('dragover', '.uikit-note', handleDragOver)