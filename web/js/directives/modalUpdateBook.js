app.directive('modalUpdateBook',['Books','$rootScope',function(Books, $rootScope){
    return {
        //templateUrl: "../../partials/modal.html",
        link: function(scope, element, attributes){

            element.on('click',function(e){
                console.log(element);
                e.preventDefault();
                var id = attributes.modalUpdateBook;

                scope.books =  Books;
                Books.updateBookView(id,
                    function (data) {
                        if (data) {
                            var modal = $('#modal_update_book');
                            modal.find('.modal-body').html(data);
                            modal.modal('show');

                            $('#books-form').on('submit',function(e){
                                e.preventDefault();
                                var form = $(this);
                                var formData = new FormData();
                                formData.append('_csrf', form.find('> input').val());
                                formData.append('id', id);
                                formData.append('Books[author_id]', form.find('#books-author_id').val());
                                formData.append('Books[name]', form.find('#books-name').val());
                                formData.append('Books[date_create_book]', form.find('#books-date_create_book').val());
                                formData.append('Books[preview]', ' ');
                                for (var i=0; i<=$('#books-preview')[0].files.length; i++){
                                    formData.append('Books[preview]',$('#books-preview')[0].files[i]);
                                }
                                $.ajax({
                                    url: '/books/update',
                                    type: 'POST',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    async: false,
                                    success: function(data){
                                        if(data.success)
                                        {
                                            scope.books = Books.getBooks();
                                            $rootScope.$on('books:load',function(event,data){
                                                scope.books = data;
                                            });
                                        }
                                   }
                                });

                            });
                        }
                });
            });
        },
        restrict: "A"
    }
}]);
