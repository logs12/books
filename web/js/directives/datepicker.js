app.directive('datepick',function(){
    return {
        link: function(scope, element, attributes){
            var nameScope = attributes['datepick'];
            $(function(){
                element.datepicker({
                    showOtherMonths: true,
                    dateFormat:'yy-mm-dd',
                    onSelect: function(dateText, datepicker) {
                        angular.element(this).val(dateText);
                    }
                });
            });
        },
    }
});
