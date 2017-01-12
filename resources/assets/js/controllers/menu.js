angular.module('app.controllers')
    .controller('menuController', [
        '$scope',
        '$cookies',
        function ($scope,
                  $cookies) {

            $scope.user = $cookies.getObject('user');
        }]);