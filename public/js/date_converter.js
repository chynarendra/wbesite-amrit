
$("document").ready(function () {
    $("#from_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate:'0'
    });

    $("#to_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate:'0'
    });

    $(".startDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });

    $(".endDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });
    $("#follow_date").datepicker({
        autoClose:true,
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate:0,
    });
    $(".followDate").datepicker({
        autoClose:true,
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        minDate:0,
    });
    $("#eng_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });
    $(".purchaseDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate:'0'
    });
    $("#start_eng_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });
    $("#end_eng_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

});
