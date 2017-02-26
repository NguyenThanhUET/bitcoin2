<?php
class Error_ErrorController extends Zend_Controller_Action{
    /*public function init(){
    }*/
    public function indexAction() {
        $this->_helper->_layout->disableLayout();
        $errors = $this->_getParam('error_handler');
        $this->redirect('/');
        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        $exception = $this->getResponse()->getException();
        $this->view->excCode = $exception[0]->getCode();
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                if ($this->auth->hasIdentity()) {
                    $this->auth->clearIdentity();
                }
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = 'Page not found';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = 'Application error';
                $this->redirect('/');
                break;
        }
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            if ($this->auth->hasIdentity()) {
                $this->auth->clearIdentity();
            }
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            if ($this->auth->hasIdentity()) {
                $this->auth->clearIdentity();
            }
            $this->view->exception = $errors->exception;
        }
        $this->view->request   = $errors->request;
    }
    public function getLog() {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }
    public function page404Action() {
        $this->_helper->_layout->disableLayout();
        if ($this->auth->hasIdentity()) {
            $this->auth->clearIdentity();
        }
        $this->redirect('/');
    }
    public function page403Action() {
        $this->_helper->_layout->disableLayout();
        /*if ($this->auth->hasIdentity()) {
            $this->auth->clearIdentity();
        }
        $this->auth->clearIdentity();
        $this->redirect('/');*/
    }
}