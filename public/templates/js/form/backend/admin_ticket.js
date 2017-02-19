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
        $(document).on('click','.answer-link',function(){
            var parent = $(this).parents('tr.tr-record');
            $('.tr-record').removeClass('selected');
            $('#answer-text').attr('messageid',0);
            $(parent).addClass('selected');
            $('#question-text').val($(parent).find('.td-question').html());
            $('#customer_id_refer').html($(parent).find('.td-customer-id').html());
            $('#answer-text').attr('messageid',$(parent).attr('record-id'))
        });
        $(document).on('click','#answer-btn',function(){
            var messageid = $('#answer-text').attr('messageid');
            if(1*messageid!=0){
                jConfirm('Do you want to send message ?','Confirm',function(r){
                    if(r){
                        var messageContent = $('#answer-text').val();
                        if($.trim(messageContent) !=''){
                            answerHandler(messageid,function(){
                                console.log($('.tr-record[record-id="'+messageid+'"]'));
                                $('.tr-record[record-id="'+messageid+'"]').find('.td-answer').html(
                                    $('#answer-text').val()
                                );
                                $('tr.tr-record[record-id="'+messageid+'"]').find('.status-td').html('Answered');
                                $('tr.tr-record[record-id="'+messageid+'"]').find('.status-td').removeClass('color-default').addClass('color-success');
                            });
                        }else{
                            jAlert('Please type answer !','Warning');
                        }

                    }
                });
            }else{
                jAlert('Please choose ticket to answer','Warning');
            }
        });

    } catch (e) {
        alert('initEvents' + e.message);
    }
}
function answerHandler(id, callback) {
    var data = {};
    data['id'] = id;
    data['comment'] = $('#answer-text').val();
    $.ajax({
        type: 'POST',
        url: '/backend/ticket/answer',
        dataType: 'json',
        loading: true,
        data: data,
        success: function (res) {
            switch (res['status']) {
                //not perssion
                case PE:
                    jMessage(23);
                    break;
                // success
                case 1:
                    var message = "<div class='form-group isa_success'><i class='fa fa-times-circle'></i>Update Successfull</div>";
                    $('.message').html(message);
                    if (callback) {
                        callback();
                    }
                    break;
                // error
                case 0:
                    var message = "<div class='form-group isa_error'><i class='fa fa-times-circle'></i>Update Error</div>";
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


