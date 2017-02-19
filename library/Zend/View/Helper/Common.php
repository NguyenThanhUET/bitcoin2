<?php
class Zend_View_Helper_Common extends Zend_View_Helper_Abstract
{
	public function common() {
		return $this;
	}
	public function vn_str_filter($str){
		$str_before = array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
							"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
							,"ế","ệ","ể","ễ",
							"ì","í","ị","ỉ","ĩ",
							"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
							,"ờ","ớ","ợ","ở","ỡ",
							"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
							"ỳ","ý","ỵ","ỷ","ỹ",
							"đ",
							"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
							,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
							"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
							"Ì","Í","Ị","Ỉ","Ĩ",
							"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
							,"Ờ","Ớ","Ợ","Ở","Ỡ",
							"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
							"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
							"Đ", " ");
						
		$str_after = array("a","a","a","a","a","a","a","a","a","a","a"
						,"a","a","a","a","a","a",
						"e","e","e","e","e","e","e","e","e","e","e",
						"i","i","i","i","i",
						"o","o","o","o","o","o","o","o","o","o","o","o"
						,"o","o","o","o","o",
						"u","u","u","u","u","u","u","u","u","u","u",
						"y","y","y","y","y",
						"d",
						"A","A","A","A","A","A","A","A","A","A","A","A"
						,"A","A","A","A","A",
						"E","E","E","E","E","E","E","E","E","E","E",
						"I","I","I","I","I",
						"O","O","O","O","O","O","O","O","O","O","O","O"
						,"O","O","O","O","O",
						"U","U","U","U","U","U","U","U","U","U","U",
						"Y","Y","Y","Y","Y",
						"D", "-");
		return strtolower(str_replace($str_before,$str_after,$str));
	}
	public function product_price($priceFloat) {
		$symbol = 'đ';
		$symbol_thousand = '.';
		$decimal_place = 0;
		$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
		return $price.$symbol;
	}
}
?>