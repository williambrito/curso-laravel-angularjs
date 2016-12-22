angular.module('app.controllers')
    .controller('projectMemberIndexController', [
        '$scope',
        'projectMemberService',
        'userService',
        '$routeParams',
        function ($scope,
                  projectMemberService,
                  userService,
                  $routeParams) {

            $scope.member = new projectMemberService();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.member.$save({id: $routeParams.id}).then(function (data) {
                        $scope.member = new projectMemberService();
                        $scope.userSelected = {};
                        $scope.members.unshift(data);
                    });
                }
            };

            $scope.loadMembers = function () {
                $scope.members = projectMemberService.query({
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                });
            };

            $scope.formatName = function (model) {
                if (model) {
                    return model.name;
                }
                return '';
            };

            $scope.getUsers = function (name) {
                return userService.query({
                    search: name
                }).$promise;
            };

            $scope.loadMembers();
        }]);