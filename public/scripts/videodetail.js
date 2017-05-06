angular.module('authApp')

.controller('VideoDetailCtrl', ['$scope', '$http', '$location', '$sce', 'videoData', function videoData($scope, $http, $location, $sce, videoData) {

    var videoDetailId = $location.path().split("/")[2] || "unknown";
    
    var url = 'http://www.limestream.tv/api/video/' + videoDetailId;

    $http({
        method: 'GET',
        url: url
    }).then(function (success) {
        $scope.videoDetail = success.data;
    },function (error) {

        console.error('Error happened while getting the movie list.')

    });

    this.video = videoData;
    
}]);