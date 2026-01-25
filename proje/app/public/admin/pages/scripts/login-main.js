/**
 * Created by user on 7.01.2017.
 */
$(document).ready(function () {
    $('#trash').click(function () {
        $('#passKey').text("");
    });
    $( "#createKey" ).submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'post',
            data: data,
            processData: false,
            success: function(result){
                if(result.result == false){
                    $('#passKey').text(result.message);
                    setTimeout(function () {
                        $('#passKey').text("");
                    },700);
                }else if(result.result == true){
                    $('#passKey').text(result.message);
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    });
});