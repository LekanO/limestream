(function() {

	'use strict';

	var myApp = angular
		.module('authApp')

		.directive('backgroundImage', function(){
			return function(scope, element, attrs){
				restrict: 'A',
				attrs.$observe('backgroundImage', function(value) {
					element.css({
						'background-image': 'url(' + value +')'
					});
				});
			};
		});
		
})();
