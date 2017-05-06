(function() { 
	'use strict';

	angular
		.module('authApp')
		.controller('LiveController', LiveController);

	function LiveController(dataFactory,$scope,$http, $auth) {

		$scope.data = [];
  		$scope.libraryTemp = {};
  		$scope.totalItemsTemp = {};
  		$scope.totalItems = 0;
  		$scope.pageChanged = function(newPage) {
    		getResultsPage(newPage);
  };
  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest('/dashLive?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalItems = data.total;
          });
      }else{
        dataFactory.httpRequest('/dashLive?page='+pageNumber).then(function(data) {
          $scope.data = data.data;
          $scope.totalItems = data.total;
        });
      }
  }
  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalItemsTemp = $scope.totalItems;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalItems = $scope.totalItemsTemp;
              $scope.libraryTemp = {};
          }
      }
  }
  $scope.saveAdd = function(){
    dataFactory.httpRequest('dashLive','POST',{},$scope.form).then(function(data) {
      $scope.data.push(data);
      $(".modal").modal("hide");
    });
  }
  $scope.edit = function(id){
    dataFactory.httpRequest('dashLive/'+id+'/edit').then(function(data) {
    	console.log(data);
      	$scope.form = data;
    });
  }
  $scope.saveEdit = function(){
    dataFactory.httpRequest('dashLive/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
      	$(".modal").modal("hide");
        $scope.data = apiModifyTable($scope.data,data.id,data);
    });
  }
  $scope.remove = function(item,index){
    var result = confirm("Are you sure delete this item?");
   	if (result) {
      dataFactory.httpRequest('dashLive/'+item.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
      });
    }
  }
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

}
})(); 
