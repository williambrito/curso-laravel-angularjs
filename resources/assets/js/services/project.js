angular.module('app.services')
    .service('projectService', ['$resource', function ($resource) {
        return $resource('/project/:id', {id: '@id'}, {
            update: {
                method: 'PUT'
            }
        });
    }]);