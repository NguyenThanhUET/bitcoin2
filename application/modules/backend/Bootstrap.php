<?php
/**
 * Admin Bootstrap
 *
 * @author        GiangNT
 * @package       Auth Module
 *
 */
class Backend_Bootstrap extends Zend_Application_Module_Bootstrap
{

	protected function _initAutoload() {
		$moduleLoader = new Zend_Application_Module_Autoloader(array(
					'namespace' => 'Backend',
					'basePath' => APPLICATION_PATH . '/modules/backend'
					));

		$resourceLoader = new Zend_Loader_Autoloader_Resource ( array (
				'basePath' => APPLICATION_PATH . '/modules/backend',
				'namespace' => '',
				'resourceTypes' => array (
						'controller' => array (
								'path' => '/controllers',
								'namespace' => 'Backend_'
						)
				)
		));
		return;
	}

}
