angular.module('authApp.users.service', [

])

// A RESTful factory for retrieving users from 'users'
.factory('users', ['$http', 'utils', function ($http, utils) {
  var path = 'assets/contacts.json';
  var users = $http.get(path).then(function (resp) {
    return resp.data.users;
  });

  var factory = {};
  factory.all = function () {
    return users;
  };
  factory.get = function (id) {
    return users.then(function(){
      return utils.findById(users, id);
    })
  };
  return factory;
}]);