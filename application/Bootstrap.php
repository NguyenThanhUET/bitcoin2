<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initAutoload() {
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
			'basePath' => APPLICATION_PATH,
			'namespace' => '',
			'resourceTypes' => array(
				'form' => array(
					'path' => 'forms/',
					'namespace' => 'Form_'
				),
				'model' => array(
					'path' => 'models/',
					'namespace' => 'Model_'
				)
			)
		));
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array(
				'module'     => 'error',
				'controller' => 'error',
				'action'     => 'index'
		)));
		Zend_Session::start();
		Zend_Layout::startMvc();
	}

	protected function _initSession() {
		$options = $this->getOptions();
		Zend_Session::setOptions($options['resources']['session']);
		Zend_Session::start();
	}

	protected function _initDoctype() {
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('HTML5');
	}

	protected function _initRewrite() {
		$front = Zend_Controller_Front::getInstance();
		$router = $front->getRouter();
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/routes.ini', 'routers');

		if(isset($config->routes)) {
				$router->addConfig($config,'routes');
		}
		// $router->addRoute(
		// 'logout',
		// new Zend_Controller_Router_Route('/logout',
													// array(
													// 'module' => 'auth',
													// 'controller' => 'Index',
													// 'action' => 'logout'))
		// );
	}

}
?>
