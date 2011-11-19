<?php

class ProblemsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_ProblemsMapper();
        $this->view->problems = $mapper->fetchAll();
    }

    public function addProblemAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        if ($this->getRequest()->isPost()) {
            $problem = new Application_Model_Problem($data);
            $mapper  = new Application_Model_ProblemsMapper();
            $mapper->save($problem);
        }
    }

    public function updateProblemAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        if ($this->getRequest()->isPost()) {
            $problem = new Application_Model_Problem($data);
            $mapper  = new Application_Model_ProblemsMapper();
            $mapper->update($problem);
        }
    }

    public function deleteProblemAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        $mapper = new Application_Model_ProblemsMapper();
        $mapper->delete($data['id']);
    }

    public function fetchProblemsAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       

        $mapper = new Application_Model_ProblemsMapper();
        $entries = $mapper->fetchAll();
        foreach($entries as $entry){
            echo '<li><a class="blogpost" href="#" id="'.$entry->getId().'">'.
                '<img src="'.$this->view->baseUrl("icons/color_18/lightbulb").
                '"/>'.$entry->getName().
                '</a></li>';
        }
    }

    public function fetchSingleProblemAction()
    { 
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return;
        }
        $request = $this->getRequest();
        $data = $request->getParams();
        $mapper = new Application_Model_ProblemsMapper();
        $problem = new Application_Model_Problem();
        $mapper->find($data['id'],$problem);
        $response = array (
            'id' => $problem->getId(),
            'description' => $problem->getDescription(),
            'name' => $problem->getName(),
            'code' => $problem->getCode(),
            'created' => $problem->getCreated(),
            'uri' => $problem->getUri(),
            'content' => $problem->getContent(),
            'difficulty' => $problem->getDifficulty(),
            'cuteness' => $problem->getCuteness(),
            );
        echo json_encode($response);
        return;
    }

    public function adminAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         
    }

    public function pAction()
    {
	$this->view->headTitle("Problems");	    
        $problemid = $this->getRequest()->getParam('id');
        $mapper = new Application_Model_ProblemsMapper();
        $this->view->problem = new Application_Model_Problem;
        $mapper->find($problemid,$this->view->problem);
    }


}















