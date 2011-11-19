<?php

class Application_Model_CommentsMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Comments');
        }
        return $this->_dbTable;
    }

    public function delete($id)
    {
        $where['id = ?'] = $id;
        $this->getDbTable()->delete($where);
    }    

    public function save(Application_Model_Comment $comment)
    {
        $data = array(
            'postid'   => $comment->postid,
            'reply_to_id' => $comment->reply_to_id,
            'user' => $comment->user,
            'url' => $comment->url,
            'comment' => $comment->comment,
            'email' => $comment->email,
            'created' => date('Y-m-d H:i:s'),
        );
 
        if (null === ($id = $comment->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Comment $comment)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $comment->setId($row->id)
            ->setComment($row->comment)
            ->setCreated($row->created);
    }

     
    public function fetchAll($postid)
    {
        $resultSet = $this->getDbTable()->fetchAll(
            $this->getDbTable()->select()
            ->where('postid = ?',$postid)
            ->order('created ASC')
            );

        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Comment();
            $entry->setId($row->id)
                ->setPostid($row->postid)
                ->setUser($row->user)
                  ->setComment($row->comment)
                  ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }


}

