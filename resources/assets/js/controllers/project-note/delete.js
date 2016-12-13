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

            $scope.note = projectNoteService.get({
                id: $routeParams.id,
                idNote: $routeParams.idNote
            });

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.delete = function () {
                $scope.note.$delete({
                    id: $routeParams.id,
                    idNote: $routeParams.idNote
                }).then(function () {
                    $location.path('/project/' + $routeParams.id + '/notes');
                }, function (data) {
                    $scope.error.erro = true;
                    $scope.error.message = data.data.erro;
                });
            };
        }]);