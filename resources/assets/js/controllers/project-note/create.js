angular.module('app.controllers')
    .controller('projectNoteCreateController', [
        '$scope',
        'projectNoteService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectNoteService,
                  $location,
                  $routeParams) {
            $scope.note = new projectNoteService();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.note.$save({id: $routeParams.id}).then(function () {
                        $location.path('/project/' + $routeParams.id + '/notes');
                    }, function () {

                    });
                }
            };
        }]);