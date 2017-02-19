<?php
/**
 ****************************************************************************
 * MOVE
 * SCREEN ID Controller
 * 
 * 処理概要/process overview		:	Paging
 * 作成日/create date			:	2015/05/09
 * 作成者/creater				:	hiepnv – hiepnv@ans-asia.com
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
class  Zend_View_Helper_Pagination extends Zend_View_Helper_Abstract {
	public function pagination() {
		return $this;
	}
	/**
	* show()
	* 
	* @author      :   hiepnv 	- 2015/05/09 - create
	* @author      :   
	* @param       :   $page
	* @return      :   html
	* @access      :   public
	* @see         :  
	*/
	public function show($page = array()) {
		$html	= '';
		if (sizeof($page) != 0) {
			$start = min(($page['page']-1)*$page['pagesize']+1, $page['totalRecord']);
			$end   = min(($page['page'])*$page['pagesize'], $page['totalRecord']);
			//get html 
			$html	.=	'<div class="col-md-6 col-sm-6 w-info-count">';
			$html	.=	'	<form class="form-inline">';
			$html	.=	'		<div class="form-group">' . $this->pagination()->showSize($page['pagesize']) . '</div>';
			$html	.=	'		<div class="form-group">' . $this->pagination()->displayCount($start, $end, $page['totalRecord']) . '</div>';
			$html	.=	'	</form>';
			$html	.=	'</div>';
			$html	.=	'<div class="col-md-6 col-sm-6 w-paging">';
			//$html	.=	$this->pagination()->showPage($page['page'],$page['pageMax'], $page['totalRecord']);
			$html 	.=	$this->pagination()->showPage($page['page'], $page['pagesize'], $page['totalRecord']);
			$html	.=	'</div>';
			$html	.=	'<div class="clearfix"></div>';
		} else {
			$html	.=	'<div class="col-md-6 col-sm-6 w-info-count">';
			$html	.=	'	<form class="form-inline">';
			$html	.=	'		<div class="form-group"><select id="page-size" class="form-control">';
			$html	.=	'			<option value="20" >20 件</option>';
			$html	.=	'			<option value="50" selected="selected">50 件</option>';
			$html	.=	'			<option value="100">100 件</option>';
			$html	.=	'		</select></div>';
			$html	.=	'		<div class="form-group"><label class="lbl-count-data">検索結果</label></div>';
			$html	.=	'	</form>';
			$html	.=	'</div>';
			$html	.=	'<div class="col-md-6 col-sm-6 w-paging">';
			$html	.=	'	<ul class="pagination">';
			$html	.=	'	</ul>';
			$html	.=	'</div>';
			$html	.=	'<div class="clearfix"></div>';
		}
		return $html;
	}
	
	/**
	* displayCount
	* 
	* @author      :   hiepnv 	- 2015/05/09 - create
	* @author      :   
	* @param       :   null
	* @return      :   null
	* @access      :   public
	* @see         :  
	*/
	public function displayCount($start, $end, $totalRecord ) {
		$html  = '';
		if ( $start != 0) {
			$html = '<label class="lbl-count-data">検索結果（全'.number_format($totalRecord).'件中　'.number_format($start).'~'.number_format($end).'件を表示）</label>';
		} else {
			$html =  '<label class="lbl-count-data">検索結果（全'.number_format($totalRecord). '件中）';
		}
		return $html;
	}
	/**
	* showSize
	* 
	* @author      :   hiepnv 	- 2015/05/09 - create
	* @author      :   
	* @param       :   null
	* @return      :   null
	* @access      :   public
	* @see         :  
	*/
	public function showSize($size = 50) {
		$size20 = ($size == 20) ?  'selected="selected"' : '';
		$size50 = ($size == 50) ?  'selected="selected"' : '';
		$size100 = ($size ==100) ?  'selected="selected"' : '';
		$select = '';
		$select .= '<select id="page-size" class="form-control">';
		$select .=   '<option value="20" ' . $size20 . ' >20 件</option>';
		$select .=   '<option value="50" ' . $size50 . ' >50 件</option>';
		$select .=   '<option value="100" ' . $size100 . '>100 件</option>';
		$select .= '</select>';
		return $select;
	}
	/**
	 * showPage_1
	 *
	 * @author      :   hiepnv 	- 2015/05/09 - create
	 * @author      :
	 * @param       :
	 * @return      :   html
	 * @access      :   public
	 * @see         :
	 */
	// test showPage_1(2, 5, 35);
	// numberDisplay la so trang hien thi tren web, theo man mau la 5
	function showPage($page, $display, $totalRecord, $numberDisplay = 3) {
		$pageNumber = ceil($totalRecord/$display);
		if ($pageNumber < 1){
			return;
		}
		//
		$html = '<ul class="pagination">';
		// show prev
		if ($page > 1) {
			// ($page - 1)
			$html .= '<li page="'. 1 .'"><a>«</a></li>';
			$html .= '<li page="'. ($page-1) .'"><a>‹</a></li>';
		} else {
			$html .= '<li class="disabled"><a>«</a></li>';
		}
		// pageNumber nam trong khoang 1<=pageNumber<=numberDisplay
		if ($pageNumber >= 1 && $pageNumber <= $numberDisplay) {
			$html .= $this->showElements(1, $pageNumber, $page);
		}elseif ($pageNumber > $numberDisplay) { // so trang lon hon so phan tu can hien thi
			$middle 	= floor($numberDisplay / 2);
			$prevNum 	= $page - 1;
			$nextNum 	= $totalRecord - $page;
			// phia truoc va phia sau co du trang de hien thi
			if ($prevNum >= $middle && $nextNum >= $middle) {
				// nut previous
				$forLast = ($pageNumber - ($numberDisplay - 2));
				if ( ($page == $pageNumber || $page == $pageNumber - 1) && $forLast >= 0 ) {
					for($i = $forLast; $i <= $page; $i++) {
						$html .= $this->showPrev($i, $i - 1);
					}
				}
				else {
					for($i = ($page - $middle + 1); $i <= $page; $i++) {
						$html .= $this->showPrev($i, $i - 1);
					}
				}
				$html .= '<li class="actived" page="'.$page.'"><a>' . $page .' </a></li>';
				for ($i = $page; $i < ($page + $middle); $i++) {
					$html .= $this->showNext($i, $pageNumber, $i + 1);
				}
			} else {
				$html .= $this->showElements(1, $numberDisplay, $page);
			}
		}
		// show next
		if ($page < $pageNumber) {
			// ($page + 1)
			$html .= '<li page="'. ($page+1) .'"><a>›</a></li>';
			$html .= '<li page="'. $pageNumber .'"><a>»</a></li>';
		} else {
			$html .= '<li class="disabled"><a>»</a></li>';
		}
		$html .= '</ul>';
		//return html
		return $html;
	}
	/**
	 * showElements
	 *
	 * @author      :   hiepnv 	- 2015/05/09 - create
	 * @author      :
	 * @param       :   
	 * @return      :   html
	 * @access      :   public
	 * @see         :
	 */
	function showElements($start, $end, $current) {
		$html = '';
		$actived = '';
		for ($i=$start; $i <= $end; $i++) {
			if ($i == $current) {
				$actived = 'class="actived"';
			}
			$html .= '<li page="'.$i.'" ' . $actived . '>';
			$html .= '<a>' . $i . '</a>';
			$html .= '</li>';
			$actived = '';
		}
		return $html;
	}
	/**
	 * showPrev
	 *
	 * @author      :   hiepnv 	- 2015/05/09 - create
	 * @author      :
	 * @param       :   
	 * @return      :   html
	 * @access      :   public
	 * @see         :
	 */
	function showPrev($page, $char = '') {
		if ($char == '') {
			$char = 'Previous';
		}
		if ($page > 1) {
			return '<li page="'.($page - 1).'"><a>' . $char . '</a></li>';
		}
	}
	/**
	 * showNext
	 *
	 * @author      :   hiepnv 	- 2015/05/09 - create
	 * @author      :
	 * @param       :   
	 * @return      :   html
	 * @access      :   public
	 * @see         :
	 */
	function showNext($page, $pageNumber, $char = '') {
		if ($char == '') {
			$char = 'Next';
		}
		if ($page < $pageNumber) {
			return '<li page="'.($page + 1).'"><a>' . $char . '</a></li>';
		}
	}
}
?>