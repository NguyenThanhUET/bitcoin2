<?php
/**
 * Class process email
 *
 * @category  ANS-ASIA
 * @package   Email
 * @copyright  Copyright (c) 2015 ANS-ASIA
 */
class Zend_Email
{
	/**
	 * Send mail
	 * * @param string $from thông tin người gửi
	 * @param string $mailTo danh sách nhận email gửi đi cách nhau bởi dấu ';'
	 * @param string $mailCC danh sách email được CC cách nhau bởi dấu ';'
	 * @param string $mailBCC danh sách email được BCC cách nhau bởi dấu ';'
	 * @param string $subject chủ đề email
	 * @param string $body Nội dung email
	 * @param string $attachment đường dẫn đến
	 */
	function sendMail($data){
		try{
			if(file_exists(APPLICATION_PATH . '/configs/mail.ini')){
				$mailConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/mail.ini', 'mail');
				if(isset($data['mailTo']) && $data['mailTo'] && isset($data['subject']) && $data['subject']){
					$config = array(
							'ssl'          => $mailConfig->mail->ssl
						,	'auth'         => $mailConfig->mail->auth
						,   'port'         => $mailConfig->mail->port
						,   'username'     => $mailConfig->mail->username
						,   'password'     => $mailConfig->mail->password
					);
					$from = $data['from'] != '' ? $data['from'] : $mailConfig->mail->system;
					$transport = new Zend_Mail_Transport_Smtp($mailConfig->mail->smtp, $config);
					$mail = new Zend_Mail('UTF-8');
					$to = explode(';', $data['mailTo']);
					foreach($to as $row){
						$mail->addTo(trim($row));
					}
					//
					if(isset($data['from']) &&  $data['from'] && filter_var($data['from'], FILTER_VALIDATE_EMAIL)){
						if(isset($data['fromName']) && $data['fromName']){
							$mail->setFrom($data['from'],$data['fromName']);
						}else{
							$mail->setFrom($data['from']);
						}
					}else{
						$mail->setFrom($mailConfig->mail->address, $mailConfig->mail->system);
					}
					//
					if(isset($data['mailCC']) && $data['mailCC']){
						$cc = explode(';', $data['mailCC']);
						foreach($cc as $row){
							$mail->addCc(trim($row));
						}
					}
					//
					if(isset($data['mailBCC']) && $data['mailBCC']){
						$bcc = explode(';', $data['mailBCC']);
						foreach($bcc as $row){
							$mail->addBcc(trim($row));
						}
					}
					//
					if(isset($data['subject']) && $data['subject']){
						$mail->setSubject($data['subject']);
					}
					// add header
					//$mail->addHeader($mailConfig->mail->system,date('Y/m/d H:i',microtime(true)),false);
					// html text
					$body = '';
					if(isset($data['body']) && $data['body'] != ''){
						$body = '<html><body>'.$data['body'].'</body></html>';
						$mail->setBodyHtml($body);
					}
					// Attachment
					if(isset($data['attachment']) && is_file($data['attachment'])){
						$fileNameMD5	=	$data['attachment'];
						$upload = new Zend_File_Transfer();
						$upload->addValidator('Size', false, 50000, $fileNameMD5);
						$finfo = new finfo;
						$fileinfo = $finfo->file($fileNameMD5, FILEINFO_MIME);
						$at = new Zend_Mime_Part(file_get_contents($fileNameMD5));
						$at->type = $fileinfo;
						$at->filename = $fileNameMD5;//$name;
						$at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
						$at->encoding = Zend_Mime::ENCODING_BASE64;
						$mail->addAttachment($at);
					}
					$mail->send($transport);
					$this->respon['status']		=	OK;
					$this->respon['message'] 	=	'send mail to '.$data['mailTo'].' sucess';
				}else{
					$this->respon['status']		=	NG;
					$this->respon['message'] 	=	'params error';
				}
			}else{
				$this->respon['status']		=	NG;
				$this->respon['message']	=	'Don\'t find file config mail';
			}
		}catch(Exception $e){
			$this->respon['status']		=	EX;
			$this->respon['message'] 	=	$e->getMessage();
		}
		return $this->respon;
	}
}
