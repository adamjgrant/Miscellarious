define ['./module'], (controllers) ->
	controllers.controller 'ProductsCtrl', ['$scope', 'angularFire', 'ngProgress', ($scope, angularFire, ngProgress) ->
		$scope.products = $scope.featuredProducts = []
		ngProgress.start()
		products = new Firebase "https://#{k$.settings.firebaseName}.firebaseio.com/products/"
		promise = angularFire products, $scope, 'products'
		promise.then ->
			$scope.productForId = (id) ->
				productIndex = 0
				$.grep($scope.products, (e, i) -> productIndex = i if e.id == id )
				$scope.products[productIndex]
			$.grep($scope.products, (e, i) -> $scope.featuredProducts.push($scope.products[i]) if e.featured == true )
			# $.grep( $scope.products, (e, i) -> $scope.featuredProducts.push($scope.products[i]) )
			console.log $scope.products
			console.log $scope.featuredProducts

			# Pagination

			$scope.genericItems = $scope.products # Loosely-couples with pagination include
			$scope.currentPage = 0
			$scope.pageSize = 10
			$scope.numPages = () ->
				Math.ceil $scope.genericItems.length/$scope.pageSize
			$scope.startFrom = () ->
				$scope.currentPage * $scope.pageSize + 3 # We used up the first three in the sub-featured items
			$scope.increment = () -> $scope.currentPage++
			$scope.deincrement = () -> $scope.currentPage--
			$scope.setCurrentPage = (number) ->
				$scope.currentPage = number

			# Shopping Cart

			$scope.lastRemoved = null
			$scope.purchases = [
				product: $scope.productForId(2)
				quantity: 2
			,
				product: $scope.productForId(12)
				quantity: 4
			,
				product: $scope.productForId(19)
				quantity: 1
			]
			$scope.deletePurchase = (id) ->
				purchaseIndex = 0
				$.grep($scope.purchases, (e, i) -> purchaseIndex = i if e.product.id == id)
				$scope.lastRemoved = $scope.purchases[purchaseIndex]
				$scope.purchases.splice(purchaseIndex, 1)
			$scope.restorePurchase = (purchase) ->
				$scope.purchases.push(purchase)
				$scope.lastRemoved = null
			$scope.total = () ->
				return $scope.purchases.reduce(
					(a, b) ->
						return { quantity: a.quantity + (b.quantity * b.product.price)}
				, {quantity: 0}).quantity
			ngProgress.complete()

	]