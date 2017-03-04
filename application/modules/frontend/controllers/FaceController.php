<?php

class Frontend_FaceController extends Frontend_AppController {

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
		$this->_config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/init_home.ini', 'home');
		//Amount
		$this->view->amountGHInt = $this->_config->home->amountGHInt;
		$this->view->amountPHInt = $this->_config->home->amountPHInt;
		$this->view->amount_add_tmp = $this->_config->home->amount_add_tmp;
		//person and visitor
		$this->view->visitorInit	=	rand($this->_config->home->visitorInitMin,$this->_config->home->visitorInitMax);
		$this->view->totalPerson	=	$this->_config->home->totalPerson;
		$this->view->refreshVistor	=	$this->_config->home->refresh_visitor;
		$this->view->visitMin		=	$this->_config->home->visitorInitMin;
		$this->view->visitMax		=	$this->_config->home->visitorInitMax;
		$dataInvest = $this->model->executeSql('SPC_GET_DASHBOARD_DATA_INFO', array());
		if(!empty($dataInvest[0][0])){
			$this->view->dataInvest	=	$dataInvest[0][0];
		}
		$plans = $this->model->executeSql('SPC_GET_PLAN_FEE', array());
		if (!empty($plans[0][0])) {
            $this->view->planA_amount = $plans[0][0]["amount"];
            $this->view->planA_recived = $plans[0][0]["recived"];
            $this->view->planA_duration = $plans[0][0]["duration"];
            $this->view->planA_daily = number_format((($this->view->planA_recived)/$this->view->planA_amount)*100/$this->view->planA_duration, 1, ",", '');

            $this->view->planB_amount = $plans[0][1]["amount"];
            $this->view->planB_recived = $plans[0][1]["recived"];
            $this->view->planB_duration = $plans[0][1]["duration"];
            $this->view->planB_daily = number_format((($this->view->planB_recived)/$this->view->planB_amount)*100/$this->view->planB_duration, 1, ",", '');

            $this->view->planC_amount = $plans[0][2]["amount"];
            $this->view->planC_recived = $plans[0][2]["recived"];
            $this->view->planC_duration = $plans[0][2]["duration"];
            $this->view->planC_daily = number_format((($this->view->planC_recived)/$this->view->planC_amount)*100/$this->view->planC_duration, 1, ",", '');
        }
	}
	/**
	 * index home
	 */
	public function indexAction(){

		$this->view->title = 'Home';
		$this->_helper->layout->setLayout('face_layout');
		$data = $this->model->executeSql('GET_LAST_TRAN_TMP', array());
		$listPolicy = $this->model->executeSql('GET_POLICY_HOME_LST1', array());

		if(!empty($data[0])){
			$this->view->data = $data[0];
		}
		if(!empty($listPolicy[0])){
			$this->view->listPolicy = $listPolicy[0];
		}
	}

	public function aboutusAction(){
		$this->view->title = 'About Us';
        $this->_helper->layout->disablelayout();
		///$this->_helper->layout->setLayout('face_layout');
	}

    public function featuresAction(){
        $this->view->title = 'Features';
        $this->_helper->layout->disablelayout();
        ///$this->_helper->layout->setLayout('face_layout');
    }

	public function termsAction(){
		$this->view->title = 'Terms & Conditions';
        $this->_helper->layout->disablelayout();
//		$this->_helper->layout->setLayout('face_layout');
	}

	public function faqAction(){
		$this->view->title = 'FQA';
        $this->_helper->layout->disablelayout();
//		$this->_helper->layout->setLayout('face_layout');
	}
	public function supportcentreAction(){
		$this->view->title = 'Support Centre';
        $this->_helper->layout->disablelayout();
//		$this->_helper->layout->setLayout('face_layout');
	}

}
