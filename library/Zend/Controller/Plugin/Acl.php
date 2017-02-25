<?php
/**
 ****************************************************************************
 * ANS ASIA
 * ACL
 *
 * ????/process overview		:	Phân quy?n trong framework
 * ???/create date			:	2014/04/15
 * ???/creater				:	giangnt - giangnt@ans-asia.com
 *
 * ???/update date 			:	2015/09/22
 * ???/updater				:	viettd - viettd@ans-asia.com
 * ????	/update content		:	Update to mannet
 *
 * @package    	 				: 	ACL
 * @copyright   				: 	Copyright (c) ANS-ASIA
 * @version						: 	1.0.0
 * **************************************************************************
 */
class Zend_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {
	private $_acl;
	private $_auth;
	private $_user;
	private $_model;
	public function __construct (){
		$this->_acl   = new Zend_Acl();
		$this->_auth  = Zend_Auth::getInstance();
		$this->_model = new Model_DAO();
	}
	/**
	 * preDispatch
	 *
	 * @author      :   giangnt 	- 2014/04/15 - create
	 * @author      :   viettd 	- 2015/09/22 - modify
	 * @param       :   $request
	 * @return      :   null
	 * @access      :   public
	 * @see         :   Phân quy?n khi login
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		try{
			if(!$this->_auth->hasIdentity()) {
				return;
			}
			$this->_user 	= $this->_auth->getIdentity();
			$kind 			= $this->_user['permission'];
			$PUBLIC    		= 'PUBLIC';
			$ROLE      		= '';
			// FOR STAFF
			$member			= array();
			if(file_exists(APPLICATION_PATH . '/configs/permission.ini')){
				$memberConfig 		= new Zend_Config_Ini(APPLICATION_PATH . '/configs/permission.ini', 'member');
				$member 				= $memberConfig->member->controller->toArray();
				$adminConfig 		= new Zend_Config_Ini(APPLICATION_PATH . '/configs/permission.ini', 'admin');
				$admin 				= $adminConfig->admin->controller->toArray();
			}
			$default   = array(
			 	'register'
			, 	'login'
			,	'home'
			,	'face'
			,	'test'

			);
			$c_name = strtoupper($request->getControllerName());
			$a_name = strtoupper($request->getActionName());
			// Add a new role
			if(!$this->_acl->hasRole($PUBLIC)) {
				$this->_acl->addRole(new Zend_Acl_Role($PUBLIC));
			}
			$parents = array($PUBLIC);
			if(!$this->_acl->hasRole($ROLE)) {
				$this->_acl->addRole(new Zend_Acl_Role($ROLE), $parents);
			}
			// Add default resources
			foreach ($default as $rs) {
				if(!$this->_acl->has($rs)) {
					$this->_acl->add(new Zend_Acl_Resource($rs));
				}
				// Allow PUBLIC to see some pages
				$this->_acl->allow($PUBLIC, $rs);
			}
			if($kind == 1){
				for ($i = 0;$i < count($member);$i++){
					if(!$this->_acl->has(strtoupper($member[$i]))) {
						$this->_acl->add(new Zend_Acl_Resource(strtoupper($member[$i])));
					}
					$this->_acl->allow($PUBLIC, strtoupper($member[$i]));
				}
			}else if($kind==2){
				for ($i = 0;$i < count($admin);$i++){
					if(!$this->_acl->has(strtoupper($admin[$i]))) {
						$this->_acl->add(new Zend_Acl_Resource(strtoupper($admin[$i])));
					}
					$this->_acl->allow($PUBLIC, strtoupper($admin[$i]));
				}
			}
			if(!$this->_acl->isAllowed($ROLE, $c_name, $a_name)) {
				return $this->permissionDeny();
			}
		} catch(Exception $e) {
			return $this->permissionDeny();
		}
	}
	/**
	 * permissionDeny
	 *
	 * @author      :   viettd 	- 2015/06/22 - create
	 * @author      :   quangnk - 2015/06/28 - modify
	 * @param       :   type_of_param  - description
	 * @return      :   type_of_result - description
	 * @access      :   public/pravite/protected
	 * @see         :   remark
	 */
	protected function permissionDeny() {
		//$this->_auth->clearIdentity();
		return Zend_Controller_Action_HelperBroker::getStaticHelper('redirector')->setGotoUrl('/error/Error/page403');
	}
}
?>