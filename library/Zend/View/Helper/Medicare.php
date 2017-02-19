<?php
/**
 * Medicare Project
 *
 * PHP 5
 * @author      : GiangNT - create
 * @author      : Canh - update - 2015/05/26
 * @copyright   : Copyright (c) ANS-ASIA
 * @package     : helper
 */
class  Zend_View_Helper_Medicare extends Zend_View_Helper_Abstract {

	public function medicare() {
		return $this;
	}

	public function show($title=null, $gen_bar = array(), $spec_bar = array()) {

		$strGenBar	= (sizeof($gen_bar) == 0)?'':$this->medicare()->genBar($gen_bar);
		$strSpecBar	= (sizeof($spec_bar) == 0)?'':$this->medicare()->specBar($spec_bar);

		$str  = '<div class="container-fluid no-padding in-file-func-nav">';
		$str .= '	<div class="col-lg-12 col-md-12 action-nav">';
		$str .= '		<div class="col-lg-12 col-md-12" id="nav-fnc">';
		$str .= '<ul id="specific-bar" class="pull-left action-icon action-icon-left">';
		$str .= '	<li class="title" style="padding: 10px 15px 8px 15px !important;">' . $title . '</li>';
		$str .= '	<li class="dropdown chilr1 hidden text-center">';
		$str .= '		<a tabindex="0" data-toggle="dropdown" class="dropdown-toggle text-center">';
		$str .= '			<i class="fa fa-caret-square-o-down" style="display: block; height: 33px; margin-top: 13px; font-size: 20px;"></i>';
		$str .= '			<span class="text-item"></span>';
		$str .= '		</a>';
		$str .= '		<ul id="" class="dropdown-menu">';
		$str .= $strSpecBar;
		$str .= '		</ul>';
		$str .= '	</li>';
		$str .= $strSpecBar;
		$str .= '</ul>';
		$str .= '			<ul id="general-bar" class="pull-right action-icon action-icon-right">';
		$str .= '				<li class="dropdown chilr1 hidden text-center">';
		$str .= '					<a tabindex="0" data-toggle="dropdown" class="dropdown-toggle text-center"><i class="fa fa-caret-square-o-down" style="display:block; height: 33px; margin-top: 13px; font-size: 20px;"></i><span class="text-item"></span></a>';
		$str .= '					<ul class="dropdown-menu" >';
		$str .= $strGenBar;
		$str .= '					</ul>';
		$str .= '				</li>';
		$str .= $strGenBar;
		$str .= '			</ul>';
		$str .= '		<div class="clearfix"></div>';
		$str .= '		</div>';
		$str .= '	</div>';
		$str .= '</div>';
		return $str;
	}

	public function specBar($items=array()) {
		$print	          = array('id'=>'btn-print'	, 'title'=>'バーコード'	, 'icon'=>'glyphicon-print'	, 'lable'=>'バーコード');
		$print_stock      = array('id'=>'btn-print'	, 'title'=>'在庫調整一覧'	, 'icon'=>'glyphicon-print'	, 'lable'=>'在庫調整一覧');
		$print_main       = array('id'=>'btn-print'	, 'title'=>'印刷'	, 'icon'=>'glyphicon-print'	, 'lable'=>'印刷');
		$export	          = array('id'=>'btn-export'	, 'title'=>'出力'	, 'icon'=>'glyphicon-export'	, 'lable'=>'出力');
		$import	          = array('id'=>'btn-import'	, 'title'=>'取込'	, 'icon'=>'glyphicon-import'	, 'lable'=>'取込');
		$copy	          = array('id'=>'btn-copy'	, 'title'=>'コピー登録'	, 'icon'=>'glyphicon-edit'	, 'lable'=>'コピー登録');
		$stock_secure     = array('id'=>'btn-stock_secure'	, 'title'=>'在庫確保'	, 'icon'=>'glyphicon-edit'	, 'lable'=>'在庫確保');
		$execute          = array('id'=>'btn-execute'	, 'title'=>'実行'	, 'icon'=>''	, 'lable'=>'実行');
		$confirm_batch    = array('id'=>'btn-confirm_batch'	, 'title'=>'バッチ状況確認'	, 'icon'=>''	, 'lable'=>'バッチ状況確認');
		$change_office    = array('id'=>'btn-change-office'	, 'title'=>'支援事業所変更'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'事業所変更');
		$edit_phrase      = array('id'=>'edit-phrase'	, 'title'=>'文例編集'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'文例編集');
		$situation_history= array('id'=>'btn-show-his'	, 'title'=>'状況履歴'	, 'icon'=>'glyphicon glyphicon-road'	, 'lable'=>'状況履歴');
		$repair_history   = array('id'=>'btn-register-repair-his'	, 'title'=>'修理履歴登録'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'修理履歴登録');
		$item_spec        = array('id'=>'btn-print-item-spec'	, 'title'=>'単品明細表印刷'	, 'icon'=>'glyphicon-print'	, 'lable'=>'単品明細表');
		$visit_his_detail = array('id'=>'btn-visit-his-detail'	, 'title'=>'訪問履歴詳細'	, 'icon'=>'fa fa-car'	, 'lable'=>'訪問履歴詳細');
		$visit_his_del    = array('id'=>'btn-visit-his-del'	, 'title'=>'訪問履歴削除'	, 'icon'=>'fa fa-car'	, 'lable'=>'訪問履歴削除');
		// BEGIN : KienNT - update - 2015/06/18
		$print_after_subject        = array('id'=>'btn-print-after-subject'	, 'title'=>'アフターサービス対象者一覧表'	, 'icon'=>'glyphicon glyphicon-print'	, 'lable'=>'㋐対象者');
		$print_after_report			= array('id'=>'btn-print-after-report'	, 'title'=>'アフターサービス報告書印刷'	, 'icon'=>'glyphicon glyphicon-print'	, 'lable'=>'㋐報告書');
		$accept_register			= array('id'=>'accept-register'	, 'title'=>'受注登録'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'受注登録');
		$rent_collect_list			= array('id'=>'rent-collect-list'	, 'title'=>'貸出・回収情報一覧'	, 'icon'=>'fa fa-retweet'	, 'lable'=>'貸出・回収');
		$rent_plan					= array('id'=>'rent-plan'	, 'title'=>'貸出予定'	, 'icon'=>'fa fa-retweet'	, 'lable'=>'貸出予定');
		$rent_monthly_detail		= array('id'=>'rent-monthly-detail'	, 'title'=>'貸出月次明細情報'	, 'icon'=>'fa fa-retweet'	, 'lable'=>'貸出月次明細');
		$contact_register			= array('id'=>'contact-register'	, 'title'=>'連絡先情報登録'	, 'icon'=>'fa fa-phone'	, 'lable'=>'連絡先登録');
		$approve_register			= array('id'=>'approve-register'	, 'title'=>'認定情報登録'	, 'icon'=>'glyphicon glyphicon-certificate'	, 'lable'=>'認定情報登録');
		$visit_register				= array('id'=>'visit-register'	, 'title'=>'訪問履歴登録'	, 'icon'=>'fa fa-car'	, 'lable'=>'訪問登録');
		$btn_print_after_report		= array('id'=>'btn-print-after-report'	, 'title'=>'報告書印刷'	, 'icon'=>'glyphicon glyphicon-print'	, 'lable'=>'㋐報告書');
		$service_plan_register		= array('id'=>'service-plan-register'	, 'title'=>'サービス計画書作成'	, 'icon'=>'fa fa-plus-square'	, 'lable'=>'㋚作成');
		$error_register				= array('id'=>'error-register'	, 'title'=>'過誤登録'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'過誤登録');
		// END : KienNT - update - 2015/06/18
		// Canh - update - 2015/05/26
		$link_ms131       = array('id'=>'btn-link_ms131'	, 'title'=>'レンタル単価'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'レンタル単価');
		$link_ms341       = array('id'=>'btn-link_ms341'	, 'title'=>'販売単価'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'販売単価');
		// END : Canh - update - 2015/05/26

		// BEGIN : Sang - update - 2015/06/10
		$ms130_copy       = array('id'=>'btn-ms130_copy'	, 'title'=>'予防一般を除いてコピー'	, 'icon'=>''	, 'lable'=>'予防一般を除いてコピー');
		// END 	 : Sang - update - 2015/06/10

		// Canh - update - 2015/06/17
		$edit_1_rc040	= array('id'=>'btn-edit_1_rc040'		, 'title'=>'サービス利用確認書'	, 'icon'=>'glyphicon-edit'		, 'lable'=>'サービス利用確認書');
		$print_rc040	= array('id'=>'btn-print_rc040'	, 'title'=>'メディケアカード'	, 'icon'=>'glyphicon-print'	, 'lable'=>'メディケアカード');
		$edit_2_rc040	= array('id'=>'btn-edit_2_rc040'		, 'title'=>'空受注'	, 'icon'=>'glyphicon-edit'		, 'lable'=>'空受注');
		$save_rc040 	= array('id'=>'btn-save_rc040'	, 'title'=>'出荷確定'	, 'icon'=>'glyphicon-ok'		, 'lable'=>'出荷確定');
		// END : Canh - update - 2015/06/17

		// AnhMT - update - 2015/08/06
		$setting    = array('id'=>'btn-setting'         ,'title'=>'単品管理番号設定'       ,'icon'=>'glyphicon-pencil'       , 'lable' =>'単品番号設定');
		$toretrieve = array('id'=>'btn-to-retrieve'     ,'title'=>'回収予定へ変更'         ,'icon'=>'glyphicon-refresh'      , 'lable' =>'回収予定へ');
		$tolending  = array('id'=>'btn-to-lending'      ,'title'=>'貸出中へ変更'           ,'icon'=>'glyphicon-refresh'      , 'lable' =>'貸出中へ');
		$tosave     = array('id'=>'btn-to-save'         ,'title'=>'セットマスタ読み込み'    ,'icon'=>'glyphicon-floppy-save'  , 'lable' =>'ｾｯﾄﾏｽﾀ読込');
		$printbarcode       = array('id'=>'btn-print-barcode'         ,'title'=>'バーコード印刷'    ,'icon'=>'glyphicon-print'  , 'lable' =>'バーコード');
		$printgoodslist     = array('id'=>'btn-print-goods-list'         ,'title'=>'仕入れ商品リスト印刷'    ,'icon'=>'glyphicon-print'  , 'lable' =>'仕入商品ﾘｽﾄ');
		$print_st250	    = array('id'=>'btn-print'	, 'title'=>'廃棄商品リスト印刷'	, 'icon'=>'glyphicon-print'	, 'lable'=>'廃棄商品リスト');
		$revert	            = array('id'=>'btn-revert'	, 'title'=>'復活'	, 'icon'=>''	, 'lable'=>'復活');
		// END : AndMT - update - 2015/08/06

		// AnhTV - update - 2015/08/10
		$print_1_rc280    = array('id'=>'btn-print-return-paper'	,'title'=>'回収用紙印刷'       ,'icon'=>'glyphicon-print'       , 'lable' =>'回収用紙印刷');
		$print_2_rc280    = array('id'=>'btn-print-return-slip'     ,'title'=>'回収伝票印刷'       ,'icon'=>'glyphicon-print'       , 'lable' =>'回収伝票印刷');
		$print_3_rc280    = array('id'=>'btn-print-contact-suspend' ,'title'=>'契約中断用紙印刷'    ,'icon'=>'glyphicon-print'       , 'lable' =>'契約中断用紙');
		// END : AnhTV - update - 2015/08/10

		$rc011_copy_carry_in_plan_date	= array('id'=>'btn-copy_carry_in_plan_date'	, 'title'=>'搬入予定日'	, 'icon'=>'glyphicon-copyright-mark'	, 'lable'=>'搬入予定日');
		$rc011_copy_ship_plan_date	= array('id'=>'btn-copy-ship_plan_date'	, 'title'=>'出荷予定日'	, 'icon'=>'glyphicon-copyright-mark'	, 'lable'=>'出荷予定日');
		$rc011_copy_execute_date	= array('id'=>'btn-copy-execute_date'	, 'title'=>'対応日'	, 'icon'=>'glyphicon-copyright-mark'	, 'lable'=>'対応日');

		$rc011_cleardate	= array('id'=>'btn-cleardate'	, 'title'=>'日付ｸﾘｱ'	, 'icon'=>'glyphicon-remove'	, 'lable'=>'日付ｸﾘｱ');
		$rc011_changestatus1	= array('id'=>'btn-changestatus1'	, 'title'=>'出荷可能へ'	, 'icon'=>'glyphicon-arrow-right'	, 'lable'=>'出荷可能へ');
		$rc011_changestatus2	= array('id'=>'btn-changestatus2'	, 'title'=>'出荷済へ'	, 'icon'=>'glyphicon-arrow-right'	, 'lable'=>'出荷済へ');
		$rc011_changestatus3	= array('id'=>'btn-changestatus3'	, 'title'=>'指示に戻す'	, 'icon'=>'glyphicon-arrow-left'	, 'lable'=>'指示に戻す');
		$rc011_changestatus4	= array('id'=>'btn-changestatus4'	, 'title'=>'待ちに戻す'	, 'icon'=>'glyphicon-arrow-left'	, 'lable'=>'待ちに戻す');
		$rc011_cancel	= array('id'=>'btn-cancel'	, 'title'=>'受注ｷｬﾝｾﾙ'	, 'icon'=>'glyphicon-remove'	, 'lable'=>'受注ｷｬﾝｾﾙ');
		$rc011_rc090	= array('id'=>'btn-rc090'	, 'title'=>'単品番号表示'	, 'icon'=>'fa fa-list-ul icon-item'	, 'lable'=>'単品番号表示');
		$rc011_cs060	= array('id'=>'btn-cs060'	, 'title'=>'訪問履歴登録'	, 'icon'=>'fa fa-car icon-item'	, 'lable'=>'訪問履歴登録');
		$btn_edit_withdrawal		= array('id'=>'btn-edit-withdrawal'	, 'title'=>'出金一覧表印刷'	, 'icon'=>'glyphicon-edit', 'lable'=>'出金情報入力');
		$btn_print_cashbook	= array('id'=>'btn-print-cashbook'	, 'title'=>'現金出納帳印刷'	, 'icon'=>'glyphicon-print', 'lable'=>'現金出納帳');
		$btn_print_withdrawal_list	= array('id'=>'btn-print-withdrawal-list'	, 'title'=>'出金一覧表印刷'	, 'icon'=>'glyphicon-print', 'lable'=>'出金一覧表');
		$od050_copy 	= 	array('id'=>'btn-copy'	, 'title'=>'日付コピー'	, 'icon'=>'glyphicon-copyright-mark'	, 'lable'=>'日付コピー');
		$od050_get 		= 	array('id'=>'btn-get'	, 'title'=>'強制完了'		, 'icon'=>'glyphicon-arrow-left'		, 'lable'=>'強制完了');
		$od050_print 	= 	array('id'=>'btn-print'	, 'title'=>'商品申込書'	, 'icon'=>'glyphicon-print'				, 'lable'=>'商品申込書');
		$rc180_confirm = array('id'=>'btn-confirm'	, 'title'=>'確認'	, 'icon'=>'glyphicon-ok'		, 'lable'=>'確認');
		$rc180_execute = array('id'=>'btn-execute'	, 'title'=>'実行'	, 'icon'=>'glyphicon-ok'		, 'lable'=>'実行');
		$retrieve_plan_change = array('id'=>'retrieve-plan-change'	, 'title'=>'実行'	, 'icon'=>'glyphicon-arrow-left'		, 'lable'=>'実行');
		$cs140_add      = array('id'=>'cs140_add'	, 'title'=>'受注登録'	, 'icon'=>'glyphicon glyphicon-edit'	, 'lable'=>'受注登録');


		$strSpecBar = '';
		foreach ($items as $item) {
			$item_arr = $$item;
			$strSpecBar .= '<li id="' . $item_arr['id'] . '" class="func-button text-center ' . $item_arr['id'] . '">';
			$strSpecBar .= '<a tabindex="0" data-toggle="tooltip" title="' . $item_arr['title'] . '">';
			$strSpecBar .= '<span class="glyphicon ' . $item_arr['icon'] . ' icon-item"></span>';
			$strSpecBar .= '<span class="text-item">' . $item_arr['lable'] . '</span>';
			$strSpecBar .= '</a>';
			$strSpecBar .= '</li>';
		}
		return $strSpecBar;
	}

	public function genBar($items=array()) {
		// Canh - update - 2015/06/09
		$copy	= array('id'=>'btn-copy'	, 'title'=>'コピー'	, 'icon'=>'glyphicon-copyright-mark'	, 'lable'=>'コピー');
		// END : Canh - update - 2015/06/09
		$search	= array('id'=>'btn-search'	, 'title'=>'検索'	, 'icon'=>'glyphicon-search'	, 'lable'=>'検索');
		$add	= array('id'=>'btn-add'		, 'title'=>'新規'	, 'icon'=>'glyphicon-edit'		, 'lable'=>'新規');
		$edit 	= array('id'=>'btn-edit'	, 'title'=>'修正'	, 'icon'=>'glyphicon-pencil'	, 'lable'=>'修正');
		$clear 	= array('id'=>'btn-clear'	, 'title'=>'クリア'	, 'icon'=>'glyphicon-remove'	, 'lable'=>'クリア');
		$back 	= array('id'=>'btn-back'	, 'title'=>'戻る'	, 'icon'=>'glyphicon-share-alt'	, 'lable'=>'戻る');
		$save 	= array('id'=>'btn-save'	, 'title'=>'保存'	, 'icon'=>'glyphicon-ok'		, 'lable'=>'保存');
		$del 	= array('id'=>'btn-del'		, 'title'=>'削除'	, 'icon'=>'glyphicon-trash'		, 'lable'=>'削除');
		$add_child 	= array('id'=>'btn-add-row'		, 'title'=>'子商品追加'	, 'icon'=>'glyphicon-plus'		, 'lable'=>'子商品追加');
		$del_child 	= array('id'=>'btn-del-row'		, 'title'=>'子商品削除'	, 'icon'=>'glyphicon-minus'		, 'lable'=>'子商品削除');
		$view_edit 	= array('id'=>'btn-view-edit'	, 'title'=>'修正（詳細）'	, 'icon'=>'glyphicon-pencil'	, 'lable'=>'修正（詳細）');

		// Duy - update - 2015/06/05 - Reason: same id with the aboves but different in title and label
		$add_row 	= array('id'=>'btn-add-row'		, 'title'=>'行追加'	, 'icon'=>'glyphicon-plus'		, 'lable'=>'行追加');
		$del_row 	= array('id'=>'btn-del-row'		, 'title'=>'行削除'	, 'icon'=>'glyphicon-minus'		, 'lable'=>'行削除');
		// END: Duy - update - 2015/06/05

		// Canh - update - 2015/05/26
		$move_up_row 	= array('id'=>'btn-move-up-row'		, 'title'=>'行移動'	, 'icon'=>'glyphicon-arrow-up'		, 'lable'=>'行移動');
		$move_down_row 	= array('id'=>'btn-move-down-row'	, 'title'=>'行移動'	, 'icon'=>'glyphicon-arrow-down'	, 'lable'=>'行移動');
		$append_row_1   = array('id'=>'btn-append-row-1'	    , 'title'=>'仕入先追加'	, 'icon'=>'glyphicon-plus'	, 'lable'=>'仕入先追加');
		$del_last_row_1 = array('id'=>'btn-del-last-row-1'	    , 'title'=>'仕入先削除'	, 'icon'=>'glyphicon-minus'	, 'lable'=>'仕入先削除');
		$append_row_2   = array('id'=>'btn-append-row-2'	    , 'title'=>'検査項目追加'	, 'icon'=>'glyphicon-plus'	, 'lable'=>'検査項目追加');
		$del_last_row_2 = array('id'=>'btn-del-last-row-2'	    , 'title'=>'検査項目削除'	, 'icon'=>'glyphicon-minus'	, 'lable'=>'検査項目削除');
		// END : Canh - update - 2015/05/26

		// Canh - update - 2015/06/17
		$search_2	= array('id'=>'btn-search-2'	, 'title'=>'キャンセル検索'	, 'icon'=>'glyphicon-search'	, 'lable'=>'キャンセル検索');
		$edit_2 	= array('id'=>'btn-edit-2'	, 'title'=>'修正 (詳細)'	, 'icon'=>'glyphicon-pencil'	, 'lable'=>'修正 (詳細)');
		$detail 	= array('id'=>'btn-detail', 'title'=>'詳細', 'icon'=>'glyphicon glyphicon-list icon-item', 'lable'=>'詳細');
		// END : Canh - update - 2015/06/17

		// AnhMT - update - 2015/08/25
		$detail_2	= array('id'=>'btn-detail', 'title'=>'明細', 'icon'=>'glyphicon glyphicon-list icon-item', 'lable'=>'明細');
		// END : AnhMT - update - 2015/08/25

		// BEGIN : KienNT - update -2015/06/18
		$btn_add_use_kind			= array('id'=>'btn-add-use-kind'	, 'title'=>'利用分類追加'	, 'icon'=>'glyphicon glyphicon-plus'	, 'lable'=>'利用分類追加');
		$btn_del_use_kind			= array('id'=>'btn-del-use-kind'	, 'title'=>'利用分類削除'	, 'icon'=>'glyphicon glyphicon-minus'	, 'lable'=>'利用分類削除');
		// END : KienNT - update -2015/06/18
		$btn_add_row_payment		= array('id'=>'btn-add-row-payment'	, 'title'=>'入金追加'	, 'icon'=>'glyphicon glyphicon-plus'	, 'lable'=>'入金行追加');
		$btn_del_row_payment		= array('id'=>'btn-del-row-payment'	, 'title'=>'入金削除'	, 'icon'=>'glyphicon glyphicon-minus'	, 'lable'=>'入金行削除');
		$strGenBar = '';
		$fix_padding = '';
		foreach ($items as $item) {
			$item_arr = $$item;
			if ($item_arr['id'] == 'btn-search'){
				$fix_padding = 'fix-padding';
			}
			$strGenBar .= '<li id="' . $item_arr['id'] . '" class="func-button text-center hidden ' . $item_arr['id'] . ' ' . $fix_padding .'">';
			$strGenBar .= '<a tabindex="0" data-toggle="tooltip" title="' . $item_arr['title'] . '" >';
			$strGenBar .= '<span class="glyphicon ' . $item_arr['icon'] . ' icon-item"></span>';
			$strGenBar .= '<span class="text-item">' . $item_arr['lable'] . '</span>';
			$strGenBar .= '</a>';
			$strGenBar .= '</li>';
		}
		return $strGenBar;
	}

	public function inforRegister($user_nm_u = '', $upd_datetime = '', $user_nm_c = '', $cre_datetime = '') {
		$html  = '<div class="register-info">';
		$html .=    '<div class="pull-right" style="margin-right: 15px;">';
		$html .=        '<label>更新者：</label>' . $user_nm_u;
		$html .=    '</div>';
		$html .=    '<div class="pull-right" style="margin-right: 15px;">';
		$html .=        '<label>更新日：</label>' . $upd_datetime;
		$html .=    '</div>';
		$html .=    '<div class="pull-right" style="margin-right: 15px;">';
		$html .=        '<label>登録者：</label>' . $user_nm_c;
		$html .=    '</div>';
		$html .=    '<div class="pull-right" style="margin-right: 15px;">';
		$html .=        '<label>登録日：</label>' . $cre_datetime;
		$html .=    '</div>';
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * @param unknown $object
	 * @return string
	 */
	function displayInfo($object, $option = 1){
		$max_lenght = 10;

		// 		$object['upd_user_nm'] = 'おおおおおおおおおおお';
		// 		$object['cre_user_nm'] = 'おおおおおおおおおおおおおおおお';
		if ($option == 1){
			if(isset($object['user_nm_c'])){
				$object['cre_user_nm'] = $object['user_nm_c'];
			}else{
				if(isset($object['cre_user_nm'])){
					$object['cre_user_nm'] = $object['cre_user_nm'];
				}else{
					$object['cre_user_nm'] = '';
				}

			}
			if(isset($object['user_nm_u'])){
				$object['upd_user_nm'] =  $object['user_nm_u'];
			}else{
				if(isset($object['upd_user_nm'])){
					$object['upd_user_nm'] =  $object['upd_user_nm'];
				}else{
					$object['upd_user_nm'] = '';
				}

			}

			$cre_nm = mb_substr($object['cre_user_nm'], 0, $max_lenght, "utf-8");
			if(mb_strlen($object['cre_user_nm'], 'utf-8') > $max_lenght)
				$cre_nm .= '...';
			$upd_nm = mb_substr($object['upd_user_nm'], 0, $max_lenght, "utf-8");
			if(mb_strlen($object['upd_user_nm'], 'utf-8') > $max_lenght)
				$upd_nm .= '...';
			// Canh - update - 2015/06/09
			$upd_datetime = isset($object['upd_datetime']) ? $object['upd_datetime'] : '';
			$cre_datetime = isset($object['cre_datetime']) ? $object['cre_datetime'] : '';
			// END : Canh - update - 2015/06/09
			$html = '
					<div class="register-info">
					<div class="pull-right" title="'.$object['upd_user_nm'].'">
						<label>更新者：</label>'.$upd_nm.'</div>
					<div class="pull-right">
						<label>更新日：</label>'.$upd_datetime.'</div>
					<div class="pull-right"  title="'.$object['cre_user_nm'].'">
						<label>登録者：</label>'.$cre_nm.'</div>
					<div class="pull-right">
						<label>登録日：</label>'.$cre_datetime.'</div>
					</div>';
			// START: HaTT - update 2015/07/30 - display only update information
			} else {
				if(isset($object['user_nm_u'])){
					$object['upd_user_nm'] =  $object['user_nm_u'];
				}else{
					if(isset($object['upd_user_nm'])){
						$object['upd_user_nm'] =  $object['upd_user_nm'];
					}else{
						$object['upd_user_nm'] = '';
					}
				}

				$upd_nm = mb_substr($object['upd_user_nm'], 0, $max_lenght, "utf-8");
				if(mb_strlen($object['upd_user_nm'], 'utf-8') > $max_lenght)
					$upd_nm .= '...';
				// Canh - update - 2015/06/09
				$upd_datetime = isset($object['upd_datetime']) ? $object['upd_datetime'] : '';
				// END : Canh - update - 2015/06/09
				$html = '
					<div class="register-info">
					<div class="pull-right" title="'.$object['upd_user_nm'].'">
						<label>更新者：</label>'.$upd_nm.'</div>
					<div class="pull-right">
						<label>更新日：</label>'.$upd_datetime.'</div>
					</div>';
			}
			// END: HaTT - update 2015/07/30
		echo $html;
	}

	/**
	 * format money
	 * @author kiennt
	 * @param unknown $val
	 * @param unknown $decimal_num
	 * @return unknown|string
	 */
	public function viewnumberformat($val,$decimal_num=0,$round=false){
		if($round){
			return number_format(1*$val,$decimal_num,'.',',');
		}

		if(((1*$val)-round(1*$val))==0){
			return number_format(1*$val,0,'.',',');
		}else{
			return number_format(1*$val,$decimal_num,'.',',');
		}
	}

	/**
	 * format value
	 * @author anhmt
	 * @param unknown $val
	 * @param unknown $num
	 * @return unknown|string
	 */
	public function formatEnding($val,$num=0){
		if ($val*1 == 0) {
			$val = '';
		} else {
			$val = $this->viewnumberformat($val, $num, false);
		}
		return $val;
	}

	/**
	 * format date
	 * @author GiangNT
	 * @return date
	 */
	public function formatDate($val = '', $type = 'Y/m/d'){
		if(empty($val)) {
			return '';
		}
		return date_format(date_create($val), $type);;
	}
	
	/**
	* @author KienNT
	 * @return string 'YYYY/MM
	 * @param string $val YYYYMM
	 */
	public function showYm($val = ''){
		if(strlen($val)==6){
			return( substr($val,0,4).'/'.substr($val, 4,strlen($val)-1) );
		}else{
			return '';
		}
		return '';
	}
	
	/**
	 * Generate dropdown form
	 *
	 * @param $var =
	 *            array(
	 *            "data" => $data, // list data
	 *            "value_key" => $value_key, // value key
	 *            "label_key" => $label_key, // label key.
	 *            "value" => $value, // selected value
	 *            "name" => $name, //name of select box
	 *            "id"	=> $id, // id of select box
	 *            "clazz" => $cssClass // css class of select box
	 *            "style" => $style // style inline
	 *            "has_empty" => $has_empty // Add default empty option
	 *            "option_default" => $option_default // Add default empty option
	 *            "html_option" => $html_option // html attributes for dropdownlist.
	 *            );
	 */
	public function myFormDropdown($var = array()) {
		// Select list items from code_master table
		$items =  $var['data'];

		$html_option = "";
		if(isset($var['html_option'])){
			$html_option = $var['html_option'];
		}
		$html = "<select name=\"" . $var['name'] . "\" id=\"" . $var['id'] . "\" class=\"" . $var['clazz'] . "\" style=\"".$var['style']."\" ".$html_option." >";
		if ($var['has_empty']) {
			$option_default = "";
			if(array_key_exists('option_default', $var)){
				$option_default = $var['option_default'];
			}
			$html = $html . "<option value=\"\">" . $option_default . "</option>";
		}
		foreach ( $items as $item ) {
			$selected = $item[$var['value_key']] == $var['value'] ? "selected=\"selected\"" : "";
			$html = $html . "<option value=\"" . $item[$var['value_key']] . "\" " . $selected . ">" .$item[$var['label_key']] . "</option>";
		}
		$html = $html . "</select>";


		return $html;
	}
}
?>
