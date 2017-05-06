angular.module('streamMainCtrl', [])

// inject the Comment service into our controller
    .controller('feedController', function($scope, $http, Feed) {
        // object to hold all the data for the new comment form
        $scope.feedData = {};

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        // use the function we created in our service
        // GET ALL COMMENTS ==============
        Feed.get()
            .then(function(success) {
                $scope.feeds = success.data;
                $scope.loading = false;
            });

        // function to handle submitting the form
        // SAVE A COMMENT ================
        $scope.submitFeed = function() {
            $scope.loading = true;

            // save the comment. pass in comment data from the form
            // use the function we created in our service
            Feed.save($scope.feedData)
                .success(function(data) {

                    // if successful, we'll need to refresh the comment list
                    Feed.get()
                        .success(function(getData) {
                            $scope.feeds = getData;
                            $scope.loading = false;
                        });

                })
                .error(function(data) {
                    console.log(data);
                });
        };

        // function to handle deleting a comment
        // DELETE A COMMENT ====================================================
        $scope.deleteFeed = function(id) {
            $scope.loading = true;

            // use the function we created in our service
            Feed.destroy(id)
                .success(function(data) {

                    // if successful, we'll need to refresh the comment list
                    Feed§.get()
                        .success(function(getData) {
                            $scope.feeds = getData;
                            $scope.loading = false;
                        });

                });
        };

    });