angular.module('app.services')
    .service('projectNoteService', ['$resource', function ($resource) {
        return $resource('/project/:id/note/:idNote', {id: '@id', idNote: '@idNote'}, {
            update: {
                method: 'PUT'
            }
        });
    }]);