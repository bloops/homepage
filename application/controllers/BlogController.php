<?php

class BlogController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $blog = new Application_Model_ContentMapper();
        $this->view->entries = $blog->fetchAllType('blog-post');
        $this->view->commentcounts = array();
        $commentsmapper = new Application_Model_CommentsMapper();
        foreach($this->view->entries as $post){
            $this->view->commentcounts[$post->id]=
                       count($commentsmapper->fetchAll($post->id));
        }
    }

    public function adminAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            
        // action body
    }

    public function addPostAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            
        
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        /* print_r($data); */
        if ($this->getRequest()->isPost()) {
            $blogpost = new Application_Model_Content($data);
            $mapper  = new Application_Model_ContentMapper();
            $mapper->save($blogpost);
        }        
    }

    public function fetchPostsAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            

        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       

        $blog = new Application_Model_ContentMapper();
        $entries = $blog->fetchAllType('blog-post');
        foreach($entries as $entry){
            echo '<li><a class="blogpost" href="#" id="'.$entry->getId().'">'.
                '<img src="'.$this->view->baseUrl("icons/color_18/paragraph_justify").
                '"/>'.$entry->getTitle().
                '</a></li>';
        }        
    }

    public function fetchSinglePostAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            
        // action body 
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        if (!$this->getRequest()->isPost()) {
            return;
        }
        $request = $this->getRequest();
        $data = $request->getParams();
        $blog = new Application_Model_ContentMapper();
        $blogpost = new Application_Model_Content();
        $blog->find($data['id'],$blogpost);
        if($blogpost->getId()<=0)
            return;
        echo $blogpost->getContent();
            
    }

    public function deletePostAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);            
        // action body
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        $blog = new Application_Model_ContentMapper();
        $blog->delete($data['id']);
    }

    public function updatePostAction()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
            $this->_helper->redirector($this->view->baseUrl);         
   
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        /* print_r($data); */
        if ($this->getRequest()->isPost()) {
            $blogpost = new Application_Model_Content($data);
            $mapper  = new Application_Model_ContentMapper();
            $mapper->update($blogpost);
        }        
    }

    public function postAction()
    {
        $postid = $this->getRequest()->getParam('id');
        $blog = new Application_Model_ContentMapper();
        $this->view->blogpost = new Application_Model_Content();
        $blog->find($postid,$this->view->blogpost);
        $commentsmapper = new Application_Model_CommentsMapper();
        $this->view->comments = $commentsmapper->fetchAll($this->view->blogpost->id);
    }

    public function postCommentAction()
    {
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        $request = $this->getRequest();
        $data = $request->getParams();
        $mapper = new Application_Model_CommentsMapper();

        if ($this->getRequest()->isPost()) {
            $comment = new Application_Model_Comment($data);
            $mapper  = new Application_Model_CommentsMapper();
            $mapper->save($comment);
        }        

    }

    public function fetchCommentsAction()
    {
        $this->_helper->layout->disableLayout();    //disable layout
        $this->_helper->viewRenderer->setNoRender(); //suppress       
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return;
        }
        $request = $this->getRequest();
        $data = $request->getParams();
        $commentsmapper = new Application_Model_CommentsMapper();
        $comments = $commentsmapper->fetchAll($data['postid']);
        $comments_array = get_object_vars($comments[0]);
        $response = array ();
        foreach($comments as $comment)
        {
            $comment_array = array(
                'comment' => $this->view->escape($comment->getComment()),
                'created' => date("F j, Y \a\\t g:i a",strtotime($comment->getCreated())),
                'url' => $this->view->escape($comment->getUrl()),
                'user' => $this->view->escape($comment->getUser()),
                );
            array_push($response,$comment_array);
        }
        echo json_encode($response[count($response) - 1]);
        return;
    }


}



















