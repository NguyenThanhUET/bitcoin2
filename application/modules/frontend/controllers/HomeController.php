<?php
class Frontend_HomeController extends Frontend_AppController {

	protected $model;
	protected $user;
	protected $auth;

	/**
	 * @author
	 * @package   Base
	 * @return    user, model
	 */
	public function init() {
		parent::init();
	}
	/**
	 * index home
	 */
	public function indexAction(){
		$this->_helper->layout->disablelayout();
		$this->view->title = 'Sign In';
		if ($this->auth->hasIdentity()) {
			$this->auth->clearIdentity();
		}
		if($this->getRequest()->isPost()) {
			$this->_helper->layout->disablelayout();
			$userName = $this->_getParam('username', '');
			$password = $this->_getParam('password', '');
			$isLogin	=	$this->login($userName,$password);
			if($isLogin == 1){
				$this->redirect('/frontend/member/main');
				die();
			}else{
				$this->view->errorMessage	=	'Username or password invalid  <br> <span style="margin-left: 70px;">Or your account is not active</span>';
			}
		}
	}
	/**
	 * loginAction
	 *
	 * @param       :   null
	 * @return      :   null
	 * @access      :   public
	 * @see         :
	 */
	public function login($userName,$password){
		if($this->getRequest()->isPost()){
			try {
				$txt	=	'$2a$10$1qAz2wSx3eDc4rFv5tGb5t';
				$params = array(
					$userName
				,   crypt($password, $txt)
				,	$this->get_client_ip()
				);
				$data = $this->model->executeSql('SPC_LOGIN_CUSTOMER_LST1', $params);
				if(isset($data[0][0]['islogin']) && 1*$data[0][0]['islogin']==1) {
					$this->respon['auth']['ID'] 					= $data[0][0]['ID'];
					$this->respon['auth']['FullName'] 				= $data[0][0]['FullName'];
					$this->respon['auth']['UserName'] 				= $data[0][0]['UserName'];
					$this->respon['auth']['Email'] 					= $data[0][0]['Email'];
					$this->respon['auth']['PeoplesIdentity'] 		= $data[0][0]['PeoplesIdentity'];
					$this->respon['auth']['Mobile'] 				= $data[0][0]['Mobile'];
					$this->respon['auth']['WalletAddress'] 			= $data[0][0]['WalletAddress'];
					$this->respon['auth']['adminWallet'] 			= $data[0][0]['adminWallet'];
					$this->respon['auth']['Password'] 				= $data[0][0]['Password'];

					$this->respon['auth']['permission'] 			= 1;
					$this->respon['auth']['referer'] 				= 1;

					$this->respon['auth']['acl'] 					= 1;
					$this->respon['auth']['AuthorityCD'] 			= 1;
					// save to strorage(session)
					$storage = $this->auth->getStorage();
					$storage->write($this->respon['auth']);
					return 1;
				} else {
					return 0;
				}
			} catch (Exception $e) {
				return 0;
			}
		}
	}
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

}
