(function() {

	'use strict';

	angular
		.module('authApp')
		.controller('PasswordResetController', PasswordResetController);

		function PasswordResetController($state, $auth, $http, $rootScope) {

		var vm = this;
		vm.newReset;
		vm.loginError = false;
		vm.loginErrorText;
		
		vm.reset = function() {
                        $http.post('password/reset',vm.newReset)
                        .success(function(data){
                           vm.email=vm.newReset.email;
                           vm.password=vm.newReset.password;
                           vm.password_confirmation=vm.newReset.password_confirmation;
                    }).error(function(error){
                    		vm.loginError = true;
							vm.loginErrorText = error;
                    })
                }

	}

})();
