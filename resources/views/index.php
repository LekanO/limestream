<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Lime Stream TV </title>
        <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="node_modules/dropzone/dist/basic.css">
        <link rel="stylesheet" type="text/css" href="node_modules/dropzone/dist/dropzone.css">
    </head>
    <body ng-app="authApp" ng-init="init()" style="background-image: url('https://s3-eu-west-1.amazonaws.com/smag-tv/homepage-screen-duo.jpg')">
      
        <script type="text/ng-template" id="partials/view1.html">Tabl #1</script>
        <script type="text/ng-template" id="partials/view2.html"> Tabl #2</script>
        <script type="text/ng-template" id="partials/view3.html"> Tabl #3</script>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 main">
            <div ui-view> </div>
        <div class="table-responsive">

          </div>

        </div>
      </div>
    </div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>


    <script>
        // edit /etc/hosts on the vm SIDE : 192.168.10.10
        //var socket = io('http://localhost:3000');
        



        /* var socket = io('http://ec2-52-41-160-119.us-west-2.compute.amazonaws.com:3000');

        socket.on("test-channel:App\\Events\\EventSocket", function(message){
            // increase the power everytime we load test route
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        }); */
    </script>

    </body>

 <!-- Application Dependencies -->
    <script src="node_modules/angular/angular.js"></script>
    <script src="node_modules/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="node_modules/satellizer/satellizer.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-svg-round-progressbar/0.4.8/roundProgress.min.js"></script>   
    <script src="node_modules/angular-sanitize/angular-sanitize.min.js"></script>
    <script src="node_modules/videogular/videogular.js"></script>
    <script src="node_modules/videogular-controls/vg-controls.js"></script>
    <script src="node_modules/videogular-overlay-play/vg-overlay-play.js"></script>
    <script src="node_modules/videogular-poster/vg-poster.js"></script>
    <script src="node_modules/videogular-buffering/vg-buffering.js"></script>
    <script src="node_modules/dropzone/dist/dropzone.js"></script>
    <script src="bower_components/videogular-hls/vg-hls.js"></script>



    <script src="http://cdn.dashjs.org/v2.0.0/dash.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-svg-round-progressbar/0.4.8/roundProgress.min.js"></script>
    <script src="http://static.videogular.com/scripts/videogular/latest/videogular.js"></script>
    <script src="http://static.videogular.com/scripts/controls/latest/vg-controls.js"></script>
    <script src="http://static.videogular.com/scripts/overlay-play/latest/vg-overlay-play.js"></script>
   <script src="http://static.videogular.com/scripts/poster/latest/vg-poster.js"></script>
    <script src="http://static.videogular.com/scripts/dash/latest/vg-dash.js"></script>

    <!-- Angular Material Dependencies -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
    
    <script src="scripts/com/2fdevs/videogular/plugins/vg-next-video/vg-next-video.js"></script>
    <script src="scripts/com/2fdevs/videogular/plugins/vg-next-video/vg-next-video-service.js"></script>


        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

            <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="node_modules/videogular-themes-default/videogular.min.css">
        <link rel="stylesheet" href="style/dashboard.css">
        <link rel="stylesheet" href="style/styles.css">
        <!--<link rel="stylesheet" href="style/main.css"> -->
        <link rel="stylesheet" href="style/vg-next-video.css">
        <link rel="stylesheet" href="style/ie10-viewport-bug-workaround.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Application Scripts -->

    <script src="scripts/videomain.js"></script>
    <script src="scripts/app.js"></script>

    <script src="scripts/users.js"></script>
    <script src="scripts/authController.js"></script>
    <script src="scripts/registerController.js"></script>
    <script src="scripts/userController.js"></script>
    <script src="scripts/dashVideoController.js"></script>
    <script src="scripts/dashLiveController.js"></script>
    <script src="scripts/ctmDashLiveController.js"></script>
    <script src="scripts/passwordResetEmailController.js"></script>
    <script src="scripts/profileController.js"></script>
    <script src="scripts/ProductController.js"></script>
    <script src="scripts/dashvideos.js"></script>
    <script src="scripts/dashlives.js"></script>
    <script src="scripts/tabCtrl.js"></script>
    <script src="scripts/streamMainCtrl.js"> </script>


    <script src="scripts/users-service.js"></script>
    <script src="scripts/items-service.js"></script>
    <script src="scripts/utils/utils-service.js"></script>

    <script src="scripts/videos.js"></script>
    <script src="scripts/lives.js"></script>
    <script src="scripts/livedetail.js"></script>
    <script src="scripts/videodetail.js"></script>
    <script src="scripts/VideoProvider.js"></script>
    <script src="scripts/packages/dirPagination.js"></script>
    <script src="scripts/services/myServices.js"></script>
    <script src="scripts/helper/myHelper.js"></script>
    <script src="scripts/helper/proHelper.js"></script>
    <script src="scripts/helper/liveHelper.js"></script>

    <script src="scripts/services/commentService.js"></script>

</html>
