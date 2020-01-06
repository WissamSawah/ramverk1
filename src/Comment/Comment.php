<?php

namespace Anax\Comment;

use Anax\DatabaseActiveRecord\ActiveRecordModel;
/**
 * A database driven model using the Active Record design pattern.
 */
class Comment extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comment";
    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $username;
    public $questionID;
    public $userID;
    public $answerID;
    public $comment;
    public $created;
}
