angular.module('authApp')

.controller('AllVideosListCtrl', ['$scope', '$http', function ($scope, $http) {
  
  var url = 'http://www.limestream.tv/api/videos';

  $http({method: 'GET', url: url}).
      success(function (data, status, headers, config) {
          $scope.allList = data.data;
      }).
      error(function (data, status, headers, config) {
          console.error('Error happened while getting the movie list.')
      });
}]);