<?php
namespace Anax\Latest;
use Anax\DatabaseActiveRecord\ActiveRecordModel;
/**
 * A database driven model using the Active Record design pattern.
 */
class Latest extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Questions";

     public $id;
     public $title;
     public $question;
     public $userID;
     public $tags;
     public $created;

    /**
     * Returns all the comments and answers for the thread.
     *
     * @param \Psr\Container\ContainerInterface $di A service container.
     * @param integer $amount                      Nr of posts.
     *
     * @return array with all the answers and comment ind the given post thread
     */
    public function getLatestPosts($di, $amount) : array
    {
        $db = $this->returnDb($di);
        $sql = "SELECT * FROM Questions ORDER BY id DESC LIMIT $amount";
        if (!$amount) {
            $sql = "SELECT * FROM Questions ORDER BY id DESC LIMIT 1";
        }
        $posts = $db->executeFetchAll($sql);
        return $posts;
    }

    public function getLatestTags($di, $amount) : array
    {
        $db = $this->returnDb($di);
        $sql = "SELECT * FROM Tags ORDER BY id DESC LIMIT $amount";
        if (!$amount) {
            $sql = "SELECT * FROM Tags ORDER BY id DESC LIMIT 1";
        }
        $posts = $db->executeFetchAll($sql);
        return $posts;
    }


    public function getLatestUsers($di, $amount) : array
    {
        $db = $this->returnDb($di);
        $sql = "SELECT * FROM User ORDER BY id DESC LIMIT $amount";
        if (!$amount) {
            $sql = "SELECT * FROM User ORDER BY id DESC LIMIT 1";
        }
        $posts = $db->executeFetchAll($sql);
        return $posts;
    }

    private function returnDb($di)
    {
        $db = $di->get("db");
        $db->connect();
        return $db;
    }
 }
