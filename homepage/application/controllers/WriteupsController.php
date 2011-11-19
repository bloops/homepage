<?php

class WriteupsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_ContentMapper();
        $this->view->entries = $mapper->fetchAllType('writeup');
    }

    public function adminAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         
    }

    public function addAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        if ($this->getRequest()->isPost()) 
        {
            $writeup = new Application_Model_Content($data);
            $mapper  = new Application_Model_ContentMapper();
            $mapper->save($writeup);
        }        
    }

    public function updateAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        if ($this->getRequest()->isPost()) 
        {
            $post = new Application_Model_Content($data);
            $mapper  = new Application_Model_ContentMapper();
            $mapper->update($post);
        }   
    }

    public function deleteAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        $mapper = new Application_Model_ContentMapper();
        $mapper->delete($data['id']);
    }

    public function fetchAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       

        $blog = new Application_Model_ContentMapper();
        $entries = $blog->fetchAllType('writeup');
        foreach($entries as $entry)
        {
            echo '<li><a class="blogpost" href="#" id="'.$entry->getId().'">'.
                '<img src="'.$this->view->baseUrl("icons/color_18/notepad").
                '"/>'.$entry->getTitle().
                '</a></li>';
        }
    }

    public function fetchSingleAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        if (!$this->getRequest()->isPost()) {
            return;
        }
        $request = $this->getRequest();
        $data = $request->getParams();
        $mapper = new Application_Model_ContentMapper();
        $post = new Application_Model_Content();
        $mapper->find($data['id'],$post);
        echo $post->getContent();
    }

    public function postAction()
    {
        $postid = $this->getRequest()->getParam('id');
        $mapper = new Application_Model_ContentMapper();
        $this->view->writeup = new Application_Model_Content();
        $mapper->find($postid,$this->view->writeup);
    }


}















