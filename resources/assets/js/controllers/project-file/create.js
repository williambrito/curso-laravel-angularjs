angular.module('app.controllers')
    .controller('projectFileCreateController', [
        '$scope',
        //'projectFileService',
        '$location',
        '$routeParams',
        function ($scope,
                  //projectFileService,
                  $location,
                  $routeParams) {
            $scope.file = {};//new projectFileService();
            $scope.file.project_id = $routeParams.id;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.file.$save({id: $routeParams.id}).then(function () {
                        $location.path('/project/' + $routeParams.id + '/files');
                    }, function () {

                    });
                }
            };
        }]);