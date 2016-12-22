angular.module('app.controllers')
    .controller('projectMemberDeleteController', [
        '$scope',
        'projectMemberService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectMemberService,
                  $location,
                  $routeParams) {

            $scope.member = projectMemberService.get({
                id: $routeParams.id,
                idProjectMember: $routeParams.idProjectMember
            });

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.delete = function () {
                $scope.member.$delete({
                    id: $routeParams.id,
                    idProjectMember: $routeParams.idProjectMember
                }).then(function () {
                    $location.path('/project/' + $routeParams.id + '/members');
                }, function (data) {
                    $scope.error.erro = true;
                    $scope.error.message = data.data.erro;
                });
            };
        }]);