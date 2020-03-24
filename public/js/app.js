var application = {
    'init': function(){
        // Intialize code here
    }
}


function clickMe(obj){
    var param = jQuery('#param option:selected').val();
    jQuery.ajax({
        url : '/ajax/processAjaxRequest',
        type: "post",
        data: {'param':param},
        //headers: {"x-shopify-access-token": "b32c5bf2bc4df9a26b85dba491507ad0"},
        beforeSend : function() {
            /* Logic before ajax request sent */
            jQuery(obj).text('Loading...');
        },
        success: function(data, status){
            alert(data.message);
            if(data.status == 'error'){
                // Perform any operation on error
                alert(data.error);
            }else{
                // Perform any operation on success
            }
        },
        error : function(xhr, textStatus, errorThrown) {
            if (xhr.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (xhr.status == 404) {
                alert('Requested page not found. [404]');
            } else if (xhr.status == 500) {
                alert('Server Error [500].');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (errorThrown === 'timeout') {
                alert('Time out error.');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('There was some error. Try again.');
            }
        },
        complete: function(){
            // Perform any operation need on success/error
            jQuery(obj).text('Import');
        }
    });
}


jQuery(document).ready(function(){
    application.init();
});