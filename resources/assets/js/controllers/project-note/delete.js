angular.module('app.controllers')
    .controller('projectNoteDeleteController', [
        '$scope',
        'projectNoteService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectNoteService,
                  $location,
                  $routeParams) {
            $scope.note = projectNoteService.get({id: $routeParams.id});

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.delete = function () {
                $scope.note.$delete().then(function () {
                    $location.path('note');
                }, function (data) {
                    $scope.error.erro = true;
                    $scope.error.message = data.data.erro;
                });
            };
        }]);