angular.module('authApp.items.service', [

])

// A RESTful factory for retrieving users from database'
.factory('items', ['$http', 'utils', function ($http, utils) {
  var path = 'api/profile';
  var items = $http.get(path).then(function (resp) {
    return resp.data.items;
  });

  var factory = {};
  factory.all = function () {
    return items;
  };
  factory.get = function (id) {
    return items.then(function(){
      return utils.findById(items, id);
    })
  };
  return factory;
}]);