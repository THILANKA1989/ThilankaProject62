var dash = angular.module('dash',['ngRoute']);

// Declare a controller
dash.config(function($routeProvider){
	$routeProvider

	.when('/',{
		templateUrl: 'pages/dashboard.php',
		controller: 'mainController'
	})

	.when('/resources',{
		templateUrl: 'pages/resources.php',
		controller: 'resourceController'
	})
	.when('/overview',{
		templateUrl: 'pages/overview.php',
		controller: 'overviewController'
	})
	.when('/lending',{
		templateUrl: 'pages/lending.php',
		controller: 'lendingController'
	})
	.when('/members',{
		templateUrl: 'pages/members.php',
		controller: 'membersController'
	})
	.when('/payments',{
		templateUrl: 'pages/payments.php',
		controller: 'paymentsController'
	})
	.when('/addbooks',{
		templateUrl: 'pages/addbooks.php',
		controller: 'addBooksController'
	})
	.when('/addauthors',{
		templateUrl: 'pages/addauthors.php',
		controller: 'addAuthorsController'
	})
	.when('/addpublisher',{
		templateUrl: 'pages/addpubs.php',
		controller: 'addPublishersController'
	})
	.when('/addlocations',{
		templateUrl: 'pages/addlocations.php',
		controller: 'addLocationsController'
	})
	.when('/addcategory',{
		templateUrl: 'pages/addcategory.php',
		controller: 'addCategoriesController'
	})
	.when('/addmagazines',{
		templateUrl: 'pages/addmagazines.php',
		controller: 'addMagazinesController'
	})
	.when('/addpapers',{
		templateUrl: 'pages/addnewspapers.php',
		controller: 'addPapersController'
	})
	.when('/editbooks',{
		templateUrl: 'pages/editbooks.php',
		controller: 'editBooksController'
	})
	.when('/editmag',{
		templateUrl: 'pages/editmag.php',
		controller: 'editMagsController'
	})
	.when('/editpapers',{
		templateUrl: 'pages/editpapers.php',
		controller: 'editPapersController'
	})

});
dash.controller('mainController',['$scope','$log',function($scope,$log){

}]);

dash.controller('resourceController',['$scope','$log',function($scope,$log){

}]);

dash.controller('overviewController',['$scope','$log',function($scope,$log){

}]);
dash.controller('lendingController',['$scope','$log',function($scope,$log){

}]);

dash.controller('membersController',['$scope','$log','$http',function($scope,$log,$http){

}]);

dash.controller('paymentsController',['$scope','$log',function($scope,$log){

}]);

dash.controller('addBooksController',['$scope','$log','$http',function($scope,$log){

}]);
dash.controller('addAuthorsController',['$scope','$log',function($scope,$log){

}]);
dash.controller('addPublishersController',['$scope','$log',function($scope,$log){

}]);
dash.controller('addLocationsController',['$scope','$log',function($scope,$log){

}]);
dash.controller('addCategoriesController',['$scope','$log',function($scope,$log){

}]);
dash.controller('addMagazinesController',['$scope','$log',function($scope,$log){

}]);
dash.controller('addPapersController',['$scope','$log',function($scope,$log){

}]);
dash.controller('editBooksController',['$scope','$log',function($scope,$log){

}]);
dash.controller('editMagsController',['$scope','$log',function($scope,$log){

}]);
dash.controller('editPapersController',['$scope','$log',function($scope,$log){

}]);
