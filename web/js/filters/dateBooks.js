app.filter('dateBooks',function(){
    return function (value, parameters){
        /*if (!isNaN(value))
            value = parseInt(value);
        else
            return 'Входной параметр не число';*/
        value = value*1000;

        Date.prototype.getMonthName = function(){
            var month = ['Jan','Feb','Mar','Apr','May','Jun',
                'Jul','Aug','Sep','Oct','Nov','Dec'];
            return month[this.getMonth()];
        }

        value = new Date(value);
        value =
            value.getDate()+'-'
            +value.getMonthName()+'-'
            +value.getFullYear();
        return value;
    }
});