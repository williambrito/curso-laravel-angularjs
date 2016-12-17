angular.module('app.controllers')
    .controller('projectFileCreateController', [
        '$scope',
        '$location',
        '$routeParams',
        'appConfig',
        'urlService',
        'Upload',
        function ($scope,
                  $location,
                  $routeParams,
                  appConfig,
                  urlService,
                  Upload) {

            $scope.file = {
                project_id: $routeParams.id
            };

            $scope.save = function () {
                if ($scope.form.$valid) {
                    var uploadUrl = appConfig.baseUrl +
                        urlService.getUrlFromUrlSymbol(appConfig.urls.projectFile, {
                            id: $scope.file.project_id,
                            idFile: ''
                        });
                    Upload.upload({
                        url: uploadUrl,
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