(function() {

	'use strict';

	var authApp = angular
		.module('authApp', [
			'authApp.users',
			'authApp.users.service',
			'authApp.items.service',
    		'authApp.utils.service',
			'ui.router',
			'streamMainCtrl',
			'commentService',
		    'ngSanitize',
    		'satellizer',
		    'angularUtils.directives.dirPagination',
		    'com.2fdevs.videogular',
		    'com.2fdevs.videogular.plugins.controls',
		    'com.2fdevs.videogular.plugins.overlayplay',
		    'com.2fdevs.videogular.plugins.buffering',
		    'com.2fdevs.videogular.plugins.poster',
            "com.2fdevs.videogular.plugins.dash"
         ])

		.run( 
			[	'$rootScope', '$state', '$stateParams',
			 	function($rootScope, $state, $stateParams) {	      		

	    	// It's very handy to add references to $state and $stateParams to the $rootScope
	    	// so that you can access them from any scope within your applications.For example,
	    	// <li ng-class="{ active: $state.includes('contacts.list') }"> will set the <li>
	    	// to active whenever 'contacts.list' or one of its decendents is active.
		    $rootScope.$state = $state;
		    $rootScope.$stateParams = $stateParams;
			
			// $stateChangeStart is fired whenever the state changes. We can use some parameters
			// such as toState to hook into details about the state as it is changing
			
			$rootScope.$on('$stateChangeStart', function(event, toState) {

				// Grab the user from local storage and parse it to an object
				var user = JSON.parse(localStorage.getItem('user'));			

				// If there is any user data in local storage then the user is quite
				// likely authenticated. If their token is expired, or if they are
				// otherwise not actually authenticated, they will be redirected to
				// the auth state because of the rejected request anyway
				if(user) {

					// The user's authenticated state gets flipped to
					// true so we can now show parts of the UI that rely
					// on the user being logged in
					$rootScope.authenticated = true;

					// Putting the user's data on $rootScope allows
					// us to access it anywhere across the app. Here
					// we are grabbing what is in local storage
					$rootScope.currentUser = user;

					// If the user is logged in and we hit the auth route we don't need
					// to stay there and can send the user to the main state
					if(toState.name === "auth") {

						// Preventing the default behavior allows us to use $state.go
						// to change states
						event.preventDefault();

						// go to the "main" state which in our case is users
						$state.go('users');
					}		
				}
			});
		} 
	])
		
		.config(function($stateProvider, $qProvider, $urlRouterProvider, $authProvider,  $httpProvider, $provide) {

            $qProvider.errorOnUnhandledRejections(false);

            function redirectWhenLoggedOut($q, $injector) {

				return {

					responseError: function(rejection) {

						// Need to use $injector.get to bring in $state or else we get
						// a circular dependency error
						var $state = $injector.get('$state');

						// Instead of checking for a status code of 400 which might be used
						// for other reasons in Laravel, we check for the specific rejection
						// reasons to tell us if we need to redirect to the login state
						var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];

						// Loop through each rejection reason and redirect to the login
						// state if one is encountered
						angular.forEach(rejectionReasons, function(value, key) {

							if(rejection.data.error === value) {
								
								// If we get a rejection corresponding to one of the reasons
								// in our array, we know we need to authenticate the user so 
								// we can remove the current user from local storage
								localStorage.removeItem('user');

								// Send the user to the auth state so they can login
								$state.go('streams');
							}
						});

						return $q.reject(rejection);
					}
				}
			}

	      // Use $urlRouterProvider to configure any redirects (when) and invalid urls (otherwise).
	      $urlRouterProvider

	        // The `when` method says if the url is ever the 1st param, then redirect to the 2nd param
	        // Here we are just setting up some convenience urls.
	        .when('/u?id', '/users/:id')
	        .when('/user/:id', '/users/:id')

			// Setup for the $httpInterceptor
			$provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);

			// Push the new factory onto the $http interceptor array
			$httpProvider.interceptors.push('redirectWhenLoggedOut');

			$authProvider.loginUrl = '/api/authenticate';

			$urlRouterProvider.otherwise('/streams');
			$stateProvider
				.state('auth', {
					url: '/auth',
					templateUrl: '../views/authView.html',
					controller: 'AuthController as auth'
				})
				.state('register', {
                    url: '/register',
                    templateUrl: '../views/registerView.html',
                    controller: 'RegisterController as reg'
                })
                .state('profile', {
               		url: '/profile',
                	templateUrl: '../views/user-profile-detail.html',
					controller: 'ProfileController as dash'
				})
		        .state('profile.item', {

		          // So following what we've learned, this state's full url will end up being
		          // '/contacts/{contactId}/item/:itemId'. We are using both types of parameters
		          // in the same url, but they behave identically.
		          url: '/item/:itemId',
		          views: {

		            // This is targeting the unnamed ui-view within the parent state 'contact.detail'
		            // We wouldn't have to do it this way if we didn't also want to set the 'hint' view below.
		            // We could instead just set templateUrl and controller outside of the view obj.
		            '': {
		              templateUrl: '../views/profile-detail-item.html',
		              resolve: {
			            items: ['items',
			              function( items){
			                return items.all();
			              }]
			          },
		              controller: ['$scope', '$stateParams', '$state', 'items', 'utils',
		                function (  $scope,   $stateParams, $state, items,  utils) {
	                	$scope.items = items;

		                $scope.item = utils.findById($scope.items, $stateParams.itemId);

		                  $scope.edit = function () {
		                    // Here we show off go's ability to navigate to a relative state. Using '^' to go upwards
		                    // and '.' to go down, you can navigate to any relative state (ancestor or descendant).
		                    // Here we are going down to the child state 'edit' (full name of 'contacts.detail.item.edit')
		                    $state.go('.edit', $stateParams);
		                  };
		                }]
		            },

		            // Here we see we are overriding the template that was set by 'contacts.detail'
		            'hint@': {
		              template: ' This is profile.item overriding the "hint" ui-view'
		            }
		          }
		        })
		        // Contacts > Detail > Item > Edit //
		        /////////////////////////////////////

		        // Notice that this state has no 'url'. States do not require a url. You can use them
		        // simply to organize your application into "places" where each "place" can configure
		        // only what it needs. The only way to get to this state is via $state.go (or transitionTo)
		        .state('profile.item.edit', {
		          views: {

		            // This is targeting the unnamed view within the 'contacts.detail' state
		            // essentially swapping out the template that 'contacts.detail.item' had
		            // inserted with this state's template.
		            '@profile.item': {
		              templateUrl: '../views/profile-detail-edit.html',
		              controller: ['$scope', '$stateParams', '$state', 'utils',
		                function (  $scope,   $stateParams, $state, utils) {
		                  $scope.item = utils.findById($scope.items, $stateParams.itemId);
		                  $scope.done = function () {
		                    // Go back up. '^' means up one. '^.^' would be up twice, to the grandparent.
		                    $state.go('^', $stateParams);
		                  };
		                }]
		            }
		          }
		      	})
                .state('passwordEmail', {
                    url: '/password/reset',
                    templateUrl: '../views/emailView.html',
                    controller: 'PasswordResetEmailController as auth'
                })
                .state('passwordReset', {
                    url: '/password/conf',
                    templateUrl: '../views/resetView.html',
                    controller: 'PasswordResetController as auth'
                })
				.state('timeline', { 
                    url: '/timeline',
                    template: 'This is for timeline',

                })
				.state('testing', {
					url: '/testing',
					templateUrl: '../views/socketView.html'
				})
				.state('setup', {
					url: '/setup',
					templateUrl: '../views/setupView.html'
				})
				.state('stream', {
					url: '/streams',
					templateUrl: '../views/dashVideosView.html',
					controller: 'DashAllVideosListCtrl as dash'
				})
				.state('streams', {
					url: '/streams',
					templateUrl: '../views/streamView.html',
					controller: 'AllLiveListCtrl'
				})
				.state('live', {
					url: '/live',
					templateUrl: '../views/liveView.html',
					controller: 'AllLiveListCtrl'
				})
				.state('live.detail', {
					url: "/{liveId:[0-9]{1,4}}",
					templateUrl: '../views/live-detail.html',
					controller: 'LiveDetailCtrl as controller',
					resolve: {
		                videoData: ["$stateParams", "VideoProvider", function loadVideoData($stateParams, VideoProvider) {
		                    var liveId = $stateParams.liveId;
		                    var url = 'http://www.limestream.tv/api/live/' + liveId;

		                    return VideoProvider.loadVideo(url);
		                }]
		            }
				})
				.state('livectm', {
					url: '/livectm',
					templateUrl: '../views/livectmView.html',
					controller: 'AllLiveListCtrl'
				})
				.state('livectm.detail', {
					url: "/{livectmId:[0-9]{1,4}}",
					templateUrl: '../views/live-detail.html',
					controller: 'LiveDetailCtrl as controller',
					resolve: {
		                videoData: ["$stateParams", "VideoProvider", function loadVideoData($stateParams, VideoProvider) {
		                    var livectmId = $stateParams.livectmId;
		                    var url = 'http://www.limestream.tv/api/livectm/' + livectmId;

		                    return VideoProvider.loadVideo(url);
		                }]
		            }
				})
                .state('livectm.detail.item', {
                    templateUrl: '../views/live-detail-feed.html',
                    controller: 'feedController',
                })
				.state('dashVid', {
					url: '/dashVid',
					templateUrl: '../views/dashVideosView.html',
					controller: 'DashAllVideosListCtrl as dash' 
				})
				.state('dashLive', {
					url: '/dashLives',
					templateUrl: '../views/dashLiveView.html',
					controller: 'DashAllLiveListCtrl as dash'
				})
                .state('dashVideos', {
                        url: '/dashVideos',
                        templateUrl: '../templates/dashVideosView.html',
                        controller: 'ItemController as dash'
                })
                .state('dashLives', {
                        url: '/dashLive',
                        templateUrl: '../templates/dashLiveView.html',
                        controller: 'CtmLiveController'
                })
                .state('eShop', {
                        url: '/eShop',
                        templateUrl: '../templates/eShopView.html',
                        controller: 'ProductController'
                })
				.state('videos', {
					url: '/videos',
					templateUrl: '../views/videosView.html',
					controller: 'AllVideosListCtrl'
				})
				.state('videos.detail', {
					url: "/{videoId:[0-9]{1,4}}",
					templateUrl: '../views/video-detail.html',
					controller: 'VideoDetailCtrl as controller',
					resolve: {
		                videoData: ["$stateParams", "VideoProvider", function loadVideoData($stateParams, VideoProvider) {
		                	var videoId = $stateParams.videoId;
		                    var url = 'http://www.limestream.tv/api/video/' + videoId;
		                    return VideoProvider.loadVideo(url);
		                }]
		            }
				})
				.state('videosctm', {
					url: '/videosctm',
					templateUrl: '../views/videosctmView.html',
					controller: 'AllVideosListCtrl'
				})
				.state('videosctm.detail', {
					url: "/{videoctmId:[0-9]{1,4}}",
					templateUrl: '../views/video-detail.html',
					controller: 'VideoDetailCtrl as controller',
					resolve: {
		                videoData: ["$stateParams", "VideoProvider", function loadVideoData($stateParams, VideoProvider) {
		                	var videoctmId = $stateParams.videoctmId;
		                    var url = 'http://www.limestream.tv/api/video/' + videoctmId;
		                    return VideoProvider.loadVideo(url);
		                }]
		            }
				}) 
				.state('videosctm.detail.item', {
					templateUrl: '../views/video-detail-comment.html',
					controller: 'streamMainController',
				})
			})

		.directive('dropzone', function() {
			return function (scope, element, attrs) {


			var config, dropzone;

			config = scope[attrs.dropzone];

			// create a Dropzone for the element with the given options
			dropzone = new Dropzone(element[0], config.options);

			// bind the given event handlers
			angular.forEach(config.eventHandlers, function (handler, event) {
			  dropzone.on(event, handler);
			});
  		};

	});
	
})();


<!-- http://ec2-35-161-32-198.us-west-2.compute.amazonaws.com -->

<!-- http://ec2-52-42-36-167.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-52-42-68-198.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-52-42-70-198.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-52-42-130-198.us-west-2.compute.amazonaws.com --> soasta
 
<!-- http://ec2-52-42-160-198.us-west-2.compute.amazonaws.com -->

<!-- http://ec2-52-42-189-198.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-52-42-42-57.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-52-42-145-71.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-52-42-145-72.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-35-162-150-10.us-west-2.compute.amazonaws.com/ -->

<!-- http://ec2-35-160-29-232.us-west-2.compute.amazonaws.com/ -->

