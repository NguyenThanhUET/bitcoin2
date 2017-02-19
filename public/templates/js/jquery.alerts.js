// jQuery Alert Dialogs Plugin
//
// Version 1.1
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 14 May 2009
//
// Visit http://abeautifulsite.net/notebook/87 for more information
//
// Usage:
//		jAlert( message, [title, callback] )
//		jConfirm( message, [title, callback] )
//		jPrompt( message, [value, title, callback] )
//
// History:
//
//		1.00 - Released (29 December 2008)
//
//		1.01 - Fixed bug where unbinding would destroy all resize events
//
// License:
//
// This plugin is dual-licensed under the GNU General Public License and the MIT License and
// is copyright 2008 A Beautiful Site, LLC.
//
/**
 * ****************************************************************************
 * MANNET
 * DIALOG
 * 
 * 処理概要		:	edit library jalert
 * 作成日		:	2015/09/23
 * 作成者		:	viettd – viettd@ans-asia.com
 * 
 * 更新日		:	
 * 更新者		:	
 * 更新内容		:	
 * 
 * @package		:	COMMON
 * @copyright	:	Copyright (c) ANS-ASIA
 * @version		:	1.0.0
 * ****************************************************************************
 */
(function($) {
	$.alerts = {
		// These properties can be read/written by accessing $.alerts.propertyName from your scripts at any time
		verticalOffset: -75,                // vertical offset of the dialog from center screen, in pixels
		horizontalOffset: 0,                // horizontal offset of the dialog from center screen, in pixels/
		repositionOnResize: true,           // re-centers the dialog on window resize
		overlayOpacity: 0.3,                // transparency level of overlay
		overlayColor: '#CCCCCC',               // base color of overlay
		draggable: true,                    // make the dialogs draggable (requires UI Draggables plugin)
		okButton: 'OK',         // text for the OK button
		cancelButton: 'CANCEL', // text for the Cancel button
		dialogClass: null,                  // if specified, this class will be applied to all dialogs
		// Public methods
		// alert
		alert: function(message, title, callback) {
			if( title == null ) title = '確認';
			$.alerts._show(title, message, null, 'alert', function(result) {
				if( callback ) callback(result);
			});
		},
		// confirm
		confirm: function(message, title, callback) {
			if( title == null ) title = '報告';
			$.alerts._show(title, message, null, 'confirm', function(result) {
				if( callback ) callback(result);
			});
		},
		// confirm-delete
		sendmail: function(message, title, callback) {
			if( title == null ) title = '報告';
			$.alerts._show(title, message, null, 'sendmail', function(result) {
				if( callback ) callback(result);
			});
		},
		// confirm-delete
		confirmDelete: function(message, title, callback) {
			if( title == null ) title = '報告';
			$.alerts._show(title, message, null, 'confirm-delete', function(result) {
				if( callback ) callback(result);
			});
		},
		// prompt
		prompt: function(message, value, title, callback) {
			if( title == null ) title = 'プロンプト';
			$.alerts._show(title, message, value, 'prompt', function(result) {
				if( callback ) callback(result);
			});
		},
		// warning
		warning: function(message, title, callback) {
			if( title == null ) title = '警告';
			$.alerts._show(title, message, null, 'warning', function(result) {
				if( callback ) callback(result);
			});
		},
		// prohibit
		prohibit: function(message, title, callback) {
			if( title == null ) title = '禁止';
			$.alerts._show(title, message, null, 'prohibit', function(result) {
				if( callback ) callback(result);
			});
		},
		//error
		error: function(message, title, callback) {
			if( title == null ) title = '禁止';
			$.alerts._show(title, message, null, 'error', function(result) {
				if( callback ) callback(result);
			});
		},
		// Private methods
		// show method
		_show: function(title, msg, value, type, callback) {
			$.alerts._hide();
			$.alerts._overlay('show');
			$("BODY").append(
			'<div id="popup_container">' +
				'<h1 id="popup_title"></h1>' +
				'<div id="popup_content">' +
					'<div id="popup_message"></div>' +
				'</div>' +
			'</div>');
			if( $.alerts.dialogClass ) $("#popup_container").addClass($.alerts.dialogClass);
			// IE6 Fix
			var pos = ($.browser.msie && parseInt($.browser.version) <= 6 ) ? 'absolute' : 'fixed';
			$("#popup_container").css({
				position: pos,
				zIndex: 999999,
				padding: 0,
				margin: 0
			});
			$("#popup_title").html(title);
			$("#popup_content").addClass(type);
			$("#popup_message").html(msg);
			$("#popup_message").html( $("#popup_message").text().replace(/\n/g, '<br />') );
			$("#popup_container").css({
				minWidth: $("#popup_container").outerWidth() + 5,
				maxWidth: $("#popup_container").outerWidth() + 5
			});
			$.alerts._reposition();
			$.alerts._maintainPosition(true);
			switch( type ) {
				case 'alert':
					$("#popup_message").after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						callback(true);
					});
					$("#popup_ok").focus().keypress( function(e) {
						if( e.keyCode == 13 || e.keyCode == 27 ) $("#popup_ok").trigger('click');
					});
				break;
				case 'confirm':
					
					$("#popup_message").after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button> <button id="popup_cancel">' + $.alerts.cancelButton + '</button></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						if( callback ) callback(true);
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback(false);
					});
					$("#popup_ok").focus();
					$("#popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 27 ) 
							$("#popup_cancel").trigger('click');
						if( e.keyCode == 13 ) 
							if($("#popup_ok").is(":focus"))
								$("#popup_ok").trigger('click');
							else if($("#popup_cancel").is(":focus"))
								$("#popup_cancel").trigger('click');
					});
				break;
				case 'sendmail':
					$("#popup_message").after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button> <button id="popup_cancel">' + $.alerts.cancelButton + '</button></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						if( callback ) callback(true);
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback(false);
					});
					$("#popup_ok").focus();
					$("#popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 27 ) 
							$("#popup_cancel").trigger('click');
						if( e.keyCode == 13 ) 
							if($("#popup_ok").is(":focus"))
								$("#popup_ok").trigger('click');
							else if($("#popup_cancel").is(":focus"))
								$("#popup_cancel").trigger('click');
					});
					$('#popup_panel').prepend('<div class="w-button-sendmail"><input type="checkbox" id="sendmail" />本登録後に自動で採用メールを送信する。</div>')
				break;
				case 'confirm-delete':
					$("#popup_message").after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button> <button id="popup_cancel">' + $.alerts.cancelButton + '</button></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						if( callback ) callback(true);
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback(false);
					});
					$("#popup_ok").focus();
					$("#popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 27 ) 
							$("#popup_cancel").trigger('click');
						if( e.keyCode == 13 ) 
							if($("#popup_ok").is(":focus"))
								$("#popup_ok").trigger('click');
							else if($("#popup_cancel").is(":focus"))
								$("#popup_cancel").trigger('click');
					});
				break;
				case 'prompt':
					$("#popup_message").append('<br /><input type="text" size="30" id="popup_prompt" />').after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button> <button id="popup_cancel">' + $.alerts.cancelButton + '</button></div>');
					$("#popup_prompt").width( $("#popup_message").width() );
					$("#popup_ok").click( function() {
						var val = $("#popup_prompt").val();
						$.alerts._hide();
						if( callback ) callback( val );
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback( null );
					});
					$("#popup_prompt, #popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 13 ) $("#popup_ok").trigger('click');
						if( e.keyCode == 27 ) $("#popup_cancel").trigger('click');
					});
					if( value ) $("#popup_prompt").val(value);
					$("#popup_prompt").focus().select();
				break;
				case 'warning':
					$("#popup_message").after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button> </div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						if( callback ) callback(true);
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback(false);
					});
					$("#popup_ok").focus();
					$("#popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 13 ) $("#popup_ok").trigger('click');
						if( e.keyCode == 27 ) $("#popup_cancel").trigger('click');
					});
					break;
				case 'prohibit':
					$("#popup_message").after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button> <button id="popup_cancel">' + $.alerts.cancelButton + '</button></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						callback(true);
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback( null );
					});
					$("#popup_ok").focus().keypress( function(e) {
						if( e.keyCode == 13 || e.keyCode == 27 ) $("#popup_ok").trigger('click');
					});
				break;
				case 'error':
					$("#popup_message").after('<div id="popup_panel"><button id="popup_ok">' + $.alerts.okButton + '</button></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						callback(true);
					});
					$("#popup_ok").focus().keypress( function(e) {
						if( e.keyCode == 13 || e.keyCode == 27 ) $("#popup_ok").trigger('click');
					});
				break;
				
			}
			// Make draggable
			if( $.alerts.draggable ) {
				try {
					$("#popup_container").draggable({ handle: $("#popup_title") });
					$("#popup_title").css({ cursor: 'move' });
				} catch(e) { /* requires jQuery UI draggables */ }
			}
		},
		// hide method
		_hide: function() {
			$("#popup_container").remove();
			$.alerts._overlay('hide');
			$.alerts._maintainPosition(false);
		},
		// overlay method
		_overlay: function(status) {
			switch( status ) {
				case 'show':
					$.alerts._overlay('hide');
					$("BODY").append('<div id="popup_overlay"></div>');
					$("#popup_overlay").css({
						position: 'absolute',
						zIndex: 100002,
						top: '0px',
						left: '0px',
						width: '100%',
						height: $(document).height(),
						background: $.alerts.overlayColor,
						opacity: $.alerts.overlayOpacity
					});
				break;
				case 'hide':
					$("#popup_overlay").remove();
				break;
			}
		},
		// reposition method
		_reposition: function() {
			var top = (($(window).height() / 2) - ($("#popup_container").outerHeight() / 2)) + $.alerts.verticalOffset;
			var left = (($(window).width() / 2) - ($("#popup_container").outerWidth() / 2)) + $.alerts.horizontalOffset;
			if( top < 0 ) top = 0;
			if( left < 0 ) left = 0;
			// IE6 fix
			if( $.browser.msie && parseInt($.browser.version) <= 6 ) top = top + $(window).scrollTop();
			$("#popup_container").css({
				top: top + 'px',
				left: left + 'px'
			});
			$("#popup_overlay").height( $(document).height() );
		},
		// _maintainPosition method
		_maintainPosition: function(status) {
			if( $.alerts.repositionOnResize ) {
				switch(status) {
					case true:
						$(window).bind('resize', $.alerts._reposition);
					break;
					case false:
						$(window).unbind('resize', $.alerts._reposition);
					break;
				}
			}
		}
	};
	// Shortuct functions
	// jAlert function
	jAlert = function(message, title, callback) {
		$.alerts.alert(message, title, callback);
	};
	// jConfirm function
	jConfirm = function(message, title, callback) {
		$.alerts.confirm(message, title, callback);
	};
	// jConfirm send mail function
	jSendmail = function(message, title, callback) {
		$.alerts.sendmail(message, title, callback);
	};
	// jConfirm function
	jConfirmDelete = function(message, title, callback) {
		$.alerts.confirmDelete(message, title, callback);
	};
	// jPrompt function
	jPrompt = function(message, value, title, callback) {
		$.alerts.prompt(message, value, title, callback);
	};
	// jWarning function
	jWarning = function(message, title, callback) {
		$.alerts.warning(message, title, callback);
	};
	// jProhibit function
	jProhibit = function(message, title, callback) {
//		$.alerts.error(message, title, callback);
		$.alerts.prohibit(message, title, callback);
	};
	// jError function
	jError = function(message, title, callback) {
		//$.alerts.prohibit(message, title, callback);
		$.alerts.error(message, title, callback);
	};
	//★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★
	// Create jMessage()
	//★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★
	jMessage = function(id, callback, options){
		message = '';
		if(options !=undefined){
			message = options;
		}else{
			message = _text[id];
		}
		if(_type[id]==1){
			jConfirm(message, _title[id], callback);
		}else if(_type[id]==2){
			jAlert(message, _title[id], callback);
		}else if(_type[id]==3){
			jProhibit(message, _title[id], callback);
		}else if(_type[id]==4){
			jError(message, _title[id], callback);
		}else if(_type[id]==5){
			jConfirmDelete(message, _title[id], callback);
		}else{
			jError('Unknow type message', null, callback);
		}
	};
})(jQuery);