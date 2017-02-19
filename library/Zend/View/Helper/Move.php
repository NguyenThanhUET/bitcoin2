<?php
/**
 ****************************************************************************
 * MOVE
 * Helper
 *
 * 処理概要/process overview		:	MOVE hepler
 * 作成日/create date			:	2016/04/29
 * 作成者/creater				:	HiepNV – hiepnv@ans-asia.com
 *
 * 更新日/update date 			:
 * 更新者/updater				:
 * 更新内容	/update content		:
 *
 * @package    	 				: 	MODULE NAME
 * @copyright   				: 	Copyright (c) ANS-ASIA
 * @version						: 	1.0.0
 * **************************************************************************
 */
class  Zend_View_Helper_Move extends Zend_View_Helper_Abstract {
    public $companyInformation = array();
    public $employeeInformation = array();
    protected $model;
    protected $user;
    protected $auth;
    public function move() {
        $this->model = new Model_DAO();
        $this->auth = Zend_Auth::getInstance();
        $this->user = $this->auth->getIdentity();
        $this->view->user = $this->user;
        return $this;
    }
    /**
     * show
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @param       :   type_of_param  - description
     * @return      :   type_of_result - description
     * @access      :   public
     * @see         :   show button function
     */
    public function genLeftMenu(){
        $html ='';
        if(1*$this->user['LoginType']==2){
            $html = file_get_contents('../application/layouts/scripts/customer_leftmenu.phtml');
        }else if(1*$this->user['LoginType']==3){
            $html = file_get_contents('../application/layouts/scripts/outsourcing_leftmenu.phtml');
        }else {
            $html = file_get_contents('../application/layouts/scripts/leftmenu.phtml');
        }
        return $html;
    }
    /**
     * @author	:	Trinhnv 2016/08/17
     * @return 	:	string
     * @see		:	show popup function
     */
    public function genMessage($message_no = 0, $targetId = '', $keyvalue1 = '', $keyvalue2 = '', $keyvalue3 = '') {
        $params = array($message_no,$targetId,$keyvalue1,$keyvalue2, $keyvalue3 );
        $img = '';
        if(isset($data[0][0]["MessageFlag"]) ){
            if($data[0][0]["MessageFlag"] == 0){
                $img = 'flag';
            } else {
                $img = 'plain-flag';
            }
        }
        $data = $this->model->executeSql('SPC_GET_NOTIFICATION', $params);
        $html = '';
        if(isset($data[0][0])) {

            $html ='<link rel="stylesheet" href="/templates/css/form/sys002_2.css?'.time().'"'.' type="text/css" />';

            $html .= '<div class="row message-popup ">';
            $html .= '<div class=" col-md-12 w-group-button-search padding-bottom-5 padding-right-5">';
            $html .= '★通知★';
            $html .= '<button class="min-w-38 btn-show-hide" id="btn-show-hide-popup" style="float:right;">一</button>';
            $html .= '<div class="div-show-hide-popup message-fee">';
            $html .= '		<div class="col-md-12 row-item">';
            $html .= '				<div class="col-md-3 m-div m-div-title">タイトル</div>';
            $html .= '				<div class="col-md-8 m-div l-w-item">';
            $html .= '						<input id="MessagePopup" readonly class="form-control" value="'.$data[0][0]["Message"].'">';
            $html .= '						</div>';
            $html .= '						<div class="col-md-1 no-padding-left" id="flag-popup">';
            $html .= '						<span class="img-check flag-click-popup click flg-btn-popup glyphicon glyphicon-flag '.$data[0][0]['FlagClass'].'" MessageNo="'.$data[0][0]["MessageNo"].'"';
            $html .= ' 						MessageFlag="'.$data[0][0]["MessageFlag"].'" style="font-size: 20px;padding-top: 0px;"></span>';
            $html .= '						</div>';
            $html .= '						</div>';
            $html .= '						<div class="col-md-12 no-padding-left">';
            $html .= '						<div class="pull-left">';
            $html .= '						<table class="tbl-desc">';
            $html .= '						<thead>';
            $html .= '						<tr>';
            $html .= '						<td >';
            $html .= '						<div class="form-rows">';
            $html .= '						○<label class="btn-copy-data w1s margin-left-6">';
            $html .= '						<span class="icon-flag-text glyphicon glyphicon-flag" messageflag="0" style="color:red;"></span>';
            $html .= '								</label>マークがついている通知は、一覧から消えません。</div>';
            $html .= '										</td>';
            $html .= '										</tr>';
            $html .= '										<tr>';
            $html .= '										<td >';
            $html .= '										<div>○「完了」を押下すると、トップ画面に戻ります。</div>';
            $html .= '										</td>';
            $html .= '										</tr>';
            $html .= '										</thead>';
            $html .= '										</table>';
            $html .= '										</div>';
            $html .= '										</div>';
            $html .= '										<div class="col-md-11 no-padding"><button id="btn-save-popup" class="btn-save-message margin-right-13">完了</button></div>';
            $html .= '										<div class="clearfix"></div>';
            $html .= '										</div>';
            $html .= '										</div>';
            $html .= '										</div>';
            $html .= '<script src="/templates/js/form/sys002_2.js?'.time().'"' .'></script>';
        }
        return $html;
    }
    /**
    * show
    *
    * @author      :   hiepnv 	- 2016/05/04 - create
    * @param       :   type_of_param  - description
    * @return      :   type_of_result - description
    * @access      :   public
    * @see         :   show button function
    */
    public function show($title=null, $buttonLeft = array(), $buttonRight = array(),$permission = 0) {
        $buttonLeftString 	= (sizeof($buttonLeft) == 0) ? '': $this->move()->genButtonLeft($buttonLeft,$permission);
        $buttonRightString 	= (sizeof($buttonRight) == 0) ? '': $this->move()->genButtonRight($buttonRight,$permission);
        // gen string html
        $html = '';
        $html .= '<div class="w-group-button">';
        $html .= '	<div class="container-fluid">';
        $html .= '		<div class="navbar-header">';
        $html .= '			<span type="button" class="navbar-toggle collapsed glyphicon glyphicon-collapse-down" data-toggle="collapse"';
        $html .= '				data-target="#bs-example-navbar-collapse-2" aria-expanded="false"></span>';
        $html .= '		</div>';
        $html .= '		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">';
        $html .= '			<ul class="w-button-left">'.$buttonLeftString;
        $html .= '			</ul>';
        $html .= '			<ul class="w-button-right">'.$buttonRightString;
        $html .= '			</ul>';
        $html .= '		</div>';
        $html .= '	</div>';
        $html .= '	<div class="clearfix"></div>';
        $html .= '</div>';
        // return html
        return $html;
    }
    /**
    * genButtonLeft function
    *
    * @author      :   hiepnv 	- 2016/05/04 - create
    * @author      :
    * @param       :   null
    * @return      :   null
    * @access      :   public
    * @see         :
    */
    public function genButtonLeft($items = array(),$permission = 0){
        // check permision
        $result = '';
        $searchButton 					= array('id'=>'btn-search','icon'=>'/templates/icon-button/search.png','label'=>'検索','permission'=>$permission);
        $updateButton 					= array('id'=>'btn-update','icon'=>'/templates/icon-button/add.png','label'=>'登録/更新','permission'=>$permission);
        $backButton 					= array('id'=>'btn-back','icon'=>'/templates/icon-button/undo.png','label'=>'戻る','permission'=>$permission);
        $updateButtonEST002				= array('id'=>'btn-close','icon'=>'/templates/icon-button/btn-lock.png','label'=>'確定','permission'=>$permission);
        $publishButtonEST002			= array('id'=>'btn-pulish','icon'=>'/templates/icon-button/btn_ON.png','label'=>'公開','permission'=>$permission);
        $updateButton006				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-apply.png','label'=>'依頼する','permission'=>$permission);
        $referCustomer006				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/btn-back.png','label'=>'表示する','permission'=>$permission);
        $referCustomer0062				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/btn-back.png','label'=>'仮登録戻る','permission'=>$permission);
        $orderButtonCus009				= array('id'=>'btn-request','icon'=>'/templates/icon-button/btn_irai.png','label'=>'発注','permission'=>$permission);
        $saveButtonCus009 				= array('id'=>'btn-save-cus009','icon'=>'/templates/icon-button/btn-apply.png','label'=>'登録','permission'=>$permission);
        //longvv add button Screen CHK002 at 2016/09/08
        $chk002print1					= array('id'=>'btn-chk002print1','icon'=>'/templates/icon-button/btn-print.png','label'=>'作業員名簿','permission'=>$permission);
        $chk002print2 					= array('id'=>'btn-chk002print2','icon'=>'/templates/icon-button/btn-print.png','label'=>'作業員名簿（全建）','permission'=>$permission);
        $gotoCHK003						= array('id'=>'btn-gotochk003','icon'=>'/templates/icon-button/btn-add.png','label'=>'事故入力','permission'=>$permission);
        // vuongvt add button Screen INV004 - 2016/10/03
        $btnConfirm 					= array('id'=>'btn-inv004-confirm','icon'=>'/templates/icon-button/btn-apply.png','label'=>'全て確定','permission'=>$permission);
         //ASI005 button reload data by longvv at 20160929
        $reloadButton 					= array('id'=>'btn-reload','icon'=>'/templates/icon-button/btn-reload.png','label'=>'最新','permission'=>$permission);
        //generate html of button left

        $updateEST006HFill007_OSC		= array('id'=>'btn-updateFil007','icon'=>'/templates/icon-button/unamused-emoticon-face-outlined-symbol.png','label'=>'お断り','permission'=>$permission);
        $updateEST006HFill007			= array('id'=>'btn-updateFil007','icon'=>'/templates/icon-button/btn_kotowaru.png','label'=>'お断り','permission'=>$permission);
        //bhn001
        $searchPartsButton 				= array('id'=>'btn-search-parts','icon'=>'/templates/icon-button/btn-search.png','label'=>'履歴検索','permission'=>$permission);
		//ASI005  by longvv at 20161116
		$updateButtonASI005				= array('id'=>'btn-confirm','icon'=>'/templates/icon-button/btn-lock.png','label'=>'お仕事確定','permission'=>$permission);
        $saveButtonASI005 				= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply.png','label'=>'登録','permission'=>$permission);
        //ASI007  by longvv at 20161116
		$confirmButtonASI007			= array('id'=>'btn-confirm','icon'=>'/templates/icon-button/btn-lock.png','label'=>'確定','permission'=>$permission);
        $contactButtonASI007 			= array('id'=>'btn-contact','icon'=>'/templates/icon-button/speech-bubble.png','label'=>'連絡','permission'=>$permission);
        //CHK002 by longvv at 20161128
        $contactButtonCHK002			= array('id'=>'btn-contact','icon'=>'/templates/icon-button/speech-bubble.png','label'=>'連絡','permission'=>$permission);
		$confirmButtonCHK002 			= array('id'=>'btn-confirm','icon'=>'/templates/icon-button/btn-lock.png','label'=>'作業完了確定','permission'=>$permission);
        $saveButtonCHK002 				= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply.png','label'=>'明細仮登録','permission'=>$permission);
        //longvv add button Screen CHK010 at 2016/12/07
        $confirmButtonCHK010			= array('id'=>'btn-confirmCHK010','icon'=>'/templates/icon-button/btn-lock.png','label'=>'作業完了確定更新','permission'=>$permission);
        foreach ($items as $item){
            $item_arr 	= $$item;
            $class 		= '';
            $disabled  	= '';
            if($item_arr['permission'] == 1){
                $class			 	= 'not-allow';
                $item_arr['id'] 	= '';
                $disabled			= 'disabled="disabled"';
            }
            else if($item_arr['permission'] != 3
                    && ($item == 'M002I_prososalDeleteButtonLeft' || $item == 'M002I_detailDeleteButtonLeft')
                    ){
                $class			 	= 'not-allow';
                $item_arr['id'] 	= '';
                $disabled			= 'disabled="disabled"';
            }
            if($item_arr['permission'] != 3 && (
                        $item == 'creditLimitApproveButtonLeft'
                    ||	$item == 'realContractProcessButtonLeft'
                    )
                ){
                $result .= '';
            }else{
                $result .= '<li id="'.$item_arr['id'].'" class="'.$class.'" '.$disabled.'>';
                $result .= '	<img src="'.$item_arr['icon'].'" />';
                $result .= '		<label class="text-item text-item-button">'.$item_arr['label'].'</label>';
                $result .= '</li>';
            }
        }
        return $result;
    }
    /**
     * genButtonRight function
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   $items - array name of button
     * @return      :   $result - string of button right
     * @access      :   public
     * @see         : 	return html of button right
     */
    public function genButtonRight($items=array(),$permission = 0){
        $result = '';
        //common button
        $searchButton 					= array('id'=>'btn-search','icon'=>'/templates/icon-button/btn-search.png','label'=>'検索','permission'=>$permission);
        $updateButton 					= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add.png','label'=>'登録/更新','permission'=>$permission);
        $updateButton2 					= array('id'=>'btn-update-2','icon'=>'/templates/icon-button/btn-add.png','label'=>'NGワーカー検索','permission'=>$permission);
        $updateButtonSch003 			= array('id'=>'btn-update-sch003','icon'=>'/templates/icon-button/btn-history-clock.png','label'=>'削除履歴','permission'=>$permission);
        $backButton 					= array('id'=>'btn-back','icon'=>'/templates/icon-button/btn-back.png','label'=>'戻る','permission'=>$permission);
        $backButton_OSC					= array('id'=>'btn-back','icon'=>'/templates/icon-button/btn-back-osc.png','label'=>'戻る','permission'=>$permission);
        $saveButton 					= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply.png','label'=>'登録','permission'=>$permission);
        $rec002SaveButton 				= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply.png','label'=>'日次確定','permission'=>$permission);
        $PrintRec006Button 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'未入金リスト','permission'=>$permission);
        $salaryPrintButton 				= array('id'=>'btn-sal-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'印刷','permission'=>$permission);
        $saveButton_OSC 				= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-appy-osc.png','label'=>'登録','permission'=>$permission);
        $addSys002						= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add.png','label'=>'予定登録','permission'=>$permission);
        $requestButton 					= array('id'=>'btn-request','icon'=>'/templates/icon-button/btn_irai.png','label'=>'依頼','permission'=>$permission);
        $deliveryButton 				= array('id'=>'btn-delivery','icon'=>'/templates/icon-button/btn-apply.png','label'=>'配信','permission'=>$permission);
        $printButton 					= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'ﾘｽﾄ出力','permission'=>$permission);
        $printButtonSch003 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-circus-tent.png','label'=>'イベント一覧','permission'=>$permission);
        $deleteButton 					= array('id'=>'btn-delete','icon'=>'/templates/icon-button/btn-delete.png','label'=>'削除','permission'=>$permission);
        //MST007S - button thanhnv add at 2016/06/20
        $updateButtonM017S 				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add.png','label'=>'新規登録','permission'=>$permission);
        $searchLoan						= array('id'=>'btn-search-loan','icon'=>'/templates/icon-button/btn-search.png','label'=>'貸出処理検索','permission'=>$permission);
        $referButtonM022I				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/MST022i.png','label'=>'回答者を選択する','permission'=>$permission);
        //generate html of button right
        // trinhnv 2016/07/04 w009
        $updateButtonW0091 				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add.png','label'=>'新規登録','permission'=>$permission);
        $updateButtonW0092 				= array('id'=>'btn-update-2','icon'=>'/templates/icon-button/btn-add.png','label'=>'申請者検索画面','permission'=>$permission);
        // trinhnv 2016/07/13 EST002
        $deleteButtonEST002 			= array('id'=>'btn-delete-estno','icon'=>'/templates/icon-button/btn-delete.png','label'=>'見積削除','permission'=>$permission);
        $updateButtonEST002				= array('id'=>'btn-add','icon'=>'/templates/icon-button/btn-lock.png','label'=>'確定','permission'=>$permission);
        $addButtonEST002				= array('id'=>'btn-add2','icon'=>'/templates/icon-button/btn-add.png','label'=>'明細追加','permission'=>$permission);
        $deleteButtonEST0022			= array('id'=>'btn-delete-detail','icon'=>'/templates/icon-button/btn-delete.png','label'=>'明細削除','permission'=>$permission);
        // trinhnv 2016/07/21 EST05
        $releaseButtonEST005			= array('id'=>'btn-release','icon'=>'/templates/icon-button/btn-delete.png','label'=>'確定解除','permission'=>$permission);
        $refuseButtonEST005				= array('id'=>'btn-refuse','icon'=>'/templates/icon-button/btn-add.png','label'=>'御断り','permission'=>$permission);
        //EST006H
        $confirmEST006H				    = array('id'=>'btn-confirm','icon'=>'/templates/icon-button/btn-lock.png','label'=>'確定','permission'=>$permission);
        $confirmEST006H_OSC			    = array('id'=>'btn-confirm','icon'=>'/templates/icon-button/padlock.png','label'=>'確定','permission'=>$permission);

        $updateEST006H				    = array('id'=>'btn-update006H','icon'=>'/templates/icon-button/reload.png','label'=>'更新','permission'=>$permission);
        $updateEST006H_OSC				= array('id'=>'btn-update006H','icon'=>'/templates/icon-button/reload_osc.png','label'=>'更新','permission'=>$permission);

        $updateEST006M				    = array('id'=>'btn_updateEST006M','icon'=>'/templates/icon-button/reload.png','label'=>'更新','permission'=>$permission);
        $updateEST006M_OSC			    = array('id'=>'btn_updateEST006M','icon'=>'/templates/icon-button/reload_osc.png','label'=>'更新','permission'=>$permission);

        // copy button sch007
        $copyButton						= array('id'=>'btn-copy','icon'=>'/templates/icon-button/add-documents.png','label'=>'コピー','permission'=>$permission);
        // button sch001
        $deleteHistoryButton			= array('id'=>'btn-delete-history','icon'=>'/templates/icon-button/btn-history-clock.png','label'=>'削除履歴','permission'=>$permission);
        $newButton						= array('id'=>'btn-new','icon'=>'/templates/icon-button/btn-apply.png','label'=>'新規作成','permission'=>$permission);
        $listeventButton				= array('id'=>'btn-list-event','icon'=>'/templates/icon-button/btn-circus-tent.png','label'=>'イベント一覧','permission'=>$permission);
        //customer
        $mailButton						= array('id'=>'btn-mail','icon'=>'/templates/icon-button/mail.png','label'=>'mail','permission'=>$permission);
        $confirmPointButton				= array('id'=>'btn-confirm-point','icon'=>'/templates/icon-button/dollar-coin-stack.png','label'=>'ポイント','permission'=>$permission);
        // customer006
        $referCustomer005				= array('id'=>'btn-refer005','icon'=>'/templates/icon-button/btn-add.png','label'=>'仮登録戻る','permission'=>$permission);
        $progress006					= array('id'=>'btn-progress','icon'=>'/templates/icon-button/btn-up.png','label'=>'プログレスバー','permission'=>$permission);
        $updateButton006				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-apply.png','label'=>'依頼する','permission'=>$permission);
        $referCustomer006				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/btn-back.png','label'=>'表示する','permission'=>$permission);
        $referCustomer0062				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/btn-back.png','label'=>'仮登録戻る','permission'=>$permission);
        $notification					= array('id'=>'btn-create-notification','icon'=>'/templates/icon-button/btn-chat.png','label'=>'ﾒｯｾｰｼﾞ作成','permission'=>$permission);
        //cus007
        $saveButton007 					= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply.png','label'=>'発注','permission'=>$permission);
        $customerPrintButton 			= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'印刷','permission'=>$permission);
        //cus009
        // cus008
        $copyButtonCUS008				= array('id'=>'btn-copy','icon'=>'/templates/icon-button/add-documents.png','label'=>'見積から作成','permission'=>$permission);
        $gotoCUS009						= array('id'=>'btn-goto005','icon'=>'/templates/icon-button/btn-add.png','label'=>'新規作成','permission'=>$permission);
        //longvv add button Screen CHK002 at 2016/09/08
        $gotoASI005						= array('id'=>'btn-gotoasi005','icon'=>'/templates/icon-button/btn-add.png','label'=>'差替・手当変更','permission'=>$permission);
        //inv001
        $saveButtonINV001 				= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply.png','label'=>'請求日報作成','permission'=>$permission);
        $savePrintINV008 				= array('id'=>'savePrintINV008','icon'=>'/templates/icon-button/btn-print.png','label'=>'出力/公開','permission'=>$permission);

        //ORD002
        $rejectButton 			        = array('id'=>'btn-reject-order','icon'=>'/templates/icon-button/btn_kotowaru.png','label'=>'御断り','permission'=>$permission);
        $orderConfirmButton 			= array('id'=>'btn-order-confirm','icon'=>'/templates/icon-button/btn-lock.png','label'=>'受注確定','permission'=>$permission);
        $cancelButton 					= array('id'=>'btn-cancel','icon'=>'/templates/icon-button/btn-lock-open.png','label'=>'確定解除','permission'=>$permission);
        $deleteButtonORD002			= array('id'=>'btn-delete-order','icon'=>'/templates/icon-button/btn-delete.png','label'=>'受注削除','permission'=>$permission);

        //longvv add button Screen ASI005A at 2016/09/14
        $gotoASI005C					= array('id'=>'btn-gotoasi005c','icon'=>'/templates/icon-button/btn-add.png','label'=>'受注明細一括作成','permission'=>$permission);
        //sal004
        $btnUpdateSal004 					= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-lock.png','label'=>'振込日設定','permission'=>$permission);
        $btnDeleteSal004 					= array('id'=>'btn-delete','icon'=>'/templates/icon-button/btn-lock-open.png','label'=>'振込日解除','permission'=>$permission);
        // sal006
        $modifySal006 					= array('id'=>'btn-modify','icon'=>'/templates/icon-button/btn-apply.png','label'=>'給与明細修正','permission'=>$permission);
        $delSal006 					    = array('id'=>'btn-delete','icon'=>'/templates/icon-button/btn-delete.png','label'=>'給与明細削除','permission'=>$permission);

        // salary 007
        $createSal007					= array('id'=>'btn-createData','icon'=>'/templates/icon-button/btn-add.png','label'=>'銀行データ作成','permission'=>$permission);
        // billing INV005
        $outputBillingButton 			= array('id'=>'btn-output-billing','icon'=>'/templates/icon-button/btn-print.png','label'=>'請求書','permission'=>$permission);
        $outputDetailBillingButton 		= array('id'=>'btn-output-detail-billing','icon'=>'/templates/icon-button/btn-print.png','label'=>'請求明細','permission'=>$permission);
        // sal003
        $createSal003 					= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply.png','label'=>'給与明細作成','permission'=>$permission);
        //INV007
        $updateButtonInv007			    = array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-apply.png','label'=>'更新','permission'=>$permission);
        $rollbackButtonInv007			= array('id'=>'btn-rollback','icon'=>'/templates/icon-button/btn-history-clock.png','label'=>'戻し','permission'=>$permission);
        //SAL002
        $printButtonSAL002 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'当日払リスト','permission'=>$permission);
          // wrk002
        $btnPDF							= array('id'=>'btn-pdf-wrk002','icon'=>'/templates/icon-button/btn_pdf.png','label'=>'出力','permission'=>$permission);
        $btnExcelWrk002                           = array('id'=>'btn-excel-wrk002','icon'=>'/templates/icon-button/excel.png','label'=>'出力','permission'=>$permission);
        $btnCSV							= array('id'=>'btn-csv-wrk002','icon'=>'/templates/icon-button/csv-file-format-extension.png','label'=>'CSV','permission'=>$permission);
        $btnExportl008					= array('id'=>'btnExportl008','icon'=>'/templates/icon-button/btn-print.png','label'=>'領収書','permission'=>$permission);
        $btnUpdateSal008				= array('id'=>'btnUpdateSal008','icon'=>'/templates/icon-button/btn-apply.png','label'=>'ワーカー情報更新','permission'=>$permission);
        $btnBillingSal005				= array('id'=>'btnBillingSal005','icon'=>'/templates/icon-button/btn-print.png','label'=>'領収書','permission'=>$permission);
        $btnProcessPaySal005			= array('id'=>'btnProcessPaySal005','icon'=>'/templates/icon-button/btn-apply.png','label'=>'支払処理','permission'=>$permission);
        $btnBackNotPaySal005			= array('id'=>'btnBackNotPaySal005','icon'=>'/templates/icon-button/btn_back-arrow.png','label'=>'未払に戻す','permission'=>$permission);
        $btnChangeDateSal005			= array('id'=>'btnChangeDateSal005','icon'=>'/templates/icon-button/btn-apply.png','label'=>'振込日設定','permission'=>$permission);
        $btnDateReleaseSal005			= array('id'=>'btnDateReleaseSal005','icon'=>'/templates/icon-button/btn-lock-open.png','label'=>'振込日解除','permission'=>$permission);
        $btnReturnUndeliveredSal005		= array('id'=>'btnReturnUndeliveredSal005','icon'=>'/templates/icon-button/btn_back-arrow.png','label'=>'未振込に戻す','permission'=>$permission);
        $btnCancelFinancialSal005		= array('id'=>'btnCancelFinancialSal005','icon'=>'/templates/icon-button/cancel.png','label'=>'金融機関取消','permission'=>$permission);
        $btnSaveSal005 					= array('id'=>'btnSaveSal005','icon'=>'/templates/icon-button/btn-apply.png','label'=>'ﾜｰｶｰ情報更新','permission'=>$permission);
        
        

        $btnSaveSal008					= array('id'=>'btnSaveSal008','icon'=>'/templates/icon-button/btn-add.png','label'=>'領収書ボタン','permission'=>$permission);
        // billing INV004
        $btnInv004Nohin					= array('id'=>'btn-nohin','icon'=>'/templates/icon-button/btn-print.png','label'=>'納品書','permission'=>$permission);
        $btnInv004NohinDetail			= array('id'=>'btn-nohin-detail','icon'=>'/templates/icon-button/btn-print.png','label'=>'納品明細書','permission'=>$permission);
        $btnInv004BillingButton 		= array('id'=>'btn-inv004-output-billing','icon'=>'/templates/icon-button/btn-print.png','label'=>'請求書','permission'=>$permission);
        $btnInv004DetailBillingButton 	= array('id'=>'btn-inv004-output-detail-billing','icon'=>'/templates/icon-button/btn-print.png','label'=>'請求明細','permission'=>$permission);
        //longvv add button Screen ASI005 at 2016/09/28
        $gotoASI012						= array('id'=>'btn-gotoasi012','icon'=>'/templates/icon-button/btn-add.png','label'=>'労働条件通知書','permission'=>$permission);
        $gotoASI013						= array('id'=>'btn-gotoasi013','icon'=>'/templates/icon-button/btn-add.png','label'=>'受注確認書','permission'=>$permission);
        $gotoASI005A					= array('id'=>'btn-gotoasi005a','icon'=>'/templates/icon-button/btn-add.png','label'=>'明細入力','permission'=>$permission);
        $gotoASI005F					= array('id'=>'btn-gotoasi005f','icon'=>'/templates/icon-button/btn-add.png','label'=>'差替ワーカー','permission'=>$permission);
        $gotoASI006						= array('id'=>'btn-gotoasi006','icon'=>'/templates/icon-button/btn-add.png','label'=>'ワーカー引当','permission'=>$permission);
        $gotoASI009						= array('id'=>'btn-gotoasi009','icon'=>'/templates/icon-button/btn-add.png','label'=>'外注引当','permission'=>$permission);
        $gotoASI010						= array('id'=>'btn-gotoasi010','icon'=>'/templates/icon-button/btn-add.png','label'=>'受注フリ','permission'=>$permission);
        $btnUpdateWorkerSAL008			= array('id'=>'btnUpdateWorkerSAL008','icon'=>'/templates/icon-button/btn-add.png','label'=>' ワーカー情報更新','permission'=>$permission);
        // OSP001
        $btnExportOSP001				= array('id'=>'btn-export','icon'=>'/templates/icon-button/btn-print.png','label'=>'外注支払月報','permission'=>$permission);
        $btnexportSal001				= array('id'=>'btnexportSal001','icon'=>'/templates/icon-button/btn-print.png','label'=>'領収書','permission'=>$permission);

        // OSP003
        $btnUpdateOSP003				= array('id'=>'btnUpdateOSP003','icon'=>'/templates/icon-button/btn-apply.png','label'=>'外注情報更新','permission'=>$permission);


        $btnPayemntSal001				= array('id'=>'btnPayemntSal001','icon'=>'/templates/icon-button/btn-print.png','label'=>'当日払リスト','permission'=>$permission);

        $updateButtonApp001 			= array('id'=>'btn-update001','icon'=>'/templates/icon-button/btn-add.png','label'=>'新規追加','permission'=>$permission);
        //CRM001
        $printButtonCRM001 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'出力','permission'=>$permission);
        //bhn001
        $searchPartsButton 				= array('id'=>'btn-search-parts','icon'=>'/templates/icon-button/btn-search.png','label'=>'履歴検索','permission'=>$permission);
        //URI004 by oba at 2016/11/08
        $printURI004Button 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'売上月報','permission'=>$permission);

        //URI003
        $searchClientButton 			= array('id'=>'btn-search-client','icon'=>'/templates/icon-button/btn-search.png','label'=>'エリア売上','permission'=>$permission);

        //URI005 by okamoto at 2016/11/15
        $printURI005Button 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'担当者別売上実績','permission'=>$permission);

        //URI001 by BinhNN at 2016/11/15
        $printURI001Button 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'請求一覧','permission'=>$permission);
        //URI002 at 2016/11/16
        $printURI002Button 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print.png','label'=>'締日別請求一覧表','permission'=>$permission);
        //EXP004
        $btnExportExp004					= array('id'=>'btnExportExp004','icon'=>'/templates/icon-button/btn-print.png','label'=>'出力','permission'=>$permission);
        $btnExportExp003					= array('id'=>'btnExportExp003','icon'=>'/templates/icon-button/btn-print.png','label'=>'CSV出力','permission'=>$permission);
        
        //REC004
        $btnDailyConfirm                    = array('id'=>'btn-daily-confirm','icon'=>'/templates/icon-button/btn-apply.png','label'=>'日次確定','permission'=>$permission);
        $btnPaymentList                    = array('id'=>'btn-payment-list','icon'=>'/templates/icon-button/btn-print.png','label'=>'入金リスト','permission'=>$permission);
        
        //EXP002
        $btnExportExp002                    = array('id'=>'btn-export','icon'=>'/templates/icon-button/btn-print.png','label'=>'経費集計','permission'=>$permission);

        $btnApplyWRK005                    = array('id'=>'btn-apply-wrk005','icon'=>'/templates/icon-button/btn-apply.png','label'=>'申請','permission'=>$permission);
        $btnReferWRK005                    = array('id'=>'btn-refer-to-wrk002','icon'=>'/templates/icon-button/btn-apply.png','label'=>'出退勤画面','permission'=>$permission);
        $btnRegisterAllWRK005              = array('id'=>'btn-register-all','icon'=>'/templates/icon-button/btn-apply.png','label'=>'一括','permission'=>$permission);
        $btnIndividualWRK005              = array('id'=>'btn-register-all','icon'=>'/templates/icon-button/btn-apply.png','label'=>'個別','permission'=>$permission);
        $btnApplyWRK005_2                 = array('id'=>'btn-apply-wrk005','icon'=>'/templates/icon-button/btn-apply.png','label'=>'登録','permission'=>$permission);
        foreach ($items as $key=>$item){
            // check group button
            if(is_array($item)){
                $result .= '<li class="btn-right dropdown w-list-button-print">';
                $result .= '	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                $result .= '		<label class="text-item text-item-button"><span class="glyphicon glyphicon-print print-dropdown"></span>帳票出力</label>';
                $result .= '	</a>';
                $result .= '	<ul class="dropdown-menu">';
                foreach ($item as $temp){
                    $temp_array = $$temp;
                    // check permision
                    $class 	= '';
                    $disabled  	= '';
                    if($temp_array['permission'] == 1){
                        $class 				= 'not-allow';
                        $temp_array['id'] 	= '';
                        $disabled			= 'disabled="disabled"';
                    }
                    // append result
                    $result .= '<li class="btn-right '.$class.'" id="'.$temp_array['id'].'" '.$disabled.'>';
                    $result .= '	<span class="'.$temp_array['icon'].'"></span>';
                    $result .= '		<label class="text-item text-item-button">'.$temp_array['label'].'</label>';
                    $result .= '</li>';
                }
                $result .= '	</ul>';
                $result .= '</li>';
            }else{
                $item_arr = $$item;
                // check permision
                $class 	= '';
                $disabled  	= '';
                if($item_arr['permission'] == 1){
                    $class 				= 'not-allow';
                    $item_arr['id'] 	= '';
                    $disabled			= 'disabled="disabled"';
                }
                //
                $result .= '<li class="btn-right '.$class.'" id="'.$item_arr['id'].'" '.$disabled.'>';
                $result .= '	<img src="'.$item_arr['icon'].'"/>';
                $result .= '		<label class="text-item text-item-button">'.$item_arr['label'].'</label>';
                $result .= '</li>';
            }
        }
        return $result;
    }
    /**
     * show customer
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @param       :   type_of_param  - description
     * @return      :   type_of_result - description
     * @access      :   public
     * @see         :   show button function
     */
    public function showCustomer($title=null, $buttonLeft = array(), $buttonRight = array(),$permission = 0) {
        $buttonLeftString 	= (sizeof($buttonLeft) == 0) ? '': $this->move()->genButtonLeftCustomer($buttonLeft,$permission);
        $buttonRightString 	= (sizeof($buttonRight) == 0) ? '': $this->move()->genButtonRightCustomer($buttonRight,$permission);
        // gen string html
        $html = '';
        $html .= '<div class="w-group-button">';
        $html .= '	<div class="container-fluid">';
        $html .= '		<div class="navbar-header">';
        $html .= '			<span type="button" class="navbar-toggle collapsed glyphicon glyphicon-collapse-down" data-toggle="collapse"';
        $html .= '				data-target="#bs-example-navbar-collapse-2" aria-expanded="false"></span>';
        $html .= '		</div>';
        $html .= '		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">';
        $html .= '			<ul class="w-button-left">'.$buttonLeftString;
        $html .= '			</ul>';
        $html .= '			<ul class="w-button-right">'.$buttonRightString;
        $html .= '			</ul>';
        $html .= '		</div>';
        $html .= '	</div>';
        $html .= '	<div class="clearfix"></div>';
        $html .= '</div>';
        // return html
        return $html;
    }
    /**
     * genButtonLeft Customer function
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   null
     * @return      :   null
     * @access      :   public
     * @see         :
     */
    public function genButtonLeftCustomer($items = array(),$permission = 0){
        // check permision
        $result = '';
        $searchButton 					= array('id'=>'btn-search','icon'=>'/templates/icon-button/btn-search-cus.png','label'=>'検索','permission'=>$permission);
        $updateButton 					= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add-cus-1.png','label'=>'登録/更新','permission'=>$permission);
        $backButton 					= array('id'=>'btn-back','icon'=>'/templates/icon-button/btn-back-cus.png','label'=>'戻る','permission'=>$permission);
        $updateButtonEST002				= array('id'=>'btn-close','icon'=>'/templates/icon-button/btn-lock.png','label'=>'確定','permission'=>$permission);
        $updateButton006				= array('id'=>'btn-request','icon'=>'/templates/icon-button/btn_irai-cus.png','label'=>'依頼する','permission'=>$permission);
        $referCustomer006				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/btn-preview-cus.png','label'=>'表示する','permission'=>$permission);
        $referCustomer0062				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/btn-preview-cus.png','label'=>'仮登録戻る','permission'=>$permission);
        $orderButtonCus009				= array('id'=>'btn-request','icon'=>'/templates/icon-button/btn_irai-cus.png','label'=>'発注','permission'=>$permission);
        $previewButtonCus009 			= array('id'=>'btn-preview-cus009','icon'=>'/templates/icon-button/btn-preview-cus.png','label'=>'表示する','permission'=>$permission);
        $previewButtonCus009 			= array('id'=>'btn-preview-cus009','icon'=>'/templates/icon-button/btn-preview-cus.png','label'=>'表示する','permission'=>$permission);
        //generate html of button left
        foreach ($items as $item){
            $item_arr 	= $$item;
            $class 		= '';
            $disabled  	= '';
            if($item_arr['permission'] == 1){
                $class			 	= 'not-allow';
                $item_arr['id'] 	= '';
                $disabled			= 'disabled="disabled"';
            }
            else if($item_arr['permission'] != 3
                    && ($item == 'M002I_prososalDeleteButtonLeft' || $item == 'M002I_detailDeleteButtonLeft')
                    ){
                        $class			 	= 'not-allow';
                        $item_arr['id'] 	= '';
                        $disabled			= 'disabled="disabled"';
            }
            if($item_arr['permission'] != 3 && (
                    $item == 'creditLimitApproveButtonLeft'
                    ||	$item == 'realContractProcessButtonLeft'
                    )
                    ){
                        $result .= '';
            }else{
                $result .= '<li id="'.$item_arr['id'].'" class="'.$class.'" '.$disabled.'>';
                $result .= '	<img src="'.$item_arr['icon'].'" />';
                $result .= '		<label class="text-item text-item-button">'.$item_arr['label'].'</label>';
                $result .= '</li>';
            }
        }
        return $result;
    }
    /**
     * genButtonRight function
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   $items - array name of button
     * @return      :   $result - string of button right
     * @access      :   public
     * @see         : 	return html of button right
     */
    public function genButtonRightCustomer($items=array(),$permission = 0){
        $result = '';
        //common button
        $searchButton 					= array('id'=>'btn-search','icon'=>'/templates/icon-button/btn-search-cus.png','label'=>'検索','permission'=>$permission);
        $updateButton 					= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'登録/更新','permission'=>$permission);
        $updateButton2 					= array('id'=>'btn-update-2','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'NGワーカー検索','permission'=>$permission);
        $updateButtonSch003 			= array('id'=>'btn-update-sch003','icon'=>'/templates/icon-button/btn-history-clock.png','label'=>'削除履歴','permission'=>$permission);
        $backButton 					= array('id'=>'btn-back','icon'=>'/templates/icon-button/btn-back-cus.png','label'=>'戻る','permission'=>$permission);
        $saveButton 					= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply-cus.png','label'=>'登録','permission'=>$permission);

        $saveButton_OSC					= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-appy-osc.png','label'=>'登録','permission'=>$permission);

        $requestButton 					= array('id'=>'btn-request','icon'=>'/templates/icon-button/btn_irai-cus.png','label'=>'依頼','permission'=>$permission);
        $deliveryButton 				= array('id'=>'btn-delivery','icon'=>'/templates/icon-button/btn-apply-cus.png','label'=>'配信','permission'=>$permission);
        $printButton 					= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print-cus.png','label'=>'ﾘｽﾄ出力','permission'=>$permission);
        $printButtonSch003 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-circus-tent.png','label'=>'イベント一覧','permission'=>$permission);
        $deleteButton 					= array('id'=>'btn-delete','icon'=>'/templates/icon-button/btn-delete-cus.png','label'=>'削除','permission'=>$permission);
        //MST007S - button thanhnv add at 2016/06/20
        $updateButtonM017S 				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'新規登録','permission'=>$permission);
        $searchLoan						= array('id'=>'btn-search-loan','icon'=>'/templates/icon-button/btn-search-cus.png','label'=>'貸出処理検索','permission'=>$permission);
        $referButtonM022I				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/MST022i.png','label'=>'回答者を選択する','permission'=>$permission);
        //generate html of button right
        // trinhnv 2016/07/04 w009
        $updateButtonW0091 				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'新規登録','permission'=>$permission);
        $updateButtonW0092 				= array('id'=>'btn-update-2','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'申請者検索画面','permission'=>$permission);
        // trinhnv 2016/07/13 EST002
        $deleteButtonEST002 			= array('id'=>'btn-delete-estno','icon'=>'/templates/icon-button/btn-delete-cus.png','label'=>'見積削除','permission'=>$permission);
        $updateButtonEST002				= array('id'=>'btn-add','icon'=>'/templates/icon-button/btn-lock.png','label'=>'確定','permission'=>$permission);
        $addButtonEST002				= array('id'=>'btn-add2','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'明細追加','permission'=>$permission);
        $deleteButtonEST0022			= array('id'=>'btn-delete-detail','icon'=>'/templates/icon-button/btn-delete-cus.png','label'=>'明細削除','permission'=>$permission);
        // trinhnv 2016/07/21 EST05
        $releaseButtonEST005			= array('id'=>'btn-release','icon'=>'/templates/icon-button/btn-delete-cus.png','label'=>'確定解除','permission'=>$permission);
        $refuseButtonEST005				= array('id'=>'btn-refuse','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'御断り','permission'=>$permission);
        //EST006H
        $updateEST006H				    = array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-apply-cus.png','label'=>'確定','permission'=>$permission);
        // copy button sch007
        $copyButton						= array('id'=>'btn-copy','icon'=>'/templates/icon-button/add-documents.png','label'=>'コピー','permission'=>$permission);
        // button sch001
        $deleteHistoryButton			= array('id'=>'btn-delete-history','icon'=>'/templates/icon-button/btn-history-clock.png','label'=>'削除履歴','permission'=>$permission);
        $newButton						= array('id'=>'btn-new','icon'=>'/templates/icon-button/btn-apply-cus.png','label'=>'新規作成','permission'=>$permission);
        $listeventButton				= array('id'=>'btn-list-event','icon'=>'/templates/icon-button/btn-circus-tent.png','label'=>'イベント一覧','permission'=>$permission);
        //customer
        $mailButton						= array('id'=>'btn-mail','icon'=>'/templates/icon-button/btn-mail-cus.png','label'=>'mail','permission'=>$permission);
        $confirmPointButton				= array('id'=>'btn-confirm-point','icon'=>'/templates/icon-button/btn-coin-cus.png','label'=>'ポイント','permission'=>$permission);
        // customer006
        $referCustomer005				= array('id'=>'btn-refer005','icon'=>'/templates/icon-button/CUS_double-checked.png','label'=>'仮登録戻る','permission'=>$permission);
        $progress006					= array('id'=>'btn-progress','icon'=>'/templates/icon-button/btn-up.png','label'=>'プログレスバー','permission'=>$permission);
        $updateButton006				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn_irai-cus.png','label'=>'依頼する','permission'=>$permission);
        $referCustomer006				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/CUS_preview.png','label'=>'表示する','permission'=>$permission);
        $referCustomer0062				= array('id'=>'btn-refer','icon'=>'/templates/icon-button/btn-preview-cus.png','label'=>'仮登録戻る','permission'=>$permission);
        $pdfCustomer009					= array('id'=>'btn-pdf','icon'=>'/templates/icon-button/btn-print-cus.png','label'=>'PDF','permission'=>$permission);
        $updateButton009				= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn_irai-cus.png','label'=>'発注する','permission'=>$permission);
        $notification					= array('id'=>'btn-create-notification','icon'=>'/templates/icon-button/speaker.png','label'=>'ﾒｯｾｰｼﾞ作成','permission'=>$permission);

        //cus007
        $saveButton007 					= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-apply-cus.png','label'=>'発注','permission'=>$permission);
        $customerPrintButton 			= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print-cus.png','label'=>'印刷','permission'=>$permission);
        //cus013
        //承認
        $bntApprove013					= array('id'=>'btnApprove','icon'=>'/templates/icon-button/CUS_Hinin.png','label'=>'否認','permission'=>$permission);
        //否認
        $bntDeny			 			= array('id'=>'btnDeny','icon'=>'/templates/icon-button/btn-apply-cus.png','label'=>'承認','permission'=>$permission);
        // cus008
        $copyButtonCUS008				= array('id'=>'btn-copy','icon'=>'/templates/icon-button/CUS_ESTCopy.png','label'=>'見積から作成','permission'=>$permission);
        $gotoCUS009						= array('id'=>'btn-goto005','icon'=>'/templates/icon-button/btn-add-cus.png','label'=>'新規作成','permission'=>$permission);
        // cus014
        $btnPDF							= array('id'=>'btn-pdf','icon'=>'/templates/icon-button/CUS_PDF.png','label'=>'出力','permission'=>$permission);
        // cus015
        $btnPDF1						= array('id'=>'btn-pdf1','icon'=>'/templates/icon-button/CUS_PDF.png','label'=>'納品書','permission'=>$permission);
        $btnPDF2						= array('id'=>'btn-pdf2','icon'=>'/templates/icon-button/CUS_PDF.png','label'=>'納品明細書','permission'=>$permission);
        //cus010
        $printButtonCUS010 				= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print-cus.png','label'=>'出力','permission'=>$permission);
        foreach ($items as $key=>$item){
            // check group button
            if(is_array($item)){
                $result .= '<li class="btn-right dropdown w-list-button-print">';
                $result .= '	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                $result .= '		<label class="text-item text-item-button"><span class="glyphicon glyphicon-print print-dropdown"></span>帳票出力</label>';
                $result .= '	</a>';
                $result .= '	<ul class="dropdown-menu">';
                foreach ($item as $temp){
                    $temp_array = $$temp;
                    // check permision
                    $class 	= '';
                    $disabled  	= '';
                    if($temp_array['permission'] == 1){
                        $class 				= 'not-allow';
                        $temp_array['id'] 	= '';
                        $disabled			= 'disabled="disabled"';
                    }
                    // append result
                    $result .= '<li class="btn-right '.$class.'" id="'.$temp_array['id'].'" '.$disabled.'>';
                    $result .= '	<span class="'.$temp_array['icon'].'"></span>';
                    $result .= '		<label class="text-item text-item-button">'.$temp_array['label'].'</label>';
                    $result .= '</li>';
                }
                $result .= '	</ul>';
                $result .= '</li>';
            }else{
                $item_arr = $$item;
                // check permision
                $class 	= '';
                $disabled  	= '';
                if($item_arr['permission'] == 1){
                    $class 				= 'not-allow';
                    $item_arr['id'] 	= '';
                    $disabled			= 'disabled="disabled"';
                }
                //
                $result .= '<li class="btn-right '.$class.'" id="'.$item_arr['id'].'" '.$disabled.'>';
                $result .= '	<img src="'.$item_arr['icon'].'"/>';
                $result .= '		<label class="text-item text-item-button">'.$item_arr['label'].'</label>';
                $result .= '</li>';
            }
        }
        return $result;
    }
    ////////////////////////
    /**
     * show outsourcing
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @param       :   type_of_param  - description
     * @return      :   type_of_result - description
     * @access      :   public
     * @see         :   show button function
     */
    public function showOutsourcing($title=null, $buttonLeft = array(), $buttonRight = array(),$permission = 0) {
        $buttonLeftString 	= (sizeof($buttonLeft) == 0) ? '': $this->move()->genButtonLeftOutsourcing($buttonLeft,$permission);
        $buttonRightString 	= (sizeof($buttonRight) == 0) ? '': $this->move()->genButtonRightOutsourcing($buttonRight,$permission);
        // gen string html
        $html = '';
        $html .= '<div class="w-group-button">';
        $html .= '	<div class="container-fluid">';
        $html .= '		<div class="navbar-header">';
        $html .= '			<span type="button" class="navbar-toggle collapsed glyphicon glyphicon-collapse-down" data-toggle="collapse"';
        $html .= '				data-target="#bs-example-navbar-collapse-2" aria-expanded="false"></span>';
        $html .= '		</div>';
        $html .= '		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">';
        $html .= '			<ul class="w-button-left">'.$buttonLeftString;
        $html .= '			</ul>';
        $html .= '			<ul class="w-button-right">'.$buttonRightString;
        $html .= '			</ul>';
        $html .= '		</div>';
        $html .= '	</div>';
        $html .= '	<div class="clearfix"></div>';
        $html .= '</div>';
        // return html
        return $html;
    }
    /**
     * genButtonLeft Customer function
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   null
     * @return      :   null
     * @access      :   public
     * @see         :
     */
    public function genButtonLeftOutsourcing($items = array(),$permission = 0){
        // check permision
        $result = '';
        $searchButton 					= array('id'=>'btn-search','icon'=>'/templates/icon-button/btn-search-cus.png','label'=>'検索','permission'=>$permission);
        $updateButton 					= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add-cus-1.png','label'=>'登録/更新','permission'=>$permission);
        $backButton 					= array('id'=>'btn-back','icon'=>'/templates/icon-button/btn-back-cus.png','label'=>'戻る','permission'=>$permission);
        //generate html of button left
        foreach ($items as $item){
            $item_arr 	= $$item;
            $class 		= '';
            $disabled  	= '';
            if($item_arr['permission'] == 1){
                $class			 	= 'not-allow';
                $item_arr['id'] 	= '';
                $disabled			= 'disabled="disabled"';
            }
            else if($item_arr['permission'] != 3
                    && ($item == 'M002I_prososalDeleteButtonLeft' || $item == 'M002I_detailDeleteButtonLeft')
                    ){
                        $class			 	= 'not-allow';
                        $item_arr['id'] 	= '';
                        $disabled			= 'disabled="disabled"';
            }
            if($item_arr['permission'] != 3 && (
                    $item == 'creditLimitApproveButtonLeft'
                    ||	$item == 'realContractProcessButtonLeft'
                    )
                    ){
                        $result .= '';
            }else{
                $result .= '<li id="'.$item_arr['id'].'" class="'.$class.'" '.$disabled.'>';
                $result .= '	<img src="'.$item_arr['icon'].'" />';
                $result .= '		<label class="text-item text-item-button">'.$item_arr['label'].'</label>';
                $result .= '</li>';
            }
        }
        return $result;
    }
    /**
     * genButtonRight function
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   $items - array name of button
     * @return      :   $result - string of button right
     * @access      :   public
     * @see         : 	return html of button right
     */
    public function genButtonRightOutsourcing($items=array(),$permission = 0){
        $result = '';
        //common button
        $searchButton 					= array('id'=>'btn-search','icon'=>'/templates/icon-button/btn-search-osc.png','label'=>'検索','permission'=>$permission);
        $updateButton 					= array('id'=>'btn-update','icon'=>'/templates/icon-button/btn-add-osc.png','label'=>'登録/更新','permission'=>$permission);
        $backButton 					= array('id'=>'btn-back','icon'=>'/templates/icon-button/btn-back-osc.png','label'=>'戻る','permission'=>$permission);
        $mailButton						= array('id'=>'btn-mail','icon'=>'/templates/icon-button/open-envelope.png','label'=>'mail','permission'=>$permission);
        $confirmPointButton				= array('id'=>'btn-confirm-point','icon'=>'/templates/icon-button/outsource-dollar-coin-stack.png','label'=>'ポイント','permission'=>$permission);
        $saveButton_OSC					= array('id'=>'btn-save','icon'=>'/templates/icon-button/btn-appy-osc.png','label'=>'登録','permission'=>$permission);
        $btnPrint						= array('id'=>'btn-print','icon'=>'/templates/icon-button/btn-print_osc.png','label'=>'名簿出力','permission'=>$permission);
        //osc 009
        $updateButtonOSC009				= array('id'=>'btn-update','icon'=>'/templates/icon-button/checked(4).png','label'=>'更新','permission'=>$permission);
        $rollbackButtonOSC009			= array('id'=>'btn-rollback','icon'=>'/templates/icon-button/backward-time.png','label'=>'更新戻し','permission'=>$permission);

        foreach ($items as $key=>$item){
            // check group button
            if(is_array($item)){
                $result .= '<li class="btn-right dropdown w-list-button-print">';
                $result .= '	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                $result .= '		<label class="text-item text-item-button"><span class="glyphicon glyphicon-print print-dropdown"></span>帳票出力</label>';
                $result .= '	</a>';
                $result .= '	<ul class="dropdown-menu">';
                foreach ($item as $temp){
                    $temp_array = $$temp;
                    // check permision
                    $class 	= '';
                    $disabled  	= '';
                    if($temp_array['permission'] == 1){
                        $class 				= 'not-allow';
                        $temp_array['id'] 	= '';
                        $disabled			= 'disabled="disabled"';
                    }
                    // append result
                    $result .= '<li class="btn-right '.$class.'" id="'.$temp_array['id'].'" '.$disabled.'>';
                    $result .= '	<span class="'.$temp_array['icon'].'"></span>';
                    $result .= '		<label class="text-item text-item-button">'.$temp_array['label'].'</label>';
                    $result .= '</li>';
                }
                $result .= '	</ul>';
                $result .= '</li>';
            }else{
                $item_arr = $$item;
                // check permision
                $class 	= '';
                $disabled  	= '';
                if($item_arr['permission'] == 1){
                    $class 				= 'not-allow';
                    $item_arr['id'] 	= '';
                    $disabled			= 'disabled="disabled"';
                }
                //
                $result .= '<li class="btn-right '.$class.'" id="'.$item_arr['id'].'" '.$disabled.'>';
                $result .= '	<img src="'.$item_arr['icon'].'"/>';
                $result .= '		<label class="text-item text-item-button">'.$item_arr['label'].'</label>';
                $result .= '</li>';
            }
        }
        return $result;
    }
    ///////////////////////////////////////////////////////////////
    /**
     * showCreateUpdate function
     *
     * @author      :   hiepnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   $items - array name of button
     * @return      :   $result - string of button right
     * @access      :   public
     * @see         : 	return html of create or update information
     */
    public function showCreateUpdate($data = array()){
        $html = '';
        $makeID = '';
        $makeName = '';
        $updateID = '';
        $updateName = '';
        $makeTime = '';
        $updateTime = '';
        $strMake ='';
        $strUpdate ='';
        $html .= '<div class="col-md-12 w-info-update">';
        if(isset($data) && !empty($data)){
            $makeID = $data['MakeID']=='' ? '' : $data['MakeID'].': ';
            $makeID = $makeID != '' ? substr(str_repeat('0',10).$makeID,-12):$makeID ;
            $makeName = $data['MakeName'];
            $updateID = $data['UpdateID']=='' ? '' : $data['UpdateID'].':';
            $updateID = $updateID != '' ? substr(str_repeat('0',10).$updateID,-11):$updateID ;
            $updateName = $data['UpdateName'];
            $makeTime = $data['MakeTime'] =='' ? '' : ' ['.$data['MakeTime'].']';
            $updateTime = $data['UpdateTime'] =='' ? '' : ' ['.$data['UpdateTime'].']';
            $strMake = 	$makeID.$makeName.$makeTime;
            $strUpdate = $updateID.$updateName.$updateTime;

            $html .= '<div class="pull-right">';
            $html .= '	<table class="tbl-create-update" style="margin-right: 37px;width:100%">';
            $html .= '		<thead>';
            $html .= '			<tr>';
            $html .= '				<th width="100px" class="text-align-center">登録</th>';
            $html .= '				<th width="320px">';
            $html .= '					<div class="text-overfollow" style="max-width:310px" data-container="body" data-toggle="tooltip"';
            $html .= '						data-original-title="'.$strMake.'">';
            $html .= 						$strMake;
            $html .= '					</div>';
            $html .= '				</th>';
            $html .= '				<th width="100px" class="text-align-center">更新</th>';
            $html .= '				<th width="320px">';
            $html .= '					<div class="text-overfollow" style="max-width:310px" data-container="body" data-toggle="tooltip"';
            $html .= '						data-original-title="'.$strUpdate.'">';
            $html .= 						$strUpdate;
            $html .= '					</div>';
            $html .= '				</th>';
            $html .= '			</tr>';
            $html .= '		</thead>';
            $html .= '	</table>';
            $html .= '</div>';
        }else{
            $html .= '<div class="pull-right">';
            $html .= '	<table class="tbl-create-update" style="margin-right: 37px;width:100%">';
            $html .= '		<thead>';
            $html .= '			<tr>';
            $html .= '				<th width="100px" class="text-align-center">登録</th>';
            $html .= '				<th width="320px">';
            $html .= '					<div class="text-overfollow" style="max-width:310px" data-container="body" data-toggle="tooltip"';
            $html .= '						data-original-title="">';
            $html .= '					</div>';
            $html .= '				</th>';
            $html .= '				<th width="100px" class="text-align-center">更新</th>';
            $html .= '				<th width="320px">';
            $html .= '					<div class="text-overfollow" style="max-width:310px" data-container="body" data-toggle="tooltip"';
            $html .= '						data-original-title="">';
            $html .= '					</div>';
            $html .= '				</th>';
            $html .= '			</tr>';
            $html .= '		</thead>';
            $html .= '	</table>';
            $html .= '</div>';
        }
        $html .= '</div">';
        $html .= '<div class="clearfix"></div>';
        return $html;
    }
    /**
    * showLoginInformation
    *
    * @author      :   hiepnv 	- 2016/05/04 - create
    * @author      :
    * @param       :   null
    * @return      :   null
    * @access      :   public
    * @see         :
    */
    public function showLoginInformation(){
        $params = $this->user;
        $staffCd			=	'';
        $staffName 			=	'';
        $areaCd				=	'';
        $areaName			=	'';
        $officeCd			=	'';
        $officeName			=	'';

        $result = '';
        if(isset($params)){
            $staffCd			=	isset($params['StaffCD']) ? $params['StaffCD'] : '';
            $staffCd			=	substr('0000000000'.$staffCd,-10);
            $staffName			=	isset($params['StaffName']) ? $params['StaffName'] : '';
            $areaCd				=	isset($params['AreaCD']) ? $params['AreaCD'] : '';
            $areaCd				=	substr('0000'.$areaCd,-4);
            $areaName			=	isset($params['AreaName']) ? $params['AreaName'] : '';
            $officeCd			=	isset($params['OfficeCD']) ? $params['OfficeCD'] : '';
            $officeName			=	isset($params['OfficeName']) ? $params['OfficeName'] : '';
            $strTitle			=	$areaCd .' : '. $officeName.' ('.$staffCd .' : '.$staffName.') '.$this->getCurrentDateJp();
            $result 			.= '<div style="max-width:600px;" class="login-info" data-toggle="tooltip" data-placement="bottom"
                                    title="" data-original-title="'.$strTitle.'">';
            $result 			.= $strTitle;
            $result 			.= 	'</div>';

        }
        return $result;
    }
    /**
     * showWorkerLoginInformation for Mobile
     *
     * @author      :   thanhnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   null
     * @return      :   null
     * @access      :   public
     * @see         :
     */
    public function showWorkerLoginInformation(){
        $params = $this->user;
        $workerCd			=	'';
        $workerName 		=	'';
        $officeName			=	'';

        $result = '';
        if(isset($params)){
            $workerCd			=	isset($params['WorkerID']) ? $params['WorkerID'] : '';
            $workerCd			=	substr('00000000'.$workerCd,-8);
            $workerName			=	isset($params['WorkerName']) ? $params['WorkerName'] : '';
            $officeName			=	isset($params['OfficeName']) ? $params['OfficeName'] : '';
            $strTitle			=	$officeName.' '.$workerCd .' '.$workerName;
            $result 			.= '<div class="pull-right w-info-user"><div class="login-info pull-left w-officename" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'.$strTitle.'">';
            $result 			.= $officeName;
            $result 			.= 	'</div>';
            $result 			.= '<div class="login-info pull-right w-workername">';
            $result 			.= $workerCd.' '.$workerName;
            $result 			.= 	'</div></div>';

        }
        return $result;
    }
    /**
     * showCustomerLoginInformation for Mobile
     *
     * @author      :   thanhnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   null
     * @return      :   null
     * @access      :   public
     * @see         :
     */
    public function showCustomerLoginInformation(){
        $params = $this->user;
        $workerCd			=	'';
        $workerName 		=	'';
        $officeName			=	'';

        $result = '';
        if(isset($params)){
            $dayWeek			=	isset($params['DayWeek']) ? $params['DayWeek'] : '';
            $AreaCd				=	isset($params['AreaCD']) ? $params['AreaCD'] : '';
            $OfficeName			=	isset($params['OfficeName']) ? $params['OfficeName'] : '';
            $customerCd			=	isset($params['OtherStaffCD']) ? $params['OtherStaffCD'] : '';
            $clientName			=	isset($params['ClientName']) ? $params['ClientName'] : '';
            $customerCd			=	substr('0000'.$customerCd,-4);
            $customerName		=	isset($params['OtherStaffName']) ? $params['OtherStaffName'] : '';
            $strTitle			=	$clientName.' 様 '.$customerCd .': '.$customerName.' 様 '.date('Y').'年'. date('m').'月'. date('d').'日'.'('.$dayWeek.')';

            $result 			.= '<div style="max-width:600px;" class="login-info" data-toggle="tooltip" data-placement="bottom"
                                    title="" data-original-title="'.$strTitle.'">';
            $result 			.= $strTitle;
            $result 			.= 	'</div>';

        }
        return $result;
    }
    /**
     * showOutSourcingLoginInformation for Mobile
     *
     * @author      :   thanhnv 	- 2016/05/04 - create
     * @author      :
     * @param       :   null
     * @return      :   null
     * @access      :   public
     * @see         :
     */
    public function showOutSourcingLoginInformation(){
        $params = $this->user;
        $workerCd			=	'';
        $workerName 		=	'';
        $officeName			=	'';
        $gaichuName			=	'';
        $result = '';
        if(isset($params)){
            $gaichuName			=	isset($params['GaichuName'])?$params['GaichuName']:'';
            $dayWeek			=	isset($params['DayWeek']) ? $params['DayWeek'] : '';
            $AreaCd				=	isset($params['AreaCD']) ? $params['AreaCD'] : '';
            $AreaCd				=	substr('0000'.$AreaCd,-4);
            //$customerCd			=	isset($params['OtherStaffCD']) ? $params['OtherStaffCD'] : '';
            //$customerCd			=	substr('0000000000'.$customerCd,-10);
            $customerName		=	isset($params['OtherStaffName']) ? $params['OtherStaffName'] : '';
            $strTitle			=	$gaichuName.' 様   '.$customerName.' 様 '.date('Y').'年'. date('m').'月'. date('d').'日'.'('.$dayWeek.')';

            $result 			.= '<div style="max-width:600px;" class="login-info" data-toggle="tooltip" data-placement="bottom"
                                    title="" data-original-title="'.$strTitle.'">';
            $result 			.= $strTitle;
            $result 			.= 	'</div>';

        }
        return $result;
    }
    public function showDesctiptionDelete(){
        $result = '';
        $result .= '<div class="pull-left">';
        $result .= '	<table class="tbl-desc">';
        $result .= '		<thead>';
        $result .= '			<tr>';
        $result .= '				<th width="100px">';
        $result .= '					<div style="display: inline-flex; vertical-align:middle;">';
        $result .= '						<div class="row-delete-desc"></div>';
        $result .= '						<div class="row-delete-txt">枠は、使用禁止　</div>';
        $result .= '					</div>';
        $result .= '				</th>';
        $result .= '			</tr>';
        $result .= '		</thead>';
        $result .= '	</table>';
        $result .= '</div>';
        return $result;
    }
    /**
     * getCurrentDateJp
     * @author    HiepNV
     * @param
     * @return
     */
    function getCurrentDateJp() {
        $days = array("日","月","火","水","木","金","土");
        $date = @date('Y年 m月 d日 (').($days[@date("w")]).('曜) ');
        return $date;
    }
    /**
    * getPermisson
    *
    * @author      :   hiepnv 	- 2015/11/20 - create
    * @author      :
    * @param       :   null
    * @return      :   null
    * @access      :   public
    * @see         :
    */
    public function getPermission(){
        //check exists acl
        $authority_typ = 0;
        $controller = strtoupper(Zend_Controller_Front::getInstance()->getRequest()->getControllerName());
//         if(isset($this->user['acl'])){
//             foreach ($this->user['acl'] as $temp){
//                 if($controller == strtoupper($temp['controller_nm'])){
//                     $authority_typ = $temp['authority_typ'];
//                 }
//             }
//         }
        //
        return $authority_typ;
    }
    /**
    * checkExistsMenu
    *
    * @author      :   hiepnv 	- 2016/03/11 - create
    * @author      :
    * @param       :   null
    * @return      :   null
    * @access      :   public
    * @see         :
    */
    public function checkExistsMenu($controller = ''){
        //check exists acl
        $exists = 0;
        if(isset($this->user['acl'])){
            foreach ($this->user['acl'] as $temp){
                if($controller == strtoupper($temp['controller_nm'])){
                    $exists = 1;
                }
            }
        }
        // return
        return $exists;
    }
    /**
     * upload file temp
     *
     * @author      :   biennv 	- 2015/11/23 - create
     * @param       :   null
     * @return      :   json
     * @access      :   public
     * @see         :   remark
     */
    public function readFileImport($fileName) {
        try {
            $result		=	array(
                'status'	=>	OK
            ,	'data'		=>	''
            );
            $data		=	'';
            $arrData	=	array();
            $i			=	0;
            $extAlow	=	array('txt','csv','xlsx');
            $pathUpload	=	new Zend_Config_Ini ( APPLICATION_PATH . '/configs/common.ini', 'upload' );
            $file		=	$pathUpload->upload->pathTem.$fileName;
            $ext 		=	strtolower(trim(strrchr($fileName, '.'),'.'));
            if(is_file($file) && in_array($ext, $extAlow)){
                switch($ext){
                        case 'txt':
                            $content	=	file_get_contents($file);
                            $line		=	explode("\n", $content);
                            foreach ($line as $row){
                                $tmp = trim($row);
                                if($tmp != ''){
                                    $val = explode(',', $tmp);
                                    $txt = '';
                                    foreach ($val as $item) {
                                        $txt			.=	trim(trim($item,'"')).SUB_DELIMITER;
                                        $arrData[$i][]	=	trim(trim($item,'"'));
                                    }
                                    $data .= $txt.DELIMITER;
                                    $i++;
                                }
                            }
                            break;
                        case 'csv':
                            $content	=	file_get_contents($file);
                            if(mb_detect_encoding($content, 'SJIS',true)==true)
                            {
                                $content = mb_convert_encoding($content,'UTF-8','SJIS');
                            }

                            $Data1 = str_getcsv($content, "\n"); //parse the rows
                            foreach($Data1 as $Row){
                                $tmp = str_getcsv($Row, ","); //parse the items in rows
                                $data .= implode(SUB_DELIMITER, $tmp).DELIMITER;
                                $arrData[$i]	=	$tmp;
                                $i++;
                            }
                            break;
                        case 'xlsx':
                            $arrData = $this->loadExcelFile($file);
                            if($arrData){
                                foreach ($arrData as $row){
                                    $data .= implode(SUB_DELIMITER, $row).DELIMITER;
                                }
                            }
                            break;
                        default:
                            $result['status']	=	EPT;
                            break;
                    }
            }
            if(mb_detect_encoding($data, 'UTF-8',TRUE)==false && mb_detect_encoding($data, 'SJIS',true)==false)
            {
                $result['status']	=	EPT;
            }else{
                $encode = mb_detect_encoding($data,'UTF-8, SJIS');
                if($encode == 'SJIS'){
                    $data = mb_convert_encoding($data,'UTF-8','SJIS');
                    foreach ($arrData as $k1=>$v1){
                        foreach ($v1 as $k2=>$v2){
                            $arrData[$k1][$k2] = mb_convert_encoding($v2,'UTF-8','SJIS');
                        }
                    }
                }
                $result['data'] = $data;
            }
            $result['arrData']	=	$arrData;
            return $result;
        } catch ( Exception $ex ) {
            return array(
                'status'	=>	EX
            ,	'data'		=>	''
            );
        }
    }
    /**
     * read file excel
     *
     * @author      :   biennv 	- 2015/12/02 - create
     * @param       :   null
     * @return      :   array
     * @access      :   protect
     * @see         :   remark
     */
    protected  function loadExcelFile($file) {
        if(is_file($file) ) {
            require_once 'PHPExcel/IOFactory.php';
            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file);
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = 'O';
            $rowData = array();
            $rowData = $sheet->rangeToArray('A0:' . $highestColumn.$highestRow);
            return  $rowData;
        }
    }
    /**
     * format number
     * @author hiepnv
     * @param unknown $val
     * @param unknown $num
     * @return unknown|string
     */
    public function formatNumber($val,$num = 0, $displayzero = true){

        if ($val*1 == 0 && $displayzero) {
            $val = '';
        } else if($val*1 == 0 && !$displayzero) {
            $val = 0;
        }else {
            if ((int)$val == $val){
                return number_format(1*$val,0,'.',',');
            }else{
                return number_format(1*$val,$num,'.',',');
            }
        }
        return $val;
    }
    /**
     * format title
     * @author hiepnv
     * @param unknown $val
     * @param unknown $num
     * @return unknown|string
     */
    public function addHalfSpace($val){
        $strReturn = '';
        if($val !=''){
            $arr = str_split($val);
            if(strlen($val) <= 7){
                for($i= 0;$i <= strlen($val)-1 ;$i++){
                    $strReturn .= ($arr[$i].' ');
                }
            }else{
                $strReturn = $val;
            }
        }
        return $strReturn;
    }
    /**
     * getDayofWeek
     *
     * @author      :   HiepNV 	- 2016/10/14 - create
     * @author      :
     * @param       :   date
     * @return      :   day
     * @access      :   public
     * @see         :
     */
    public function getDayofWeek($strDate){
        $dys = array("日","月","火","水","木","金","土");
        $tmpDate = date_create($strDate);
        $dy  = date_format($tmpDate,"w");
        $dyj = $dys[$dy];
        return $dyj;
    }
}
?>
