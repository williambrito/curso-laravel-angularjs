angular.module('app.services')
    .service('userService', ['$resource', function ($resource) {
        return $resource('/user', {}, {
            get: {
                url: '/user/authenticated',
                method: 'GET'
            }
        });
    }]);