angular.module('app.services')
    .service('projectTaskService', ['$resource', function ($resource) {
        return $resource('/project/:id/task/:idTask', {id: '@id', idTask: '@idTask'}, {
            update: {
                method: 'PUT'
            }
        });
    }]);