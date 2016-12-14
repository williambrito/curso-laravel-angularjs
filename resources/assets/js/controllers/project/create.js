angular.module('app.controllers')
    .controller('projectCreateController', [
        '$scope',
        'projectService',
        '$location',
        function ($scope,
                  projectService,
                  $location) {
            $scope.project = new projectService();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.$save().then(function () {
                        $location.path('/projects');
                    }, function () {

                    });
                }
            };
        }]);