angular.module('authApp')

.controller('LiveDetailCtrl', ['$scope', '$http', '$location', '$sce', 'videoData', function videoData($scope, $http, $location, $sce, videoData) {

	var liveDetailId = $location.path().split("/")[2] || "unknown";
  
  	var url = 'http://www.limestream.tv/api/live/' + liveDetailId;
    $http.get(url).success(function (data) {
        $scope.liveDetail = data;
    });

    this.live = videoData;
         
}]);