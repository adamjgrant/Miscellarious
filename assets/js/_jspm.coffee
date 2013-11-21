# JSPM

jspm.config
	endpoints:
		ks:
			location: './apps'
			normalize: (name) ->
				name = name + '/main' if (name.split('/').length == 1)
				return name
	map:
		'bootstrap': 		'github:twbs/bootstrap@3.0.2/js/bootstrap'
		'angular': 			'angular@1.2.0/angular'
		'angularFire': 		'angularFire@0.3'
		'ang-app': 			'ks:ang-app'
		'angular-route':	'ks:ang-app/resources/angular-route'
		'ng-sanitize':		'ks:ang-app/resources/ng-sanitize'
		'ng-progress':		'ks:ang-app/resources/ng-progress'
		'fontawesome': 		'cdnjs:font-awesome/4.0.1/css/font-awesome.min.css!'
	shim: 
		'cdnjs:angular.js/1.2.0/angular':
			exports: 'angular'
		'ks:ang-app/resources/angular-route': ['angular@1.2.0/angular']
		'ks:ang-app/resources/ng-progress': ['angular@1.2.0/angular']
		'ks:ang-app/resources/ng-sanitize': ['angular@1.2.0/angular']
