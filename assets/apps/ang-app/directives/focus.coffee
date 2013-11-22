define ['./module'], (directives) ->
	directives.directive 'focus', [->
		(scope, element, attrs) ->
			attrs.$observe 'focus', (newValue) ->
				newValue == 'true' && element[0].focus() 
	]