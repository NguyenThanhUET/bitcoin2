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
        $(document).on('change','.active-flg',function(){
            var parent      =   $(this).parents('tr.tr-record');
            var recordID    =   $(parent).attr('record-id');
            var subparent   =   $('tr.sub-record[record-id="'+recordID+'"]');
            var active      =   0;
            if($(this).is(':checked')){
                active  =   1;
            }
            jConfirm('Do you want to change Active ?','Confirm',function(r){
                if(r){
                    activeChange(recordID,active);
                }
            });
        });
        $(document).on('click','.delete-btn',function(){
            var parent  =   $(this).parents('tr.tr-record');
            var recordID    =   $(parent).attr('record-id');
            var subparent   =   $('tr.sub-record[record-id="'+recordID+'"]');
            jConfirm('Do you want to delete ?','Confirm',function(r){
                if(r){
                    deleteCustomer(recordID,function(){
                        $(parent).remove();
                        $(subparent).remove();
                    });
                }
            });
        });
    } catch (e) {
        alert('initEvents' + e.message);
    }
}
function activeChange(id,active, callback){
    var data    =   {};
    data['id']  =   id;
    data['active']  =   active;
    $.ajax({
        type        :   'POST',
        url         :   '/backend/management/activecustomer',
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
function deleteCustomer(id, callback){
    var data    =   {};
    data['id'] = id;
    console.log(data);
    $.ajax({
        type        :   'POST',
        url         :   '/backend/management/deletecustomer',
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
                    var message =   "<div class='form-group isa_success'><i class='fa fa-times-circle'></i>Delete Successfull</div>";
                    $('.message').html(message);
                    if(callback){
                        callback();
                    }
                    break;
                // error
                case 0:
                    var message =   "<div class='form-group isa_error'><i class='fa fa-times-circle'></i>Delete Error</div>";
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


