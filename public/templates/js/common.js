/**
 * ****************************************************************************
 * MOVE
 * MOVE COMMON.JS
 *
 * 処理概要		:	MOVE_common.js
 * 作成日		:	2015/09/15
 * 作成者		:	hiepnv – hiepnv@ans-asia.com
 *
 * 更新日		:
 * 更新者		:
 * 更新内容		:
 *
 * @package		:	MODULE NAME
 * @copyright	:	Copyright (c) ANS-ASIA
 * @version		:	1.0.0
 * ****************************************************************************
 */
var OK 	= 200;// OK
var NG 	= 201;// Not good
var EX 	= 202;// Exception
var EPT = 203;// Empty
var VALIDATE = 204;
var PE 	= 999;// Not permission
var NUMBER_PASTE_DATA_STATUS = true;
var DELIMITER = '|#|@';// delimiter
var PAGE = 1// page of search screen
var PAGE_SIZE = 50 //number of record in a page
var _isIE = false;
var _ie;
var	ROW_LIMIT = 10000;//limit number of record in all page
// Add new
var CONFIRM	= '確認';
$(document).ready(function() {
    try {
        init();
        setUseSettingType();
       // _formatInput();
    } catch (e) {
        alert('ready' + e.message);
    }
});

function setUseSettingType() {
	if( typeof acl == 'undefined' || !$.isArray(acl)) {
		return;
	}
	$.each(acl, function(index, element) {
		//debugger;
		if(element.controller_nm.toUpperCase() == controller) {
			var btnid = '#' + element.FunctionCD + ', ' + '.' + element.FunctionCD;
			if(element.UseSettingTyp == 2){
				$(btnid).addClass('not-allow').css('cursor','not-allowed').prop('disabled', true).find('a').attr('tabindex', '-1');
			} else if(element.UseSettingTyp == 3) {
				$(btnid).css("display", 'none');
			}
			var btnid = '#' + element.FunctionCD;
			$(btnid).unbind('click');
			var btnid ='.' + element.FunctionCD;
			$(btnid).unbind('click');
		}
		//
		if(element.UseSettingTyp == 3 && element.FunctionCD == 'view') {
			$('#gNav_wrap').find('a[href*="' + element.controller_nm.toLowerCase() + '"]').remove();
		}else if(element.UseSettingTyp == 2 && element.FunctionCD == 'view') {
			$('#gNav_wrap').find('a[href*="' + element.controller_nm.toLowerCase() + '"]')
						.attr('href', "#")
						.children('li').addClass('disabled-menu');
		}
	});
}

/**
 * initialize
 *
 * @author : viettd - 2015/09/15 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function init() {
    try {
        //hiepnv 2016/06/13 add white space in text title
        $('.screen-name-info').each(function(){
            var eleTitle = $(this);
            var title  = $(this).text();
            var str = title.split('').join(' ');
            eleTitle.text(str);
        });
        // trinhnv 2016/09/08
        $('.negative').each(function() {
            var input = $(this).val();

            if(input.indexOf("-") > -1){
                $(this).addClass('color-red');
            }
        });
        // end 2016/09/08
        $(document).on('click','#gNav_btn',function(){
            if($(this).hasClass( 'open' )){
                $(this).removeClass('open');
                $('#gNav_wrap').removeClass('open');
            }else{
                $(this).addClass('open');
                $('#gNav_wrap').addClass('open');
            }
        });
        $("body").keydown(function (e) {
            if(e.keyCode == 115){
                e.preventDefault();
                var elFocus = $('input.item-focused');
                if($(elFocus).hasClass('hasDatepicker') || $(elFocus).hasClass('month')){
                	$(elFocus).trigger('blur');
                	$('#btn-search').trigger('click');
                }else{
                	$('#btn-search').trigger('click');
                }
            }
            if(e.keyCode == 120){
                $('#btn-update').trigger('click');
                $('#btn-save').trigger('click');
            }
            if(e.keyCode == 123){
                e.preventDefault();
                $('#btn-back').trigger('click');
                $('.btn-close-popup').trigger('click');
            }
            if(e.keyCode==121){
                e.preventDefault();
                $('#btn-print').trigger('click');
            }
        });
        $(document).on('focus','input.numeric:enabled, input.only-number:enabled',
            function(e) {
                $(this).attr('type', 'tel');
            }
        );
        $(document).on('hover','.dropdown-submenu',function(){
            $(this).parents('.dropdown-menu').find('.dropdown-menu').css('display','none');
            $(this).find('.dropdown-menu').css('display','block');
            $(this).find('a').css('border-left-color','#fff');
        });
        $(document).on('click','.btn-coming-soon',function(){
            //alert('Coming Soon');
        });
        $(document).click(function (e){
          if (!$(".dropdown-menu").is(e.target) && $(".dropdown-menu").has(e.target).length == 0){
           $('.dropdown-submenu').find('.dropdown-menu').css('display','none');
          }
        });
        // click icon show/hide search conditon
        $(document).on(
                'click',
                '.btn-show-hide-item',
                function() {
                    try {
                        //get searching area height
                        //var divHeight = $('.w-group-button-search').height();
                        $('.w-area-search').slideToggle('fast');
                        if ($('.btn-show-hide-item').hasClass(
                                'glyphicon-collapse-down')) {
                            $('.btn-show-hide-item').removeClass(
                                    'glyphicon-collapse-down');
                            $('.btn-show-hide-item').addClass(
                                    'glyphicon-collapse-up');
                            resizeTable(0);
                            //set height for table when clicking show/hide button
                            /*$('.w-result-data').height(Number($('.w-result-data').height())+Number(divHeight));
                            $('.w-data-table').height(Number($('.w-data-table').height())+Number(divHeight));
                            $('.w-body-table-fix').height(Number($('.w-body-table-fix').height())+Number(divHeight));*/
                        } else {
                            $('.btn-show-hide-item').removeClass(
                                    'glyphicon-collapse-up');
                            $('.btn-show-hide-item').addClass(
                                    'glyphicon-collapse-down');
                            resizeTable(1);
                            //set height for table when clicking show/hide button
                            /*$('.w-result-data').height(Number($('.w-result-data').height())-Number(divHeight)-150);
                            $('.w-data-table').height(Number($('.w-data-table').height())-Number(divHeight)-150);
                            if(Number($('.w-body-table-fix').height())>=Number($('.w-result-data').height())){
                                $('.w-body-table-fix').height(Number($('.w-result-data').height())-120);
                            }*/
                        }
                    } catch (e) {
                        alert('.btn-show-hide-item' + e.message);
                    }
                });
        // click button download
        $(document).on(
                'click',
                '.btn-attach-file',
                function() {
                    try {
                        var data		=	{};
                        var localPath	= $(this).attr('localPath');
                        var filename 	= $(this).attr('filename');
                        var sync		= $(this).attr('sync');
                        data['local_path']	=	localPath;
                        data['file_name']	=	filename;
                        data['sync']		=	sync;
                        var urlCheck 	= '/common/upload/checkfile/';
                        var _this = this;
                        $.ajax({
                            type : 'POST',
                            url : urlCheck,
                            data: data,
                            dataType : 'JSON',
                            success : function(res) {
                                if (res.status == NG) {
                                    jMessage(29);
                                } else{
                                    var fileName = res.fileName;
                                    $('#download-file-common').attr('href','/upload/temp/'+fileName);
                                    document.getElementById('download-file-common').click();
                                    deleteFileTemp(fileName);
//                                    var urlDownload = '/common/upload/download/fileName/'+fileName;
//                                    window.location.href = urlDownload;
                                }
                            }
                        });
                    } catch (e) {
                        alert('.realupload' + e.message);
                    }
                });

        
        // click button download file by service 
        // BaoNC
        $(document).on('click','.btn-attach-file-services', function() {
	            try { 
	            	data['opption']		=	3;  // copy
	                data['fromFolder']	= $(this).attr('localPath'); ; // file return 
	                $.ajax({
	                    type : 'POST',
	                    url	 :	'/export/GetList/getallfile', 
	                    data: data, 
	                    timeout:100000000,
	                    success : function(res) { 
	                        if (res.status == NG) {
	                            jMessage(29);
	                        } else{
	                            var fileName = res['filename'].replace("[" , "").replace("]" , "");
	                            $('#download-file-common').attr('href','/upload/temp/'+fileName);
	                            document.getElementById('download-file-common').click();
	                            deleteFileTemp(fileName);
	//                                    var urlDownload = '/common/upload/download/fileName/'+fileName;
	//                                    window.location.href = urlDownload;
	                        }
	                      
	                    }
	                });  
	                
	            } catch (e) {
	                alert('.btn-attach-file-services	' + e.message);
	            }
        	});
        	// End BaoNC
        
        
        // click button download
        $(document).on('click','.btn_get_all_file',
                function() {
                    try {
                        var data		=	{};
                        var localPath	= $(this).attr('localPath');
                        var filename 	= $(this).attr('filename');
                        var sync		= $(this).attr('sync');
                        data['local_path']	=	localPath;
                        data['file_name']	=	filename;
                        data['sync']		=	sync;
                        var urlCheck 	= '/common/upload/getallfile/';
                        var _this = this;
                        $.ajax({
                            type : 'POST',
                            url : urlCheck,
                            data: data,
                            dataType : 'JSON',
                            success : function(res) {
                                log(res);

                            }
                        });
                    } catch (e) {
                        alert('.realupload' + e.message);
                    }
                });


        // check button in menu (not-allow)
        $(document).on('click','.not-allow',function(){
            try {
                jMessage(23);
            } catch (e) {
                alert('.not-allow' + e.message);
            }
        });
        // check IE?
        if ($('html').hasClass('ie')
                || (Function('/*@cc_on return document.documentMode===10@*/')())) {
            _isIE = true;
            _ie = (function() {
                var undef, v = 3, div = document.createElement('div'), all = div
                        .getElementsByTagName('i');
                while (div.innerHTML = '<!--[if gt IE ' + (++v)
                        + ']><i></i><![endif]-->', all[0])
                    ;
                return v > 4 ? v : undef;
            }());
        } else {
            _isIE = false;
        }
        // focus input text search
        $('#key-search').focus();
        // input file
        $(document).on(
                'change',
                '.realupload',
                function() {
                    try {
                        $(this).parents('.upload').find('.input-path').val(
                                $(this).val().replace(/^.*[\\\/]/, ''));
                    } catch (e) {
                        alert('.realupload' + e.message);
                    }
                });
        // clear file name
        $(document).on('click', '.btn-clearfile', function() {
            try {
                var div = $(this).closest('.upload');
                div.find('.input-path').val('');
            } catch (e) {
                alert('.btn-clearfile' + e.message);
            }
        });
        //
        $(document).on(
                'click',
                '.btn-clearfile',
                function() {
                    $(this).parents('.upload').find('.input-path').val('');
                    if (_isIE) {
                        $(this).parents('.upload').find('.realupload')
                                .replaceWith(
                                        $("input[type='file']").clone(true));
                    } else {
                        $(this).parents('.upload').find('.realupload').val('');
                    }
                });
        // focus input search
        $(document).on(
                'focus',
                '.input-group input',
                function() {
                    try {
                        if ($(this).hasClass('required')) {
                            $(this).parent('.input-group').find('button')
                                    .addClass('control-focus');
//							$(this).parent('.input-group').find(
//									'.control-focus').css('border-color',
//									'#FF3B3B');
                        } else {
                            $(this).parent('.input-group').find('button')
                                    .addClass('control-focus');
//							$(this).parent('.input-group').find(
//									'.control-focus').css('border-color',
//									'#66afe9');
                        }
                    } catch (e) {
                        alert('.input-group input' + e.message);
                    }
                });
        // blur input search
        $(document).on(
                'blur',
                '.input-group input',
                function() {
                    try {
//						if($(this).parent().find('input').hasClass('required')){
//							$(this).parent('.input-group').find('button').css( 'border-color', '#FF3B3B');
//						}else{
//							$(this).parent('.input-group').find('button').css( 'border-color', '#DBD6D6');
//						}
                        $(this).parent('.input-group').find('button').removeClass('control-focus');
                    } catch (e) {
                        alert('.input-group input' + e.message);
                    }
                });
        $(".only-number, .numeric").bind('paste', function(e) {
            var _this = $(this);
            setTimeout(function(e) {
                if (!_validateNumber($(_this).val())) {
                    $(_this).val('');
                }
            }, 0);
        });
        // Enter event
        $(document).on('keypress', '#key-search', function(e) {
            try {
                if (e.keyCode == 13) {
                    $('#btn-search').trigger('click');
                }
            } catch (e) {
                alert('#key-search' + e.message);
            }
        });
        $(document).on('keypress', '.li-click', function(e) {
            try {
                if (e.keyCode == 13) {
                    $(this).trigger('click');
                }
            } catch (e) {
                alert('li-click' + e.message);
            }
        });
        $(document).on('keypress', '.ui-datepicker-trigger', function(e) {
            try {
                if (e.keyCode == 13) {
                    $(this).trigger('click');
                }
            } catch (e) {
                alert('.date' + e.message);
            }
        });
        // // disable scroll window when display colobox
        $(document).bind('cbox_open', function() {
            $('html').css({
                overflow : 'hidden'
            });
        }).bind('cbox_closed', function() {
            $('html').css({
                overflow : ''
            });
        });
        $(document).on('click', '.btn-close-popup', function() {
            parent.$.colorbox.close();
        });
        // Event Scroll fixed column table
        $('.w-nofix-body').scroll(
                function() {
                    $(this).parents('.w-fixed-table').find('.w-nofix-header')
                            .scrollLeft($(this).scrollLeft());
                    $(this).parents('.w-fixed-table').find('.w-fix-body')
                            .scrollTop($(this).scrollTop());
                });

        // Click function display Popup
        $(document).on('click', '.btn-popup', function() {
            $.colorbox({
                iframe : true,
                innerWidth : '80%',
                innerHeight : '60%',
                opacity : 0.2,
                href : $(this).attr('href'),
                escKey : false,
                cbox_load : function() {
                    $('#cboxClose').remove();
                    $("#cboxTitle").remove();
                }
            });
        });


        $('.w-content-data').scroll(function(){
           try{
             $('.date').datepicker("hide");
            // $('.date').blur();
           }catch(e){
            alert('.w-content-data scroll' + e.message);
           }
          });
        // quangnk update 06-10-2015 createa table fix header
        createTableFixHeader();
        $('#myTabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
        // Even click menu left screen masster - quangnk 22/09/2015
        $(document).on('click', '.li-click', function() {
            $('li.li-click').removeClass('li-click-focus');
            $(this).addClass('li-click-focus');
            clickMenuLeft($(this));
        });
        resize();
        $(window).resize(function() {
            resize();
            resizeMaster();
            var curWidth = $('#colorbox').width();
            if(curWidth >= 768){
                $(this).colorbox.resize({
                    innerWidth : '80%',
                    innerHeight : '80%'
                });
            }
            createTableFixHeader();
        });
        // show Loading
        jQuery.ajaxSetup({
            beforeSend : function() {
                // window.addEventListener("keydown", preventKeydown, false);
                var loading = getParameterByName('loading', this.url);
                // console.log(this.loading);
                if (this.loading) {
                    var cbox = $('#cboxLoadedContent:visible');
                    if (cbox.length > 0) {
                        if (cbox.find('.div_loading').length == 0) {
                            cbox.append($('.div_loading').clone());
                        }

                        cbox.find('.div_loading').css('position', 'absolute');
                        cbox.find('.div_loading').show();
                    } else {
                        $('.div_loading').show();
                    }
                }
            },
            complete : function(res) {
                $('table:not(.no-pre) td').each(function() {
                    if ($(this).children().length == 0) {
                        $(this).addClass('pre-wrap');
                    }
                });
                // window.removeEventListener("keydown", preventKeydown, false);
                if (this.loading) {
                    var cbox = $('#cboxLoadedContent:visible');
                    if (cbox.length > 0) {
                        cbox.find('.div_loading').remove();
                        // cbox.find('.div_loading').hide();
                    } else {
                        $('.div_loading').hide();
                    }
                }
                //check session time out when call ajax
//				if(res['responseText'] == 'セッションタイムアウトが発生しました。再度ログインしてください'){
//					window.location.href = '/auth/login';
//				}
            }
        });
        // ★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★
        // INPUT METHOD
        // ★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★
        // li-click click
        $(document).on('click', '.li-click', function() {
            try {
                $('.w-list-data-search li').removeClass('actived');
                $(this).addClass('actived');
            } catch (e) {
                alert('.li-click' + e.message);
            }
        });
        //show drop down on focusing for autocomplete items
        $(document).on('focus, click', '.ui-autocomplete-input', function(){
            $(this).autocomplete("search");
        });

        // Tool-tip
        $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
        // input upper
        $(document)
                .on(
                        'keypress',
                        'input.upper',
                        function(event) {
                            // var ctrlDown = event.ctrlKey||event.metaKey; //
                            // Mac support
                            if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                                    // 9
                                    || (event.keyCode > 64 && event.keyCode < 91)
                                    || event.keyCode == 116 // F5
                                    || event.keyCode == 46 // del
                                    || event.keyCode == 35 // end
                                    || event.keyCode == 36 // home
                                    || event.keyCode == 37 // ←
                                    || event.keyCode == 39 // →
                                    || event.keyCode == 8 // backspace
                                    || event.keyCode == 9 // tab
                                    || event.keyCode == 188 // ,
                                    || event.keyCode == 189 // -
                                    || event.keyCode == 109 // numpad -
                                    || event.keyCode == 173 // - (firefox only)
                                    || event.keyCode == 190 // .
                                    || event.keyCode == 110 // numpad .
                                    || (event.shiftKey && event.keyCode == 35) // shift
                                    // +
                                    // end
                                    || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                            ))
                                    || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                            // Shift
                            // +
                            // [0~9]
                            )
                                event.preventDefault();
                        });
        // input.percent, input.percent-money, input.time
        $(document)
                .on(
                        'keydown',
                        'input.rate, input.percentage,input.time, input.time25, input.time30',
                        function(event) {
                            // var ctrlDown = event.ctrlKey||event.metaKey; //
                            // Mac support
                            if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                                    // 9
                                    || (event.keyCode > 95 && event.keyCode < 106) // numpad
                                    // 0 ~
                                    // numpad
                                    // 9
                                    || event.keyCode == 116 // F5
                                    || event.keyCode == 46 // del
                                    || event.keyCode == 35 // end
                                    || event.keyCode == 36 // home
                                    || event.keyCode == 37 // ←
                                    || event.keyCode == 39 // →
                                    || event.keyCode == 8 // backspace
                                    || event.keyCode == 9 // tab
                                    || event.keyCode == 188 // ,
                                    || event.keyCode == 190 // .
                                    || event.keyCode == 110 // numpad .
                                    || (event.shiftKey && event.keyCode == 35) // shift
                                    // +
                                    // end
                                    || (event.shiftKey && event.keyCode == 36) // shift
                                    // +
                                    // home
                                    || event.ctrlKey // allow all ctrl combination
                                    || event.keyCode == 229 // ten-key processing
                                    ))
                                    || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                            // Shift
                            // +
                            // [0~9]
                            )
                                event.preventDefault();
                        });
        // input.timeblock5 allow top and bottom keyboard -- thanhnv add at 2016/10/10
        $(document)
                .on(
                        'keydown',
                        'input.timeblock5',
                        function(event) {
                            // var ctrlDown = event.ctrlKey||event.metaKey; //
                            // Mac support
                            if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                                    // 9
                                    || (event.keyCode > 95 && event.keyCode < 106) // numpad
                                    // 0 ~
                                    // numpad
                                    // 9
                                    || event.keyCode == 116 // F5
                                    || event.keyCode == 46 // del
                                    || event.keyCode == 35 // end
                                    || event.keyCode == 36 // home
                                    || event.keyCode == 37 // ←
                                    || event.keyCode == 39 // →
                                    || event.keyCode == 38 // arrow up
                                    || event.keyCode == 40 // arrow bottom
                                    || event.keyCode == 8 // backspace
                                    || event.keyCode == 9 // tab
                                    || event.keyCode == 188 // ,
                                    || event.keyCode == 190 // .
                                    || event.keyCode == 110 // numpad .
                                    || (event.shiftKey && event.keyCode == 35) // shift
                                    // +
                                    // end
                                    || (event.shiftKey && event.keyCode == 36) // shift
                                    // +
                                    // home
                                    || event.ctrlKey // allow all ctrl combination
                                    || event.keyCode == 229 // ten-key processing
                                    ))
                                    || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                            // Shift
                            // +
                            // [0~9]
                            )
                                event.preventDefault();
                            //thanhnv add at 2016/10/10
                            if (event.keyCode == 38){
                                var time	=	_formatTimeBlock5($(this),'+5');
                                if(time !=''){
                                    $(this).val(time);
                                }
                            }
                            if (event.keyCode == 40){
                                var time	=	_formatTimeBlock5($(this),'-5');
                                if(time !=''){
                                    $(this).val(time);
                                }
                            }
                        });
        // input.number
        $(document)
                .on(
                        'keydown',
                        'input.number',
                        function(event) {
                            if (event.keyCode != 9) {
                                NUMBER_PASTE_DATA_STATUS = true;
                            }
                            // var ctrlDown = event.ctrlKey||event.metaKey; //
                            // Mac support
                            if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                                    // 9
                                    || (event.keyCode > 95 && event.keyCode < 106) // numpad
                                    // 0 ~
                                    // numpad
                                    // 9
                                    || event.keyCode == 116 // F5
                                    || event.keyCode == 46 // del
                                    || event.keyCode == 35 // end
                                    || event.keyCode == 36 // home
                                    || event.keyCode == 37 // ←
                                    || event.keyCode == 39 // →
                                    || event.keyCode == 8 // backspace
                                    || event.keyCode == 9 // tab
                                    // || event.keyCode == 110 // numpad .
                                    || event.keyCode == 13 // Enter
                                    || (event.shiftKey && event.keyCode == 35) // shift
                                    // +
                                    // end
                                    || (event.shiftKey && event.keyCode == 36) // shift
                                    // +
                                    // home
                                    || event.ctrlKey // allow all ctrl combination
                                    || event.keyCode == 229 // ten-key processing
                                    ))
                                    || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                            // Shift
                            // +
                            // [0~9]
                            )
                                event.preventDefault();
                        });
        $(document).on(
                'change',
                'input.number',
                function(event) {
                    if (!_validateNumber($(this).val())
                            || _validateFullSize($(this).val())) {
                        $(this).val('');
                    }
                });
        // input method
        $(document)
                .on(
                        'keydown',
                        'input.tel',
                        function(event) {
                            // var ctrlDown = event.ctrlKey||event.metaKey; //
                            // Mac support
                            if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                                    // 9
                                    || (event.keyCode > 95 && event.keyCode < 106) // numpad
                                    // 0 ~
                                    // numpad
                                    // 9
                                    || event.keyCode == 116 // F5
                                    || event.keyCode == 46 // del
                                    || event.keyCode == 35 // end
                                    || event.keyCode == 36 // home
                                    || event.keyCode == 37 // ←
                                    || event.keyCode == 39 // →
                                    || event.keyCode == 8 // backspace
                                    || event.keyCode == 9 // tab
                                    || event.keyCode == 189 // -
                                    || event.keyCode == 109 // numpad -
                                    || event.keyCode == 173 // - (firefox only)
                                    ///|| event.keyCode == 107 // numpad +
                                    //|| (event.shiftKey && event.keyCode == 187) // shift
                                    // +
                                    // add
                                    || (event.shiftKey && event.keyCode == 35) // shift
                                    // +
                                    // end
                                    || (event.shiftKey && event.keyCode == 36) // shift
                                    // +
                                    // home
                                    || event.ctrlKey // allow all ctrl combination
                                    || event.keyCode == 229 // ten-key processing
                                    ))
                                    || (event.shiftKey && (event.keyCode > 47
                                            && event.keyCode < 58 || event.keyCode == 189)) // exlcude
                            // Shift
                            // +
                            // [0~9]
                            )
                                event.preventDefault();
                        });
        // input tel in mobile
        $(document).on('keydown', 'input.tel-mobile', function(event) {
            // var ctrlDown = event.ctrlKey||event.metaKey; //
            // Mac support
            if (!((event.keyCode > 47 && event.keyCode < 58) // 0 ~ 9
                    || (event.keyCode > 95 && event.keyCode < 106) // numpad
                    || event.keyCode == 8 // backspace
                    || event.keyCode == 189 // +
                    || event.keyCode == 187 // -
                    || event.keyCode == 9 // tab
                    || event.keyCode == 229 // ten-key processing
            )) {
                event.preventDefault();
            } else {
                // var string = $(this).val();
                // if (!_validatePhoneFaxNumber(string)) {
                // $(this).val('');
                // }
            }
        });
        // input keydown only-number
        $(document)
                .on(
                        'keydown',
                        'input.only-number',
                        function(event) {
                            if(!event){
                                alert('dsd');
                            }
                            try {
                                var negativeEnabled = false;
                                if ($(this).attr('negative')) {
                                    negativeEnabled = $(this).attr('negative');
                                }
                                // if (event.shiftKey) {
                                // event.preventDefault();
                                // }
                                 if (event.keyCode == 229) {
                                     $(this).val('');
                                 }

                                if (event.keyCode == 53)
                                    return true;
                                if (!((event.keyCode > 47 && event.keyCode < 58)
                                        || (event.keyCode > 95 && event.keyCode < 106)
                                        || event.keyCode == 116
                                        || event.keyCode == 46
                                        || event.keyCode == 37
                                        || event.keyCode == 39
                                        || event.keyCode == 8
                                        || event.keyCode == 9
                                        || event.ctrlKey // 20160404 - sangtk - allow all ctrl combination //
                                        || event.keyCode == 229 // ten-key processing
                                        )
                                        // || event.shiftKey
                                        || (negativeEnabled == false
                                                && event.keyCode == 189 || event.keyCode == 109)) {
                                    event.preventDefault();
                                }
                                if (negativeEnabled
                                        && (event.keyCode == 189 || event.keyCode == 109)) {
                                    var val = $(this).val();
                                    var negative = '-' + val.replace(/-/g, '');
                                    $(this).val(negative);
                                }
                            } catch (e) {
                                alert(e.message);
                            }
                        });
        // input blur only-number
        // input keydown only-number
        $(document)
                .on(
                        'keydown',
                        'input.notnumber',
                        function(event) {
                            try {
                                var negativeEnabled = false;
                                if ($(this).attr('negative')) {
                                    negativeEnabled = $(this).attr('negative');
                                }
                                if (event.shiftKey) {
                                    event.preventDefault();
                                }
                                if (!(((event.keyCode <= 47 || event.keyCode >= 58) && (event.keyCode <= 95 || event.keyCode >= 106))
                                        || event.keyCode == 116
                                        || event.keyCode == 46
                                        || event.keyCode == 37
                                        || event.keyCode == 39
                                        || event.keyCode == 8 || event.keyCode == 9)
                                        || event.shiftKey
                                        || (negativeEnabled == false
                                                && event.keyCode == 189 || event.keyCode == 109)) {
                                    event.preventDefault();
                                }
                            } catch (e) {
                                alert(e.message);
                            }
                        });
        // negative trinhnv2016/09/08
        $(document)
        .on(
                'keydown',
                'input.negative',
                function(event) {
                    if (event.keyCode != 9) {
                        NUMBER_PASTE_DATA_STATUS = true;
                    }
                    // var ctrlDown = event.ctrlKey||event.metaKey; //
                    // Mac support
                    if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                            // 9
                            || (event.keyCode > 95 && event.keyCode < 106) // numpad
                            // 0 ~
                            // numpad
                            // 9
                            || event.keyCode == 116 // F5
                            || event.keyCode == 46 // del
                            || event.keyCode == 35 // end
                            || event.keyCode == 36 // home
                            || event.keyCode == 37 // ←
                            || event.keyCode == 39 // →
                            || event.keyCode == 8 // backspace
                            || event.keyCode == 9 // tab
                            // || event.keyCode == 110 // numpad .
                            || event.keyCode == 13 // Enter
                            || event.keyCode == 189 // -
                            || event.keyCode == 109 // numpad -
                            || event.keyCode == 173 // - (firefox only)
                            || (event.shiftKey && event.keyCode == 35) // shift
                            // +
                            // end
                            || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                            || event.keyCode == 229 // ten-key processing
                            ))
                            || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                    // Shift
                    // +
                    // [0~9]
                    )
                        event.preventDefault();
                });
        $(document).on('focus', 'input.negative:enabled', function() {
            var val = $(this).val();
            $(this).val(val.replace(/,/g, "")).select();
        });
        $(document).on('blur', '.negative', function () {
            var amount = $(this).val();
            if(amount< 0) {
                $(this).addClass('color-red');
            } else {
                $(this).removeClass('color-red');
            }
            if(! $.isNumeric(amount)) {
                $(this).val('');
            } else {
                $(this).val(formatNumber(amount,0));
            }
        });
        // end 2016/09/08
        $(document).on('blur', 'input.only-number', function() {
            try {
                if (!_validateNumber($(this).val())) {
                    $(this).val('');
                }else{
                    if($(this).hasClass('validate-to')){
                        if(($(this).val() * 1)==0){
                            $(this).val('');
                        }
                    }
                }
            } catch (e) {
                alert(e.message);
            }
        });
        $(document).on('blur', 'input.tel, input.tel-mobile', function() {
            try {
                var string 	=	$(this).val();
                var reg2 	=	/^[0-9-]+$/;
                if(!string.match(reg2)){
                    $(this).val('');
                }
            } catch (e) {
                alert(e.message);
            }
        });
        $(document).on('blur', 'input.post-code', function() {
            try {
                var string 	=	$(this).val();
                var reg2 	=	/^[0-9-]+$/;
                if(!string.match(reg2)){
                    $(this).val('');
                }else{
                    string = string.replace(/-/gi,'');
                    if($(this).val().length>=4){
                    	$(this).val(string.substring(0,3) + '-' + string.substring(3,string.length));
                    }
                }
            } catch (e) {
                alert(e.message);
            }
        });
        $(document).on('blur', 'input.padding-zero', function() {
            try {
                var maxLength = $(this).attr('maxlength');
                var input = $(this).val();
                if (!_validateNumber($(this).val())) {
                    $(this).val('');
                } else {
                    if(input != '') {
                        input = '000000000000000' + '' + input;
                        var tmp = input.substring(input.length,input.length -maxLength);
                        $(this).val(tmp);

                    }
                }
            } catch (e) {
                alert(e.message);
            }
        });
//		$(document).on('focus', 'input.padding-zero:not(readonly)', function() {
//			try {
//
//				var input = $(this).val();
//				if(input != '') {
//					$(this).val(input*1);
//				}
//
//			} catch (e) {
//				alert(e.message);
//			}
//		});
        //keyup ten-key
        $(document).on('keyup',
                'input.tel, input.tel-mobile, input.only-number, input.number, input.numeric, input.money, input.rate, input.percentage, input.zip_cd, input.zip_cd_en, input.time, input.time25, input.time30, input.timeblock5', function() { //2016/03/30 sangtk add zip_cd_en
            var noSbcRegex = /[^\x00-\x7E]+/g;
            var target = $(this);
            try {
                 if(target.val().match(noSbcRegex))  {
                     target.val( target.val().replace(noSbcRegex, '') );
                }
            } catch (e) {
                alert(e.message);
            }
        });
        // blur zip_cd
        $(document).on('blur', 'input.zip_cd', function() {
            var string = $(this).val();
            if (!_validateZipCd($(this).val())) {
                $(this).val('');
            }
        });
        // blur zip_cd_en
        $(document).on('blur', 'input.zip_cd_en', function() {
            var string = $(this).val();
            if (!_validateZipCdEn(string)) {
                $(this).val('');
            }
        });
        // blur katakana
        $(document).on('blur', 'input.katakana', function() {
            var string = $(this).val();
            if (_validateFullSize(string)) {
                $(this).val('');
            }
        });
        // blur fullsize
        $(document).on('blur', 'input.fullsize', function() {
            var string = $(this).val();
            if (!_validateKatakana(string)) {
                $(this).val('');
            }
        });
        // blur fullsize for textarea
        $(document).on('blur', 'textarea.fullsize', function() {
            var string = $(this).val();
            if (!_validateFullSize(string)) {
                $(this).val('');
            }
        });
        // blur alphabetkatakana
        $(document).on('blur', 'input.alphabetkatakana', function() {
            var string = $(this).val();
            if (!_validateHalfSizeAlphabet(string)) {
                $(this).val('');
            }
        });
        // blur not number
        $(document).on('blur', 'input.notnumber', function() {
            var string = $(this).val();
            var reg = /\d/;
            if (string.match(reg)) {
                $(this).val('');
            }
        });
        // blur alphanumeric
        $(document).on('blur', 'input.alphanumeric', function() {
            var string = $(this).val();
            if (!_validateHalfSizeAlphanumeric(string)) {
                $(this).val('');
            }
        });
        // blur tel-mobile
        // $(document).on('blur','input.tel-mobile',function() {
        // var string = $(this).val();
        // if (!_validatePhoneFaxNumber(string)) {
        // $(this).val('');
        // }
        // });
        // focus zip_cd
        $(document).on('focus', 'input.zip_cd', function() {
//			var string = $(this).val();
//			var reg = /^[0-9]{3}\-[0-9]{4}$/;
//			if (string.match(reg)) {
//				$(this).val(string.replace(/\D/g, ''));
//			}
            $(this).select();
        });
        // input blur time
        $(document)
                .on(
                        'blur',
                        'input.time',
                        function() {
                            var string	=	'';
                            if ($(this).val().length==1){
                                string	= padZeroRight($(this).val(), 3);
                                string 	= padZeroLeft(string, 4);
                            }else{
                                string = padZeroRight($(this).val(), 4);
                            }
                            var reg1 = /^(([0-1][0-9])|(2[0-3])):[0-5][0-9]|[2][4]:[0][0]$/;
                            var reg2 = /^(([0-1][0-9])|(2[0-3]))[0-5][0-9]|[2][4][0][0]$/;
                            var reg3 = /^[2][4][0][0]$/;
                            if (string.match(reg1)) {
                                $(this).val(string);
                            } else if (string.match(reg2)) {
                                if($(this).val().length <=2){
                                    $(this).val( string.substring(2) + ':' + string.substring(0, 2));
                                }else if($(this).val().length ==3){
                                    $(this).val( string.substring(2) + ':' + string.substring(0, 1));
                                }else{
                                    $(this).val( string.substring(0, 2) + ':' + string.substring(2));
                                }

                            } else {
                                $(this).val('');
                            }
                            if (!_validateTime($(this).val())) {
                                $(this).val('');
                            }
                        });
        // input blur time25
        $(document).on(
                'blur',
                'input.time25',
                function() {
                    var string	=	'';
                    if ($(this).val().length==1){
                        string	= padZeroRight($(this).val(), 3);
                        string 	= padZeroLeft(string, 4);
                    }else{
                        string = padZeroRight($(this).val(), 4);
                    }
                    var reg1 = /^([0-9][0-9]):[0-5][0-9]$/;
                    var reg2 = /^([0-9][0-9])[0-5][0-9]$/;
                    if (string.match(reg1)) {
                        $(this).val(string);
                    } else if (string.match(reg2)) {
                        $(this).val(
                                string.substring(0, 2) + ':'
                                        + string.substring(2));
                    } else {
                        $(this).val('');
                    }
                    if (!_validateTime25($(this).val())) {
                        $(this).val('');
                    }
                });
        // input blur hours23
        $(document).on(
                'blur',
                'input.hours23',
                function() {
                    var string	=	'';
                    if ($(this).val().length==1){
                        string	= padZeroLeft($(this).val(), 2);
                    } else {
                        string	= $(this).val();
                    }
                    var reg = /\b(2[0-3]|[0-1]?[0-9])\b/;
                    if (string.match(reg)) {
                        $(this).val(string);
                    } else {
                        $(this).val('');
                    }
                    if (!_validateHours23(string)) {
                        $(this).val('');
                    }
                });
        // input blur hours24
        $(document).on(
                'blur',
                'input.hours24',
                function() {
                    var string	=	$(this).val();
                    var tmpString = "";
                    var reg = /^(2[0-4]|1[0-9]|[1-9])$/;
                    if (string.match(reg)) {
                        if ($(this).val().length==1){
                            tmpString	= padZeroLeft($(this).val(), 2);
                        } else {
                            tmpString	= $(this).val();
                        }
                        $(this).val(tmpString);
                    } else {
                        $(this).val('');
                    }
                    if (!_validateHours24(string)) {
                        $(this).val('');
                    }
                });
        // input blur minutes59
        $(document).on(
                'blur',
                'input.minutes59',
                function() {
                    var string	= $(this).val();
                    var tmpString = "";
                    var reg = /^([0-5]?[0-9])$/;
                    if (string.match(reg)) {
                        if ($(this).val().length==1){
                            tmpString	= padZeroLeft($(this).val(), 2);
                        } else {
                            tmpString	= $(this).val();
                        }
                        $(this).val(tmpString);
                    } else {
                        $(this).val('');
                    }
                    if (!_validateMinutes60(string)) {
                        $(this).val('');
                    }
                });
        // input blur time25
        $(document).on(
                'blur',
                'input.time30',
                function() {
                    var string	=	'';
                    if ($(this).val().length==1){
                        string	= padZeroRight($(this).val(), 3);
                        string 	= padZeroLeft(string, 4);
                    }else{
                        string = padZeroRight($(this).val(), 4);
                    }
                    var reg1 = /^([0-9][0-9]):[0-5][0-9]$/;
                    var reg2 = /^([0-9][0-9])[0-5][0-9]$/;
                    if (string.match(reg1)) {
                        $(this).val(string);
                    } else if (string.match(reg2)) {
                        $(this).val(
                                string.substring(0, 2) + ':'
                                        + string.substring(2));
                    } else {
                        $(this).val('');
                    }
                    if (!_validateTime30($(this).val())) {
                        $(this).val('');
                    }
                });
     // input blur timeblock5 --thanhnv
        $(document).on(
                'blur',
                'input.timeblock5',
                function() {
                    $(this).val(_formatTimeBlock5($(this)));
                });
        // input blur email
//		$(document).on('blur', '.email', function() {
//			if (!_validateEmail($(this).val())) {
//				$(this).errorStyle(_text[90]);
//				$(this).val('');
//			}
//		});


        // focus date
        $(document).on('focus', 'input.date', function(){
            var string = $(this).val();
            var reg = /^[0-9]{4}[\/.][0-9]{2}[\/.][0-9]{2}$/;
            if (string.match(reg)){
                $(this).val(string.replace(/\D/g,''));
            }
        });
        // input method for blur datepicker
        $(document).on('blur','input.date ',function() {
            var string = $(this).val(); 
            var reg1 = /^[0-9]{8}$/;
            var reg2 = /^[0-9]{4}[\/.][0-9]{2}[\/.][0-9]{2}$/;
            if (string.match(reg1)) {
                $(this).val(
                        string.substring(0, 4) + '/'
                                + string.substring(4, 6) + '/'
                                + string.substring(6));
            } else if (string.match(reg2)) {
                $(this).val(string);
            } else {
                var date = autoFormatDate($(this).val());
                var strDate = date;
                if(strDate !='' && strDate != 'undefined' && strDate !== undefined){
                    strDate = strDate.replace(/\//gi,'');
                    if(!_validateNumber(strDate)){
                        $(this).val('');
                    }else{
                        $(this).val(date);
                    }
                }
            }
            if (!_validateYyyyMmDd($(this).val())) { 
                var date = autoFormatDate($(this).val()); 
                var strDate = ( date !='undefined' ?  'date' : '' ); 
                strDate = strDate.replace(/\//gi,'');
                if(!_validateNumber(strDate)){
                    $(this).val('');
                }else{
                    $(this).val(date);
                }
            }
            //HiepNV - check valid date afer auto format
            if(!moment($(this).val(),"YYYY/MM/DD").isValid()){
                $(this).val('');
            }
        });
        $(document).on( 'blur', 'input.longlat',function() {
            try {
                var string = $(this).val();
                for(var i=0; i<string.length;i++){
                    if(string[i] == "°") string = string.replace("°","");
                }
                var reg1 = /^[0-9.,"'newsNEWS/\s/g]+$/;
                if (!string.match(reg1)) {
                    $(this).val('');
                }
            } catch (e) {
                alert(e.message);
            }
        });
        $(document).on(
                'blur',
                'input.month',
                function() {
                    try {
                        var string = $(this).val();
                        var reg1 = /^[0-9]{6}$/;
                        var reg2 = /^[0-9]{4}[\/.][0-9]{2}$/;
                        if (string.match(reg1)) {
                            $(this).val(
                                    string.substring(0, 4) + '/'
                                            + string.substring(4, 6));
                            $(this).val(set_limit_date_month($(this).val()));
                        } else if (string.match(reg2)) {
                            $(this).val(string);
                            $(this).val(set_limit_date_month($(this).val()));
                        } else {
                            $(this).val('');
                        }
                        if (string.replace(/\D/g, '') != $(this).attr('old')) {
                            $(this).next('.hasYmpicker').trigger('change');
                        }
                        if (!_validateYyyyMm($(this).val())) {
                            $(this).val('');
                        }
                    } catch (e) {
                        alert(e.message);
                    }
                });
        $(document).on('focus', 'input.month', function() {
            try {
                var string = $(this).val();
                var reg = /^[0-9]{4}[\/.][0-9]{2}$/;
                if (string.match(reg)) {
                    $(this).val(string.replace(/\D/g, ''));
                    $(this).attr('old', string.replace(/\D/g, ''));
                }
            } catch (e) {
                alert(e.message);
            }
        });
        // zip code
        $(document)
                .on(
                        "keydown",
                        'input.zip_cd, input.zip_cd_en', //2016/03/30 sangtk add zip_cd_en
                        function(e) {
                            // if(e.shiftKey){
                            // e.preventDefault();
                            // }
                            // Allow: backspace, delete, tab, escape, enter, -
                            if ($.inArray(e.keyCode, [ 46, 8, 9, 27, 13, 109,
                                    110, 116, 117, 173, 189, 229]) !== -1 // 2016/03/25 sangtk add 299 for tenkey processing
                                    ||
                                    // Allow: Ctrl+A, C, X, V
                                    ($.inArray(e.keyCode,
                                            [ 65, 67, 86, 88, 116 ]) !== -1 && e.ctrlKey === true)
                                    ||
                                    // Allow: home, end, left, right
                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                                // let it happen, don't do anything
                                return;
                            }
                            // Ensure that it is a number and stop the keypress
                            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57))
                                    && (e.keyCode < 96 || e.keyCode > 105)) {
                                e.preventDefault();
                            }
                        });
        // numeric
        $(document)
                .on(
                        'keydown',
                        'input.numeric:enabled',
                        function(e) {
                            if (!((e.keyCode > 47 && e.keyCode < 58)
                                            || (e.keyCode > 95 && e.keyCode < 106)
                                            // ////////// PERIOD SIGN
                                            // ////////////////////////////////////////////////////////////////
                                            || ((e.keyCode == 190 || e.keyCode == 110) && $(
                                                    this).val().indexOf('.') === -1)
                                            || e.keyCode == 173
                                            || e.keyCode == 109
                                            || e.keyCode == 189
                                            || e.keyCode == 116
                                            || e.keyCode == 46
                                            || e.keyCode == 37
                                            || e.keyCode == 39
                                            || e.keyCode == 8
                                            || e.keyCode == 9
                                            || e.keyCode == 229 // ten-key processing
                                            )) {
                                e.preventDefault();
                                return false;
                            }
                            var negativeEnabled = $(this).attr('negative');
                            var percen = $(this).attr('percen');
                            if (e.keyCode != 116
                                    && e.keyCode != 46
                                    && e.keyCode != 37
                                    && e.keyCode != 39
                                    && e.keyCode != 8
                                    && e.keyCode != 9
                                    && e.keyCode != 173
                                    && e.keyCode != 189
                                    && e.keyCode != 109
                                    && ($(this).get(0).selectionEnd - $(this)
                                            .get(0).selectionStart) < $(this)
                                            .val().length) {
                                // DEFAULT PARAMS (NUMERIC (10, 0))
                                var ml = 10;
                                var dc = 0;
                                if (parseInt($(this).attr('maxlength')) * 1 > 2) {
                                    //ml = 1 * $(this).attr('maxlength') - 1;
                                    ml = 1 * $(this).attr('maxlength');
                                }
                                if (parseInt($(this).attr('decimal')) > 0) {
                                    dc = 1 * $(this).attr('decimal');
                                    if (dc >= ml - 1) {
                                        dc = 0;
                                    }
                                }
                                var it = (ml - (dc > 0 ? (dc + 1) : 0));
                                // CURRENT STATES
                                var val = $(this).val();
                                var negative = val.indexOf('-') > -1;
                                var selectionStart = $(this).get(0).selectionStart;
                                var selectionEnd = $(this).get(0).selectionEnd;
                                if (negative) {
                                    val = val.substring(1);
                                    selectionStart--;
                                    selectionEnd--;
                                }
                                // OUTPUT STATES
                                var destSelectionStart = undefined;
                                var destSelectionEnd = undefined;
                                var destVal = undefined;
                                // SKIP PERIOD KEY WHEN DECIMAL = 0
                                if (dc == 0
                                        && (e.keyCode == 190 || e.keyCode == 110)) {
                                    e.preventDefault();
                                }
                                // EXCEED THE ACCEPTED NUMBER OF INTEGERS
                                if (val.match(new RegExp('[0-9]{' + it + '}'))
                                        && selectionStart <= it) {
                                    // PERIOD DOES NOT EXIST
                                    if (val.indexOf('.') === -1) {
                                        // PERIOD KEY NOT RECEIVED (USER FORGETS
                                        // TO TYPE PERIOD)
                                        // DECIMAL > 0
                                        if (e.keyCode != 190
                                                && e.keyCode != 110 && dc > 0) {
                                            e.preventDefault();
                                            var output = val.substring(0,
                                                    selectionStart)
                                                    + String
                                                            .fromCharCode((96 <= e.keyCode && e.keyCode <= 105) ? e.keyCode - 48
                                                                    : e.keyCode)
                                                    + val
                                                            .substring(selectionStart);
                                            // INSERT PERIOD
                                            destVal = output.substring(0, ml
                                                    - (dc + 1))
                                                    + '.'
                                                    + output.substring(ml
                                                            - (dc + 1));
                                        }
                                        // PERIOD EXISTS
                                        // CARET STARTS NEXT TO THE PERIOD
                                    } else if (selectionStart == val
                                            .indexOf('.')) {
                                        // EXCEED THE ACCEPTED NUMBER OF
                                        // DECIMALS
                                        if (val.match(new RegExp('\\.[0-9]{'
                                                + dc + '}$'))) {
                                            e.preventDefault();
                                        } else {
                                            // JUMP TO THE NEXT POSITION THEN
                                            // INSERT THE DIGIT
                                            destSelectionStart = selectionStart + 1;
                                        }
                                        // CARET STARTS BEFORE THE PERIOD AND
                                        // NOTHING HIGHLIGHTED
                                    } else if (selectionStart < val
                                            .indexOf('.')
                                            && selectionStart == selectionEnd) {
                                        e.preventDefault();
                                        // CARET STARTS BEFORE THE PERIOD AND
                                        // ENDS AFTER THE PERIOD (HIGHLIGHTS
                                        // OVER THE PERIOD)
                                    } else if (selectionEnd > val.indexOf('.')
                                            && selectionStart < val
                                                    .indexOf('.')) {
                                        e.preventDefault();
                                        var output = val.substring(0,
                                                selectionStart)
                                                + String
                                                        .fromCharCode((96 <= e.keyCode && e.keyCode <= 105) ? e.keyCode - 48
                                                                : e.keyCode)
                                                + val.substring(selectionEnd);
                                        destVal = output.substring(0, ml
                                                - (dc + 1))
                                                + '.'
                                                + output.substring(ml
                                                        - (dc + 1));
                                        destSelectionStart = selectionStart + 1;
                                        destSelectionEnd = selectionStart + 1;
                                    }
                                    // INTEGERS CAN BE ADDED BUT...
                                    // EXCEED THE ACCEPTED NUMBER OF DECIMALS
                                } else if (val.match(new RegExp('\\.[0-9]{'
                                        + dc + '}$'))) {
                                    // PERIOD EXISTS
                                    // CARET STARTS AFTER THE PERIOD
                                    if (val.indexOf('.') != -1
                                            && selectionStart > val
                                                    .indexOf('.')) {
                                        e.preventDefault();
                                    }
                                }
                                // CARET RESULT
                                if (destVal && negative) {
                                    destVal = '-' + destVal;
                                }
                                if (destVal) {
                                    $(this).val(destVal);
                                }
                                if (negative && destSelectionStart) {
                                    destSelectionStart++;
                                }
                                if (destSelectionStart) {
                                    $(this).get(0).selectionStart = destSelectionStart;
                                }
                                if (negative && destSelectionEnd) {
                                    destSelectionEnd++;
                                }
                                if (destSelectionEnd) {
                                    $(this).get(0).selectionEnd = destSelectionEnd;
                                }
                            } else if (e.keyCode == 173 || e.keyCode == 109
                                    || e.keyCode == 189) {
                                e.preventDefault();
                                if (negativeEnabled) {
                                    var val = $(this).val();
                                    var negative = val.indexOf('-') > -1;
                                    if (negative) {
                                        $(this).val(val.substring(1));
                                    } else {
                                        $(this).val('-' + val);
                                    }
                                }
                                if(1*percen	==1){
                                    var val = $(this).val().replace(/[-,%]/g, '');
                                    $(this).val(val+'%');
                                }
                            }
                            // fix maxlenght
                            var val = $(this).val();
                            if ($(this).attr('fixed') != undefined
                                    && val.indexOf('-') > -1) {
                                var f_maxlenght = (parseInt($(this).attr(
                                        'maxlengthfixed')) + 1)
                                        + '';
                                if (val.length <= f_maxlenght) {
                                    $(this).attr('maxlength', f_maxlenght);
                                } else {
                                    $(this).attr('maxlength', f_maxlenght);
                                }
                            } else if ($(this).attr('maxlength') > $(this)
                                    .attr('maxlengthfixed')) {
                                $(this).attr('maxlength',
                                        $(this).attr('maxlengthfixed'));
                            }
                        });
        // input method for numeric
        $(document)
                .on(
                        'blur',
                        'input.numeric:enabled',
                        function() {
                            try {
                                var negativeEnabled = $(this).attr('negative');
                                var percen = $(this).attr('percen');
                                var val = $(this).val();
                                var negative = val.indexOf('-') > -1;
                                if (negative) {
                                    val = val.substring(1);
                                }
                                var old = val;
                                val = val.replace('.', '');
                                val = old;
                                var dc = 1 * $(this).attr('decimal');
                                var result = parseFloat(val.replace(/,/g, ""));
                                if (result || result === 0) {
                                    result = result.toFixed(dc);
                                    if (result.indexOf('.') > -1) {
                                        var integer = result.substring(0,
                                                result.indexOf('.')).replace(
                                                /\B(?=(\d{3})+(?!\d))/g, ",");
                                        var decimal = result.substring(result
                                                .indexOf('.'));
                                        var ml = typeof $(this).attr('maxlength') != 'undefined' ? parseInt($(this).attr('maxlength')) : 0;
                                        if(ml > 0 && integer.length > (ml-2)){
                                            var num = ml-dc-1;
                                            var tmp = $(this).val().replace('.', "");
                                            integer = parseFloat(tmp.substring(0,num));
                                            decimal = parseFloat('0.'+tmp.substring(num,num+dc));
                                        }
                                        val = integer + decimal;
                                    } else {
                                        val = result.replace(
                                                /\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                } else {
                                    val = '';
                                }
                                $(this)
                                        .val(
                                                (val != '' && val != '0'
                                                        && negativeEnabled && negative) ? ('-' + val)
                                                        : val);
                                if(1*percen==1){
                                    val	=	val.replace(/[%]/g, '');
                                    $(this).val(val+'%');
                                }
                            } catch (e) {
                                alert('Error input.numeric blur event: '
                                        + e.message);
                            }
                        });
        // blur money, amount,rate, percentage
        $(document).on('blur', 'input.amount, input.rate, input.percentage',
                function(event) {
                    var item = $(this);
                    var value = item.val().replace(/,/gi, '');
                    if (value != '') {
                        if ($.isNumeric(value)) {
                            value = addCommas(value);
                            if (value == 0) {
                                item.val('');
                            } else {
                                item.val(value);
                            }
                        } else {
                        }
                    }
                });
        // format money
        $("input.money").keyup(function(e) {
            var val = parseInt($(this).val());
            if (val == 0) {
                $(this).val('');
                return;
            }
            $(this).val(formatMoney(val));
        });
        function formatMoney(num) {
            var str = num.toString(), parts = false, output = [], i = 1, formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return (formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        }
        // focus numeric
        $(document).on('focus', 'input.numeric:enabled', function() {
            var val = $(this).val();
            var negative = val.indexOf('-') > -1;
            var percen	=	$(this).attr('percen');
            if (negative) {
                val = val.substring(1);
            }
            val = val.replace(/,/g, "");
            $(this).val(negative ? ('-' + val) : val);
            if (1*percen	==	1){
                val	=	val.replace(/%/g, '');
                $(this).val(val+'%');
            }
            $(this).select();
        });
        $(document).on('focus', 'input:enabled,textarea:enabled', function() {
        	 $( "body" ).delegate( "*", "focus blur", function() {
           	  var elem = $( this );
           	  setTimeout(function() {
           	    elem.toggleClass( "item-focused", elem.is( ":focus" ) );
           	  }, 0 );
           	});
        	$(this).select();
        });
        // change upload-file
        $(document).on(
                'change',
                '.upload-file',
                function() {
                    $(this).parents('.upload').find('.input-path').val(
                            $(this).val().replace(/^.*[\\\/]/, ''));
                });
        // focus money item
        $(document).on('focus', 'input.money', function() {
            $(this).val($(this).val().replace(/,/g, ''));
            $(this).select();
        });
        // focus time item
        $(document).on('focus', 'input.time, input.time25, input.time30, input.timeblock5', function() {
            $(this).val($(this).val().replace(/:/g, ''));
            $(this).select();
        });
    } catch (e) {
        alert('initialize' + e.message);
    }
    // namnb update 05/11/2015
    _changeStatusSort();
}
/**
 * showPopup
 *
 * @author : viettd - 2015/09/15 - create
 * @author :
 * @param :
 *            href,callback
 * @return : null
 * @access : public
 * @see :
 */
function showPopup(href, callback) {
    var iwidth	=	'80%';
    var iheight	=	'80%';
    if(window.location.href != window.parent.location.href){
        iwidth	=	'100%';
        iheight	=	'100%';
    }
    var properties = {
        href : href,
        open : true,
        iframe : true,
        fastIframe : false,
        opacity : 0.2,
        escKey : true,
        overlayClose : false,
        innerWidth : iwidth,
        innerHeight : iheight,
        reposition : true,
        speed : 0,
        cbox_load : function() {
            $('#cboxClose, #cboxTitle').remove();
        },
        onClosed : function() {
            if (callback) {
                callback();
            }
        }
    };
    $.colorbox(properties);
}
//edit by phonglv 2016/01/15
function showPopup2(href, callback) {
    var properties = {
        href : href,
        open : true,
        iframe : true,
        fastIframe : false,
        opacity : 0.2,
        escKey : true,
        overlayClose : false,
        innerWidth : '100%',
        innerHeight : '100%',
        reposition : true,
        speed : 0,
        cbox_load : function() {
            $('#cboxClose, #cboxTitle').remove();
        },
        onClosed : function() {
            if (callback) {
                callback();
            }
        }
    };
    $.colorbox(properties);
}
//edit by thanhnv 2016/06/16
function showPopupReSize(href,width,height, callback) {
    var properties = {
        href : href,
        open : true,
        iframe : true,
        fastIframe : false,
        opacity : 0.2,
        escKey : true,
        overlayClose : false,
        innerWidth : width+'%',
        innerHeight : height+'%',
        reposition : true,
        speed : 0,
        cbox_load : function() {
            $('#cboxClose, #cboxTitle').remove();
        },
        onClosed : function() {
            if (callback) {
                callback();
            }
        }
    };
    $.colorbox(properties);
}
/**
 * _autoFormattingDate
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function _autoFormattingDate(target) {
    $(target)
            .focusout(
                    function() {
                        var string = $(this).val();
                        if (string.length == 8) {
                            string = string.substring(0, 4) + '/'
                                    + string.substring(4, 6) + '/'
                                    + string.substring(6);
                        }
                        var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[13578]|1[02])[\/.]31|((19|[2-9][0-9])[0-9]{2}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|((19|[2-9][0-9])[0-9]{2}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)$/;
                        if (string.match(reg)) {
                            $(this).val(string);
                        }
                    });
}
/**
 * _autoFormattingMonth
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function _autoFormattingMonth(target) {
    $(target)
            .focusout(
                    function() {
                        var string = $(this).val();
                        if (!($(this).hasClass('from-month'))) {
                            if (string.length == 6) {
                                string = string.substring(0, 4) + '/'
                                        + string.substring(4, 6);
                            }
                            var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[1-9]|1[0-2])$/;
                            if (string.match(reg)) {
                                $(this).val(string);
                            }
                        } else {
                            switch (string.length) {
                            case 6:
                                string = string.substring(0, 4) + '/'
                                        + string.substring(4, 6) + '/01';
                                break;
                            case 7:
                                string = string.substring(0, 4)
                                        + string.substring(4, 7) + '/01';
                                break;
                            case 8:
                                string = string.substring(0, 4) + '/'
                                        + string.substring(4, 6) + '/'
                                        + string.substring(6);
                                break;
                            }
                            var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[1-9]|1[0-2])[\/.](01)$/;
                            if (string.match(reg)) {
                                $(this).val(string);
                            }
                        }
                    });
}
/**
 * add comma function
 *
 * @param nStr
 * @return str
 */
function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
/**
 * Common item validation process. Call when click save button.
 *
 * @author : hiepnv - 2016/07/13 - create
 * @author :
 * @param :  element
 * @return : true/false
 * @access : public
 * @see :
 */
function _validate2(element) {
    if (!element) {
        element = $('body');
    }
    var error = 0;
    var cnt = 0;
    var arrError = [];
    _clearErrors();
    try {
        // validate required
        element.find('.required:enabled').each(function() {
            if ($(this).is(':visible') || typeof $(this).parents('.w-result-tabs').html() != 'undefined') {
                if (($(this).is("input") || $(this).is("textarea")) && $.trim($(this).val()) == '') {
                    $(this).addClass('hasError');
                    arrError.push($(this).attr('titleText')+_text[27]);
                    error++;
                } else if ($(this).is("select") && ($(this).val() == '0' || $(this).val() == undefined)) {
                    $(this).addClass('hasError');
                    arrError.push($(this).attr('titleText')+_text[27]);
                    error++;
                }
            }
        });
        element.find('.checkbox-required').each(function() {
            $(this).find('input').each(function(){
                if($(this).attr('checked')=='checked'){
                    cnt ++;
                }
            });
            if(cnt == 0  ){
                $(this).addClass('hasError');
                arrError.push({id:$(this).attr('id') , value:$(this).attr('titleText')+_text[27]});
                error++;
            }
        });
        element.find('.email').each(function() {
            if (!_validateEmail($(this).val())) {
                $(this).addClass('hasError');
                arrError.push($(this).attr('titleText')+_text[90]);
                error++;
            }
        });
        //quangnk update 23/07/2016
        element.find('.from-date').each(function() {
            if (!_validateFromToDate($(this).val(),$(this).parents('.form-rows').find('.to-date').val())) {
                $(this).addClass('hasError');
                arrError.push(_text[67]);
                error++;
            }
        });

        element.find('.from-hh').each(function() {
            var from_hh = $(this).find('option:selected').text();
            var from_mm = $(this).parents('.form-rows').find('.from-mm option:selected').text();
            var to_hh = $(this).parents('.form-rows').find('.to-hh option:selected').text();
            var to_mm = $(this).parents('.form-rows').find('.to-mm option:selected').text();
            var from = from_hh.toString() + from_mm.toString();
            var to	 = to_hh.toString() + to_mm.toString();
            if (!_validateFromToTime(from,to)) {
                $(this).addClass('hasError');
                arrError.push($(this).attr('titleText')+_text[163]);
                error++;
            }
            if (!_validateFromToTime2(from,to)) {
                $(this).addClass('hasError');
                arrError.push($(this).attr('titleText')+_text[236]);
                error++;
            }
        });
        //confirm password quangnk update 2016/08/05
        if(element.find('.password').val()!=element.find('.confirm-password').val()){
            $(this).addClass('hasError');
            arrError.push(element.find('.password').attr('titleText')+_text[201]);
            error++;
        }
        if(element.find('.password').length > 0 && element.find('.password').val()!='' && element.find('.password').val().length < 6){
            $(this).addClass('hasError');
            arrError.push(element.find('.password').attr('titleText')+_text[215]);
            error++;
        }
        // trinhnv update follow EST_005
        var count1	=	0;
        var count2	=	0;
        $('.tbn-amount-fil002').find('select').each(function(){
            if($(this).val()==6){
                count1++;
            }
        });
        $('.tbn-amount-fil001').find('select').each(function(){
            if($(this).val()==7){
                count2++;
            }
        });
        if(count1 > 1){
            $('.tbn-amount-fil002').find('select').each(function(){
                if($(this).val()==6){
                    $(this).addClass('hasError');
                    arrError.push('1個あたりの料金項目' + _text[196]);
                }
            });
        }
        if(count2 > 1){
            $('.tbn-amount-fil001').find('select').each(function(){
                if($(this).val()==7){
                    $(this).addClass('hasError');
                    arrError.push('受注全体の金額項目' + _text[196]);
                }
            });
        }
        if(count1 > 1|| count2>1){
            error++;
        }
        if (error > 0) {
            messageError(arrError);
            $('.hasError:first').focus();
            return false;
        } else {
            return true;
        }
    } catch (e) {
        alert('_validate2: ' + e.toString());
    }
}
/**
 * Common item validation process. Call when click save button.
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @param :
 *            element
 * @return : true/false
 * @access : public
 * @see :
 */
function _validate(element) {
    if (!element) {
        element = $('body');
    }
    var error = 0;
    var cnt = 0;
    try {
        _clearErrors();
        // validate required
        element.find('.required:enabled:not([readonly])').each(function() {

            //biennv 2016/01/14 fix required in tab
            if ($(this).is(':visible') || typeof $(this).parents('.w-result-tabs').html() != 'undefined') {
                if (($(this).is("input") || $(this).is("textarea")) && $.trim($(this).val()) == '') {
                    $(this).errorStyle(_text[27]);
                    error++;
                } else if ($(this).is("select") && ($(this).val() == '0' || $(this).val() == undefined)) {
                    $(this).errorStyle(_text[27]);
                    error++;
                }
            }
        });
        element.find('.checkbox-required').each(function() {
            $(this).find('input').each(function(){
                if($(this).attr('checked')=='checked'){
                    cnt ++;
                }
            });
            if(cnt == 0  ){
                $(this).errorStyle(_text[27]);
                $(this).css('background','#FDB8BA');
                error++;
            }
        });
        if (error > 0) {
            return false;
        } else {
            return true;
        }
    } catch (e) {
        alert('_validate: ' + e.toString());
    }
}
/**
 * format phone, fax number
 *
 * @param string
 * @param input
 */
function _validatePhoneFaxNumber(string) {
    try {
        string = _formatString(string);
        var reg = /^[0-9]+[-][0-9]+[-][0-9]+$/;
        if (string.match(reg) || string == '') {
            return true;
        }
        return false;
    } catch (e) {
        alert('_validatePhoneFaxNumber: ' + e);
    }
}
/**
 * Check number
 *
 * @param string
 * @returns {Boolean}
 */
function _validateNumber(string) {
    try {
        string = _formatString(string);
        var regexp = /^[0-9]+$/;
        if (regexp.test(string) || string == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        alert('_ValidateNumber: ' + e);
    }
}
/**
 * Convert Full-width to Half-width Characters
 *
 * @param string
 * @returns string
 */
function _formatString(string) {
    try {
        string = $.textFormat(string, '9');
        string = $.textFormat(string, '@');
        string = $.textFormat(string, 'a');
        string = $.textFormat(string, 'A');
        return string;
    } catch (e) {
        alert('_formatString: ' + e);
    }
}
/**
 * check length of string
 *
 * @param string
 * @param length
 * @returns {Bolean}
 */
function _validateLength(string, length) {
    try {
        var len = string.length;
        if (len > length) {
            return false;
        } else {
            return true;
        }
    } catch (e) {
        alert('_validateLength: ' + e);
    }
}
/**
 * check full size
 *
 * @param string
 * @returns {boolean}
 */
function _validateFullSize(string) {
    try {
        // string = $.rtrim(string);
        string = $.mbRTrim(string);
        if ($.byteLength(string) != string.length) {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        alert('_validateFullSize: ' + e);
    }
}
/**
 * validate zip code
 *
 * @param string
 * @returns {boolean}
 */
function _validateZipCd(zip_cd) {
    try {
        zip_cd = _formatString(zip_cd);
        var reg1 = /^[0-9]{3}-[0-9]{4}$/;
        var reg2 = /^[0-9]{3}[0-9]{4}$/;
        //
        if (zip_cd.match(reg1) || zip_cd.match(reg2) || zip_cd == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        alert('_validateZipCd: ' + e);
    }
}
/**
 * validate zip code en
 *
 * @param string
 * @returns {boolean}
 */
function _validateZipCdEn(zip_cd_en) {
    try {
        zip_cd_en = _formatString(zip_cd_en);
        var reg1 = /^\d+(-\d+)*$/;
        //
        if (zip_cd_en.match(reg1) || zip_cd == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        alert('_validateZipCdEn: ' + e);
    }
}
/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyyMmDd(string) {
    if (string == '') {
        return true;
    }
    if (string.length == 8) {
        string = string.substring(0, 4) + '/' + string.substring(4, 6) + '/'
                + string.substring(6);
    }
    string = _formatString(string);
    var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[13578]|1[02])[\/.]31|((19|[2-9][0-9])[0-9]{2}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|((19|[2-9][0-9])[0-9]{2}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyyMmDd2(string) {
    if (string == '') {
        return true;
    }
    if (string.length == 8) {
        string = string.substring(0, 4) + '/' + string.substring(4, 6) + '/'
                + string.substring(6);
    }
    string = _formatString(string);
    var reg = /^([0-9]{4})[\/.](0[13578]|1[02])[\/.]31|([0-9]{4}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|([0-9]{4}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((1[0-9]|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyyMm(string) {
    if (string == '') {
        return true;
    }
    if (string.length == 6) {
        string = string.substring(0, 4) + '/' + string.substring(4);
    }
    string = _formatString(string);
    var reg = /^((1[0-9]|[2-9][0-9])[0-9]{2})[\/.](0[1-9]|1[0-2])$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyy(string) {
    if (string == '') {
        return true;
    }
    if (string.length == 6) {
        string = string.substring(0, 4) + '/' + string.substring(4);
    }
    string = _formatString(string);
    var reg = /^((1[0-9]|[2-9][0-9])[0-9]{2})[\/.](0[1-9]|1[0-2])$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}

/**
 * function validate money
 *
 * @param string
 * @param real
 * @param img
 * @returns {Boolean}
 */
function _validateMoney(string, real, img) {
    try {
        string = string.replace(/,/gi, "");
        if (string == '') {
            return true;
        } else {
            string = _formatString(string);
            if (string.indexOf('.') > -1) {
                var res = string.split('.');
                if (res[0].length > real || res[1].length > img) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (string.length > real) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    } catch (e) {
        alert('_validateMoney: ' + e);
    }
}

/**
 * Check percent number money
 *
 * @param string
 * @returns {Boolean}
 */
function _validatePercentMoney(string) {
    string = _formatString(string);
    if (string != '') {
        var number = parseInt(string);
        if (number >= 0 && number <= 100) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}
/**
 * Check number
 *
 * @param string
 * @returns {Boolean}
 */
function _validateZero(string) {
    try {
        string = _formatString(string);
        string = parseInt(string) * 1 || 0;
        if (string != 0) {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        alert('_validateZero: ' + e);
    }
}
/**
 * Validate length
 *
 * @param value_input
 * @param length_compare
 * @returns {Boolean}
 */
function _validateEqualLength(value_input, length_compare) {
    try {
        var string = $.trim(value_input);
        if (string == '') {
            return true;
        } else {
            if (string.length != length_compare) {
                return false;
            } else {
                return true;
            }
        }
    } catch (e) {
        alert('_validateEqualLength: ' + e);
    }
}
/**
 * _formatInput
 *
 * @author : viettd - 2015/10/05 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 * @mode :  not param func resizeMaster , 1 = mode function resizeMaster2()
 */
function _formatInput(mode) {
    try {

        // format date
        $('input.date').attr('placeholder','yyyy/mm/dd');
        if ($('input.date') && $('input.date').length > 0) {
            $('input.date').each(function() {
                if ($(this).is('[readonly]') || $(this).is('[disabled]')) {
                    $(this).datepicker('destroy');
                } else {
                    if (!$(this).hasClass('hasDatepicker')) {
                        $.appendDatepicker($(this));
                    }
                }
            });
        }
        // format month
        if ($('input.month') && $('input.month').length > 0) {
            $('input.month').each(function() {
                if ($(this).is('[readonly]') || $(this).is('[disabled]')) {
                    $(this).ympicker('destroy');
                } else {
                    if (!$(this).hasClass('hasYmpicker')) {
                        $.appendYmpicker($(this));
                        $(this).attr('maxlength', 7);
                    }
                }
            });
        }
        // format point
        $('input.point').each(function() {
            var string = $(this).val();
            var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]))$/;
            if (string.match(reg)) {
                $(this).val(string);
            } else {
                $(this).val('');
            }
        });
        // format rate
        $('input.rate').each(function() {
            var string = $(this).val();
            var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]{1,2}))$/;
            if (string.match(reg)) {
                $(this).val(string);
            }
        });
        // format money
        $('input.money').each(
                function() {
                    var length = 99;
                    try {
                        length = parseInt($(this).attr('maxlength'))
                                - Math
                                        .floor(parseInt($(this).attr(
                                                'maxlength')) / 4);
                    } catch (e) {
                        length = 99;
                    }
                    $(this).priceFormat({
                        limit : length,
                        prefix : '',
                        centsSeparator : '',
                        thousandsSeparator : ',',
                        clearOnEmpty : true,
                        centsLimit : 0
                    });
                });
        // format cash
        $('input.cash').each(
                function() {
                    var length = 99;
                    try {
                        length = parseInt($(this).attr('maxlength'))
                                - Math
                                        .floor(parseInt($(this).attr(
                                                'maxlength')) / 4);
                    } catch (e) {
                        length = 99;
                    }
                    $(this).priceFormat({
                        limit : length,
                        prefix : '',
                        centsSeparator : '',
                        thousandsSeparator : ',',
                        allowNegative : true,
                        clearOnEmpty : true,
                        centsLimit : 0
                    });
                });
        // format zip_cd
        $('input.zip_cd').each(function(index) {
            if (!_validateZipCd($(this).val())) {
                $(this).val('');
            }
        });
        $('input.padding-zero').each(function() {
            var maxLength = $(this).attr('maxlength');
            var input = $(this).val();
            if (!_validateNumber($(this).val())) {
                $(this).val('');
            } else {
                if(input != '') {
                    input = '000000000000000' + '' + input;
                    var tmp = input.substring(input.length,input.length - maxLength);
                    $(this).val(tmp);
                }
            }
        });
        $('.w-title-item label, .lbl-title, .login-info, .lbl-title-no-bg').each(function(){
            var eleTitle = $(this);
            var title  = $(this).text();
            var str = '';
            if(title.length <= 7){
            	var noSpace = $(this).attr("noSpace");
            	
            	if (typeof noSpace == 'undefined'){
            		 str = title.split('').join(' ');
                     eleTitle.text(str);
            	} 
               
            }
        });
        $('.m-div-title:not(.no-space-text)').each(function(){
            var eleTitle = $(this);
            var title  = $(this).text();
            var str = '';
            if(title.length <= 7){
            	var noSpace = $(this).attr("noSpace");
            	if (typeof noSpace == 'undefined'){
           		 str = title.split('').join(' ');
                    eleTitle.text(str);
            	}  
            }
        });
        //quangnk update 2016/07/15
        $('.nav-tabs li a').each(function(){
            var eleTitle = $(this);
            var title  = $(this).text();
            var str = '';
            if(title.length <= 7){
                str = title.split('').join(' ');
                eleTitle.text(str);
            }
        });
        //quangnk update 2016/07/15
        $('.tbl-header:not(.no-space-text) thead tr th').each(function(){

            if($(this).find('select').length == 0  && $(this).find('input').length == 0 && $(this).find('button').length==0 && $(this).find('img').length==0 && $(this).find('span').length==0){
                var eleTitle = $(this);
                var title  = $.trim($(this).text());
                var str = '';
                if(title.length <= 7){
                    str = title.split('').join(' ');
                    eleTitle.text(str);
                }
            }
        });
        $('.tbl-header-1:not(.no-space-text) thead tr th').each(function(){
            if($(this).find('select').length == 0  && $(this).find('input').length == 0 && $(this).find('button').length==0 && $(this).find('img').length==0 && $(this).find('span').length==0){
                var eleTitle = $(this);
                var title  = $.trim($(this).text());
                var str = '';
                if(title.length <= 7){
                	var noSpace = $(this).attr("noSpace");
                	if (typeof noSpace == 'undefined'){
               		 str = title.split('').join(' ');
                        eleTitle.text(str);
                	}  
                	
                	/*
                    str = title.split('').join(' ');
                    eleTitle.text(str);*/
                }
            }
        });
        $(".only-number, .numeric").bind('paste', function(e) {
            var _this = $(this);
            setTimeout(function(e) {
                if (!_validateNumber($(_this).val())) {
                    $(_this).val('');
                }
            }, 0);
        });
        //tabs init
        $('#myTabs a').click(function(e) {
               e.preventDefault();
               $(this).tab('show');
           });
        //disable tabindex input
        $('input[readonly="readonly"]').attr('tabindex','-1');
        $('input[readonly=""]').attr('tabindex','-1');
        $('button').attr('tabindex','-1');
        // blur all item
        $('input.time').trigger('blur');
//		$('input.only-number').trigger('blur');
        $('input.time25').trigger('blur');
        $('input.time30').trigger('blur');
        // $('input.zip_cd').trigger('blur');
        // format percent
        $('input.percent').trigger('blur');
        $('input.tel').trigger('blur');
        $('input.numeric').trigger('blur');
        $('.tooltip').remove();
        $('[data-toggle="tooltip"]').tooltip();
        $('textarea').each(function(){
            var div = $(this).parent();
            var heigth = Number(div.height());
           // div.css('height',heigth+1);
        })
        $('#page-size').attr('tabindex',-1);
        $('#menu-content a').attr('tabindex',-1);
        $('.ui-datepicker-trigger').attr('tabindex',-1);
        if(mode==1){
            resizeMaster2();
        }else if (mode ==2){
            resizeMaster3();
        }else if (mode ==-1){
            // Not nothing
        }
        else{
            resizeMaster();
        }

    } catch (e) {
        alert('_formatInput: ' + e.toString());
    }
}
function resizeMaster2() {
    var heightScreen = $(window).height()*1;
    var heightTagCalc = 0;
    var heightTable = 0;
    var paddingAll	= 50;
    $('.tag-calc').each(function(){
        heightTagCalc += $(this).outerHeight()*1;
    });
    heightTable = heightScreen - heightTagCalc -  paddingAll;
    $('.table-resize').height(heightTable);
}
function resizeMaster3(inputPadding) {
    var heightScreen = $(window).height()*1;
    var heightTagCalc = 0;
    var heightTable = 0;
    var paddingAll	= 80;
    var heightHeader	=	0;
    var heightHeaderFix	=	0;
    var heightFooter	=	0;
    // BaoNC check add
    var groupbutton  = 0 ;
    // End BaoNC 
    if (inputPadding!=undefined){
    	paddingAll	=	inputPadding;
    }
    heightHeader = ($('.w-header').length>0?$('.w-header').outerHeight():0);
    // BaoNC 
    groupbutton	 =	 ($('.w-group-button').length>0?$('.w-group-button').outerHeight():0);
    // End BaoNC
    //heightFooter	=	($('.w-footer').length>0 ? $('.w-footer').outerHeight() *1 :0 );
   // heightMenu 	=	($('.w-group-button').length>0?$('.w-group-button').outerHeight():0);
    
    $('.tag-calc').each(function(){
    	if(!$(this).attr("hidden")){
    		heightTagCalc += $(this).outerHeight()*1;
    		 
    	}else{
    		 
    	}
    	
        
    });
    heightTagCalc	+=heightHeader + heightFooter;
    heightTable = heightScreen - heightTagCalc -  paddingAll - groupbutton;
    $('.table-resize').height(heightTable);
}
/**
 * Function resize DIV MAIN
 *
 * @author : quanhnk - 2015/10/05 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function resize() {
    try {
        var widthScreen = 0;
        var heightScreen = 0;
        var heightHeader = 0;
        var heightGroupButton = 0;
        var heightInfo = 0;
        var heightFooter = 0;
        var heightHr = 0;
        var heightPadding = 20;
        var heightFix = 26;
        var division = 0;
        var heightItem = 0;
        widthScreen = $(window).width();
        heightScreen = $(window).height()*1;
        heightHeader = $('.w-header').height()*1;
        heightHeaderFix =  $('.w-header-fix').length *1 > 0 ? $('.w-header-fix').height()*1 + 1 : 0;
        heightGroupButton = $('.w-group-button').height()*1;
        heightGroupButtonFix = $('.w-group-button-fix').height()*1;
        heightInfo = $('.w-info').height()*1;
        heightFooter = $('.w-footer').height();
        heightCreateUpdate  = $('.tbl-create-update:last').height()*1;
        paddingCreateUpdate = 0;
        if(heightCreateUpdate != 0){
            paddingCreateUpdate = 0;
        }
        heightMain = heightScreen
                - (heightHeader+ heightHeaderFix + heightGroupButton +heightGroupButtonFix + heightInfo + heightFooter
                        + heightHr + heightPadding + heightCreateUpdate + paddingCreateUpdate);
        $('.w-content-data').css({
            height : heightMain + 6,//quangnk update 6/7/2016
        });
        /* biennv 2016/04/08 fix bug hidden lable search */
         $('.w-title-item').each(function() {
            division = Math.floor($(this).parents('.row').find('.w-item-search').height() / 24);
            if (widthScreen > 991) {
                heightItem = heightFix * division;
            } else {
                heightItem = heightFix;
            }
            $(this).css({
                height : heightItem
            });
        });
        /* hiepnv 2016/05/11 begin calculate height table search */
         var contentHeight = Number($('.w-content-data').height());
         var conditionHeight = Number($('.search-condition').height());
         var infoResultHeight = Number($('.w-info-result').height());
         var paddingTopHeight = 24;
         var mainDataHeight = contentHeight - conditionHeight -infoResultHeight - paddingTopHeight;
         var tableDataHeight  =  $('.w-result-data').find('.w-main-data').height();
         $('.w-result-data').css('min-height',tableDataHeight+infoResultHeight + 5); //add 5px padding top form search
         /* hiepnv 2016/05/11 end calculate height table search */
    } catch (e) {
        alert('resize' + e.message);
    }
}

/**
 * Function resize DIV MAIN
 *
 * @author : quangk - 2016/13/09 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function resizeMaster() {
    try {
        if($('.w-content-data-master').length > 0){
            var widthScreen = 0;
            var heightScreen = 0;
            var heightHeader = 0;
            var heightHeaderFix = 0;
            var heightGroupButton = 0;
            var heightGroupButtonFix = 0;
            var heightInfo = 0;
            var heightFooter = 0;
            var heightHr = 0;
            var heightPadding = 20;
            var heightFix = 26;
            var division = 0;
            var heightItem = 0;
            var searchCondition = 0;
            var infoResult = 0;
            var heighHeaderTable = 0;
            var paddingAll		= 63;
            var dataAfterResult = 0;
            var dataBeforeResult = 0;
            
            heightHeader = $('.w-header').height();
            heightGroupButton = $('.w-group-button').height();
            
            searchCondition 	= 	$('.search-condition').height()*1;
            
            infoResult 			= 	$('.w-info-result').height()*1;
            heighHeaderTable	=	$('.w-header-table-fix-1').height()*1
            dataAfterResult		=	$('.data-after-result').outerHeight()*1;
            dataBeforeResult		=	$('.data-before-result').height()*1;
            heightScreen = $(window).height();
            
            heightHeaderFix = $('.w-header-fix').height() *1;
            
            heightGroupButtonFix = $('.w-group-button-fix').height()*1;
            heightInfo = $('.w-info').height()*1;
            heightFooter = $('.w-footer').height();
            heightCreateUpdate  = $('.tbl-create-update').height()*1;
            paddingCreateUpdate = 0;
            var extend = 0;
            if($('.extend').length > 0){
            	$('.extend').each(function(){
            		extend = extend + $(this).height()*1; 
            	});
            }
            if(heightCreateUpdate != 0){
                paddingCreateUpdate = 0;
            }
            heightMain = heightScreen
                    - (heightHeader + heightHeaderFix + heightGroupButton + heightGroupButtonFix + heightInfo + heightFooter
                            + heightHr + heightPadding + heightCreateUpdate + paddingCreateUpdate + searchCondition
                            + infoResult + heighHeaderTable + paddingAll + dataAfterResult + dataBeforeResult + extend );
            
//            console.log(heightHeader , heightHeaderFix , heightGroupButton , heightGroupButtonFix , heightInfo , heightFooter
//                            , heightHr , heightPadding , heightCreateUpdate , paddingCreateUpdate , searchCondition
//                            , infoResult , heighHeaderTable , paddingAll , dataAfterResult , dataBeforeResult )
            $('.div-table-data-master').css({
                height : heightMain + 6,//quangnk update 6/7/2016
            });
        }
         /* hiepnv 2016/05/11 end calculate height table search */
    } catch (e) {
        alert('resize' + e.message);
    }
}

/**
 * Function click menu left
 *
 * @author : quanhnk - 2015/10/05 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function clickMenuLeft(elem) {
    try {
        if ($(elem).attr('data-ref') == 'undefined') {
            return false;
        }
        var id = $(elem).attr('data-ref');
        if ($(id).length <= 0) {
            return false;
        }
        // slide up or down child level
        $(id).slideToggle('slow');
        $(elem).siblings('li.list-child-menu').not(id).slideUp('slow');
        // change parent background color
        $('.li-click').css({
            'background-color' : '#fff'
        });
        elem.css({
            'background-color' : '#FDFDB9'
        });
        // change arrow parent level
        $('.icon-open-list').removeClass('glyphicon-triangle-bottom');
        $('.icon-open-list').addClass('glyphicon-triangle-right');
        $(elem).find('.icon-open-list').addClass('glyphicon-triangle-bottom');
        return false;
//		var flag = elem.find('.glyphicon-triangle-right').length;
//		// closed li openning
//		$('.icon-open-list').removeClass('glyphicon-triangle-bottom');
//		$('.icon-open-list').addClass('glyphicon-triangle-right');
//		$('.list-child-menu').hide();
//		$('.li-click').css({
//			'background-color' : '#fff'
//		});
//		elem.css({
//			'background-color' : '#FDFDB9'
//		});
//		if (flag > 0) {
//			elem.next().next().show('fast');
//			elem.find('.icon-open-list').addClass('glyphicon-triangle-bottom');
//			elem.find('.icon-open-list')
//					.removeClass('glyphicon-triangle-right');
//		} else {
//			if (elem.next().next().hasClass('list-child-menu')) {
//				elem.next().next().hide('fast');
//			}
//			elem.find('.icon-open-list').addClass('glyphicon-triangle-right');
//			elem.find('.icon-open-list').removeClass(
//					'glyphicon-triangle-bottom');
//		}
    } catch (e) {
        alert('clickMenuLeft' + e.message);
    }
}
/**
 * _findErrMsgPosition
 *
 * @author : viettd - 2015/09/23 - create
 * @author :
 * @return : item- description
 * @access : public
 * @see :
 */
function _findErrMsgPosition(item) {
    try {
        var top = item.position().top;
        var left = item.position().left
                + 1
                * item.css('margin-left').substring(0,
                        item.css('margin-left').length - 2);
        while (!item.parent().is('body')) {
            if (item.parent().css('position') == 'relative') {
                top += item.parent().position().top;
                left += item.parent().position().left;
            } else if (item.parent().is('#cboxLoadedContent')) {
                top += $('#colorbox').position().top;
                left += $('#colorbox').position().left;
                break;
            }
            item = item.parent();
        }
        return {
            top : top,
            left : left
        };
    } catch (e) {
        alert('_findErrMsgPosition: ' + e.message);
    }
}
/**
 * Find first error item and focus it
 */
function _focusErrorItem() {
    try {
        $('.textbox-error:first').focus();
    } catch (e) {
        alert('_focusErrorItem: ' + e.message);
    }
}
/**
 * Clear all red items. Call when no error detected.
 */
function _clearErrors() {
    try {
        $('.textbox-error').removeErrorStyle();
        $('.checkbox-required').removeClass('textbox-error');
        $('.hasError').removeClass('hasError');
        $('.checkbox-required').removeAttr('has-balloontip-message');
        $('.checkbox-required').removeAttr('style');
         $('#msg').removeClass('msgerror').html('');
         $('#msg').hide();
        // $('.textbox-error').removeClass('error-item').removeAttr('index');
    } catch (e) {
        alert('_clearErrors' + e.message);
    }
}
/**
 * set_limit_date_month
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @param :
 *            date
 * @return : date
 * @access : public
 * @see : set limit date ( 1900/01/01 -> 9999/12/31 )
 */
function set_limit_date_month(date) {
    try {
        if (date == '') {
            return '';
        }
        var date_value = parseInt((date + "/01").replace('/', '').replace('/',
                ''));
        if (date_value < 19000101 || date_value > 99991231) {
            return '';
        }
        return date;
    } catch (e) {
        alert('set_limit_date_month' + e.message);
    }
}
/**
 * set_limit_date
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @return : null
 * @access : public
 * @see : set limit date ( 1900/01/01 -> 9999/12/31 )
 */
function set_limit_date(date) {
    try {
        if (date == '') {
            return '';
        }
        var date_value = parseInt((date).replace('/', '').replace('/', ''));
        if (date_value < 19000101 || date_value > 99991231) {
            return '';
        }
        return date;
    } catch (e) {
        alert('set_limit_date' + e.message);
    }
}
/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyyMm(string) {
    if (string == '') {
        return true;
    }
    string = _formatString(string);
    var reg = /^([0-9]{4})\/(0[1-9]|1[0-2])$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyyMmDd(string) {
    if (string == '') {
        return true;
    }
    if (string.length == 8) {
        string = string.substring(0, 4) + '/' + string.substring(4, 6) + '/'
                + string.substring(6);
    }
    string = _formatString(string);
    var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[13578]|1[02])[\/.]31|((19|[2-9][0-9])[0-9]{2}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|((19|[2-9][0-9])[0-9]{2}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Time
 *
 * @param string
 * @returns {Boolean}
 */
function _validateTime(string) {
    string = _formatString(string);
    var reg = /^(([0-1][0-9])|(2[0-3])):[0-5][0-9]|[2][4]:[0][0]$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Time
 *
 * @param string
 * @returns {Boolean}
 */
function _validateTime25(string) {
    string = _formatString(string);
    var reg = /^([0-9][0-9]):[0-5][0-9]$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check hours of time < 24
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHours23(string) {
    string = _formatString(string);
    var reg = /\b(2[0-3]|[0-1]?[0-9])\b/;
    if (string.match(reg) && parseInt(string) < 24) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check hours of time 1 - 24
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHours24(string) {
    string = _formatString(string);
    var reg = /^(2[0-4]|1[0-9]|[1-9])$/;
    if (string.match(reg) && parseInt(string) >= 1 && parseInt(string) <= 24) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check minutes of time < 60
 *
 * @param string
 * @returns {Boolean}
 */
function _validateMinutes60(string) {
    string = _formatString(string);
    var reg = /^[0-5]?[0-9]$/;
    if (string.match(reg) && parseInt(string) < 60) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Time
 *
 * @param string
 * @returns {Boolean}
 */
function _validateTime30(string) {
    string = _formatString(string);
    var reg = /^([0-9][0-9]):[0-5][0-9]$/;
    var timeInt	=	1*(string.replace(/:/gi,''));
    if ((string.match(reg) || string == '') && timeInt<3060) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check DateTime
 *
 * @param string
 * @returns {Boolean}
 */
function _validateDateTime(string) {
    string = _formatString(string);
    var reg = /^(((19|[2-9][0-9])[0-9]{2})[\/.](0[13578]|1[02])[\/.]31|((19|[2-9][0-9])[0-9]{2}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|((19|[2-9][0-9])[0-9]{2}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)) ((([0-1][0-9])|(2[0-3])):[0-5][0-9])$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Validate Point(xxx.x)
 */
function _validatePoint(string) {
    string = _formatString(string);
    var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]))$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Validate Rate(xxx.xx)
 */
function _validateRate(string) {
    string = _formatString(string);
    var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]{1,2}))$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Money
 *
 * @param string
 * @returns {Boolean}
 */
function _validateCash(string) {
    string = _formatString(string);
    var reg = /^[\-]?[0-9]{1,3}(\,[0-9]{3})*$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Tel Number
 *
 * @param string
 * @returns {Boolean}
 */
function _validatePhoneNumber(string) {
    string = _formatString(string);
    var reg = /^((\([0-9]{4}\)[0-9]{4}|[0-9]{4}\-[0-9]{4}|[0-9]{8})|(\([0-9]{2,3}\)|[0-9]{2,3}|[0-9]{2,3}-)(\([0-9]{3,4}\)[0-9]{3,4}|[0-9]{3,4}\-[0-9]{3,4}|[0-9]{6,8}))$/;
    if (reg.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check URL
 *
 * @param string
 * @returns {Boolean}
 */
function _validateUrl(string) {
    string = _formatString(string);
    var regexp = /^((http|https):\/\/)?(www\.)?([a-zA-Z0-9\-_]{2,}\.){1,3}[a-z]{2,}(\/|\/[\w#?+=&%@\-\/\.]*)?$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Email Address
 *
 * @param string
 * @returns {Boolean}
 */
function _validateEmail(string) {
    // string = _formatString(string);
    var regexp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check halfsize alphanumeric
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHalfSizeAlphanumeric(string) {
    // string = _formatString(string);
    var regexp = /^[a-zA-Z0-9]+$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check halfsize alphabet
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHalfSizeAlphabet(string) {
    // string = _formatString(string);
    var regexp = /^[a-zA-Z]+$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Katakana String
 *
 * @param string
 * @returns {Boolean}
 */
function _validateKatakana(string) {
    if(string != '') {
         /**
          * 2015/01/16
          * check is string fullsize?
          */
    //  return /^[\u3000-\u303f\u3040-\u309f\u30a0-\u30ff\uff00-\uff9f\u4e00-\u9faf\u3400-\u4dbf\u25cb\u00d7]+$/.test(string.replace(/\r?\n|\r/g, ''));
         var isFullSize  = /^[^\uff65-\uffef\u4db6-\u4dbf\ue000-\ue757\u0020-\u007e]+$/.test(string.replace(/\r?\n|\r|\s/g, ''));
         return isFullSize;
     }else{
      return true;
     }
}
/**
 * Convert Full-width to Half-width Characters
 *
 * @param string
 * @returns string
 */
function _formatString(string) {
    string = $.textFormat(string, '9');
    string = $.textFormat(string, '@');
    string = $.textFormat(string, 'a');
    string = $.textFormat(string, 'A');
    return string;
}
/**
 * _validateNumber
 *
 * @author : biennv - 2015/04/17 - create
 * @param :
 *            string
 * @returns : {Boolean}
 */
function _validateNumber(string) {
    try {
        var regexp = /^-*[0-9]+$/;
        if (regexp.test(string) || string == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        alert(e.message);
    }
}
/**
 * _validateFromToDate
 *
 * @author : viettd - 2015/12/07 - create
 * @author :
 * @return : true/false
 * @access : public
 * @see :
 */
function _validateFromToDate(from, to) {
    try {
        if (from != '' && to != '') {
            var fromDate = new Date(from);
            var toDate = new Date(to);
            if (fromDate.getTime() > toDate.getTime()) {
                return false;
            }
        }
        return true;
    } catch (e) {
        alert('_validateFromToDate:' + e.message);
    }

}

/**
 * _validateFromToDate
 *
 * @author : viettd - 2015/12/07 - create
 * @author :
 * @return : true/false
 * @access : public
 * @see :
 */
function _validateFromToTime(from, to) {
    try {
        if (from != '' && to != '') {
            if (parseInt(from) > parseInt(to)  ) {
                return false;
            }
        }
        return true;
    } catch (e) {
        alert('_validateFromToTime:' + e.message);
    }

}

/**
 * _validateFromToDate
 *
 * @author : viettd - 2015/12/07 - create
 * @author :
 * @return : true/false
 * @access : public
 * @see :
 */
function _validateFromToTime2(from, to) {
    try {
        if (from != '' && to != '') {
            if (parseInt(from) == parseInt(to)  ) {
                return false;
            }
        }
        return true;
    } catch (e) {
        alert('_validateFromToTime:' + e.message);
    }

}
/**
 * padZeroLeft
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @param :
 *            $data
 * @param :
 *            $max
 * @return : null
 * @access : public
 * @see :
 */
function padZeroLeft($data, $max) {
    try {
        var length = $max - $data.length; // alert(length);
        var zero = '';
        if (length == $max) {
            return '';
        }
        for (var i = 0; i < length; i++) {
            zero = zero + '0';
        }
        return zero + $data;
    } catch (e) {
        alert('padZeroLeft' + e.message);
    }
}
/**
 * padZeroRight
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @param :
 *            $data
 * @param :
 *            $max
 * @return : null
 * @access : public
 * @see :
 */
function padZeroRight($data, $max) {
    try {
        var length = $max - $data.length; // alert(length);
        var zero = '';
        if (length == $max) {
            return '';
        }
        for (var i = 0; i < length; i++) {
            zero = zero + '0';
        }
        return $data+zero;
    } catch (e) {
        alert('padZeroRight' + e.message);
    }
}
/**
 * processError
 *
 * @author : viettd - 2015/10/14 - create
 * @author :
 * @param :
 *            null
 * @return : null
 * @access : public
 * @see :
 */
function processError(error) {
    try {
        // check the first row of table error has error_typ = 1 (dialog)
        if (error[0].error_typ == 1) {
            jMessage(error[0].message_no, function() {
                //location.reload();
            });
            // check the first row of table error has error_typ = 2(dialog can
            // eidt message)
        } else if (error[0].error_typ == 2) {
            jMessage(error[0].message_no, function() {}, error[0].remark);
        }else if(error[0].error_typ == 999){
            jError(error[0].remark,'例外');
        } else {
            for ( var i in error) {
                // if tooltip
                if (error[i].error_typ == 0) {
                    // check id
                    if (error[i].item.indexOf('#') != -1) {
                        var msg = _text[error[i].message_no];
                        // check item is muliti attribute
                        if (error[i].item.indexOf(',') != '') {
                            var itemAarray = error[i].item.split(',');
                            for (var j = 0; j < itemAarray.length; j++) {
                                $(itemAarray[j]).errorStyle(msg,'textbox-error');
                            }
                        } else {
                            $(error[i].item).errorStyle(msg, 'textbox-error');
                        }
                    }
                    // check class
                    if (error[i].item.indexOf('.') != -1) {
                        // when index is not exists.
                        if (error[i].value1 == 0) {
                            var msg = _text[error[i].message_no];
                            // check item is muliti attribute
                            if (error[i].item.indexOf(',') != '') {
                                var itemAarray = error[i].item.split(',');
                                for (var j = 0; j < itemAarray.length; j++) {
                                    $(itemAarray[j]).errorStyle(msg,'textbox-error');
                                }
                            } else {
                                $(error[i].item).errorStyle(msg,'textbox-error');
                            }
                            // when index is exists
                        } else {
                            var index = error[i].value1;
                            var msg = _text[error[i].message_no];
                            $(error[i].item).eq(index - 1).errorStyle(msg,'textbox-error');
                        }
                    }
                } else {
                    jMessage(error[i].message_no);
                }
            }
        }
    } catch (e) {
        alert('processError' + e.message);
    }
}
/**
 * processError
 *
 * @author : hiepnv - 2016/07/20 - create
 * @author :
 * @param : null
 * @return : null
 * @access : public
 * @see :
 */
function processError2(error) {
    try {
        var arrError = [];
        // check the first row of table error has error_typ = 1 (dialog)
        if (error[0].error_typ == 1) {
            jMessage(error[0].message_no, function() {
                //location.reload();
            });
            // check the first row of table error has error_typ = 2(dialog can
            // eidt message)
        } else if (error[0].error_typ == 2) {
            jMessage(error[0].message_no, function() {}, error[0].remark);
        }else if(error[0].error_typ == 999){
            jError(error[0].remark,'例外');
        } else {
            for ( var i in error) {
                // if tooltip
                if (error[i].error_typ == 0) {
                    // check id
                    if (error[i].item.indexOf('#') != -1) {
                        var msg = _text[error[i].message_no];
                        // check item is muliti attribute
                        if (error[i].item.indexOf(',') != '') {
                            var itemAarray = error[i].item.split(',');
                            for (var j = 0; j < itemAarray.length; j++) {
                                $(itemAarray[j]).addClass('textbox-error');
                                arrError.push($(itemAarray[j]).attr('titletext')+msg);
                            }
                        } else {
                            $(error[i].item).addClass('textbox-error');
                        }
                    }
                    // check class
                    if (error[i].item.indexOf('.') != -1) {
                        // when index is not exists.
                        if (error[i].value1 == 0) {
                            var msg = _text[error[i].message_no];
                            // check item is muliti attribute
                            if (error[i].item.indexOf(',') != '') {
                                var itemAarray = error[i].item.split(',');
                                for (var j = 0; j < itemAarray.length; j++) {
                                    $(itemAarray[j]).addClass('textbox-error');
                                    arrError.push($(itemAarray[j]).attr('titletext')+msg);
                                }
                            } else {
                                $(error[i].item).addClass('textbox-error');
                                arrError.push($(itemAarray[j]).attr('titletext')+msg);
                            }
                            // when index is exists
                        } else {
                        	var itemAarray = error[i].item.split(',');
                            var index = error[i].value1;
                            var msg = _text[error[i].message_no];
                            $(error[i].item).eq(index - 1).addClass('textbox-error');
                            for (var j = 0; j < itemAarray.length; j++) {
                                arrError.push($(itemAarray[j]).attr('titletext')+msg);
                            }
//                            $(error[i].item).eq(index - 1).addClass('textbox-error');
//                            arrError.push($(itemAarray[j]).attr('titletext')+msg);
                        }
                    }
                } else {
                    jMessage(error[i].message_no);
                }
            }
            if(arrError.length > 0){
                messageError(arrError);
            }
        }
    } catch (e) {
        alert('processError2 ' + e.message);
    }
}
/**
 * createTableFixHeader
 *
 * @author : quanhnk - 2015/10/07 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function createTableFixHeader() {
    try {
        var widthWrapTable = 0;
        var heightWrapTable = 0;
        $('.w-data-table').each(
                function() {
                    widthWrapTable = $(this).attr('width');
                    heightWrapTable = $(this).attr('height');
                    $(this).find('.w-header-table-fix .tbl-header').css(
                            'width', widthWrapTable + 'px');
                    if ($(this).attr('table-popup') == 'true') {
                        heightWrapTable = parent.$('#colorbox').height() - 240;
                        $(this).find('.w-body-table-fix').css({
                            'width' : (1 * widthWrapTable + 1 * 17) + 'px',
                            'height' : +heightWrapTable + 'px'
                        });
                    } else {
                        $(this).find('.w-body-table-fix').css({
                            'width' : (1 * widthWrapTable + 1 * 17) + 'px',
                            'height' : +heightWrapTable + 'px'
                        });
                    }
                    $(this).find('.w-body-table-fix .tbl-body').css('width',
                            widthWrapTable + 'px');
                    var heightParent	=	$(this).find('.w-body-table-fix').height();
                    var heightChild		=	$(this).find('.tbl-body').height();
                    var width			=	$(this).find('.w-body-table-fix').css('width');
                });
                $('.w-body-table-fix').scroll(
                function() {
                    $(this).parents('.w-data-table')
                            .find('.w-header-table-fix').scrollLeft(
                                    $(this).scrollLeft());// 左右連動させる\
                });
    } catch (e) {
        alert('createTableFixHeader' + e.message);
    }
}
/**
 * createNew
 *
 * @author : viettd - 2015/10/30 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function createNew(object) {
    try {
        var array = new Array();
        if (object != '') {
            array = object.split(',');
            for (var i = 0; i < array.length; i++) {
                var element = array[i];
                if ($(element).length) {
                    $(element).find('input,textarea').val('');
                    $(element).find('select option').prop("selected", false);
                    $(element).find(
                            'input[type="checkbox"],input[type="ratio"]')
                            .removeAttr('checked');
                    if ($('#mode').length) {
                        $('#mode').attr('mode', 'C');
                    }
                    _clearErrors();
                }
            }
        }
        // clear all information update + create
        $('body').find('#cre_user,#upd_user,#cre_date,#upd_date').text('');
    } catch (e) {
        alert('create new ' + e.message);
    }
}
/**
 * fillCreateUpdateInfor
 *
 * @author : viettd - 2015/10/30 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function fillCreateUpdateInfor(res) {
    try {
        if (typeof (res) != 'undefined') {
            var cre_user = res['cre_user'];
            var upd_user = res['upd_user'];
            var cre_date = res['cre_date'];
            var upd_date = res['upd_date'];
        }
    } catch (e) {
        alert('fillCreateUpdateInfor' + e.message);
    }
}
/**
 * initItem
 *
 * @author : viettd - 2015/10/30 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function initItem(obj) {
    try {
        // int element
        $.each(obj, function(key, element) {
            // add maxlength
            if (element['attr']['maxlength'] != undefined) {
                $('#' + key).attr('maxlength', element['attr']['maxlength']);
            }
            // add class
            if (element['attr']['class'] != undefined) {
                $('#' + key).addClass(element['attr']['class']);
            }
            // add decimal
            if (element['attr']['decimal'] != undefined) {
                $('#' + key).attr('decimal', element['attr']['decimal']);
            }
            // add read-only
            if (element['attr']['readonly'] != undefined) {
                $('#' + key).attr('readonly', element['attr']['readonly']);
            }
            // add disabled
            if (element['attr']['disabled'] != undefined) {
                $('#' + key).attr('disabled', element['attr']['disabled']);
            }
            // add tabindex
            if (element['attr']['tabindex'] != undefined) {
                $('#' + key).attr('tabindex', element['attr']['tabindex']);
            }
            // add titleText
            if (element['attr']['title'] != undefined) {
                $('#' + key).attr('titleText', element['attr']['title']);
            }
            // add titleText
            if (element['attr']['negative'] != undefined) {
                $('#' + key).attr('negative', element['attr']['negative']);
            }
            // add border button refer
//			if ($('#' + key).parent().hasClass('input-group')) {
//				if($('#' + key).parent().find('.input-group-btn').length > 0){
//					if($('#' + key).parent().find('input').hasClass('required')){
//						$('#' + key).parent().find('button').addClass('control-focus');
//						$('#' + key).parent().find('.control-focus').css('border-color','#FF3B3B');
//					}
//				}
//			}
        });
        // format input
        //_formatInput();
    } catch (e) {
        alert('initItem' + e.message);
    }
}
/**
 * getData
 *
 * @author : viettd - 2015/10/12 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function getData(obj) {
    try {
        var data = {};
        $.each(obj, function(key, element) {
            switch (element.type) {
            case 'text':
                if($('#' + key).hasClass('padding-zero')){
                    data[key] = $.mbRTrim($('#' + key).val()) == '' ? 0 : $.mbRTrim($('#' + key).val())*1;
                }else{
                    data[key] = $.mbRTrim($('#' + key).val());
                }
                break;
            case 'textarea':
                data[key] = $.mbRTrim($('#' + key).val());
                break;
            case 'time':
                data[key] = $.mbRTrim($('#' + key).val()).replace(':', '');
                break;
            case 'refer':
                data[key] = $.mbRTrim($('#' + key).val());
                break;
            case 'select':
                data[key] = $('#' + key).val();
                if (!data[key]) {
                    data[key] = 0;
                }
                break;
            case 'radiobox':
                var name = element['attr']['name'];
                data[key] = $("input[name='" + name + "']:checked").val();
                break;
            case 'checkbox':
                data[key] = false;
                if ($('#' + key).is(":checked")) {
                    data[key] = true;
                }
                break;
            case 'money':
                data[key] = $.mbRTrim($('#' + key).val()).replace(/,/g, '');
                break;
            // add by phonglv
            case 'numeric':
                data[key] = 1*($.mbRTrim($('#' + key).val()).replace(/,/gi,'').replace(/%/gi,''));
                break;
            case 'title':
                data[key] = $.trim($('#' + key).text());
                break;
            default:
                break;
            }
            ;
        });
        return data;
    } catch (e) {
        alert('getData: ' + e.message);
    }
}
/**
 * _changeStatusSort
 *
 * @author : namnb - 2015/11/05 - create
 * @param :
 *            null
 * @returns : null
 */
function _changeStatusSort() {
    var element = $('a.sort-column');
    if (!element.length)
        return; // no elements found, do nothing
    var up = 'glyphicon-triangle-top';
    var down = 'glyphicon-triangle-bottom';
    element.css({
        'color' : '#333',
        'text-decoration' : 'none',
        'cursor' : 'pointer',
        'width' : '100%',
        'height' : '100%',
        'display' : 'inline-block'
    });
    $('a.sort-column').on('click', function() {
        var child = $(this).find('span');
        if (child.hasClass(down)) { // default down
            child.removeClass(down);
            child.addClass(up);
        } else {
            child.removeClass(up);
            child.addClass(down);
        }
    });
}
/**
 * htmlEntities
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function htmlEntities(str) {
    try {
        if (str == undefined) {
            str = '';
        }
        return str.replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(
                /&gt;/g, '>').replace(/&quot;/g, '"');
    } catch (e) {
        alert('htmlEntities' + e.message);
    }
}
/**
 * getParameterByName
 *
 * @author : viettd - 2015/11/13 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function getParameterByName(name, url) {
    try {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex
                .exec(url);
        return results === null ? "" : decodeURIComponent(results[1].replace(
                /\+/g, " "));
    } catch (e) {
        alert('getParameterByName' + e.message);
    }
}
/**
 * Description of function
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function _linkFunction(url, param) {
    try {
        param.url = url;
        $.ajax({
            type : 'POST',
            url : '/common/link/session',
            dataType : 'json',
            data : {
                param : param
            },
            success : function(res) {

            }
        });
    } catch (e) {
        alert('linkFunction' + e.message);
    }
}
/**
 * calculate age from birthday
 *
 * @author : phonglv - 2015/11/18 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function calculateAge(dateString) {
    try {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (isNaN(age)){
            age	=	'';
        }
        return age;
    } catch (e) {
        alert('calculate age from birthday' + e.message);
    }
}
/**
 * priceFormat of function
 *
 * @author : KienNT - 2015/05/27 - create
 * @param  : 999999
 * @return : 999,999
 */
function priceFormat(val) {
    try {
        var rgx = /(\d+)(\d{3})/;
        str = val + '';
        while (rgx.test(str)) {
            str = str.replace(rgx, '$1' + ',' + '$2');
        }
        return (str);
    } catch (e) {
        alert('priceFormat: ' + e.message);
    }
}
/**
 * unPriceFormat
 *
 * @author		:	viettd - 2016/02/17 - create
 * @author		:
 * @params		:	999,999
 * @return		:	999999
 * @access		:	public
 * @see			:
 */
function unPriceFormat(val) {
    try {
        var res = 0;
        if(val != ''){
            res = val.replace(/,/g , '');
        }
        return (res);
    } catch (e) {
        alert('unPriceFormat: ' + e.message);
    }
}

/**
 * resizeTable
 *
 * @author : viettd - 2015/12/04 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function resizeTable(flag) {
    try {
        var wMainData = $('.w-main-data').height();
        var wGroupButtonSearch = $('.w-group-button-search').height();
        resize();
    } catch (e) {
        alert('resizeTable' + e.message);
    }
}
/**
 * delete file temp
 *
 * @author : biennv - 2015/12/04 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function deleteFileTemp(fileName) {
    try {
        $.ajax({
            type : 'POST',
            url : '/common/upload/deletetemp',
            dataType : 'json',
            data : {
                file : fileName
            },
            success : function(res) {
            }
        });
    } catch (e) {
        alert('deleteFileTemp' + e.message);
    }
}
/**
 * delete file temp
 *
 * @author : biennv - 2015/12/04 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function deleteFolderTemp(folder) {
    try {
        $.ajax({
            type : 'POST',
            url : '/common/upload/deletefolder',
            dataType : 'json',
            data : {
                folder : folder
            },
            success : function(res) {
            }
        });
    } catch (e) {
        alert('deleteFolderTemp' + e.message);
    }
}
/**
 * post param into Link controller to save session param
 *
 * @author : thanhnv - 2015/12/08 - create
 * @author :
 * @param :
 *            string - screenId
 * @param :
 *            json object - parram
 * @return : null
 * @access : public
 * @see :
 */
function postParamToLink(screenId, parram,referUrl,callback) {
    try {
        if (referUrl==null){
            referUrl	=	'';
        }
        $.ajax({
            type : 'POST',
            url : '/common/link/session',
//			dataType : 'json',
            data : {
                'screen_id' : screenId,
                'param' : parram
            },
            success : function(res) {
                if(callback){
                    callback();
                }
                if(referUrl!=''){
                    window.location.href = referUrl;
                }
            }
        });
    } catch (e) {
        alert('postParamToLink' + e.message);
    }
}
/**
 * post param into Link controller to delete session param
 *
 * @author : thanhnv - 2015/12/09 - create
 * @author :
 * @param :
 *            string - screenId
 * @param :
 *            json object - parram
 * @return : null
 * @access : public
 * @see :
 */
function deleteParamToLink(screenId,screenBackUrl,callback) {
    try {
        $.ajax({
            type : 'POST',
            url : '/common/link/deletesession',
            data : {
                'screen_id' : screenId,
            },
            success : function(res) {
                if(callback){
                    callback();
                }
                if(screenBackUrl!=''){
                    window.location.href = screenBackUrl;
                }
            }
        });
    } catch (e) {
        alert('deleteParamToLink' + e.message);
    }
}

/**
 * get params search
 *
 * @author		:	biennv - 2015/12/15 - create
 * @author		:
 * @params		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function getParamSearch(callback){
    try {
        //click クリア
        $(document).on('click', '#btn-clear', function() {
            try {
                jMessage(41, function(r){
                    if(r){
                        if(typeof localStorage !== 'undefined'){
                            localStorage.setItem('reset',1);
                            location.reload();
                        }
                    }
                });
            } catch (e) {
                alert('#btn-clear' + e.message);
            }
        });
        if(typeof localStorage === 'undefined' || localStorage.getItem('reset') == 0){
            var screenId	=	$('#screen-id').val();
            $.ajax({
                type : 'POST',
                url : '/master/m923/getpramasearch',
                dataType : 'json',
                data : {
                    'screen_id' : screenId,
                },
                success : function(res) {
                    if(res.status == OK){
                        $('input[type="checkbox"]').removeAttr('checked');
                        $('input[type="radio"]').removeAttr('checked');
                        $('select > option').removeAttr('selected');
                        $.each(res.data,function(ind,row){
                            var conditionId		=	$.trim(row.condition_id);
                            var conditionValue	=	$.trim(row.condition_value);
                            if(typeof $('#'+conditionId) != 'undefined'){
                                var tag	=	$('#'+conditionId).prop("tagName");
                                if(tag == 'SELECT'){
                                    if(conditionValue != ''){
                                        var tmp1 = conditionValue.split(",");
                                        $.each(tmp1,function(ind,val1){
                                            var tmp = val1.split(".");
                                            var val = $.trim(tmp[0]);
                                            $('select').attr(conditionId,val);
                                            $('#'+conditionId).find('option[value="'+val+'"]').attr('selected','selected');
                                        });
                                    }
                                }else{
                                    var typ = (typeof $('#'+conditionId).attr('type') != 'undefined' ? $('#'+conditionId).attr('type').toLowerCase() : 'text');
                                    switch(typ){
                                    case 'text':
                                            $('#'+conditionId).val(conditionValue);
                                        break;
                                    case 'tel':
                                        $('#'+conditionId).val(conditionValue);
                                    break;
                                    case 'checkbox':
                                        if(conditionValue != ''){
                                            var nameraddio = $('#'+conditionId).attr('name');
                                            var tmp = conditionValue.split(', ');
                                            var arrvalue = [];
                                            $.each(tmp,function(ind,val){
                                                var tmp2 = val.split('.');
                                                if(typeof tmp2[0] != 'undefined'){
                                                    if(tmp2[0] != '') arrvalue.push(tmp2[0]);
                                                }
                                            });
                                            parent.$('input[name="'+nameraddio+'"]').each(function(){
                                                if($.inArray($(this).val(),arrvalue) > -1){
                                                    $(this).attr('checked','checked');
                                                }
                                            });
                                        }
                                        break;
                                    case 'radio':
                                        if(conditionValue != ''){
                                            var nameraddio = $('#'+conditionId).attr('name');
                                            var tmp = conditionValue.split(', ');
                                            var arrvalue = [];
                                            $.each(tmp,function(ind,val){
                                                var tmp2 = val.split('.');
                                                if(typeof tmp2[0] != 'undefined'){
                                                    if(tmp2[0] != '') arrvalue.push(tmp2[0]);
                                                }
                                            });
                                            parent.$('input[name="'+nameraddio+'"]').each(function(){
                                                if($.inArray($(this).val(),arrvalue) > -1){
                                                    $(this).attr('checked','checked');
                                                }
                                            });
                                        }
                                        break;
                                    default:
                                        $('#'+conditionId).val(conditionValue);
                                        break;
                                    }
                                }
                            }
                        });
                        $('select[trigger-data="true"]').trigger('change');
                    }else{
                        //$('select[trigger-data="true"]').trigger('change');
                        if(callback){
                            callback();
                        }
                    }
                },
                error:function(){
                    if(callback){
                        callback();
                    }
                }
            });
        }else{
            localStorage.setItem('reset',0);
        }
    } catch (e) {
        alert('getParamSearch' + e.message);
    }
}
/**
 * autoSendMail
 *
 * @author		:	viettd - 2015/12/15 - create
 * @author		:
 * @params		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function autoSendMail(from,mailTo,mailCC,mailBCC,mailSubject,mailBody,screenID) {
    try {
        $.ajax({
            type		:	'POST',
            url			:	'/mail/mail/send',
            dataType	:	'json',
            loading		:	true,
            data		:	{
                'from':from
            ,	'mailTo':mailTo
            ,	'mailCC':mailCC
            ,	'mailBCC':mailBCC
            ,	'mailSubject':mailSubject
            ,	'mailBody':mailBody
            ,	'screenID':screenID
            },
         success: function(res) {
             if(typeof callback !== 'undefined'){
                callback(res);
             }
         }
        });
    } catch (e) {
        alert('autoSendMail' + e.message);
    }
}
/**
 * get html contiditon
 *
 * @author		:	thanhnv - 2016/02/02 - create
 * @author		:
 * @params		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function getHtmlCondition(id){
    $('select option').each(function(){ $(this).attr('selected',this.selected); });
    $(id).find('input').each(function() {
        if( $(this).is('[type="text"]') || $(this).is('[type="tel"]') ) {
            $(this).attr('value', $(this).val());
            $('.date').removeClass('hasDatepicker');	//add by longvv at 201609012
            $('.date').next('img').remove();			//add by longvv at 201609012
            $('.month').parent().find('.hasYmpicker').remove(); //add quangnk 20161115
            $('.month').parent().find('img').remove()			//add quangnk 20161115
        }else if( $(this).is('[type="checkbox"]') ) {
             if( $(this).is(':checked') ) {
              $(this).attr('checked', true);
             } else {
                 $(this).removeAttr('checked');
             }
        }else if( $(this).is('[type="radio"]') ) {
             if( $(this).is(':checked') ) {
                      $(this).attr('checked', true);
                 } else {
                    $(this).removeAttr('checked');
                 }
            }
    });
    return $(id).html();
}
/**
 * input Latin characters only
 *
 * @author		:	phonglv - 2016/02/16 - create
 * @author		:
 * @params		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function inputLatinOnly(_this){
    if (_this.value.match(/[^A-Za-z0-9\s'\.,-\/#!$%\^&\*;:{}=\-_`~()+@]/g)) {
        _this.value = _this.value.replace(/[^A-Za-z0-9\s'\.,-\/#!$%\^&\*;:{}=\-_`~()+@]/g, '');
    }
}
//phonglv 2016/02/17
//latin class for inputing letters, space and special characters
$(document).on('blur', 'input.latin', function() {
    var VAL = $(this).val();

    var latin = /^[a-zA-Z0-9 !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/i;

    if (!latin.test(VAL)) {
        $(this).value = $(this).val('');
    }
});
//biennv 2016/04/21 override function errorStyle
var originalMethod = jQuery.fn.errorStyle;
jQuery.fn.extend({
    errorStyle: function(message, style) {
        $('.tab-error').removeClass('tab-error');
        originalMethod.apply(this, arguments);
        var elem = $('.textbox-error:first');
        if(elem.parents('.tab-pane:hidden').length > 0){
            var index = elem.parents('.tab-pane').index();
            $('.nav-tabs').find('li').eq(index).find('a').trigger('click');
        }
        $('.nav-tabs').find('li').each(function(index,val){
            if($('.tab-pane').eq(index).find('.textbox-error').length > 0){
                $('.nav-tabs').find('li').eq(index).find('a').addClass('tab-error');
            }
        });
    }
  });
/**
 * showLoading
 *
 * @author		:	viettd - 2016/04/14 - create
 * @author		:
 * @params		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function showLoading() {
    $('.div_loading').fadeIn('slow');
    $('.div_loading').removeClass('hidden');
}
/**
 * removeLoading
 *
 * @author		:	viettd - 2016/04/14 - create
 * @author		:
 * @params		:	null
 * @return		:	null
 * @access		:	public
 * @see			:
 */
function removeLoading(){
    $('.div_loading').fadeOut('slow');
    $('.div_loading').addClass('hidden');
};
/**
 * eventEnterSearch
 * @author  :   GiangNT - 2015/10/27 - create
 * @return
*/
function eventEnterSearch(obj) {
    try{
        /*$.each(obj, function(key, element) {
            if(key != 'page'){
                if(element.type == 'select') {
                    $(document).on('keydown', '#' + key, function(e) {
                        if(e.keyCode == 13){
                            e.preventDefault();
                        }
                    });
                }
                $(document).on('keyup', '#' + key, function(e) {
                    if(e.keyCode == 13){
                        $(':focus').focusout();
                        $('#btn-search').trigger('click');
                    }
                });
            }
        });*/
    }catch(e){
        alert('eventEnterSearch: ' + e.message);
    }
}

function setGetPrams(obj) {
    var param = '';
    $.each(obj, function(key, element) {
        param += '&' + key + '=' + encodeURI(element);
    });
    return param.slice( 1 );
}
function paddingCD(str,len) {
    var strReturn  ='';
    if(str !=''){
        var myRepeat = '';
        for (var i = 0; i < len; ++i) {
            myRepeat += '0';
        }
        strReturn = myRepeat+str;
        strReturn = strReturn.substring(strReturn.length -len,strReturn.length);
    }
    return strReturn;
}
/**
 * @author: GiangNT
 * @param {Object} selector
 * @param {Object} count
 */
function hoverGroup (selector, count, colorhover) {
    if(typeof count == 'undefined'){
        count = 1;
    }
    if(typeof colorhover == 'undefined'){
        colorhover = '#FCFCCD';
    }

    var selectorTr = selector + ' tbody tr';
    var eq, eq0, el, color;
    try {
    	$(selectorTr).die('mouseover');
    	$(selectorTr).die('mouseleave');
        $(document).on({
            mouseover: function(){
                if($(this).find('td.no-hover').length > 0){
                    return;
                }
                eq    = $(this).index();
                color = $(this).css("background-color");
                eq0   = eq - eq%count;
                var x = count;
                while(x--){
                    var index = eq0 + x;
                    el  = selector + ' tbody tr:eq(' + index +')';
                    $(el).css("background-color", colorhover);
                    eltd  = selector + ' tbody tr:eq(' + index +') td';
                    $(eltd).css("background-color", colorhover);
                }
            },
            mouseleave: function(){
                if($(this).find('td.no-hover').length > 0){
                    return;
                }
                var x = count;
                while(x--){
                    var index = eq0 + x;
                    el  = selector + ' tbody tr:eq(' + index +')';
                    eltd  = selector + ' tbody tr:eq(' + index +') td';
                    var style = $(el).attr('style').split(";");
                    for(var i = style.length - 1; i--;){
                        if (style[i].indexOf("background-color") != -1) style.splice(i, 1);
                    }
                    style = style.join(";");
                    $(el).attr('style', style);
                    $(eltd).attr('style', style);
                }
            }
        }, selectorTr);
    } catch (e){
        console.log(e);
    }
}
//decode html charactor
function htmlEntities(str) {
     if(str == undefined ) {
         str = '';
     }
 return str.replace( /&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
}
/**
 * tooltip format
 *
 * @author  :   hiepnv - 2016/07/13 - create
 * @author  :
 * @param 	:	error array ex ['e1','e2']
 */
function _formatTooltip(){
    try{
         $('.text-overfollow').each(function(i) {
              var i = 1;
              var colorText = '';
              var element = $(this)
                  .clone()
                  .css({display: 'inline', width: 'auto', visibility: 'hidden'})
                  .appendTo('body');

              if( element.width() <= $(this).width() ) {
               $(this).removeAttr('data-original-title');
              }

              element.remove();
             });
    }catch(e){
        alert('format tooltip '+e.message);
    }
}
/**
 * messageError
 *
 * @author  :   hiepnv - 2016/07/13 - create
 * @author  :
 * @param 	:	error array ex ['e1','e2']
 */
function messageError(error){
    try{
        var txt	=	'';
        if (!$('#msg').find('.error_title').length > 0){
            txt	=	'<p class="error_title">エラーメッセージ</p>'
            txt +=	'<ul class="error_content">';
            $.each(error, function(index,val){
                txt	+=	'<li>'+val+'</li>';
            });
            txt +=	'</ul>';
            $('#msg').removeClass('msgsucces');
            $('#msg').addClass('msgerror');
            $('#msg').append(txt);
        }else{
            $.each(error, function(index,val){
                txt	+=	'<li>'+val+'</li>';
            });
            $('#msg').removeClass('msgsucces');
            $('#msg').addClass('msgerror');
            $('#msg .error_content').append(txt);
        }
        $('#msg').show();
        document.body.scrollTop = 0;
        _focusErrorItem();
    }catch(e){
        alert(e.message);
    }
}

/**
 * initTextCombobox of function
 *
 * @author  :   GiangNT - 2015/05/19 - create
 * @param
 * @return
*/
function initTextCombobox() {
    $.widget( "custom.combobox", {
        _create: function() {
            this.wrapper = $( "<span>" ).addClass( "custom-combobox" ).insertAfter( this.element );
            this.element.hide();
            this._createAutocomplete();
        },

        _createAutocomplete: function() {
            var tabindex = this.element.attr('tabindex');
            var selected = this.element.children( ":selected" ),
            value = selected.val() ? selected.text() : "",
            id = this.element.attr("inputid");
            this.input = $( "<input />" )
            .appendTo( this.wrapper )
            .val( value )
            .attr( "title", "" )
            .attr( "maxlength", "60" )
            .attr( "id", id)
            .attr( "optionvalue", '-1')
            .attr( "tabindex", tabindex)
            .addClass( "form-control custom-combobox-input ui-widget ui-widget-content ui-corner-left" )
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: $.proxy( this, "_source" ),
                open: function() {
                    var maxWidth = Math.max.apply( null, $( '.ui-autocomplete:visible li a' ).map( function () {return $( this ).outerWidth( true );}).get() );
                    maxWidth += 40;
                    $('.ui-autocomplete:visible').width(maxWidth);
                }
            })
            .tooltip({
                tooltipClass: "ui-state-highlight"
            });

            this._on( this.input, {
                autocompleteselect: function( event, ui ) {
                    ui.item.option.selected = true;
                    this.input.attr("optionvalue", ui.item.option.value);
                    this._trigger( "select", event, {
                        item: ui.item.option
                    });

                },
                autocompletechange: function(event, ui) {
                    if(ui.item) {
                        this.input.trigger("change");
                    }
                }
            });
        },
        _source: function( request, response ) {
            var value = this.input.val();
            this.input.attr( "optionvalue", this.element.find('option:contains(' + value + ')').val());
            // var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
            response( this.element.children( "option" ).map(function() {
                var text = $.trim($( this ).text());
                return {
                    label: text,
                    value: text,
                    option: this
                };
            }) );
        },
        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        }
    });
}
/**
 * return date format
 *
 * @author  :   HiepNV - 2016/07/21 - create
 * @param : string
 * @return date ,713 -> 2016/07/13
*/
function autoFormatDate(str){
    var D_yy = '';
    var D_DTR = '';
    var D_val =  str.replace(/\//gi,'').replace(/_/gi,'');

    if((D_val =='') || (1*D_val==0)){
        return;
    }
    if(D_val.trim().length < 5){
        var cur = new Date();
        D_yy = cur.getFullYear();
        //Simple check
        var fullVal = ('00'+D_val.trim()).slice(-10);
        var dmVal = fullVal.slice(-4);
        var mVal = dmVal.substring(0,2);
        var dVal = D_val.slice(-2);
        if(dVal > 31 || dVal <= 0){
            return D_DTR;
        }else if(mVal > 12 || mVal <= 0){
            return D_DTR;
        }
        D_DTR = D_yy + "/" + dmVal.substring(0,2) + "/" + ("00" + D_val.trim()).slice(-2);
    }else if(D_val.trim().length <= 6){
        var d6 = ("00" + D_val.trim()).slice(-6);
        var d4 = ("00" + D_val.trim()).slice(-4);
        var d2 = ("00" + D_val.trim()).slice(-2);
        if(d2 * 1 > 31){
            return D_DTR;
        }
        D_DTR = "20" + d6.substring(0,2) + "/" + d4.substring(0,2) + "/" + d2;
    }else if(D_val.trim().length == 8){
        var d5 = D_val.trim().substring(5,6);
        if(D_val.trim().slice(-2)* 1 > 31){
            return D_DTR;
        }
        D_DTR = D_val.trim().substring(0,4) +  "/" + d5 + "/"+ D_val.trim().slice(-2);
    }
    return D_DTR;
}
var _returnCheck =0
/**
 * check From To
 * @param elecment
 * @param type
 * return : 1: must input
 * 			2: from >=to
 */
var _headerMessageError ='';
function checkFromTo( elecment ,type ){
    _returnCheck = 0
    $(".from").removeAttr("style")
    $(".to").removeAttr("style")
    try {
         $(elecment).each(function(i){
             if(!$(this).find('.from').prop("disabled")  ==true){
                 var Start =  $(this).find('.from').val().replace(":" , "");
                 var End  =  $(this).find('.to').val().replace(":" , "");
                 if(parseInt(Start) != 0 || parseInt(End) !=0){
                     if( (parseInt(Start) == 0 && parseInt(End) >=0 ) || (parseInt(End) == 0 && parseInt(Start) >=0 ) ){
                         _returnCheck = 2;
                         if(parseInt(Start) == 0){
                             $(this).find('.from').css('border','1px solid red');
                             _headerMessageError = $(this).find('.from').attr('headerError');
                         }
                         if(parseInt(End) == 0){
                             $(this).find('.to').css('border','1px solid red');
                             _headerMessageError = $(this).find('.to').attr('headerError');
                         }
                         return false
                     }
                     if(parseInt(Start) >= parseInt(End)){
                         _returnCheck = 1;
                         $(this).find('.from').css('border','1px solid red');
                         $(this).find('.to').css('border','1px solid red');
                        // $(this).find('.from').style.border = "thin dotted red";
                         return false
                     }

                 }
             }
         });
    } catch (e) {
        // TODO: handle exception
        alert("checkFromTo accc" + e);
    }


}

/**
 * change format Percent
 * @param element :
 * @param type : 1: 100$ , 2: 100.000,11
 */
function changeformatPercent(element , type){
    try {
        switch(type){
        case '1':
            var tmpValStr	=	$(element).val().replace(/,/g, '').replace(/%/g, '');
            var numberArr	=	tmpValStr.split(".");
            var decimal		=	(numberArr[0] != undefined && numberArr[0]!=''?numberArr[0].substring(0,2):0);
            var afterNumber	=	(numberArr[1] != undefined && numberArr[1]!=''?numberArr[1].substring(0,2):0);
            var tmpVal		=	1*(decimal+'.'+afterNumber);
            $(element).attr('percen',1);
            $(element).attr('decimal',2);
            $(element).attr('maxlength',5);
            if(tmpVal < 0){
                tmpVal	=	tmpVal*(-1);
            }
            $(element).val(priceFormat(tmpVal)+'%');
            break;
        case '2':
            $(element).removeAttr('negative');
            $(element).removeAttr('percen');
            $(element).removeAttr('decimal');
            $(element).attr('maxlength',9);
            $(element).val(priceFormat($(element).val().replace('%' , '')));
            break;
        case '':

            break;
        }

    } catch (e) {
        log(e)
    }
}

/**
 * Console.log in screen
 * @param message
 */
function log(message){
    console.log(message);
    console.log("------------------------->");
}

/**
 * initEvents
 *
 * @author      :   tuannq - 2016/08/08 - create
 * @author      :
 * @return      :   null
 * @access      :   public
 * @see         :
 */
function checkAll(idSelect, changeSelect) {

    $(document).on('click', idSelect, function(e){ 
        var tdFirst = $(changeSelect).find('tr td:first-child ');
        log(changeSelect);
        log(tdFirst);
        if($(this).prop('checked')){
            tdFirst.each(function(index) {
                if(!$(this).prop('checked')){
                    $(this).find('input[type="checkbox"]').prop('checked', true);
                }
            });
        } else{
            tdFirst.each(function() {
                if($(this).find('input[type="checkbox"]').prop('checked')){
                    $(this).find('input[type="checkbox"]').prop('checked', false);
                }
            });
        }
    });

    var itemCheck = changeSelect + ' tr td:first-child';
    var itemNotCheck = 'tr td:first-child input:checkbox:not(:checked)';


    if($(changeSelect).find(itemNotCheck).length == 0 && $(changeSelect).find('tr.first td:first-child').length != 0) {
            $(idSelect).prop('checked', true);
        }

    $(document).on('click', itemCheck, function(){
        if(!$(this).find('input[type="checkbox"]').prop('checked')){
            if($(idSelect).prop('checked')){
                $(idSelect).prop('checked', false);
            }
        }
        if($(changeSelect).find(itemNotCheck).length == 0) {
            $(idSelect).prop('checked', true);
        }
    });
}
/**
 * formatNumber
 * @author : Trinhnv - 2016/08/28
 * @param val
 * @param num
 * @param displayzero
 * @returns
 */
function formatNumber (val, num, displayzero) {
    try {
        if (!num) {
            num = 0;
        }
        console.log(val)
        if(!displayzero) {
            displayzero =  true;
        }
        if(val*1 == 0 && displayzero) {
            return '';
        } else if(val*1 == 0 && !displayzero) {
            return 0;
        } else {
            return addCommas(val);
        }

    } catch (e) {
        alert('formatNumber: ' + e.message);
    }
}
/**
 * @author : thanhnv - 2016/10/10
 * @param input
 * @param mode
 * @returns {String}
 */
function _formatTimeBlock5(input,mode){
    try {
        var result	=	'';
        var string	=	'';
        if ($(input).val().length==1){
            string	= padZeroRight($(input).val(), 3);
            string 	= padZeroLeft(string, 4);
        }else{
            string = padZeroRight($(input).val(), 4);
        }
        var reg1 = /^([0-9][0-9]):[0-5][0-9]$/;
        var reg2 = /^([0-9][0-9])[0-5][0-9]$/;
        if (string.match(reg1)) {
            var timeInt	=	1*string.replace(/:/gi,'');
            var minute	=	timeInt %100;
            var hour	=	Math.floor(timeInt/100);
            var totalMinute	=	hour*60 + minute;
            if(mode=='+5'){
                totalMinute	=	totalMinute+5;
            }else if(mode=='-5'){
                console.log('beffor',totalMinute);
                totalMinute	=	1*totalMinute-5;
                console.log('-5',totalMinute);
            }
            hour	=	Math.floor(1*totalMinute/60);
            minute	=	1*totalMinute%60;
            minute	=	(minute-minute%5);
            result	=	padZeroLeft(''+hour,2) + ':'+ padZeroLeft(''+minute,2);
            //result	=	string;//$(input).val(string);
        } else if (string.match(reg2)) {
            var	timeInt	=	1* string;
            var minute	=	timeInt %100;
            var hour	=	Math.floor(timeInt/100);
            var totalMinute	=	hour*60 + minute;
            if(mode=='+5'){
                totalMinute	=	1*totalMinute+5;
            }else if(mode=='-5'){
                console.log('beffor',totalMinute);
                totalMinute	=	1*totalMinute-5;
                console.log('-5',totalMinute);
            }
            hour	=	Math.floor(1*totalMinute/60);
            minute	=	1*totalMinute%60;
            minute	=	(minute-minute%5);
            result	=	padZeroLeft(''+hour,2) + ':'+ padZeroLeft(''+minute,2);
        } else {
            result	=	'';//$(input).val('');
        }
        if (!_validateTime30(result)) {
            console.log(result);
            result = '';//$(input).val('');
        }

        return result;
    } catch (e) {
        return '';
    }
}
function getlistfile($mode , $fromFolder ){
     try {
         var data		=	{};
         var localPath	= "";
         var filename 	= "";
         var sync		= "";
         data['mode']	=	$mode;
         data['fromFolder']	=$fromFolder ;

         $.ajax({
             type : 'POST',
             url : '/common/upload/getallfile/',
             data: data,
             success : function(res) {
                 log(res);
             }
         });
     } catch (e) {
         alert('.getlistfile' + e.message);
     }

}
function pad(n, width, z) {
	  z = z || '0';
	  n = n + '';
	  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}
/**
 * remove Other Month Date in fullCallendar
 * 
 * @author		:	HiepNV - 2016/11/22 - create
 * @author		:	
 * @return		:	null
 * @access		:	public
 * @see			:	
 */ 
function removeOtherMonthDate(){
	$('.fc-row').each(function(){
		var lengthDate = $(this).find('div.fc-bg .fc-other-month').length;
		if(lengthDate==7){
			$(this).css('display','none');
		}
	})
}
/**
 * Check CharacterSet
 * 
 * @author		:	HiepNV - 2016/11/28 - create
 * @param		:	string,character,type	
 * @return		:	boolean
 * @access		:	public
 * @see			:	checkCharacterSet ('string','katakana','halfsize')
 */
function checkCharacterSet(str,character,type){
	try{
		var err = 0;
		var noSbcRegex = '';
		if(type =='halfsize'){
			if(_validateFullSize(str)){
				err += 1;
			}else{
				if(character =='katakana'){
					noSbcRegex  = /([ｧ-ﾝﾞﾟ])/;
					for(var i=0;i < str.length;i++){
						if(!str[i].match(noSbcRegex)){
							err += 1;
						}
					}
				}
			}
		}else{
			if(!_validateFullSize(str)){
				err += 1;
			}else{
				if(character =='katakana'){
					noSbcRegex  = /([ァ-ン])/;
					for(var i=0;i < str.length;i++){
						if(!str[i].match(noSbcRegex)){
							err += 1;
						}
					}
				}
				if(character =='hiragana'){
					noSbcRegex  = /([ぁ-ん])/;
					for(var i=0;i < str.length;i++){
						if(!str[i].match(noSbcRegex)){
							err += 1;
						}
					}
				}
			}
		}
		if(err > 0){
			return false;
		}else{
			return true;
		}
	}catch(e){
		alert('checkCharacterSet '+e.message);
	}
}
