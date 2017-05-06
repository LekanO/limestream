angular.module('authApp')
    .service("VideoProvider", ["$q", "$http", "$sce",
        function ($q, $http, $sce) {
            var defer;

            this.loadVideo = function loadVideo(url) {
                defer = $q.defer();
                
                $http.get(url).then(
                    this.onLoadVideo.bind(this),
                    this.onLoadVideoError.bind(this)
                );

                return defer.promise;
            };

            this.onLoadVideo = function onLoadVideo(response) {
                var videos = [];

                for (var i=0, l=response.data.data.length; i<l; i++) {
                    videos.push({src: response.data.data[i].src, type: response.data.data[i].type});
                }

                response.data.data = videos;

                defer.resolve(response.data);
            };

            this.onLoadVideoError = function onLoadVideoError(error) {
                defer.reject(error);
            };
        }
]);