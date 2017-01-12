angular.module('app.directives')
    .directive('loadTemplate', [
        'OAuth',
        '$http',
        '$compile',
        function (OAuth,
                  $http,
                  $compile) {

            return {
                restrict: 'E',
                link: function (scope, element, attr) {
                    scope.$on('$routeChangeStart', function (event, next, current) {
                        if (OAuth.isAuthenticated()) {
                            $http.get(attr.url).then(function (response) {
                                element.html(response.data);
                                $compile(element.contents())(scope);
                            });
                        }
                    });
                }
            };
        }]);