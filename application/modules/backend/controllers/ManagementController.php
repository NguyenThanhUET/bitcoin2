<?php
class Backend_ManagementController extends Frontend_AppController {

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
		$this->view->title = 'Dashboard';
		$this->_helper->layout->setLayout('backend-layout');
		$params	=	array();
		$data = $this->model->executeSql('SPC_GET_DASHBOARD_DATA_INFO', $params);
		$listfee	=	$this->model->executeSql('GET_FEE_AMOUNT_LIST', array());
		if(!empty($data[0][0])){
			$this->view->data	=	$data[0][0];
		}
		if(!empty($listfee[0])){
			$this->view->listfee	=	$listfee[0];
		}
	}
	/**
	 * index home
	 */
	public function customerAction(){
		$this->view->title = 'Customer Management';
		$this->_helper->layout->setLayout('backend-layout');
		$params	=	array();
		$data = $this->model->executeSql('SPC_GET_CUSTOMER_LST1', $params);
		if(!empty($data[0])){
			$this->view->data	=	$data[0];
		}
	}
	public function loggingAction(){
		$this->view->title = 'Customer Access Log';
		$this->_helper->layout->setLayout('backend-layout');
		$params	=	array();
		$data = $this->model->executeSql('SPC_GET_ACCESS_LOG', $params);
		if(!empty($data[0])){
			$this->view->data	=	$data[0];
		}
	}
	public function activecustomerAction(){
		$this->_helper->layout->disablelayout();
		$this->_helper->viewRenderer->setNoRender();
		if($this->getRequest()->isPost()){
			try {
				$params 					= array_slice($this->getAllParams(), 3);
				//execute store procedure
				$data = $this->model->executeSql('SPC_ACTIVE_CUSTOMER_ACT1',$params);
				//result
				if(isset($data[0][0]['success']) && 1*$data[0][0]['success']==1) {
					$this->respon['status'] = 1;
					$this->respon['error']  = 'Update Successfull';
				}else{
					$this->respon['status'] = 0;
					$this->respon['error']  = 'Update Error';
				}
			} catch (Exception $e){
				$this->respon['status'] 	= 0;
				$this->respon['error']  = 'Exception Error';
			}
			//
			$this->getHelper('json')->sendJson($this->respon);
		}
	}
	public function deletecustomerAction(){
		$this->_helper->layout->disablelayout();
		$this->_helper->viewRenderer->setNoRender();
		if($this->getRequest()->isPost()){
			try {
				$params = array_slice($this->getAllParams(), 3);
				//execute store procedure
				$data = $this->model->executeSql('SPC_DELETE_CUSTOMER_ACT1',$params);
				//result
				if(isset($data[0][0]['success']) && 1*$data[0][0]['success']==1) {
					$this->respon['status'] = 1;
					$this->respon['error']  = 'Update Successfull';
				}else{
					$this->respon['status'] = 0;
					$this->respon['error']  = 'Update Error';
				}
			} catch (Exception $e){
				$this->respon['status'] 	= 0;
				$this->respon['error']  = 'Exception Error';
			}
			//
			$this->getHelper('json')->sendJson($this->respon);
		}
	}


}
