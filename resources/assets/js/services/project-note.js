angular.module('app.services')
    .service('projectNoteService', ['$resource', function ($resource) {
        return $resource('/project/:id/note/:idNote', {id: '@id', idNote: '@idNote'}, {
            update: {
                method: 'PUT'
            },
            get: {
                method: 'GET',
                transformResponse: function (data, headers) {
                    var headersGetter = headers();
                    if (headersGetter['content-type'] == 'application/json' ||
                        headersGetter['content-type'] == 'text/json') {
                        var dataJson = JSON.parse(data);
                        if (dataJson.hasOwnProperty('data')) {
                            dataJson = dataJson.data;
                        }
                        return dataJson[0];
                    }
                    return data;
                }
            }
        });
    }]);