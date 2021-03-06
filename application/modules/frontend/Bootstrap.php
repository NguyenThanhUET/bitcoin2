<?php
/**
 * Admin Bootstrap
 *
 * @author        GiangNT
 * @package       Auth Module
 *
 */
class Frontend_Bootstrap extends Zend_Application_Module_Bootstrap
{

	protected function _initAutoload() {
		$moduleLoader = new Zend_Application_Module_Autoloader(array(
					'namespace' => 'Frontend',
					'basePath' => APPLICATION_PATH . '/modules/frontend'
					));

		$resourceLoader = new Zend_Loader_Autoloader_Resource ( array (
				'basePath' => APPLICATION_PATH . '/modules/frontend',
				'namespace' => '',
				'resourceTypes' => array (
						'controller' => array (
								'path' => '/controllers',
								'namespace' => 'Frontend_'
						)
				)
		));
		return;
	}

}
