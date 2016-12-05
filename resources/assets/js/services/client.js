angular.module('app.services')
    .service('clientService', ['$resource', function ($resource) {
        return $resource('/client/:id', {id: '@id'}, {
            update: {
                method: 'PUT'
            }
        });
    }]);