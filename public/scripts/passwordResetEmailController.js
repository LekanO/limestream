(function() {

	'use strict';

	angular
		.module('authApp')
		.controller('PasswordResetEmailController', PasswordResetEmailController);

		function PasswordResetEmailController($state, $auth, $http, $rootScope) {

		var vm = this;
		vm.newReset;
		vm.loginError = false;
		vm.loginErrorText;
		
		vm.reset = function() {
                        $http.post('password/email',vm.newReset)
                        .success(function(data){
                           vm.email=vm.newReset.email;
                        }).error(function(error){
                        	vm.loginError = true;
							vm.loginErrorText = error;
                        });
                }
	}

})();
 