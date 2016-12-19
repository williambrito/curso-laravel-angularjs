angular.module('app.controllers')
    .controller('projectFileEditController', [
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

            $scope.save = function () {
                if ($scope.form.$valid) {
                    projectFileService.update({
                        id: $routeParams.id,
                        idFile: $routeParams.idFile
                    }, $scope.file, function () {
                        $location.path('/project/' + $routeParams.id + '/files');
                    }, function () {

                    });
                }
            };
        }]);