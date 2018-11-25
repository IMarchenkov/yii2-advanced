$('#tasks-date').on('change', function(){
    var date = $('#tasks-date').val();
    var $dateEnd = $('#tasks-date_end');
    if($dateEnd.val() < date){
        $dateEnd.val(date);
        $dateEnd.attr('value', date);
    }
});