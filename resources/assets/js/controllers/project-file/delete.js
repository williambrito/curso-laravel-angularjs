angular.module('app.controllers')
    .controller('projectFileDeleteController', [
        '$scope',
        'projectFileService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectFileService,
                  $location,
                  $routeParams) {

            $scope.file = projectFileService.get({
                id: $routeParams.id,
                idFile: $routeParams.idFile
            });

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.delete = function () {
                $scope.file.$delete({
                    id: $routeParams.id,
                    idFile: $routeParams.idFile
                }).then(function () {
                    $location.path('/project/' + $routeParams.id + '/files');
                }, function (data) {
                    $scope.error.erro = true;
                    $scope.error.message = data.data.erro;
                });
            };
        }]);