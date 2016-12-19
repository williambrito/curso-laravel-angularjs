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
                controller: ['$scope',
                    '$element',
                    '$attrs',
                    '$timeout',
                    function ($scope,
                              $element,
                              $attrs,
                              $timeout) {
                        $scope.downloadFile = function () {
                            var anchor = $element.children()[0];
                            $(anchor).addClass('disabled');
                            $(anchor).text('Loading...');
                            projectFileService.download({id: $attrs.idProject, idFile: $attrs.idFile}, function (data) {
                                $(anchor).removeClass('disabled');
                                $(anchor).text('Save File');
                                $(anchor).attr({
                                    href: 'data:application-octet-stream;base64,' + data.file,
                                    download: data.name
                                });
                                $timeout(function () {
                                    $scope.downloadFile = function () {

                                    };
                                    $(anchor)[0].click();
                                });
                            });
                        };
                    }]
            };
        }]);