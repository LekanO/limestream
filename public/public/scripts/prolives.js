angular.module('authApp')

.controller('DashAllLiveListCtrl', ['$scope', '$http', function ($scope, $http) {
  
  var url = 'http://ec2-35-162-73-198.us-west-2.compute.amazonaws.com/api/dashlive';

  $http({method: 'GET', url: url}).
      success(function (data, status, headers, config) {
          $scope.allList = data.data;
      }).
      error(function (data, status, headers, config) {
          console.error('Error happened while getting the movie list.')
      });
}]);