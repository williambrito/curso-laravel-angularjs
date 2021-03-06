var app = angular.module('app', [
    'ngRoute',
    'angular-oauth2',
    'ngMessages',
    'ui.bootstrap.tpls',
    'ui.bootstrap.datepickerPopup',
    'ui.bootstrap.typeahead',
    'ui.bootstrap.modal',
    'ui.bootstrap.dropdown',
    'ngFileUpload',
    'http-auth-interceptor',
    'angularUtils.directives.dirPagination',
    'mgcrea.ngStrap.navbar',
    'app.controllers',
    'app.directives',
    'app.filters',
    'app.services'
]);

angular.module('app.controllers', ['angular-oauth2']);
angular.module('app.directives', []);
angular.module('app.filters', []);
angular.module('app.services', ['ngResource']);

app.provider('appConfig', ['$httpParamSerializerProvider', function ($httpParamSerializerProvider) {
    var config = {
        baseUrl: 'http://localhost:8000',
        project: {
            status: [
                {value: 1, label: 'Não Iniciado'},
                {value: 2, label: 'Iniciado'},
                {value: 3, label: 'Concluído'}
            ]
        },
        projectTask: {
            status: [
                {value: 1, label: 'Inconpleta'},
                {value: 2, label: 'Completa'}
            ]
        },
        urls: {
            projectFile: '/project/{{id}}/file/{{idFile}}'
        },
        utils: {
            transformRequest: function (data) {
                if (angular.isObject(data)) {
                    return $httpParamSerializerProvider.$get()(data);
                }
                return data;
            },
            transformResponse: function (data, headers) {
                var headersGetter = headers();
                if (headersGetter['content-type'] == 'application/json' ||
                    headersGetter['content-type'] == 'text/json') {
                    var dataJson = JSON.parse(data);
                    if (dataJson.hasOwnProperty('data') && Object.keys(dataJson).length == 1) {
                        dataJson = dataJson.data;
                    }
                    return dataJson;
                }
                return data;
            }
        }
    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }
}]);

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
        $httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest;
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
        $httpProvider.interceptors.slice(0, 1);
        $httpProvider.interceptors.slice(0, 1);
        $httpProvider.interceptors.push('oauthFixInterceptor');

        $routeProvider
            .when('/login', {
                templateUrl: 'build/views/login.html',
                controller: 'loginController'
            })
            .when('/logout', {
                resolve: {
                    logout: [
                        '$location',
                        function ($location) {
                            return $location.path('/login');
                        }]
                }
            })
            .when('/home', {
                templateUrl: 'build/views/home.html',
                controller: 'homeController',
                title: 'Home'
            })
            /*clients*/
            .when('/clients/dashboard', {
                templateUrl: 'build/views/client/dashboard.html',
                controller: 'clientDashboardController',
                title: 'Clients'
            })
            .when('/clients', {
                templateUrl: 'build/views/client/index.html',
                controller: 'clientIndexController',
                title: 'Clients'
            })
            .when('/client/create', {
                templateUrl: 'build/views/client/create.html',
                controller: 'clientCreateController',
                title: 'Clients'
            })
            .when('/client/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'clientEditController',
                title: 'Clients'
            })
            .when('/client/:id/delete', {
                templateUrl: 'build/views/client/delete.html',
                controller: 'clientDeleteController',
                title: 'Clients'
            })
            /*projects*/
            .when('/projects/dashboard', {
                templateUrl: 'build/views/project/dashboard.html',
                controller: 'projectDashboardController',
                title: 'Projects'
            })
            .when('/projects', {
                templateUrl: 'build/views/project/index.html',
                controller: 'projectIndexController',
                title: 'Projects'
            })
            .when('/project/create', {
                templateUrl: 'build/views/project/create.html',
                controller: 'projectCreateController',
                title: 'Projects'
            })
            .when('/project/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'projectEditController',
                title: 'Projects'
            })
            .when('/project/:id/delete', {
                templateUrl: 'build/views/project/delete.html',
                controller: 'projectDeleteController',
                title: 'Projects'
            })
            /*project-notes*/
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
            })
            /*project-files*/
            .when('/project/:id/files', {
                templateUrl: 'build/views/project-file/index.html',
                controller: 'projectFileIndexController'
            })
            .when('/project/:id/file/create', {
                templateUrl: 'build/views/project-file/create.html',
                controller: 'projectFileCreateController'
            })
            .when('/project/:id/file/:idFile/edit', {
                templateUrl: 'build/views/project-file/edit.html',
                controller: 'projectFileEditController'
            })
            .when('/project/:id/file/:idFile/delete', {
                templateUrl: 'build/views/project-file/delete.html',
                controller: 'projectFileDeleteController'
            })
            /*project-tasks*/
            .when('/project/:id/tasks', {
                templateUrl: 'build/views/project-task/index.html',
                controller: 'projectTaskIndexController'
            })
            .when('/project/:id/task/create', {
                templateUrl: 'build/views/project-task/create.html',
                controller: 'projectTaskCreateController'
            })
            .when('/project/:id/task/:idTask/edit', {
                templateUrl: 'build/views/project-task/edit.html',
                controller: 'projectTaskEditController'
            })
            .when('/project/:id/task/:idTask/delete', {
                templateUrl: 'build/views/project-task/delete.html',
                controller: 'projectTaskDeleteController'
            })
            /*project-member*/
            .when('/project/:id/members', {
                templateUrl: 'build/views/project-member/index.html',
                controller: 'projectMemberIndexController'
            })
            .when('/project/:id/member/:idProjectMember/delete', {
                templateUrl: 'build/views/project-member/delete.html',
                controller: 'projectMemberDeleteController'
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
    '$location',
    '$http',
    'OAuth',
    'OAuthToken',
    'authService',
    'httpBuffer',
    '$uibModal',
    function ($rootScope,
              $location,
              $http,
              OAuth,
              OAuthToken,
              authService,
              httpBuffer,
              $uibModal) {

        $rootScope.$on('$routeChangeStart', function (event, next, current) {
            if (next.$$route.originalPath != '/login') {
                if (!OAuth.isAuthenticated()) {
                    $location.path('/login');
                }
            }
        });

        $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
            $rootScope.pageTitle = current.$$route.title;
        });

        $rootScope.$on('oauth:error', function (event, data) {

            if ('invalid_grant' === data.rejection.data.error) {
                return;
            }

            if ('access_denied' === data.rejection.data.error) {
                httpBuffer.append(data.rejection.config, data.deferred);
                if (!$rootScope.isRefreshToken) {
                    $rootScope.isRefreshToken = true;
                    OAuth.getRefreshToken().then(function () {
                        $rootScope.isRefreshToken = false;
                        authService.loginConfirmed();
                    });
                }
                return;
            }

            if (!$rootScope.loginModalOpened) {
                var modalInstance = $uibModal.open({
                    templateUrl: 'build/views/templates/login-modal.html',
                    controller: 'loginModalController'
                });
                $rootScope.loginModalOpened = true;
            }
            return;
        });
    }]);