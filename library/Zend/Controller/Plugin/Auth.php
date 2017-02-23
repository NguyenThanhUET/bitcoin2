<?php
/**
 ****************************************************************************
 * MANNET
 * Zend_Controller_Plugin_Auth
 *
 * ????/process overview		:	auth login
 * ???/create date			:	2015/09/18
 * ???/creater				:	viettd – viettd@ans-asia.com
 *
 * ???/update date 			:
 * ???/updater				:
 * ????	/update content		:
 *
 * @package    	 				: 	ZEND LIBRARY
 * @copyright   				: 	Copyright (c) ANS-ASIA
 * @version						: 	1.0.0
 * **************************************************************************
 */
class Zend_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract{
	private $allow = array(
		'logout',
		'login',
		'error',
		'home',
		'register',
		'log',
		'face',
		'test',
		'upload'
	);
	public function preDispatch(Zend_Controller_Request_Abstract $request){
		try {
			$module = strtolower($request->getModuleName());
			if($module != 'mail'){
				$error 		= false;
				if (!Zend_Auth::getInstance()->hasIdentity()) {
					$error = true;
				}else{
					$user = Zend_Auth::getInstance()->getIdentity();
					if(!isset($user['permission'])){
						$error = true;
					}
					$layout = Zend_Layout::getMvcInstance();
					$view = $layout->getView();
					$view->user       = $user;
					$view->request    = $request;
				}
				if( in_array($request->getControllerName(), $this->allow)) {
					$error = false;
				}
				//when error
				if($error){
					if(strtolower($request->getModuleName()) == 'common'
						&& strtolower($request->getControllerName()) == 'popup'){
						exit("<script>parent.$.colorbox.close();parent.window.location.href = '/frontend/r656';</script>");
					}
					if ($request->isXmlHttpRequest()) {
						// 					exit("<script>window.location.href = '/auth/login';</script>");
						exit("???????????????????????????????"); // add by viettd 2016/06/24
					} else {
						$request->setModuleName('auth')->setControllerName('Login')->setActionName('index')->setParam('backurl', $_SERVER['REQUEST_URI']);
					}
				}
			}
		} catch (Exception $e) {
			$this->getResponse()->setHttpResponseCode(403);
		}
	}
}