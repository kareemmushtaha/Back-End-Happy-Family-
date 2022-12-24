$(document).ready(function () {


    $('.numberOnly').keypress(function (event) {
        var code = (event.keyCode ? event.keyCode : event.which);
        if (!(
                (code >= 48 && code <= 57) //numbers
                || (code == 46) //period
            )
            || (code == 46 && $(this).val().indexOf('.') != -1)
        )
            event.preventDefault();

        if ($(this).val().length >= parseInt($(this).attr('maxlength'))) {
            event.preventDefault();

        }
    });

    jQuery(".letterOnly").keypress(function (e) {

        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return true;
        } else {
            return false;
        }
    });
});
