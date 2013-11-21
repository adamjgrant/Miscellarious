define ['./module', 'jquery'], (controllers, $) ->
	controllers.controller 'NotesCtrl', ['$scope', 'angularFire', 'ngProgress', '$location', '$sce', ($scope, angularFire, ngProgress, $location, $sce) ->
		$scope.init = () ->

		# CRUD
		$scope.create 		= () ->
			d = new Date()
			note = 
				id: Math.floor(Math.random() * 100000000)
				posx: 300
				posy: 300
				text: ''
				color: Math.floor Math.random() * ((5-1) + 1) + 1
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
			ngProgress.start()
			$scope.roomSlug = ($location.path().substr(1,$location.path().length) || 'home')
			if (typeof $scope.unbindNotes == 'function')
				console.log 'Yes, it is a function'
				$scope.unbindNotes()
				$scope.notes = []
				$scope.read()

		$scope.getColorClass = (num) ->
			col = 'yellow'
			switch num
				when 1 then col = 'yellow'
				when 2 then col = 'green'
				when 3 then col = 'blue'
				when 4 then col = 'orange'
				when 5 then col = 'purple'
				else col = 'yellow'
			'uikit-note_' + col

		shortcodes = [
			scode: 'img:troll'
			replacement: '<div class="img-stamp img-stamp_troll"></div>'
		,
			scode: 'img:pokerface'
			replacement: '<div class="img-stamp img-stamp_pokerface"></div>'
		,
			scode: 'img:leanback'
			replacement: '<div class="img-stamp img-stamp_leanback"></div>'
		,
			scode: 'img:foreveralone'
			replacement: '<div class="img-stamp img-stamp_foreveralone"></div>'
		,
			scode: 'img:ruserious'
			replacement: '<div class="img-stamp img-stamp_ruserious"></div>'
		,
			scode: 'img:closeenough'
			replacement: '<div class="img-stamp img-stamp_closeenough"></div>'
		,
			scode: 'img:yuno'
			replacement: '<div class="img-stamp img-stamp_yuno"></div>'
		,
			scode: 'img:okay'
			replacement: '<div class="img-stamp img-stamp_okay"></div>'
		,
			scode: 'img:allthethings'
			replacement: '<div class="img-stamp img-stamp_allthethings"></div>'
		,
			scode: 'img:jackiechan'
			replacement: '<div class="img-stamp img-stamp_jackiechan"></div>'
		,
			scode: 'img:dontevencare'
			replacement: '<div class="img-stamp img-stamp_dontevencare"></div>'
		]
		$scope.format = (text) ->
			console.log text
			text = text.replace sc.scode, sc.replacement for sc in shortcodes
			text = $sce.trustAsHtml String text

		$scope.setSelectedNote = (note) ->
			$scope.selectedNote = note

		$scope.toggleInstructions = () ->
			$scope.instructions = !$scope.instructions
		$scope.toggleRR = () ->
			$scope.recentR = !$scope.recentR

	]