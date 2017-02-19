<?php
/**
 *
 * @author        GiangNT
 * @package       Base
 *
 */
class Base_AppController extends Zend_Controller_Action {

	protected $model;
	protected $user;
	protected $auth;
	public	  $logger = NULL;

	/**
	 * @author    GiangNT
	 * @package   Base
	 * @return    user, logger, model
	 */
	public function init() {
		$this->model = new Model_DAO();
		$this->auth = Zend_Auth::getInstance();
		$this->user = $this->auth->getIdentity();
		$this->view->user = $this->user;
		$this->view->message_no = $this->_getParam('MessageNo',0);
		$this->view->targetId = $this->_getParam('TargetID','');
		
		/*//2016/11/24 HiepNV unset session parram from menu
		$mode = $this->getParam('modemenu','');
		if($mode == 'menu'){
			if((Zend_Registry::isRegistered('screen_infor'))){
				Zend_Registry::set('screen_infor',array());
			}
		}*/
		//config unicode
		mb_internal_encoding('UTF-8');
		mb_http_output('SJIS');
		mb_http_input('UTF-8');
		mb_regex_encoding('UTF-8');
	}

	public function preDispatch() {

	}

	/**
	 * validate string
	 *
	 * @param string $input
	 * @return string
	 */
	public function sqlServerEscapeString($input){
		$input = str_replace('[', '[[]', $input);
		$input = str_replace('%', '[%]', $input);
		$input = str_replace('_', '[_]', $input);
		$input = rtrim($input);
		// $input = str_replace("\\", "[\\]", $input);
		// $input = str_replace("'", "''", $input);

		return $input;
	}


	/**
	 * validate string
	 * @author    GiangNT
	 * @param array, array
	 * @return array
	 */
	public function array_EscString( $datas = array(), $array_key = array(), $flag = TRUE) {
		if(empty($array_key)){
			foreach ($datas as $key => $data) {
				$datas[$key] = $this->sqlServerEscapeString($data);
			}
		} else {
			if($flag) {
				foreach ($datas as $key => $data) {
					if(in_array($key, $array_key)) {
						$datas[$key] = $this->sqlServerEscapeString($data);
					}
				}
			} else {
				foreach ($datas as $key => $data) {
					if(!in_array($key, $array_key)) {
						$datas[$key] = $this->sqlServerEscapeString($data);
					}
				}
			}
		}
		return $datas;
	}

	/**
	 * htmlspecialchars string
	 * @author    GiangNT
	 * @param array, array
	 * @return array
	 */
	public function htmlsc( $datas = array(), $array_key = array()) {
		if(empty($array_key)){
			foreach ($datas as $key => $data) {
				$datas[$key] = htmlspecialchars($data);
			}
		} else {
			foreach ($datas as $key => $data) {
				if(in_array($key, $array_key)) {
					$datas[$key] = htmlspecialchars($data);
				}
			}
		}
		return $datas;
	}

	/**
	 * format time
	 * @author    GiangNT
	 * @param array
	 * @return array
	 */
	public function format_DateTime($data = array(), $type = 'Y/m/d H:i' ,$keys = array()) {
		if(!empty($data['MakeTime'])){
			$data['MakeTime'] = $data['MakeTime']!=''?date_format(date_create($data['MakeTime']), 'Y/m/d H:i'):'';
		}
		if(!empty($data['UpdateTime'])){
			$data['UpdateTime'] = $data['UpdateTime'] != '' ? date_format(date_create($data['UpdateTime']), 'Y/m/d H:i'):'';
		}

		foreach ($keys as $key) {
			if(!empty($data[$key])){
				$data[$key] = date_format(date_create($data[$key]), $type);
			}
		}
		return $data;
	}
	/**
	 * format time
	 * @author    GiangNT
	 * @param array
	 * @return array
	 */
	public function clearIdentity() {
		$this->auth = null;
	}
	/**
	 * convert time
	 * @author    Trinhnv
	 * @param string
	 * @return string
	 */
	public function convert_DateTime($data = '19000101'){
		if($data != ''){
			$temp = $data;
			$data = substr($temp,0,4) . '-' . substr($temp,4,2) . '-' . substr($temp,6);
		}
		return $data;
	}

	/**
	 * get error
	 * @author    GiangNT
	 * @param array
	 * @return array
	 */
	public function get_Error($data = array()) {
		$result = array();
		foreach ($data as $key => $error) {
			if($error['Data'] == '1') {
				$result[0][] = $error;
			} elseif($error['Data'] == '2') {
				$result[2][] = $error;
			} elseif($error['Data'] == '3') {
				$result[3][] = $error;
			} else {
				$result[1][] = $error;
			}
		}
		return $result;
	}

	/**
	 * check multi array empty
	 * @author    GiangNT
	 * @package   Base
	 * @return    boolean
	 */
	public function is_ArrayEmpty($multiarrays) {
		if (is_array($multiarrays) and !empty($multiarrays)) {
			foreach ($multiarrays as $key => $multiarray) {
				if(!$this->is_ArrayEmpty($multiarray)){
					return false;
				}
			}
			return true;
		}
		if (empty($multiarrays)) {
			return true;
		}
		return false;
	}

	/**
	 * check isset array
	 * @author    GiangNT
	 * @package   Base
	 * @return    array
	 */

	public function issetView($data = array(), $key = 0){
		if(!isset($data[$key])){
			return array();
		}
		return $data[$key];
	}


	/**
	 * get depth array
	 *
	 * @author GiangNT
	 * @version 1.0
	 * @package Base
	 * @return int
	 */
	public function array_depth($array = array()) {
		$max_indentation = 1;
		$array_str = print_r($array, true);
		$lines = explode("\n", $array_str);
		foreach ($lines as $line) {
			$indentation = (strlen($line) - strlen(ltrim($line))) / 4;
			if ($indentation > $max_indentation) {
				$max_indentation = $indentation;
			}
		}
		return ceil(($max_indentation - 1) / 2) + 1;
	}

	/**
	 * Validate Email Address
	 * @author Canh - 2015/03/13
	 * @param string $email
	 * @return boolean
	 */
	public function validateEmail($email) {
		if($email == ''){
			return true;
		}else{
			$validator = new Zend_Validate_EmailAddress();
			return $validator->isValid($email);
		}
	}

	/**
	 * Validate Date
	 * @author Canh - 2015/03/13
	 * @param string $date
	 * @return boolean
	 */
	public function validateDate($date) {
		if($date == ''){
			return true;
		}else{
			$validator = new Zend_Validate_Date();
			return $validator->isValid($date);
		}
	}

	/**
	 * Validate URL
	 * @author Canh - 2013/03/13
	 * @param string $url
	 * @return boolean
	 */
	public function validateUrl($url) {
		if($url == ''){
			return true;
		}else{
			$validator = new Zend_Validate_Regex('/^((http|https):\/\/)?(www\.)?([a-zA-Z0-9\-_]{2,}\.){1,3}[a-z]{2,}(\/|\/[\w#?+=&%@\-\/\.]*)?$/');
			return $validator->isValid($url);
		}
	}

	/**
	 * Validate number
	 * @author Canh - 2013/03/13
	 * @param string $number
	 * @return boolean
	 */
	public function validateNumber($number) {
		if($number == ''){
			return true;
		}else{
			$validator = new Zend_Validate_Digits();
			return $validator->isValid($number);
		}
	}

	/**
	 * Validate float
	 * @author Sang - 2015/06/03
	 * @param string $number, int $real, int $img
	 * @return boolean
	 */
	public function validateFloat($number,$real,$img) {
		if($number == ''){
			return true;
		}else{
			$validator = new Zend_Validate_Regex('/^-?(?:\d+|\d*\.\d+)$/');
			if(!$validator->isValid($number)){
				return false;
			}else{
				if(strpos($number,'.')){
					$res = explode('.', $number);
					if(strlen($res[0]) > $real || strlen($res[1]) > $img){
						return false;
					}else{
						return true;
					}
				}else{
					if(strlen($number) > $real){
						return false;
					}else{
						return true;
					}
				}
			}
		}
	}

	/**
	 * Validate half-size string
	 * @author Canh - 2015/03/13
	 * @param string $halfSize
	 * @return boolean {`true` : half-size}
	 */
	public function validateHalfSize($halfSize) {
		if($halfSize == ''){
			return true;
		}else{
			$strArr = preg_split('/(?<!^)(?!$)/u', $halfSize);
			return mb_strwidth($halfSize, mb_detect_encoding($halfSize)) == count($strArr);
		}
	}

	/**
	 * Validate zip-code
	 * @author Canh - 2013/03/13
	 * @param string $zipCode
	 * @return boolean
	 */
	public function validateZipCode($zipCode) {
		if($zipCode == ''){
			return true;
		}else{
			$validator = new Zend_Validate_Regex('/^[0-9]{3}\-[0-9]{4}$/');
			return $validator->isValid($zipCode);
		}
	}

	/**
	 * Validate phone number
	 * @author Canh - 2013/03/13
	 * @param string $phone
	 * @return boolean
	 */
	public function validatePhone($phone) {
		//$validator = new Zend_Validate_Regex('/([0-9])?(-)?[0-9](-)?([0-9])?/');
		if($phone == ''){
			return true;
		}else{
			$validator = new Zend_Validate_Regex('/^[0-9]+-[0-9]+-[0-9]+$/');
			return $validator->isValid($phone);
		}
	}
	/**
	 *  Validate empty
	 *  @author trinh
	 * @param string $string
	 * @return boolean
	 */
	function validateEmpty($string){
		return !(trim($string) == '');
	}
	/**
	 * Validate array
	 * @author Canh 2015/03/20
	 *
	 * @param array $dataArr
	 * @param array $validArr
	 * @return array|boolean {false : catch error}
	 *
	 * @example $dataArr = array('maker_cd' => '259', 'maker_kana_nm' => 'sample')
	 * @example $validArr = array('maker_cd'  =>  array('empty', 'number'), 'maker_kana_nm'  =>  array('empty', 'halfsize'))
	 * @example $errors = array('maker_cd' => array('empty' => true, 'number' => false), 'maker_kana_nm'  =>  array('empty' => true, 'halfsize' => false))
	 */
	function validateArray($dataArr, $validArr) {
		try {
			$errors = array();
			$errorCnt = 0;
			foreach($validArr as $validKey => $validValue) {
				foreach($validValue as $vKey => $vV) {
					switch ($vV) {
						case 'empty':
							$errors[$validKey][$vV] = $this->validateEmpty($dataArr[$validKey]);
							break;
						case 'phone':
							$errors[$validKey][$vV] = $this->validatePhone($dataArr[$validKey]);
							break;
						case 'zipcode' :
							$errors[$validKey][$vV] = $this->validateZipCode($dataArr[$validKey]);
							break;
						case 'halfsize' :
							$errors[$validKey][$vV] = $this->validateHalfSize($dataArr[$validKey]);
							break;
						case 'number' :
							$errors[$validKey][$vV] = $this->validateNumber($dataArr[$validKey]);
							break;
						case 'url' :
							$errors[$validKey][$vV] = $this->validateUrl($dataArr[$validKey]);
							break;
						case 'date' :
							$errors[$validKey][$vV] = $this->validateDate($dataArr[$validKey]);
							break;
						case 'email' :
							$errors[$validKey][$vV] = $this->validateEmail($dataArr[$validKey]);
							break;
					}
					if (!$errors[$validKey][$vV]) {
						$errorCnt ++;
					}
				}
			}
			// if exists error
			if ($errorCnt > 0) {
				return $errors;
			} else {
				return array();
			}
		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 *  getAgoMonth
	 *  @author kiennt
	 * @param date val. timestamp
	 * @return boolean
	 */
	public function getAgoMonth($timestamp=0){
		if ($timestamp==0){ $timestamp = time(); }
		$ym = date('Y/m', strtotime('last day of -1 month', $timestamp));
		$d =  date('d', $timestamp);
		$dlast = date('t', strtotime($ym . '/01'));
		$day = $dlast > $d ? $d : $dlast;
		return $ym . '/' . $day;
	}

	/**
	 * format money
	 * @author kiennt
	 * @param unknown $val
	 * @param unknown $decimal_num
	 * @return unknown|string
	 */
	public function numberformat($val,$decimal_num){
		if(((1*$val)-round(1*$val))==0){
			return number_format(1*$val,0,'.',',');
		}else{
			return number_format(1*$val,$decimal_num,'.',',');
		}
	}
	/**
	* showInchargeInformation
	* 
	* @author      :   viettd 	- 2015/10/30 - create
	* @author      :   
	* @param       :   null
	* @return      :   null
	* @access      :   public
	* @see         :  
	*/
	public function showLoginInformation(){
		$data = array();
		$data['StaffCD'] 		= $this->user['StaffCD'];
		$data['StaffName'] 		= $this->user['StaffName'];
		$data['AreaCD']			= $this->user['AreaCD'];
		$data['OfficeCD'] 		= $this->user['OfficeCD'];
		return $data;
	}
	/**
	* getPermission
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
		// result
		return $authority_typ;
	}
	/**
	* getMailTemplate
	* 
	* @author      :   viettd 	- 2015/12/14 - create
	* @author      :   
	* @param       :   null
	* @return      :   null
	* @access      :   public
	* @see         :  
	*/
	public function getMailTemplate($mail_typ){
		$params = array(
			isset($this->user['company_no']) ? $this->user['company_no'] : 0
		,	$mail_typ
		);
		//execute store procedure
		$data = $this->model->executeSql('SPC_REFER_MAIL_TEMPLATE_INQ1',$params,'default');
		return $data[0][0];
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