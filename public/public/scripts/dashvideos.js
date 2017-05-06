window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

angular.module('authApp')

.controller('DashAllVideosListCtrl', ['$scope', '$auth', '$http', '$document', function ($scope, $auth, $http, $document) {
  
	
	var url = 'http://www.limestream.tv/api/dashVid';

  	$http({method: 'GET', url: url}).
      success(function (data, status, headers, config) {
          $scope.allList = data.data;
      }).
      error(function (data, status, headers, config) {
          console.error('Error happened while getting the movie list.')
      });


    var url = 'http://www.limestream.tv/api/dashlive';

	$http({method: 'GET', url: url}).
	      success(function (data, status, headers, config) {
	          $scope.allVidList = data.data;
	      }).
	      error(function (data, status, headers, config) {
	          console.error('Error happened while getting the movie list.')
	  });

     	var vm = this;

		vm.users;
		vm.error;

		// We would normally put the logout method in the same
		// spot as the login method, ideally extracted out into
		// a service. For this simpler example we'll leave it here
		vm.logout = function() {

			$auth.logout().then(function() {

//			$http.post('/api/logout');

				// Remove the authenticated user from local storage
				localStorage.removeItem('user');

				// Flip authenticated to false so that we no longer
				// show UI elements dependant on the user being logged in
				$rootScope.authenticated = false;

				// Remove the current user info from rootscope
				$rootScope.currentUser = null;

				// Redirect to auth (necessary for Satellizer 0.12.5+)
				$state.go('auth');
			});
		}
}]);