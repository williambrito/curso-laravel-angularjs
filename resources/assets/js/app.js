var app = angular.module('app', [
    'ngRoute',
    'angular-oauth2',
    'ngMessages',
    'app.controllers',
    'app.filters',
    'app.services'
]);

angular.module('app.controllers', ['angular-oauth2']);
angular.module('app.filters', []);
angular.module('app.services', ['ngResource']);

app.provider('appConfig', function () {
    var config = {
        baseUrl: 'http://localhost:8000',
        project: {
            status: [
                {value: 1, label: 'Não Iniciado'},
                {value: 2, label: 'Iniciado'},
                {value: 3, label: 'Concluído'}
            ]
        }
    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }
});

app.config([
    '$routeProvider',
    '$httpProvider',
    'OAuthProvider',
    'OAuthTokenProvider',
    'appConfigProvider',
    function ($routeProvider,
              $httpProvider,
              OAuthProvider,
              OAuthTokenProvider,
              appConfigProvider) {

        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.transformResponse = function (data, headers) {
            var headersGetter = headers();
            if (headersGetter['content-type'] == 'application/json' ||
                headersGetter['content-type'] == 'text/json') {
                var dataJson = JSON.parse(data);
                if (dataJson.hasOwnProperty('data')) {
                    dataJson = dataJson.data;
                }
                return dataJson;
            }
            return data;
        };

        $routeProvider
            .when('/login', {
                templateUrl: 'build/views/login.html',
                controller: 'loginController'
            })
            .when('/home', {
                templateUrl: 'build/views/home.html',
                controller: 'homeController'
            })
            .when('/clients', {
                templateUrl: 'build/views/client/index.html',
                controller: 'clientIndexController'
            })
            .when('/clients/create', {
                templateUrl: 'build/views/client/create.html',
                controller: 'clientCreateController'
            })
            .when('/clients/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'clientEditController'
            })
            .when('/clients/:id/delete', {
                templateUrl: 'build/views/client/delete.html',
                controller: 'clientDeleteController'
            })
            .when('/projects', {
                templateUrl: 'build/views/project/index.html',
                controller: 'projectIndexController'
            })
            .when('/projects/create', {
                templateUrl: 'build/views/project/create.html',
                controller: 'projectCreateController'
            })
            .when('/projects/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'projectEditController'
            })
            .when('/projects/:id/delete', {
                templateUrl: 'build/views/project/delete.html',
                controller: 'projectDeleteController'
            })
            .when('/project/:id/notes', {
                templateUrl: 'build/views/project-note/index.html',
                controller: 'projectNoteIndexController'
            })
            .when('/project/:id/note/:idNote/show', {
                templateUrl: 'build/views/project-note/show.html',
                controller: 'projectNoteShowController'
            })
            .when('/project/:id/note/create', {
                templateUrl: 'build/views/project-note/create.html',
                controller: 'projectNoteCreateController'
            })
            .when('/project/:id/note/:idNote/edit', {
                templateUrl: 'build/views/project-note/edit.html',
                controller: 'projectNoteEditController'
            })
            .when('/project/:id/note/:idNote/delete', {
                templateUrl: 'build/views/project-note/delete.html',
                controller: 'projectNoteDeleteController'
            });

        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: 'appid1',
            clientSecret: 'secret',
            grantPath: 'oauth/access_token'
        });

        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });
    }]);

app.run([
    '$rootScope',
    '$window',
    'OAuth',
    function ($rootScope,
              $window,
              OAuth) {
        $rootScope.$on('oauth:error', function (event, rejection) {

            if ('invalid_grant' === rejection.data.error) {
                return;
            }

            if ('invalid_token' === rejection.data.error) {
                return OAuth.getRefreshToken();
            }

            return $window.location.href = '/login?error_reason=' + rejection.data.error;
        });
    }]);