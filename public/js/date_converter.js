
$("document").ready(function () {
    $("#from_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#to_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#dispatch_from_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#dispatch_to_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#leave_from_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#leave_to_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#leave_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
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
    });
    $(".followDate").datepicker({
        autoClose:true,
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
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

    $("#month_start_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });
    $("#month_end_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#holiday").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#holiday1").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $("#leave").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

    $(".getDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

});

$(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        var uniqueId='holiday'+x;
        var fieldHTML = '<div class="flex-container" style="margin-top: 5px;"><div><input type="text" name="holiday[]" placeholder="week off date" class="form-control" required/></div><div><a href="javascript:void(0);" class="remove_button" style="padding: 5px;"><i class="fa fa-minus-circle text-danger"></i></a></div></div>'; //New input field html

        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html

            $("#".uniqueId).datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
            });
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

});

$(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button_leave'); //Add button selector
    var wrapper = $('.field_wrapper_leave'); //Input field wrapper
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){

        var fieldHTML = '<div class="flex-container" style="margin-top: 5px;"><div><input type="text" id="leave" name="leave[]" ' +
            'placeholder="leave date" class="form-control leaveField leave" required/></div><div><a href="javascript:void(0);" class="remove_button_leave" style="padding: 5px;"><i class="fa fa-minus-circle text-danger"></i></a></div></div>'; //New input field html

        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html

        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_leave', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
