angular.module('app.controllers')
    .controller('projectTaskDeleteController', [
        '$scope',
        'projectTaskService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectTaskService,
                  $location,
                  $routeParams) {

            $scope.task = projectTaskService.get({
                id: $routeParams.id,
                idTask: $routeParams.idTask
            });

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.delete = function () {
                $scope.task.$delete({
                    id: $routeParams.id,
                    idTask: $routeParams.idTask
                }).then(function () {
                    $location.path('/project/' + $routeParams.id + '/tasks');
                }, function (data) {
                    $scope.error.erro = true;
                    $scope.error.message = data.data.erro;
                });
            };
        }]);