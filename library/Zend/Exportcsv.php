<?php
/**
 * Class process export CSV file
 *
 * @category  ANS-ASIA
 * @package   Email
 * @copyright  Copyright (c) 2016 ANS-ASIA
 */
class Zend_Exportcsv
{
	/**
	 * export CSV
	 * @param array $data
	 */
	function export($data){
		try{
			if(file_exists(APPLICATION_PATH . '/configs/common.ini')){
				$fileName		=	md5(time()).'.csv';
				$commonConfig	=	new Zend_Config_Ini(APPLICATION_PATH . '/configs/common.ini', 'upload');
				$pathFile		=	$commonConfig->upload->pathTem.$fileName;
				if (($file = fopen ( $pathFile , 'a+' )) !== FALSE) {
					if($data){
						foreach ($data as $row){
							fputcsv ( $file, $row, ',' );
						}
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
	 * download CSV
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
