class Animal
	constructor: (@name) ->

	move: (meters) ->
		alert @name + " moved #{meters}m"

class Snake extends Animal
	move: ->
		alert 'slithering'
		super 5

class Horse extends Animal
	move: ->
		alert 'Galloping...'
		super 45

sam = new Snake "Sammy the python"
tom = new Horse "Tommy the horse"

sam.move()
tom.move()