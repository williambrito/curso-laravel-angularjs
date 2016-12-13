angular.module('app.controllers')
    .controller('homeController', [
        '$scope',
        '$cookies',
        function ($scope, $cookies) {
            console.log($cookies.getObject('user').email);
        }]);