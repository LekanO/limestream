(function() {

	'use strict';

	var myApp = angular
		.module('authApp')

		myApp.directive('fileModel', ['$parse', function ($parse) {
		    return {
		        restrict: 'A',
		        link: function(scope, element, attrs) {
		            var model = $parse(attrs.fileModel);
		            var modelSetter = model.assign;
		            
		            element.bind('change', function(){
		                scope.$apply(function(){
		                    modelSetter(scope, element[0].files[0]);
		                });
		            });
		        }
		    };
		}]);

		myApp.service('fileUpload', ['$http', function ($http) {
		    this.uploadFileToUrl = function(file, uploadUrl){
		        var fd = new FormData();
		        fd.append('file', file);
		        $http.post(uploadUrl, fd, {
		            transformRequest: angular.identity, 
		            headers: {'Content-Type': undefined}
		        })
		        .success(function(){
		        })
		        .error(function(){
		        });
		    }
		}]);

		myApp.controller('ProfileController', ['$scope', '$auth', '$http', 'fileUpload', function($scope, $auth,  $http, fileUpload){
    
		  var url = 'http://www.limestream.tv/api/profile';


            $hhtp({
                method: 'GET',
                url: url
            }).then(function (success) {
                $scope.userProfile = data.items;

            }, function (error) {
                console.error('Error happened while getting the movie list.')
            });

	    $scope.updateProfile = function(){
	        var file = $scope.myFile;
	        console.log('file is ' );
	        console.dir(file);
	        var uploadUrl = "api/profile";
	        fileUpload.uploadFileToUrl(file, uploadUrl);
	    };


	   	$scope.uploadVideo = function(){
	        var file = $scope.myFile;
     	    var poster = $scope.myPoster;
	        console.log('file is ' );
	        console.dir(file);
	        var uploadUrl = "api/video_upload";
	        fileUpload.uploadFileToUrl(file, uploadUrl);
	    };


	    $scope.uploadFile = function(){
	        var file = $scope.myFile;
	        console.log('file is ' );
	        console.dir(file);
	        var uploadUrl = "api/upload-file";
	        fileUpload.uploadFileToUrl(file, uploadUrl);
	    };

	    var vm = this;
 
		vm.users;
		vm.error;

      		// We would normally put the logout method in the same
		// spot as the login method, ideally extracted out into
		// a service. For this simpler example we'll leave it here
		vm.logout = function() {

			$auth.logout().then(function() {

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
		};
	    
	}]);

	

})();
