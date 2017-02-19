<?php
/**
 ****************************************************************************
* MOVE
* REFER DATA
*
* 処理概要/process overview		:	Refer data in project
* 作成日/create date			:	2015/11/04
* 作成者/creater				:	viettd – viettd@ans-asia.com
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
class Frontend_UploadController extends Frontend_AppController {
    protected $getListFile = array() ;
    protected $parentPath;
    public function init() {
        parent::init();
        $this->_helper->layout->disablelayout();
        $this->_helper->viewRenderer->setNoRender();
        $commonUploadPath = new Zend_Config_Ini(APPLICATION_PATH . '/configs/common.ini', 'upload');
        $this->parentPath	=	$commonUploadPath->upload->folderTo;

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

    public function uploadAction() {
        try {
            $result = array(
                    'status'	=>	NG,
                    'fileName'	=>	'',
                    'newName'	=>	'',
                    'reName'	=>	'',
                    'fullPath'	=>	'',
                    'message'	=>	''
            );
            $numberDetail = '';

            if ($this->_request->isPost ()) {
                $memberID	=	$this->user['ID'];
                $transaction_typ    =   $this->getParam('_packageMode',1);
                $reNameFile	=	date('ymdhhmmss.');


                if($memberID !=''){
                    $numberDetail = "".$memberID;
                }

                $pathUpload	=	new Zend_Config_Ini ( APPLICATION_PATH . '/configs/common.ini', 'upload' );
                $dirTemp	=	$pathUpload->upload->folderTo .$numberDetail;
                // 				$dirTemp .= ($screen.'\\');
                $maxSize	=	$pathUpload->upload->maxSize;
                $arrExt		=	$pathUpload->upload->ext->toArray();
                if (! is_dir ( $dirTemp )) {
                    mkdir ( $dirTemp ,'0777',true);
                    chmod($dirTemp, 0777);
                }
                $upload = new Zend_File_Transfer ();
                $upload->setDestination ( $dirTemp );
                $upload->setOptions ( array (
                        'useByteString' => false
                ) );
                $upload->addValidator('Size', false, array('min' => 0, 'max' => $maxSize));
                if($upload->isValid()){
                    $error = 0;
                    if($error == 0){
                        if ($upload->isUploaded ( 'fileUpload')){
                            $filePath = '';
                            if($reNameFile==''){
                                $sourceName	= 	mb_convert_encoding( $upload->getFileName('fileUpload',false), "SJIS");
                                //$nameReturn = $upload->getFileName('fileUpload',false);
                                $filePath = $upload->getFileName('fileUpload',false);
                            }else{
                                $sourceName = $reNameFile;
                                $filePath   = $upload->getFileName('fileUpload',false) ;
                            }
                            $upload->addFilter ( 'Rename', array (
                                    'target' => $sourceName.pathinfo($filePath, PATHINFO_EXTENSION)/* $name */,
                                    'overwrite' => true
                            ) );
                            $result = array(
                                    'status'	=>	OK,
                                    'fileName'	=>	$filePath,
                                    'newName'	=>	$filePath/* $name */,
                                    'reName'	=>	$reNameFile,
                                    'fullPath'	=>	$dirTemp.'/'.$reNameFile.pathinfo($filePath, PATHINFO_EXTENSION),
                                    'message'	=>	'success'
                            );
                            $upload->receive ();
                            $this->updateHistory($this->user['ID'],$result['fullPath'],$transaction_typ);
                        }
                    }
                }else{
                    $result = array(
                            'status'	=>	2,
                            'fileName'	=>	'',
                            'newName'	=>	'',
                            'reName'	=>	'',
                            'fullPath'	=>	'',
                            'message'	=>	'Error'
                    );
                }
            }
        } catch ( Exception $ex ) {
            $result = array(
                    'status'	=>	EX,
                    'fileName'	=>	'',
                    'newName'	=>	'',
                    'reName'	=>	'',
                    'fullPath'	=>	'',
                    'message'	=>	'Exception'
            );
        }
        $this->getHelper('json')->sendJson($result);
    }
    private function updateHistory($userID,$filePath,$transaction_typ){
        $params =   array(
            $userID
        ,   $filePath
        ,   $transaction_typ
        );
        $data = $this->model->executeSql('SPC_UPDATE_TRANSACTION_GH', $params);
    }

}



