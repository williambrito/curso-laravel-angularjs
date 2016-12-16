angular.module('app.controllers')
    .controller('projectFileCreateController', [
        '$scope',
        '$location',
        '$routeParams',
        'Upload',
        function ($scope,
                  $location,
                  $routeParams,
                  Upload) {

            $scope.file = {
                project_id: $routeParams.id
            };

            $scope.save = function () {
                if ($scope.form.$valid) {
                    Upload.upload({
                        url: 'http://localhost:8000/project/' + $scope.file.project_id + '/file',
                        data: {
                            file: $scope.file.file,
                            name: $scope.file.name,
                            description: $scope.file.description
                        }
                    }).then(function () {
                        $location.path('/project/' + $routeParams.id + '/files');
                    });
                }
            };
        }]);