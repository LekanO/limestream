angular.module('authApp')

.controller('VideoDetailCtrl', ['$scope', '$http', '$location', '$sce', 'videoData', function videoData($scope, $http, $location, $sce, videoData) {

    var videoDetailId = $location.path().split("/")[2] || "unknown";
    
    var url = 'http://www.limestream.tv/api/video/' + videoDetailId;

    $http.get(url).success(function (data) {
        $scope.videoDetail = data;
    });

    this.video = videoData;
    
}]);