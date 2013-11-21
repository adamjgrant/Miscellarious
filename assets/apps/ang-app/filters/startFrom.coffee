define ['./module'], (filters) ->
	filters.filter 'startFrom', [->
		(input, start) ->
			start = +start #parse to int
			input.slice start
	]

# Thanks http://j.mp/HUcrJj