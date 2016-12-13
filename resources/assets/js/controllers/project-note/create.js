angular.module('app.controllers')
    .controller('projectNoteCreateController', [
        '$scope',
        'projectNoteService',
        '$location',
        function ($scope,
                  projectNoteService,
                  $location) {
            $scope.note = new projectNoteService();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.note.$save().then(function () {
                        $location.path('note');
                    }, function () {

                    });
                }
            };
        }]);