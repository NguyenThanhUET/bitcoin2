$(document).ready(function() {
    try {
        initialize();
        initEvents();
    } catch (e) {
        alert('ready' + e.message);
    }
});
/**
 * initialize
 *
 * @author		:	viettd - 2016/05/09 - create
 * @param		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function initialize() {
    try {
        // focus into first item

    } catch (e) {
        alert('initialize' + e.message);
    }
}
/**
 * initEvents
 *
 * @author		:	hiepnv - 2016/05/09 - create
 * @author		:
 * @params		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function initEvents() {
    try {
        $(document).on('click','.confirm-btn',function(){
            var parent  =   $(this).parents('tr.tr-record');
            jConfirm('Do you want to approve ?','Confirm',function(r){
                if(r){
                    confirmTrans($(parent).attr('record-id'),function(){
                        $(parent).remove();
                    });
                }
            });
        });
    } catch (e) {
        alert('initEvents' + e.message);
    }
}
function confirmTrans(id, callback){
    var data    =   {};
    data['id'] = id;
    console.log(data);
    $.ajax({
        type        :   'POST',
        url         :   '/backend/transaction/waitingapproved',
        dataType    :   'json',
        loading     :   true,
        data        :   data,
        success: function(res) {
            switch (res['status']){
                //not perssion
                case PE:
                    jMessage(23);
                    break;
                // success
                case 1:
                    var message =   "<div class='form-group isa_success'><i class='fa fa-times-circle'></i>Update Successfull</div>";
                    $('.message').html(message);
                    if(callback){
                        callback();
                    }
                    break;
                // error
                case 0:
                    var message =   "<div class='form-group isa_error'><i class='fa fa-times-circle'></i>Update Error</div>";
                    $('.message').html(message);
                    break;
                // Exception
                case EX:
                    jError(res['Exception']);
                    break;
                default:
                    break;
            }
        }
    });
}