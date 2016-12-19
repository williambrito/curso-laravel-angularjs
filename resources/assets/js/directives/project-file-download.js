angular.module('app.directives')
    .directive('projectFileDownload', [
        'appConfig',
        'projectFileService',
        function (appConfig,
                  projectFileService) {

            return {
                restrict: 'E',
                templateUrl: appConfig.baseUrl + '/build/views/templates/project-file-download.html',
                link: function (scope, element, attr) {

                },
                controller: ['$scope', '$element', '$attrs', function ($scope, $element, $attrs) {
                    $scope.downloadFile = function () {
                        var anchor = $element.children()[0];
                        $(anchor).addClass('disabled');
                        $(anchor).text('Loading...');
                        projectFileService.download({id: $attrs.idProject, idFile: $attrs.idFile}, function (data) {

                        });
                    };
                }]
            };
        }]);