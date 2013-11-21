# deep extension for applying default settings
window.extend = (objA, objB) ->
	for p of objB
		if typeof objA[p] is "object"
			extend objA[p], objB[p]
		else
			objA[p] = objB[p]
	objA