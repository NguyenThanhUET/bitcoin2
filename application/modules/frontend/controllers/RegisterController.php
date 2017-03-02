<?php
class Frontend_RegisterController extends Frontend_AppController {
	/**
	 * @author
	 * @package   Base
	 * @return    user, logger, model
	 */
	public function init() {
		parent::init();
	}
	/**
	 * index home
	 */
	public function indexAction(){

		$this->_helper->layout->disablelayout();
		$this->view->title = 'Register';
		if($this->getRequest()->isPost()) {
			$params	=	array();
			$txt	=	'$2a$10$1qAz2wSx3eDc4rFv5tGb5t';
			$params['username'] 		=	$this->_request->getParam('username','');
			$params['fullname'] 		=	$this->_request->getParam('fullname','');
			$params['password']			=	crypt($this->_request->getParam('pass',''), $txt);
			$params['pin']				=	$this->_request->getParam('pin','');
			$params['phone']			=	$this->_request->getParam('phone','');
			$params['email']			=	$this->_request->getParam('email','');
			$params['bitaddress']		=	$this->_request->getParam('bitcoin','');
			$params['referer']			=	$this->_request->getParam('referer','');

			$params['client_ip']		=	$this->get_client_ip();
			$result	=	$this->save($params);
			if($result	==	1){
				$this->view->successMessage	=	'You have created account successful';
				$siteurl=$_SERVER['SERVER_NAME'];//'http://localhost.bitcoin:8080/';
				$siteDomain = $_SERVER['SERVER_NAME'];//'http://localhost.bitcoin:8080/';
				$sitelogin	= $_SERVER['SERVER_NAME'];//'http://localhost.bitcoin:8080/';
				$this->sendMailRegisSuccess($params['email'],$params['fullname'],$siteurl,$siteDomain,$sitelogin);
			}else if($result == -999){
				$this->view->errorMessage	=	'Create account failed';
			}else if($result	==	-1){
				$this->view->errorMessage	=	'Account already exists';
			}else if($result	==	-2){
				$this->view->errorMessage	=	'Sponosor dose not exists';
			}
			$this->view->params = $params;
		}
		$refer = $this->_request->getParam('r','-1');
		//echo $refer;die();
		if(1*$refer != -1){
			$this->view->referer	=	$refer;
			//echo $refer;die();
		}
	}
	/**
	 * index home
	 */
	public function resetpasswordAction(){
		$this->_helper->layout->disablelayout();
		$this->view->title = 'Reset Password';
		if($this->getRequest()->isPost()) {
			$params	=	array();
			$txt	=	'$2a$10$1qAz2wSx3eDc4rFv5tGb5t';
			$newpasword = $this->generateRandomString(6);
			$params['username'] =	$this->_request->getParam('username','');
			$params['password']	=	crypt($newpasword, $txt);

			$data = $this->model->executeSql('SPC_RESETPASS_CUSTOMER', $params);
			if (isset($data[0][0]['success']) && 1*$data[0][0]['success'] ==1){
				$this->view->successMessage	=	'Reset password successful <br>Please check your email and login';
				$email	=	$data[0][0]['Email'];
				$accountName	=	$data[0][0]['FullName'];
				$this->sendMailSetPass($email,$accountName,$newpasword);
				//send mail
			}else{
				$this->view->errorMessage	=	'Can not reset password, please contact administrator';
			}
		}

	}
	/**
	 * log out
	 */
	public function logoutAction() {
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		if ($this->auth->hasIdentity()) {
			$this->auth->clearIdentity();
		}
		$this->redirect('/frontend/home');
	}
	/**
	 * save data to database
	 */
	public function save($params) {
		try {

			$validate	=	$this->validate($params);
			if($validate == 1){
				$data = $this->model->executeSql('SPC_REGIS_CUSTOMER', $params);
				if (isset($data[0][0]['success']) && 1*$data[0][0]['success'] ==1){
					return 1;
				}
			}else{
				return $validate;
			}
		} catch (Exception $e) {
			return -999;
		}
	}
	//check duplicate vacxinorder
	public function validate($param){
		try {
			$input = array(
				$param['username']
			,	$param['email']
			,	$param['referer']
			);
			return $this->checkDuplicateOrder($input);
		} catch (Exception $e) {
			return -999;
		}
	}
	//check duplicate vacxinorder
	public function checkDuplicateOrder($param){
		try {
			$data = $this->model->executeSql('SPC_DUPLICATE_CUSTOMER', $param);
			if (isset($data[0][0]['success']) && 1*$data[0][0]['success'] ==1){
				return 1;
			}else if (isset($data[0][0]['success'])){
				return $data[0][0]['success'];
			}else {
				return -1;
			}
		} catch (Exception $e) {
			return -999;
		}
	}
	//send mail reset pass
	public function sendMailSetPass($sendMail,$accountName,$newpasword) {
		try {
			$iReturn = 0;
			if(file_exists(APPLICATION_PATH . '/configs/mail.ini')){
				$mailConfig 		= new Zend_Config_Ini(APPLICATION_PATH . '/configs/mail.ini', 'mail');
				$username 		=	$mailConfig->mail->username;
				$userpassword 	=	$mailConfig->mail->password;
				$send_to_email = $sendMail;
				$subject = 'Reset password information';
				$bodyText = 'Dear '.$accountName.',<br>';
				$bodyText.= 'Your reset password at '.date('Y/m/d').'<br>';
				$bodyText.= 'New password:'.$newpasword;
				//SMTP server configuration
				$smtpHost = $mailConfig->mail->smtp;
				$smtpConf = array(
					'auth' => 'login',
					'ssl' => 'tls',
				    'port'=> $mailConfig->mail->port,
					'username' => $username,
					'password' => $userpassword
				);

				$transport = new Zend_Mail_Transport_Smtp($smtpHost, $smtpConf);
				//Create email
				$mail = new Zend_Mail('UTF-8');
				$mail->setBodyHtml($bodyText);
				$mail->setFrom($userpassword, $userpassword);
				$mail->addTo($send_to_email,'');
				//$mail->addBcc($username,'');
				$mail->setSubject($subject);
				$mail->send($transport);
				$iReturn = 1;
			}else{
				$iReturn = 0;
			}
			return $iReturn;
		} catch (Exception $e) {
			$iReturn = 0;
		}
		return $iReturn;
	}
	//send mail register success
	public function sendMailRegisSuccess($sendMail,$accountName,$siteurl,$siteDomain,$sitelogin) {
		try {
		$iReturn = 0;
		if(file_exists(APPLICATION_PATH . '/configs/mail.ini')){
			$mailConfig 		= new Zend_Config_Ini(APPLICATION_PATH . '/configs/mail.ini', 'mail');
			$username 		=	$mailConfig->mail->username;
			$userpassword 	=	$mailConfig->mail->password;
			$send_to_email = $sendMail;
			$subject = 'Signup successful';
			$bodyText = 'Dear '.$accountName.',<br>';
			$bodyText.= 'Your signup to <a href="'.$siteurl.'">'.$siteDomain.' </a> at '.date('Y/m/d').'<br>';
			$bodyText.= 'Please sigup here:<a href="'.$sitelogin.'">'.$sitelogin.'</a>';
			//SMTP server configuration
			$smtpHost = $mailConfig->mail->smtp;
			$smtpConf = array(
				'auth' => 'login',
				'ssl' => 'tls',
				'port'=> $mailConfig->mail->port,
				'username' => $username,
				'password' => $userpassword
			);
			$transport = new Zend_Mail_Transport_Smtp($smtpHost, $smtpConf);
			//Create email
			$mail = new Zend_Mail('UTF-8');
			$mail->setBodyHtml($bodyText);
			$mail->setFrom($userpassword, $userpassword);
			$mail->addTo($send_to_email,'');
			$mail->addBcc($username,'');
			$mail->setSubject($subject);
			$mail->send($transport);
			$iReturn = 1;
		}else{
			$iReturn = 0;
		}
		return $iReturn;
		} catch (Exception $e) {
			$iReturn = $e->getMessage();
		}
		return $iReturn;
	}
	// Function to get the client IP address
	private function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
