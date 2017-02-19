<?php
class Backend_TicketController extends Backend_AppController {

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
		$this->view->title = 'Ticket Management';
		$this->_helper->layout->setLayout('backend-layout');
		$params	=	array();
		$data = $this->model->executeSql('SPC_GET_ADMIN_TICKET_LIST', $params);
		if(!empty($data[0])){
			$this->view->data	=	$data[0];
		}
	}
	public function answerAction(){
		$this->_helper->layout->disablelayout();
		$this->_helper->viewRenderer->setNoRender();
		if($this->getRequest()->isPost()){
			try {
				$params 					= array_slice($this->getAllParams(), 3);
				//execute store procedure
				$data = $this->model->executeSql('SPC_TICKET_ANSWER_ACT1',$params);
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
