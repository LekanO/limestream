'use strict';
angular.module('myApp',
        [
            "ngSanitize",
            "com.2fdevs.videogular",
            "com.2fdevs.videogular.plugins.controls",
            "com.2fdevs.videogular.plugins.overlayplay",
            "com.2fdevs.videogular.plugins.poster",
            "com.2fdevs.videogular.plugins.dash"
        ]
    )
    .controller('HomeCtrl',
        ["$sce", function ($sce) {
            this.config = {
                sources: [
                    {src: "http://dash.edgesuite.net/akamai/test/caption_test/ElephantsDream/elephants_dream_480p_heaac5_1.mpd"}
                ],
                theme: {
                    url: "http://www.videogular.com/styles/themes/default/latest/videogular.css"
                },
                plugins: {
                    poster: "http://www.videogular.com/assets/images/videogular.png"
                }
            };
        }]
    );