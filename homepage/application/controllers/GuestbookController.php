<?php

class GuestbookController extends Zend_Controller_Action
{

    protected $_form = null;

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $guestbook = new Application_Model_GuestbookMapper();
        $this->view->entries = $guestbook->fetchAll();
        $form    = new Application_Form_Guestbook();
        $this->view->form = $form;
    }

    public function signAction()
    {
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $form = new Application_Form_Guestbook;
        $request = $this->getRequest();
        $data = $request->getParams();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                print_r($form->getValues());
                $comment = new Application_Model_Guestbook($data);
                $mapper  = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
            }
        }
        $this->view->form = $form;
         
    }

    public function fetchAction()
    {
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $guestbook = new Application_Model_GuestbookMapper();
        $entries = $guestbook->fetchAll();
        $entries = array_reverse($entries);
        foreach ($entries as $entry):
        echo $entry->email;
        echo '<br/>'.$entry->comment;
        echo '<br/><br/>';
        endforeach;
    }


}





