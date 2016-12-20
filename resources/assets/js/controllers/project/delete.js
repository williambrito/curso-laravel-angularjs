angular.module('app.controllers')
    .controller('projectDeleteController', [
        '$scope',
        'projectService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectService,
                  $location,
                  $routeParams) {

            $scope.project = projectService.get({id: $routeParams.id});

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.delete = function () {
                $scope.project.$delete().then(function () {
                    $location.path('/projects');
                }, function (data) {
                    $scope.error.erro = true;
                    $scope.error.message = data.data.message;
                });
            };
        }]);