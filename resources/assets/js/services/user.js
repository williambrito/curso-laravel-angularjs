angular.module('app.services')
    .service('userService', ['$resource', function ($resource) {
        return $resource('/user', {}, {
            authenticated: {
                url: '/user/authenticated',
                method: 'GET'
            }
        });
    }]);