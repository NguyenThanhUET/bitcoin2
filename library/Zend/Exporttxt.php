<?php
/**
 * Class process export TXT file
 *
 * @category  ANS-ASIA
 * @package   Zend
 * @copyright  Copyright (c) 2016 ANS-ASIA
 */
class Zend_Exporttxt
{
	/**
	 * export CSV
	 * @param array $data
	 */
	function export($data){
		try{
			if(file_exists(APPLICATION_PATH . '/configs/common.ini')){
				$fileName		=	md5(time()).'.txt';
				$commonConfig	=	new Zend_Config_Ini(APPLICATION_PATH . '/configs/common.ini', 'upload');
				$pathFile		=	$commonConfig->upload->pathTem.$fileName;
				if (($file = fopen ( $pathFile , 'w' )) !== FALSE) {
					if($data){
						$stringData ='';
						foreach(preg_split("/((\r?\n)|(\r\n?))/", $data) as $line){
							$stringData = $stringData . $line. PHP_EOL;
						}
						fwrite ( $file, $stringData);
					}
					fclose ( $file );
				}
				$this->respon['status']		=	OK;
				$this->respon['message'] 	=	'';
				$this->respon['filename'] 	=	$fileName;
			}else{
				$this->respon['status']		=	NG;
				$this->respon['message']	=	'Don\'t find file config';
			}
		}catch(Exception $e){
			$this->respon['status']		=	EX;
			$this->respon['message'] 	=	$e->getMessage();
		}
		return $this->respon;
	}
	/**
	 * download TXT
	 * @param string $filename
	 */
	public function download($filename,$newname) {
		$commonConfig	=	new Zend_Config_Ini(APPLICATION_PATH . '/configs/common.ini', 'upload');
		$file			=	$commonConfig->upload->pathTem.$filename;
		$type		=	filetype($file);
		$today		=	date("F j, Y, g:i a");
		$time		=	time();
		header("Content-type: $type");
		$newname = mb_convert_encoding(urlencode($newname), 'utf-8', 'SJIS');
		header("Content-Disposition: attachment;filename*=UTF-8''$newname");
		header("Content-Transfer-Encoding: binary");
		header('Pragma: no-cache');
		header('Expires: 0');
		set_time_limit(0);
		echo chr(239) . chr(187) . chr(191);
		readfile($file);
		@unlink($file);
		exit();
	}
}
