app.directive('modalViewBook',['Books','$rootScope',function(Books, $rootScope){
    return {
        //templateUrl: "../../partials/modal.html",
        link: function(scope, element, attributes){
            element.on('click',function(e){
                e.preventDefault();
                var id = attributes.modalViewBook;
                Books.viewBook(id, function(data){
                    if (data){
                        var modal = $('#modal_view_book');
                        modal.find('.modal-body').html($(data).eq(1));
                        modal.modal({show:true});
                    }
                });
            });
        },
        restrict: "A"
    }
}]);
