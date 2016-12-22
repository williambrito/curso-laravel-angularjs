angular.module('app.services')
    .service('projectMemberService', [
        '$resource',
        function ($resource) {
            return $resource('/project/:id/member/:idProjectMember', {
                    id: '@id',
                    idProjectMember: '@idProjectMember'
                },
                {
                    update: {
                        method: 'PUT'
                    }
                });
        }]);