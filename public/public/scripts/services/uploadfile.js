angular.module('authApp.uploadfile', [

])

.factory('uploadfile', function () {

	uploadfile : function(files,success,error){
 
		var url = 'http://ec2-35-161-51-235.us-west-2.compute.amazonaws.com/api/profil';

		for ( var i = 0; i < files.length; i++)
		{
		  var fd = new FormData();
		 
		  fd.append("file", files[i]);
		 
		  $http.post(url, fd, {
		  
		   withCredentials : false,
		  
		   headers : {
		    'Content-Type' : undefined
		},
		transformRequest : angular.identity

		})
			.success(function(data)
			{
			  console.log(data);
			})
			.error(function(data)
			{
			 console.log(data);
			});	
		}
	}
	
});
