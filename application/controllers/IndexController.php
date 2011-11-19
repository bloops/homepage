<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_ContentMapper();
        $this->view->entries = $mapper->fetchAllType('scribble');
    }

    public function adminAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            
    }

    public function addScribbleAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        if ($this->getRequest()->isPost()) 
        {
            $scribble = new Application_Model_Content($data);
            $mapper  = new Application_Model_ContentMapper();
            $mapper->save($scribble);
        }        
    }

    public function updateScribbleAction()
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

    public function deleteScribbleAction()
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

    public function fetchScribblesAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       

        $blog = new Application_Model_ContentMapper();
        $entries = $blog->fetchAllType('scribble');
        foreach($entries as $entry)
        {
            echo '<li><a class="blogpost" href="#" id="'.$entry->getId().'">'.
                '<img src="'.$this->view->baseUrl("icons/color_18/notepad").
                '"/>'.$entry->getTitle().
                '</a></li>';
        }        
    }

    public function fetchSingleScribbleAction()
    {
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

    public function recentAction()
    {
        $mapper = new Application_Model_ContentMapper();
        $this->view->entries = $mapper->fetchAllType('update');
    }

    public function addUpdateAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        if ($this->getRequest()->isPost()) 
        {
            $update = new Application_Model_Content($data);
            $mapper  = new Application_Model_ContentMapper();
            $mapper->save($update);
        }        
    }

    public function deleteUpdateAction()
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

    public function fetchSingleUpdateAction()
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

    public function fetchUpdatesAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       

        $blog = new Application_Model_ContentMapper();
        $entries = $blog->fetchAllType('update');
        echo '<ul>';
        foreach($entries as $entry)
        {
            echo '<li class="edit-update" id="'.$entry->getId().'"><a>'.
                /* '<img src="'.$this->view->baseUrl("icons/color_18/notepad"). 
                   '"/>'.*/($entry->getContent()).
                '</a></li>';
        }        
        echo '</ul>';
    }

    public function updateUpdateAction()
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

    public function adminUpdatesAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            
    }

    public function linksAction()
    {
        // action body
        $this->_helper->layout->disableLayout();    //disable layout
        
    }

    public function loginAction()
    {
        // action body
    }

    public function logoutAction()
    {
        // action body
    }


}

































