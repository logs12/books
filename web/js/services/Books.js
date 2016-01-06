app.factory('Books',['$http','$rootScope', function($http, $rootScope){

    var self = this;

    /**
     * Delete books
     * @param id int - id books
      */
    self.delBook = function(id){
        $http({
            method: 'GET',
            url: '/books/delete',
            params: {
                'id':id
            },
            responseType: 'json'
        }).then(function(response){
            if (response.data.success)
                $rootScope.$broadcast('books:delete',response.data.success);
            else
                throw new Error(response.data.message);
        });
    }

    self.updateBookData = function(id){
        $http({
            method: 'GET',
            url: '/books/update',
            params: {
                'id':id
            },
            //responseType: 'json'
        }).then(function(response){
            if (response.status == 200){
                $rootScope.$broadcast('books:update',response.data);
            }
            else
                throw new Error(response.statusText);
        });
    }



    var service = {};

    function dateToTimestamp(date){
        return Math.round((new Date(date).getTime()-3*3600*1000) / 1000);
    }

    /**
     * Load data all books
     */
    service.getBooks = function(
        selectedAuthors,
        date_create_book,
        date_create,
        nameBook,
        onSuccess
        ){
        selectedAuthors = selectedAuthors || '';
        date_create = isNaN(dateToTimestamp(date_create)) ? undefined : dateToTimestamp(date_create);
        date_create_book = isNaN(dateToTimestamp(date_create_book)) ? undefined : dateToTimestamp(date_create_book);
        nameBook = nameBook || '';
        $http({
            method: 'POST',
            url: '/books/search',
            params: {
                'selectedAuthors': selectedAuthors,
                'date_create_book':date_create_book,
                'date_create':date_create,
                'nameBook':nameBook,
            },
            responseType: 'json'

        }).then(function(response){

            if (response.data.success){
                //console.log('books = ',response.data.books)
                //$rootScope.$broadcast('books:load',response.data.books);
                onSuccess && onSuccess(response.data.books)
            }else{
                throw new Error(response.data.message);
            }

        });
    }

    service.delBook = function(id){
        return self.delBook(id);
    }

    service.viewBook = function(id, onsuccess){
        $http({
            method: 'GET',
            url: '/books/view',
            params: {
                'id':id
            },
            //responseType: 'json'
        }).then(function(response){
            if (response.status == 200){
                //$rootScope.$broadcast('books:view',response.data);
                onsuccess && onsuccess(response.data);
            }
            else
                throw new Error(response.statusText);
        });
    }

    service.updateBookView = function(id,onsuccess){
        $http({
            method: 'POST',
            url: '/books/update',
            params: {
                'id':id
            },
            //responseType: 'json'
        }).then(function(response){
            if (response.status == 200){
                //$rootScope.$broadcast('books:update',response.data);
                onsuccess && onsuccess(response.data);
            }
            else
                throw new Error(response.statusText);
        });
    }

    return service;
}]);