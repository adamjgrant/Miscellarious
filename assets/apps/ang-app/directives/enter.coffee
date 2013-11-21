define ['./module'], (directives) ->
	directives.directive 'ksEnter', [->
		(scope, element, attrs) ->
			element.bind "keydown keypress", (event) ->
				if event.which is 13
					scope.$apply ->
						scope.$eval attrs.ksEnter
					event.preventDefault()
	]