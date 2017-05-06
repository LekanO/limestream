angular.module('authApp')

    .controller('AllLiveListCtrl', ['$scope', '$http', function ($scope, $http) {

        var url = 'http://www.limestream.tv/api/lives';

        $http({
            method: 'GET',
            url: url
        }).then(function (success) {
            $scope.allList = success.data.data;
        },function(error) {
            console.error('Error happened while getting the movie list.')
        });


        var url = 'http://www.limestream.tv/api/videos';

        $http({
            method: 'GET',
            url: url
        }).then(function (success) {
            $scope.allVidList = success.data.data;
        },function(error) {
            console.error('Error happened while getting the movie list.')
        });

    }]);