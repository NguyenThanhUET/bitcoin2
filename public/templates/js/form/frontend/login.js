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
        if($('#companycd').length > 0){
            $('#companycd').focus();
        }else{
            $('#username').focus();
        }
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
        $("#password, #username").keydown(function (e) {
            if(e.keyCode == 13){
                $('#login-customer').trigger('click');
            }
        });
        // Button login staff
        $(document).on('click', '#login-customer', function() {
            try {
                // post ajax
                if(!validate_input($('body'))){
                    return false;
                }else{
                    loginCustomer();
                }
            } catch (e) {
                alert('#login-customer' + e.message);
            }
        });
    } catch (e) {
        alert('initEvents' + e.message);
    }
}
function loginCustomer() {
    try {
        // get data
        $.ajax({
            type		:	'POST',
            url			:	'/frontend/home/login',
            dataType	:	'json',
            data		:	{
                    username			:	$('#username').val()
                ,	password			:	$('#password').val()
            },
            success: function(res) {
                switch (res['status']){
                    case OK:
                        window.location = '/system/sys002/index';
                        break;
                    case NG:
                        if(typeof res['error'] != 'undefined'){
                            processError(res['error']);
                        }
                        break;
                    case EX:
                        jError(res['Exception']);
                        break;
                    default:
                        break;
                }
            },
            error: function(res) {
                jMessage(379,function(){
                    $('#username').focus();
                });
            },
        });
    } catch (e) {
        alert('login customer' + e.message);
    }
}



