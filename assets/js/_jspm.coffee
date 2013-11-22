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
		'angular': 			'ks:angular/main'
		'angularFire': 		'angularFire@0.3'
		'ang-app': 			'ks:ang-app'
		'angular-route':	'ks:ang-app/resources/angular-route'
		'ng-sanitize':		'ks:ang-app/resources/ng-sanitize'
		'ng-progress':		'ks:ang-app/resources/ng-progress'
		'fontawesome': 		'cdnjs:font-awesome/4.0.1/css/font-awesome.min.css!'
	shim: 
		'ks:angular/main': exports: 'angular'
		'ks:ang-app/resources/angular-route': ['ks:angular/main']
		'ks:ang-app/resources/ng-progress': ['ks:angular/main']
		'ks:ang-app/resources/ng-sanitize': ['ks:angular/main']