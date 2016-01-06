app.controller('Books',['$scope','$rootScope','Books', 'Authors', function($scope, $rootScope, Books, Authors){


    /*Загрузка списка книг*/
    Books.getBooks('','','','',function(data){
        $scope.books = data;
        /*для правильной сортировки приводим к Int все id*/
        angular.forEach($scope.books,function(val, key){
            if (!isNaN(val.id)) $scope.books[key].id = parseInt(val.id);
            if (!isNaN(val.date_create_book)) $scope.books[key].date_create_book = parseInt(val.date_create_book);
            if (!isNaN(val.date_create)) $scope.books[key].date_create = parseInt(val.date_create);
        });
    });

    /*Удаление книг*/
    $scope.delBook = function(id){
        $scope.books = Books.delBook(id);
        $rootScope.$on('books:delete',function(event,data){
            if (data){
                $scope.books = Books.getBooks();
                $rootScope.$on('books:load',function(event,data){
                    $scope.books = data;
                });
            }
        });
    }

    /**
     * Сортировка
     * @param field - сортируемое поле
     * @param reverse - ASC или DESC
     */
    $scope.orderOptions = {
        field: 'id'
    };

    $scope.sortReverse = false;

    $scope.reverseOptions = {};

    $scope.sortStyle = {};

    $scope.setOrder = function(field, reverse){

        $scope.sortReverse = !reverse;
        console.log('reverse = ',$scope.sortReverse);
        if($scope.orderOptions != field)
            $scope.reverseOptions[field] = $scope.sortReverse;
        else
            $scope.reverseOptions[field] = !$scope.reverseOptions[fields];
        $scope.orderOptions.field = field;
        $scope.sortStyle[field] = ($scope.reverseOptions[field]) ? 'fa fa-caret-up' : 'fa fa-caret-down';
    }

    /* Фильтрация */

    /* загрузка списка авторов*/

    $scope.selectedAuthors = '';
    Authors.getAuthorsName(function(data){
        if (data){
            var selected = {
                full_name: "--Не выбрано--",
                id: "0"
            }
            data.splice(data.length,0,selected);
            $scope.authors = data;
            $scope.selectedAuthors = $scope.authors[$scope.authors.length-1];
        }
    });

    /*Обработчик кнопки искать*/
    $scope.searchBook = function(){

        var date_create_book = angular.element('#date_create_book').val();
        var date_create = angular.element('#date_create').val();

        if ($scope.selectedAuthors.id == '0')
            $scope.selectedAuthors.id = undefined;

        Books.getBooks(
            $scope.selectedAuthors.id,
            date_create_book,
            date_create,
            $scope.nameBook,
            function(data){
                $scope.books = data;
                /*для правильной сортировки приводим к Int все id*/
                angular.forEach($scope.books,function(val, key){
                    if (!isNaN(val.id)) $scope.books[key].id = parseInt(val.id);
                    if (!isNaN(val.date_create_book)) $scope.books[key].date_create_book = parseInt(val.date_create_book);
                    if (!isNaN(val.date_create)) $scope.books[key].date_create = parseInt(val.date_create);
                });
                console.log($scope.books);
            }
        );
    }

}]);


