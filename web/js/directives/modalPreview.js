app.directive('modalPreview',function(){
    return{
        link: function(scope, element, attributes){
            $('.modal_preview').on('click', function(event){
                event.preventDefault();

                var src = $(this).find('img').attr('src');
                var modalContainer = $('#modal_preview');
                var img = $("<img>", {
                    src: src,
                    width: 550,
                    height: 400
                });
                modalContainer.find('.modal-body').html(img);
                modalContainer.modal({show:true});
            });
        },
        restrict: "A"
    }
});