define ['./module'], (directives) ->
	directives.directive 'ksVisible', [->
		(scope, element, attrs) ->
			scope.$watch attrs.ksVisible, (visible) ->
				element.css 'visibility', if visible then 'visible' else 'hidden'
	]