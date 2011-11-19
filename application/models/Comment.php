<?php

class Application_Model_Comment
{
    protected $_id;
    protected $_postid;
    protected $_reply_to_id;
    protected $_created;
    protected $_user;
    protected $_url;
    protected $_comment;
    protected $_email;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid content');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid content');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setPostid($postid)
    {
        $this->_postid = $postid;
        return $this;
    }

    public function getPostid()
    {
        return $this->_postid;
    }

    public function setReply_to_id($reply_to_id)
    {
        $this->_reply_to_id = $reply_to_id;
        return $this;
    }

    public function getReply_to_id()
    {
        return $this->_reply_to_id;
    }


    public function setCreated($created)
    {
        $this->_created = $created;
        return $this;
    }

    public function getCreated()
    {
        return $this->_created;
    }


    public function setUser($user)
    {
        $this->_user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function setComment($comment)
    {
        $this->_comment = $comment;
        return $this;
    }

    public function getComment()
    {
        return $this->_comment;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }


}

