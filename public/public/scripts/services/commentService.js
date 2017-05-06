angular.module('commentService', [

])

.factory('Comment', function ($http, $location) {
    
	return {
        // get all the comments
        get : function() {

            var videoId = $location.path().split("/")[2] || "unknown";

            return $http.get('/api/comments/' + videoId);
        },

        // save a comment (pass in comment data)
        save : function(commentData, videoId) {

            var videoId = $location.path().split("/")[2] || "unknown";

            return $http({
                method: 'POST',
                url: '/api/comments/' + videoId,
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(commentData)
            });
        },

        // destroy a comment
        destroy : function(id) {
            return $http.delete('/api/comments/' + id);
        }
    }

});
