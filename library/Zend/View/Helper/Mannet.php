<?php
/**
 ****************************************************************************
 * MANNET
 * Helper
 *
 * 処理概要/process overview		:	MANNET hepler
 * 作成日/create date			:	2015/09/22
 * 作成者/creater				:	viettd – viettd@ans-asia.com
 *
 * 更新日/update date 			:	2015/10/21
 * 更新者/updater				:	phonglv – phonglv@ans-asia.com
 * 更新内容	/update content		:	add $m101iButton $m102iButton and  into navbar
 *
 * @package    	 				: 	MODULE NAME
 * @copyright   				: 	Copyright (c) ANS-ASIA
 * @version						: 	1.0.0
 * **************************************************************************
 */
class  Zend_View_Helper_Mannet extends Zend_View_Helper_Abstract {
	public $companyInformation = array();
	public $employeeInformation = array();
	protected $model;
	protected $user;
	protected $auth;
	public function mannet() {
		$this->model = new Model_DAO();
		$this->auth = Zend_Auth::getInstance();
		$this->user = $this->auth->getIdentity();
		$this->view->user = $this->user;
		return $this;
	}
	/**
	* show
	*
	* @author      :   viettd 	- 2015/09/22 - create
	* @param       :   type_of_param  - description
	* @return      :   type_of_result - description
	* @access      :   public
	* @see         :   show button function
	*/
	public function show($title=null, $buttonLeft = array(), $buttonRight = array(),$permission = 0) {
		$buttonLeftString 	= (sizeof($buttonLeft) == 0) ? '': $this->mannet()->genButtonLeft($buttonLeft,$permission);
		$buttonRightString 	= (sizeof($buttonRight) == 0) ? '': $this->mannet()->genButtonRight($buttonRight,$permission);
		// gen string html
		$html = '';
		$html .= '<div class="w-group-button">';
		$html .= '	<div class="container-fluid">';
		$html .= '		<ul class="w-name-screen">';
		$html .= '			<li>'.$title.'</li>';
		$html .= '		</ul>';
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
	* @author      :   viettd 	- 2015/09/22 - create
	* @author      :
	* @param       :   null
	* @return      :   null
	* @access      :   public
	* @see         :
	*/
	public function genButtonLeft($items = array(),$permission = 0){
		// check permision
		$result = '';
		$exportButton 					= array('id'=>'btn-export','icon'=>'glyphicon glyphicon-print','label'=>'エクスポート','permission'=>$permission);
		$importButton 					= array('id'=>'btn-import','icon'=>'glyphicon glyphicon-upload','label'=>'取り込み','permission'=>$permission);
		$sendHistoryButtonInputLeft 	= array('id'=>'btn-send-history-input','icon'=>'glyphicon glyphicon-envelope','label'=>'通信履歴入力','permission'=>$permission);
		$staffDataCopyLeft			 	= array('id'=>'btn-staff-data-copy','icon'=>'glyphicon glyphicon-copy','label'=>'スタッフデータコピー','permission'=>$permission);
		$sendButtonLeft 				= array('id'=>'btn-send','icon'=>'glyphicon glyphicon-envelope','label'=>'送信','permission'=>$permission);
		$searchButtonLeft 				= array('id'=>'btn-search','icon'=>'glyphicon glyphicon-search','label'=>'検索','permission'=>0);
		$clearButtonLeft 				= array('id'=>'btn-clear','icon'=>'glyphicon glyphicon-remove','label'=>'クリア','permission'=>0);
		$rejectButtonLeft 				= array('id'=>'btn-reject','icon'=>'glyphicon glyphicon-ban-circle','label'=>'お断り','permission'=>$permission);
		$rejectSendMailButtonLeft 		= array('id'=>'btn-reject-send-mail','icon'=>'glyphicon glyphicon-envelope','label'=>'お断りメール送信','permission'=>$permission);
		$projectIncomeStatusLeft 		= array('id'=>'btn-project-income-status','icon'=>'glyphicon glyphicon-open','label'=>'案件収支状況照会','permission'=>$permission);
		$saveButtonLeft 				= array('id'=>'btn-save','icon'=>'glyphicon glyphicon-floppy-save','label'=>'登録','permission'=>$permission);
		$arrangementButtonLeft 			= array('id'=>'btn-arrangement','icon'=>'glyphicon glyphicon-tasks','label'=>'手配','permission'=>$permission);
		$departmentDeleteButtonLeft 	= array('id'=>'btn-department-delete','icon'=>'glyphicon glyphicon-trash','label'=>'部署削除','permission'=>$permission);
		$teamDeleteButtonLeft 			= array('id'=>'btn-team-delete','icon'=>'glyphicon glyphicon-trash','label'=>'チーム削除','permission'=>$permission);
		$printButtonLeft 				= array('id'=>'btn-print','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'出力','permission'=>$permission);
		$deleteButtonLeft 				= array('id'=>'btn-delete','icon'=>'glyphicon glyphicon-trash','label'=>'削除','permission'=>$permission);
		$approveButtonLeft 				= array('id'=>'btn-approve','icon'=>'glyphicon glyphicon-ok','label'=>'承認','permission'=>$permission);
		$detailDeleteButtonLeft 		= array('id'=>'btn-detail-delete','icon'=>'glyphicon glyphicon-trash','label'=>'明細削除','permission'=>$permission);
		$M002I_detailDeleteButtonLeft 		= array('id'=>'btn-detail-delete','icon'=>'glyphicon glyphicon-trash','label'=>'明細削除','permission'=>$permission);
		$useEmailButtonLeft 			= array('id'=>'btn-use-email','icon'=>'glyphicon glyphicon-envelope','label'=>'採用メール','permission'=>$permission);
		$arrangementDoneEmailButtinLeft = array('id'=>'btn-arrangement-done-email','icon'=>'glyphicon glyphicon-envelope','label'=>'手配完了メール送信','permission'=>$permission);
		$departmentCreateButtonLeft 	= array('id'=>'btn-department-create','icon'=>'glyphicon glyphicon-plus','label'=>'部署作成','permission'=>$permission);
		$teamCreateButtonLeft 			= array('id'=>'btn-team-create','icon'=>'glyphicon glyphicon-plus','label'=>'チーム作成','permission'=>$permission);
		$newButtonLeft 					= array('id'=>'btn-new','icon'=>'glyphicon glyphicon-plus','label'=>'新規作成','permission'=>$permission);
		$workAddButtonLeft 				= array('id'=>'btn-work-add','icon'=>'glyphicon glyphicon-plus','label'=>'作業追加','permission'=>$permission);
		$deleteCFButtonLeft				= array('id'=>'btn-delete-classification','icon'=>'glyphicon glyphicon-trash','label'=>'作業種別削除','permission'=>$permission);
		$deleteWorkButtonLeft 			= array('id'=>'btn-delete-work','icon'=>'glyphicon glyphicon-trash','label'=>'作業削除','permission'=>$permission);
		$recoveryButtonLeft				= array('id'=>'btn-recovery','icon'=>'glyphicon glyphicon-refresh','label'=>'データ復活','permission'=>$permission);
		$classificationAddButtonLeft	= array('id'=>'btn-classification-add','icon'=>'glyphicon glyphicon-plus','label'=>'作業種別作成','permission'=>$permission);
		$returnGoodsButtonLeft          = array('id'=>'btn-return-goods','icon'=>'glyphicon glyphicon-gift','label'=>'返品','permission'=>$permission);
		$prososalInputButtonLeft		= array('id'=>'btn-prososal-input','icon'=>'glyphicon glyphicon-import','label'=>'案件入力','permission'=>$permission);
		$prososalOutputButtonLeft		= array('id'=>'btn-prososal-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'発注書出力','permission'=>$permission);
		$returnBackButtonLeft			= array('id'=>'btn-return-back','icon'=>'glyphicon glyphicon-share-alt','label'=>'差戻','permission'=>$permission);
		$realContractProcessButtonLeft	= array('id'=>'btn-real-contract-process','icon'=>'glyphicon glyphicon-ok','label'=>'本契約処理','permission'=>$permission);
		$callButtonLeft					= array('id'=>'btn-call','icon'=>'glyphicon glyphicon-share','label'=>'呼出','permission'=>$permission);
		$mailSendButtonLeft				= array('id'=>'btn-mail-send','icon'=>'glyphicon glyphicon-envelope','label'=>'メール送信','permission'=>$permission);
		//I010_M biennv 2015/12/15
		$prososalDetailSearchButtonLeft	= array('id'=>'btn-prososal-detail-search','icon'=>'glyphicon glyphicon-search','label'=>'案件明細検索','permission'=>$permission);
		$staffSearchButtonLeft			= array('id'=>'btn-staff-search','icon'=>'glyphicon glyphicon-search','label'=>'スタッフ検索','permission'=>$permission);
		$scheduleSearchButtonLeft		= array('id'=>'btn-schedule-left-search','icon'=>'glyphicon glyphicon-search','label'=>'スケジュール検索','permission'=>$permission);
		$employmentHistorySearchLeft	= array('id'=>'btn-employment-history-search','icon'=>'glyphicon glyphicon-search','label'=>'就業履歴検索','permission'=>$permission);
		//M005Q longvv 2016/12/18
		$prososalDetailButtonLeft		= array('id'=>'btn-prososal-detail','icon'=>'glyphicon glyphicon-th','label'=>'案件明細','permission'=>$permission);
		$prososalArrangementButtonLeft	= array('id'=>'btn-prososal-arrangement','icon'=>'glyphicon glyphicon-tasks','label'=>'案件手配','permission'=>$permission);
		$staffCalculationInputButtonLeft= array('id'=>'btn-staff-calculation-input','icon'=>'glyphicon glyphicon-yen','label'=>'ｽﾀｯﾌ精算入力','permission'=>$permission);
		$amountInputButtonLeft			= array('id'=>'btn-amount-input','icon'=>'glyphicon glyphicon-save','label'=>'売上入力','permission'=>$permission);
		//M022_I1 tuyentt 2015/12/21
		$invoicePrintButtonLeft			= array('id'=>'btn-invoice-print','icon'=>'glyphicon glyphicon-print','label'=>'納品書印刷','permission'=>$permission);
		$prososalCopyButtonLeft			= array('id'=>'btn-prososal-copy','icon'=>'glyphicon glyphicon-copy','label'=>'案件複写','permission'=>$permission);
		$prososalDeleteButtonLeft		= array('id'=>'btn-prososal-delete','icon'=>'glyphicon glyphicon-trash','label'=>'案件削除','permission'=>$permission);
		$M002I_prososalDeleteButtonLeft		= array('id'=>'btn-prososal-delete','icon'=>'glyphicon glyphicon-trash','label'=>'案件削除','permission'=>$permission);

		$detailCopyButtonLeft			= array('id'=>'btn-detail-copy','icon'=>'glyphicon glyphicon-copy','label'=>'明細複写','permission'=>$permission);
		$creditLimitApproveButtonLeft 	= array('id'=>'btn-credit-limit-approve','icon'=>'glyphicon glyphicon-ok','label'=>'限度額承認','permission'=>$permission);
		//M906 sangtk 2015/12/22
		$supplierSearchScreenButtonLeft	= array('id'=>'btn-supplier-search-screen','icon'=>'glyphicon glyphicon-share','label'=>'仕入先検索','permission'=>$permission);
		//M012Q tuyentt 2015/12/22
		$houseApprovalButtonLeft		= array('id'=>'btn-house-approval','icon'=>'glyphicon glyphicon-search','label'=>'社内承認','permission'=>$permission);
		//M201 sangtk 2015/12/28
		$csvOutputButtonLeft			= array('id'=>'btn-csv-output-left','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'CSV出力','permission'=>0);
		$broadcastMailSendButtonLeft	= array('id'=>'btn-broadcast-mail-send','icon'=>'glyphicon glyphicon-envelope','label'=>'同報メール送信','permission'=>$permission);
		//M023B vuongvt 2016/01/05
		$tempCloseLeft					= array('id'=>'btn-temp-close','icon'=>'glyphicon glyphicon-stop','label'=>'仮締','permission'=>$permission);
		$realCloseLeft					= array('id'=>'btn-real-close','icon'=>'glyphicon glyphicon-stop','label'=>'本締','permission'=>$permission);
		$cancelCloseLeft				= array('id'=>'btn-cancel-close','icon'=>'glyphicon glyphicon-ban-circle','label'=>'締解除','permission'=>$permission);
		//M023Q vuongvt 2016/01/28
		$editLeft						= array('id'=>'btn-edit','icon'=>'glyphicon glyphicon-edit','label'=>'修正','permission'=>$permission);
		//M011_I kyvd 2016/01/08
		$detailLineDeleteButtonLeft 	= array('id'=>'btn-detail-line-delete','icon'=>'glyphicon glyphicon-trash','label'=>'明細行削除','permission'=>$permission);
		$arrangeSeriesDeleteButtonLeft 	= array('id'=>'btn-arrange-series-delete','icon'=>'glyphicon glyphicon-trash','label'=>'手配一括削除','permission'=>$permission);
		$cancelExecutionLeft		 	= array('id'=>'btn-cancel-execution','icon'=>'glyphicon glyphicon-ok','label'=>'締実行','permission'=>$permission);
		//M011_I kyvd 2016/03/22
		$staffDeleteButtonLeft 			= array('id'=>'btn-staff-delete','icon'=>'glyphicon glyphicon-trash','label'=>'スタッフ削除','permission'=>$permission);
		//M011Q sangtk 2016/01/11
		$rejectMailButtonLeft 			= array('id'=>'btn-reject-mail','icon'=>'glyphicon glyphicon-envelope','label'=>'お断りメール','permission'=>$permission);
		$screenRefreshButtonLeft		= array('id'=>'btn-screen-refresh','icon'=>'glyphicon glyphicon-refresh','label'=>'画面更新','permission'=>$permission);
		//M012_I1 namtx 2016/1/15
		$registerButtonLeft				= array('id'=>'btn-register','icon'=>'glyphicon glyphicon-pencil','label'=>'登録','permission'=>$permission);
		$ontimeButtonLeft				= array('id'=>'btn-ontime','icon'=>'glyphicon glyphicon-time','label'=>'定刻','permission'=>$permission);
		$approvedButtonLeft				= array('id'=>'btn-approved','icon'=>'glyphicon glyphicon-ok','label'=>'社内承認	','permission'=>$permission);
		$multipleRegister				= array('id'=>'btn-multiple-register','icon'=>'glyphicon glyphicon-list-alt','label'=>'一括登録','permission'=>$permission);
		//M025I2 tuyentt 2016/01/15
		$cancelButtonLeft				= array('id'=>'btn-cancel','icon'=>'glyphicon glyphicon-ban-circle','label'=>'解除','permission'=>$permission);
		//M014I1 vinhnt 2016/01/18
		$confirmButtonLeft				= array('id'=>'btn-confirm','icon'=>'glyphicon glyphicon-ok','label'=>'確認','permission'=>$permission);
		//M025Q	namtx 2016/01/18
		$multipleClearButtonLeft		= array('id'=>'btn-multiple-clear','icon'=>'glyphicon glyphicon-list-alt','label'=>'一括消込','permission'=>$permission);
		//M023I TuyenTT 2016/01/21
		$billOutputLeft					= array('id'=>'btn-bill-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'請求書出力','permission'=>$permission);
		//M012R Vulq 2016/01/22
		$uploadReportLeft				= array('id'=>'btn-upload-report','icon'=>'glyphicon glyphicon-export','label'=>'ｱｯﾌﾟﾛｰﾄﾞ','permission'=>$permission);
		//M016B phonglv 2016/01/26
		$extractButtonLeft				= array('id'=>'btn-extract','icon'=>'glyphicon glyphicon-paste','label'=>'抽出','permission'=>$permission);
		$createTransferDataButtonLeft	= array('id'=>'btn-create-transfer-data','icon'=>'glyphicon glyphicon-copy','label'=>'振込データ作成','permission'=>$permission);
		//M102I namnb 2016/01/27
		$ledgerButtonLeft				= array('id'=>'btn-ledger','icon'=>'glyphicon glyphicon-book','label'=>'元帳','permission'=>$permission);
		$m102iledgerButtonLeft			= array('id'=>'btn-ledger','icon'=>'glyphicon glyphicon-book','label'=>'元帳','permission'=>0);
		$saveImportLeft 				= array('id'=>'btn-left-import','icon'=>'glyphicon glyphicon-floppy-save','label'=>'取込','permission'=>$permission);
		//M201_I kyvd 2016/01/29
		$cancellationDeletionLeft		= array('id'=>'btn-cancellation-deletion','icon'=>'glyphicon glyphicon-ban-circle','label'=>'解消・抹消','permission'=>$permission);
		$cancellationDeletionApproveLeft= array('id'=>'btn-cancellation-deletion-approve','icon'=>'glyphicon glyphicon-ok','label'=>'解消抹消承認','permission'=>$permission);
		//M102_Q longvv 2016/02/01
		$createPotcustomerButtonLeft	= array('id'=>'btn-create-potcustomer','icon'=>'glyphicon glyphicon-plus','label'=>'新規見込','permission'=>$permission);
		$createCustomerButtonLeft		= array('id'=>'btn-create-customer','icon'=>'glyphicon glyphicon-plus','label'=>'新規顧客','permission'=>$permission);
		//M201_Q3 longvv 2016/02/02
		$historySearchLeft				= array('id'=>'btn-history-search','icon'=>'glyphicon glyphicon-search','label'=>'履歴検索','permission'=>$permission);
		$emptySearchLeft				= array('id'=>'btn-empty-search','icon'=>'glyphicon glyphicon-search','label'=>'空き検索','permission'=>$permission);
		$broadcastMailButtonLeft		= array('id'=>'btn-broadcast-mail','icon'=>'glyphicon glyphicon-envelope','label'=>'同報メール','permission'=>$permission);
		//M025_B1 tuannt 2016/02/02
		$paymentRegisterButtonLeft		= array('id'=>'btn-payment-register','icon'=>'glyphicon glyphicon-list-alt','label'=>'振込人変換登録','permission'=>$permission);
		//M018R1 namtx 2016/16/02
		$uploadReportButtonLeft			= array('id'=>'btn-upload-report','icon'=>'glyphicon glyphicon-upload','label'=>'アップロード','permission'=>$permission);
		//M019_Q tuannt 2016/02/17
		$tightRegisterLeft				= array('id'=>'btn-tighten-register','icon'=>'glyphicon glyphicon-stop','label'=>'締登録','permission'=>$permission);
		// M909 namnb 18/02/2016
		$classificationAddButtonLeft1	= array('id'=>'btn-classification-add','icon'=>'glyphicon glyphicon-plus','label'=>'職種(大)作成','permission'=>$permission);
		$workAddButtonLeft1 			= array('id'=>'btn-work-add','icon'=>'glyphicon glyphicon-plus','label'=>'職種(小)追加','permission'=>$permission);
		$deleteCFButtonLeft1			= array('id'=>'btn-delete-classification','icon'=>'glyphicon glyphicon-trash','label'=>'職種(大)削除','permission'=>$permission);
		$deleteWorkButtonLeft1 			= array('id'=>'btn-delete-work','icon'=>'glyphicon glyphicon-trash','label'=>'職種(小)削除','permission'=>$permission);
		//M012_I1 namtx 22/02/2016
		$cancelApproveButtonLeft		= array('id'=>'btn-cancel-approve','icon'=>'glyphicon glyphicon-remove-circle','label'=>'承認解除','permission'=>$permission);
		//C003Q, C008R phonglv 3/3/2016
		$copyButtonLeft				 	= array('id'=>'btn-copy','icon'=>'glyphicon glyphicon-copy','label'=>'コピー','permission'=>$permission);
		$outputButtonLeft				= array('id'=>'btn-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'出力','permission'=>$permission);
		//M030R tuyentt 2016/03/10
		$outputDataButtonLeft			= array('id'=>'btn-output-data','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'データ出力','permission'=>$permission);
		//M009Q tuannt 2016/03/21
		$arrangementDoneButtonLeft 		= array('id'=>'btn-arrangement-done','icon'=>'glyphicon glyphicon-tasks','label'=>'手配完了','permission'=>$permission);
		$selectingButtonLeft 			= array('id'=>'btn-selecting','icon'=>'glyphicon glyphicon-tasks','label'=>'選考中','permission'=>$permission);
		$collectiveArrangementButtonLeft 	= array('id'=>'btn-collective-arrangement','icon'=>'glyphicon glyphicon-tasks','label'=>'一括手配','permission'=>$permission);
		//M002Q longvv 2016/03/28
		$projectProposalNoLeft			= array('id'=>'btn-prososalNo-detail','icon'=>'glyphicon glyphicon-th','label'=>'案件明細情報','permission'=>$permission);
		$prososalDetailNoButtonLeft		= array('id'=>'btn-create-proposalNo','icon'=>'glyphicon glyphicon-plus','label'=>'案件登録','permission'=>$permission);
		//generate html of button left
		foreach ($items as $item){
			$item_arr 	= $$item;
			$class 		= '';
			$disabled  	= '';
			// CHECK WHEN permission = 1 THEN DISABLED BUTTON
			if($item_arr['permission'] == 1){
				$class			 	= 'not-allow';
				$item_arr['id'] 	= '';
				$disabled			= 'disabled="disabled"';
			}
			//edited by viettd - 2016/01/14
			//edited by viettd - 2016/03/16
			// CHECK WHEN permission = 1 OR permission = 2 IS DISABLED BUTTON
			else if($item_arr['permission'] != 3
					&& ($item == 'M002I_prososalDeleteButtonLeft' || $item == 'M002I_detailDeleteButtonLeft')
					){
				$class			 	= 'not-allow';
				$item_arr['id'] 	= '';
				$disabled			= 'disabled="disabled"';
			}
			//end edited by viettd - 2016/03/16
			//edited by sangtk - 2016/03/09 - add button realContractProcessButtonLeft
			// check when permission <> 3 not view button $creditLimitApproveButtonLeft, $realContractProcessButtonLeft
			if($item_arr['permission'] != 3 && (
						$item == 'creditLimitApproveButtonLeft'
					||	$item == 'realContractProcessButtonLeft'
					)
				){
				$result .= '';
			}else{
				$result .= '<li id="'.$item_arr['id'].'" class="'.$class.'" '.$disabled.'>';
				$result .= '	<span class="'.$item_arr['icon'].'"></span>';
				$result .= '		<label class="text-item">'.$item_arr['label'].'</label>';
				$result .= '</li>';
			}
			//end edited by viettd - 2015/01/14
		}
		return $result;
	}
	/**
	 * genButtonRight function
	 *
	 * @author      :   viettd 	- 2015/09/22 - create
	 * @author      :
	 * @param       :   $items - array name of button
	 * @return      :   $result - string of button right
	 * @access      :   public
	 * @see         : 	return html of button right
	 */
	public function genButtonRight($items=array(),$permission = 0){
		$result = '';
		$searchButton = array('id'=>'btn-search','icon'=>'glyphicon glyphicon-search','label'=>'検索','permission'=>0);
		$backButton = array('id'=>'btn-back','icon'=>'glyphicon glyphicon-share-alt','label'=>'戻る','permission'=>0);
		//
		$backButtonRight 			= array('id'=>'btn-back','icon'=>'glyphicon glyphicon-share-alt','label'=>'戻る','permission'=>0);
		$conditionCallButtonRight 	= array('id'=>'btn-condition-call','icon'=>'glyphicon glyphicon-floppy-open','label'=>'条件呼出','permission'=>0);
		$conditionSaveButtonRight 	= array('id'=>'btn-condition-save','icon'=>'glyphicon glyphicon-floppy-save','label'=>'条件保存','permission'=>$permission);
		$menuBackButtonRight 		= array('id'=>'btn-menu-back','icon'=>'glyphicon glyphicon-share-alt','label'=>'glyphicon glyphicon-share-alt','permission'=>0);
		$prososalCallButtonRight 	= array('id'=>'btn-prososal-call','icon'=>'glyphicon glyphicon-floppy-open','label'=>'案件呼出','permission'=>$permission);
		$prososalSaveButtonRight 	= array('id'=>'btn-prososal-save','icon'=>'glyphicon glyphicon-floppy-save','label'=>'案件保存','permission'=>$permission);
		//M005Q longvv 2016/12/18
		$csvOutputButtonRight		= array('id'=>'btn-csv-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'CSV出力','permission'=>0);
			//
		$orderMailButtonRight		= array('id'=>'btn-order-mail','icon'=>'glyphicon glyphicon-envelope','label'=>'受注メール','permission'=>$permission);
		$employmentConditionSpecificationOutputButtonRight	= array('id'=>'btn-employment-condition-specification-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'就業条件明示書','permission'=>$permission);
		$offerOutputButtonRight				= array('id'=>'btn-offer-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'求人票','permission'=>$permission);
		$paymentBillingOutputButtonRight	= array('id'=>'btn-payment-billing-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'前金請求書','permission'=>$permission);
		$estimationOutputButtonRight		= array('id'=>'btn-estimation-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'見積書','permission'=>$permission);
		$caseContractOutputButtonRight		= array('id'=>'btn-case-contract-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'個別契約書','permission'=>$permission);
		$group1								= array('id'=>'btn-group1','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'出力書','permission'=>$permission);
		//M023B vuongvt 2016/01/05
		$tempBillOutputRight			= array('id'=>'btn-temp-bill-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'仮請求書出力','permission'=>$permission);
		$realBillOutputRight			= array('id'=>'btn-real-bill-output','icon'=>'glyphicon glyphicon-print print-dropdown','label'=>'本請求書出力','permission'=>$permission);
		$saleSearchRight				= array('id'=>'btn-sale-search','icon'=>'glyphicon glyphicon-search','label'=>'売上検索','permission'=>$permission);
		//M012I2 tuannt 2016/01/07
		$saveButtonRight				= array('id'=>'btn-save','icon'=>'glyphicon glyphicon-floppy-save','label'=>'登録','permission'=>$permission);
		//M011_I kyvd 2016/01/08
		$rejectMailButtonRight 			= array('id'=>'btn-reject-mail','icon'=>'glyphicon glyphicon-envelope','label'=>'お断りメール','permission'=>$permission);
		$contactMailButtonRight			= array('id'=>'btn-contact-mail','icon'=>'glyphicon glyphicon-envelope','label'=>'連絡メール','permission'=>$permission);
		$applicantListButtonRight		= array('id'=>'btn-applicant-list','icon'=>'glyphicon glyphicon-list','label'=>'応募者一覧','permission'=>$permission);
		$scheduleSearchButtonRight		= array('id'=>'btn-schedule-search','icon'=>'glyphicon glyphicon-search','label'=>'スケジュール検索','permission'=>$permission);
		$ngPrecedenceButtonRight		= array('id'=>'btn-ng-precedence','icon'=>'glyphicon glyphicon-retweet','label'=>'NG優先','permission'=>$permission);
		//M201_I kyvd 2016/01/29
		$withholdingTaxSlipRight		= array('id'=>'btn-withholding-tax-slip','icon'=>'glyphicon glyphicon-print','label'=>'源泉徴収票','permission'=>$permission);
		$employmentHistorySearchRight	= array('id'=>'btn-employment-history-search-right','icon'=>'glyphicon glyphicon-search','label'=>'就業履歴検索','permission'=>$permission);
		//
		$closePopupButtonRight			= array('id'=>'btn-close-popup','icon'=>'glyphicon glyphicon-share-alt','label'=>'閉じる','permission'=>$permission);
		//generate html of button right
		foreach ($items as $key=>$item){
			// check group button
			if(is_array($item)){
				$result .= '<li class="btn-right dropdown w-list-button-print">';
				$result .= '	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
				$result .= '		<label class="text-item"><span class="glyphicon glyphicon-print print-dropdown"></span>帳票出力</label>';
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
					$result .= '		<label class="text-item">'.$temp_array['label'].'</label>';
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
				$result .= '	<span class="'.$item_arr['icon'].'"></span>';
				$result .= '		<label class="text-item">'.$item_arr['label'].'</label>';
				$result .= '</li>';
			}
		}
		return $result;
	}
	/**
	 * showLogo function
	 *
	 * @author      :   viettd 	- 2015/09/22 - create
	 * @author      :
	 * @param       :   $flag - true or false
	 * @return      :   $html - html code
	 * @access      :   public
	 * @see         : 	true: show create , update information , false: not show create,update information
	 */
	public function showLogoInformation($params = array(),$flag = true){
		// Get information of create User
		$zipCode			=	'';
		$address1			=	'';
		$address2			=	'';
		$teamName 			=	'';
		$inchargeName		=	'';
		$inchargeKana		=	'';
		$teamName_title 	=	'';
		$inchargeName_title	=	'';
		$inchargeKana_title	=	'';
		$teamTel			=	'';
		$teamMail			=	'';
		$information 		= 	'';
		if(isset($params)){
			$zipCode				=	isset($params['zipCode']) ? $params['zipCode'] : '';
			$address1				=	isset($params['address1']) ? $params['address1'] : '';
			$address2				=	isset($params['address2']) ? $params['address2'] : '';
			$teamName 				=	isset($params['teamName']) && mb_strlen($params['teamName'],'UTF-8') > 8 ? mb_substr($params['teamName'], 0, 8, 'UTF-8').'...' : $params['teamName'];
			$inchargeName			=	isset($params['inchargeName']) && mb_strlen($params['inchargeName'],'UTF-8') > 8 ? mb_substr($params['inchargeName'], 0, 8, 'UTF-8').'...' : $params['inchargeName'];
			$inchargeKana			=	isset($params['inchargeKana']) && mb_strlen($params['inchargeKana'],'UTF-8') > 8 ? mb_substr($params['inchargeKana'], 0, 8, 'UTF-8').'...' : $params['inchargeKana'];
			$teamName_title			=	isset($params['teamName']) ? $params['teamName'] : '';
			$inchargeName_title		=	isset($params['inchargeName']) ? $params['inchargeName'] : '';
			$inchargeKana_title		=	isset($params['inchargeKana']) ? $params['inchargeKana'] : '';
			$teamTel				=	isset($params['teamTel']) ? $params['teamTel'] : '';
			$teamMail				=	isset($params['teamMail']) ? $params['teamMail'] : '';
		}
		//get Html file
		$html  = '';
		$html .= '<div class="w-info">';
		$html .= '	<div class="container-fluid">';
		$html .= '		<div class="col-md-8">';
		$html .= '			<div class="col-md-2 w-logo-info">';
		$html .= '				<img src="/templates/images/logo-mannet.png" class="img-responsive">';
		$html .= '			</div>';
		$html .= '			<div class="col-md-10 w-address">';
		$html .= '				<div class="col-md-12">';
		$html .= '					<div class="form-control">';
		$html .= '						<label>〒'.$zipCode.'</label>';
		$html .= '						<label class="header-address" data-toggle="tooltip" data-placement="bottom" title="'.$address1.' '.$address2.'">'.$address1.' '.$address2.'</label>';
		$html .= '					</div>';
		$html .= '				</div>';
		$html .= '				<div class="col-md-12">';
		$html .= '					<div class="col-md-6">';
		$html .= '						<div class="form-control">';
		$html .= '							<label class="title-label">担当 ： </label>';
		if($inchargeKana != ''){
		$html .= '							<label><span data-toggle="tooltip" data-placement="bottom" title="'.$teamName_title.'">'.$teamName.'</span>&nbsp;<span data-toggle="tooltip" data-placement="bottom" title="'.$inchargeName_title.'">'.$inchargeName.'</span><span data-toggle="tooltip" data-placement="bottom" title="'.$inchargeKana_title.'">（'.$inchargeKana.'）</span></label>';
		}else{
		$html .= '							<label><span data-toggle="tooltip" data-placement="bottom" title="'.$teamName_title.'">'.$teamName.'</span>&nbsp;<span data-toggle="tooltip" data-placement="bottom" title="'.$inchargeName_title.'">'.$inchargeName.'</span></label>';
		}
		$html .= '						</div>';
		$html .= '					</div>';
		$html .= '					<div class="col-md-6">';
		$html .= '						<div class="form-control">';
		$html .= '							<label class="title-label">TEL ： </label>';
		$html .= '							<label class="header-tel" data-toggle="tooltip" data-placement="bottom" title="'.$teamTel.'">'.$teamTel.'</label>&nbsp;&nbsp;';
		$html .= '							<label class="title-label">MAIL ： </label>';
		$html .= '							<label class="header-mail" data-toggle="tooltip" data-placement="bottom" title="'.$teamMail.'">'.$teamMail.'</label>';
		$html .= '						</div>';
		$html .= '					</div>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '		</div>';
		//check display information of create or update
		if($flag){
			$information = $this->mannet()->showCreateUpdate();
		}else{
			$information = '';
		}
		$html .= $information;
		$html .= '	</div>';
		$html .= '</div>';
		$html .= '<hr>';
		return $html;
	}
	/**
	 * showCreateUpdate function
	 *
	 * @author      :   viettd 	- 2015/09/22 - create
	 * @author      :
	 * @param       :   $items - array name of button
	 * @return      :   $result - string of button right
	 * @access      :   public
	 * @see         : 	return html of create or update information
	 */
	public function showCreateUpdate(){
		$html = '';
		$html .= '		<div class="col-md-4 w-info-2">';
		$html .= '		<div class="row">';
		$html .= '			<div class="col-md-6">';
		$html .= '				<div class="form-control">';
		$html .= '					<label class="title-label">登録者</label>：';
		$html .= '					<label id="cre_user"></label>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '			<div class="col-md-6">';
		$html .= '				<div class="form-control">';
		$html .= '					<label class="title-label">更新者</label>：';
		$html .= '					<label id="upd_user"></label>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '		</div>';
		$html .= '		<div class="row">';
		$html .= '			<div class="col-md-6">';
		$html .= '				<div class="form-control">';
		$html .= '					<label class="title-label">登録日時</label>：';
		$html .= '					<label id="cre_date"></label>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '			<div class="col-md-6">';
		$html .= '				<div class="form-control">';
		$html .= '					<label class="title-label">更新日時</label>：';
		$html .= '					<label id="upd_date"></label>';
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '		</div>';
		$html .= '		</div>';
		return $html;
	}
	/**
	* showCompanyInformation
	*
	* @author      :   viettd 	- 2015/09/22 - create
	* @author      :
	* @param       :   null
	* @return      :   null
	* @access      :   public
	* @see         :
	*/
	public function showCompanyInformation($company_nm = '',$employee_cd=''){
		$reduce = '';
		if (mb_strlen($company_nm, 'UTF-8') > 6) {
			$reduce .= '<span data-toggle="tooltip" data-placement="bottom" title="' . $company_nm . '">';
			$reduce .= mb_substr($company_nm, 0, 6, 'UTF-8') . ' ...';
			$reduce .= '</span>';
		} else {
			$reduce .= $company_nm;
		}
		$result = '<li>';
		$result .= '	<a>'.$employee_cd.'：'.$reduce.'</a>';
		$result .= '</li>';
		return $result;
	}
	/**
	* getPermisson
	*
	* @author      :   viettd 	- 2015/11/20 - create
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
		if(isset($this->user['acl'])){
			foreach ($this->user['acl'] as $temp){
				if($controller == strtoupper($temp['controller_nm'])){
					$authority_typ = $temp['authority_typ'];
				}
			}
		}
		//
		return $authority_typ;
	}
	/**
	* checkExistsMenu
	*
	* @author      :   viettd 	- 2016/03/11 - create
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
							/* if (($file_check = fopen($file, 'r')) !== FALSE){
								while (($data_check_endcode = fgetcsv($file_check, 200000, ",")) !== FALSE){
									$data .= implode(SUB_DELIMITER, $data_check_endcode).DELIMITER;
									$arrData[$i]	=	$data_check_endcode;
									$i++;
								}
							} */
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
}
?>