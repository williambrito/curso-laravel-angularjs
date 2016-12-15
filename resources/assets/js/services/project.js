angular.module('app.services')
    .service('projectService', [
        '$resource',
        '$filter',
        '$httpParamSerializer',
        'appConfig',
        function ($resource,
                  $filter,
                  $httpParamSerializer,
                  appConfig) {

            function transformDate(data) {
                if (angular.isObject(data) && data.hasOwnProperty('due_date')) {
                    data.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                    return $httpParamSerializer(data);
                }
                return data;
            };

            return $resource('/project/:id', {id: '@id'}, {
                save: {
                    method: 'POST',
                    transformRequest: transformDate
                },
                get: {
                    method: 'GET',
                    transformResponse: function (data, headers) {
                        var response = appConfig.utils.transformResponse(data, headers);
                        if (angular.isObject(response) && response.hasOwnProperty('due_date')) {
                            var arrayDate = response.due_date.split('-');
                            response.due_date = new Date(arrayDate[0], (arrayDate[1] - 1), arrayDate[2]);
                        }
                        return response;
                    }
                },
                update: {
                    method: 'PUT',
                    transformRequest: transformDate
                }
            });
        }]);