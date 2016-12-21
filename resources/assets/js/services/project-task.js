angular.module('app.services')
    .service('projectTaskService', [
        '$resource',
        '$filter',
        'appConfig',
        function ($resource,
                  $filter,
                  appConfig) {

            function transformDate(data) {
                var request = angular.copy(data);
                if (angular.isObject(data)) {
                    if (data.hasOwnProperty('start_date')) {
                        request.start_date = $filter('date')(request.start_date, 'yyyy-MM-dd');
                    }
                    if (data.hasOwnProperty('due_date')) {
                        request.due_date = $filter('date')(request.due_date, 'yyyy-MM-dd');
                    }
                    return appConfig.utils.transformRequest(request);
                }
                return data;
            }

            return $resource('/project/:id/task/:idTask', {id: '@id', idTask: '@idTask'}, {
                get: {
                    method: 'GET',
                    transformResponse: function (data, headers) {
                        var response = appConfig.utils.transformResponse(data, headers);
                        if (angular.isObject(response)) {
                            if (response.hasOwnProperty('start_date') && response.start_date) {
                                var arrayStartDate = response.start_date.split('-');
                                response.start_date = new Date(arrayStartDate[0], (arrayStartDate[1] - 1), arrayStartDate[2]);
                            }
                            if (response.hasOwnProperty('due_date') && response.due_date) {
                                var arrayDueDate = response.due_date.split('-');
                                response.due_date = new Date(arrayDueDate[0], (arrayDueDate[1] - 1), arrayDueDate[2]);
                            }
                        }
                        return response;
                    }
                },
                save: {
                    method: 'POST',
                    transformRequest: transformDate
                },
                update: {
                    method: 'PUT'
                }
            });
        }]);