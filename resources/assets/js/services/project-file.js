angular.module('app.services')
    .service('projectFileService', [
        '$resource',
        'appConfig',
        'urlService',
        function ($resource,
                  appConfig,
                  urlService) {
            var url = urlService.getUrlResource(appConfig.urls.projectFile);
            return $resource(url, {id: '@id', idFile: '@idFile'}, {
                update: {
                    method: 'PUT'
                }
            });
        }]);