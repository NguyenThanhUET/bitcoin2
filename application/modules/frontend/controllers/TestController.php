<?php
class Frontend_TestController extends Frontend_AppController {

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
		$this->_helper->viewRenderer->setNoRender();
		$EMAIL      = "nguyenthanhuet2016@gmail.com";
		$PASSWORD   = "thienminh1992";
		$cookie = '';
		$a = $this->cURL("https://login.facebook.com/login.php?login_attempt=1",true,null,"email=$EMAIL&pass=$PASSWORD");

		preg_match('%Set-Cookie: ([^;]+);%',$a,$b);
		$c = $this->cURL("https://login.facebook.com/login.php?login_attempt=1",true,$b[1],"email=$EMAIL&pass=$PASSWORD");
		preg_match_all('%Set-Cookie: ([^;]+);%',$c,$d);
		for($i=0;$i<count($d[0]);$i++)
			$cookie.=$d[1][$i].";";
		/*
        NOW TO JUST OPEN ANOTHER URL EDIT THE FIRST ARGUMENT OF THE FOLLOWING FUNCTION.
        TO SEND SOME DATA EDIT THE LAST ARGUMENT.
        */
		/*echo $this->cURL("http://www.facebook.com/",null,$cookie,null);*/
	}

	function cURL($url, $header=NULL, $cookie=NULL, $p=NULL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, $header);
		curl_setopt($ch, CURLOPT_NOBODY, $header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		if ($p) {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
		}
		$result = curl_exec($ch);
		if ($result) {
			return $result;
		} else {
			return curl_error($ch);
		}
		curl_close($ch);
	}



}
