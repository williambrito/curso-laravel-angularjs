angular.module('app.services')
    .service('projectService', [
        '$resource',
        '$filter',
        '$httpParamSerializer',
        function ($resource,
                  $filter,
                  $httpParamSerializer) {

            return $resource('/project/:id', {id: '@id'}, {
                save: {
                    method: 'POST',
                    transformRequest: function (data) {
                        if (angular.isObject(data) && data.hasOwnProperty('due_date')) {
                            data.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                            return $httpParamSerializer(data);
                        }
                        return data;
                    }
                },
                update: {
                    method: 'PUT'
                }
            });
        }]);