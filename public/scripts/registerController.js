(function() {

	'use strict';

	angular
		.module('authApp')
		.controller('RegisterController', RegisterController);


	function RegisterController($state, $auth, $http, $rootScope) {

		var vm = this;

		vm.success;
		vm.loginError = false;
		vm.loginErrorText;
		

		
		vm.register = function() {
                        $http.post('/api/register', vm.newUser)
                        .success(function(data){
                           vm.username=vm.newUser.username;            	
                           vm.first_name=vm.newUser.first_name;
                           vm.last_name=vm.newUser.last_name;
                           vm.last_name=vm.newUser.organisation;
                           vm.email=vm.newUser.email;
                           vm.password=vm.newUser.password;
                        }).success(function(status) {
								vm.loginError = true;
								vm.loginErrorText = status;
					});
                }
	}

})();