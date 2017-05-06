angular.module('authApp')

.controller('LiveDetailCtrl', ['$scope', '$http', '$location', '$sce', 'videoData', function videoData($scope, $http, $location, $sce, videoData) {

	var liveDetailId = $location.path().split("/")[2] || "unknown";
  
  	var url = 'http://www.limestream.tv/api/live/' + liveDetailId;

    $http({
        method: 'GET',
        url: url
    }).then(function (success) {
        $scope.liveDetail = success.data;
    },function (error) {
        console.error('Something went wrong');
    });

    this.live = videoData;



    var vm = this;

    vm.body='';
    vm.newFeed={};
    vm.loginError = false;
    vm.loginErrorText;

    vm.feedSuccess = false;
    vm.feedSuccessText;

    vm.postFee = function() {

        var url = 'http://www.limestream.tv/api/live/' + liveDetailId + this.user.id;

        $http.post(url,vm.newFeed)
            .success(function(data){
                vm.body=vm.newFeed.body;
                // Handle errors
            }, function(success) {
                vm.registerSuccess = true;
                vm.registerSuccessText = success.data.success;
            });
    },
        vm.listen = function() {

            Echo.join('live')
                .here((users) => {
                this.count = users.length;
        })
            .joining((user) => {
                this.count++;
        })
            .leaving((user) => {
                this.count--;
        })
            .listen('NewFeed', (e) => {
                this.feeds.unshift(e);
        });
    }
         
}]);