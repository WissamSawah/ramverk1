<?php

namespace Anax\Question;
use Anax\DatabaseActiveRecord\ActiveRecordModel;
/**
 * A database driven model using the Active Record design pattern.
 */
class Question extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Questions";
    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $title;
    public $question;
    public $userID;
    public $tags;
    public $created;
}
