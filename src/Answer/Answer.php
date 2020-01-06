<?php
namespace Anax\Answer;
use Anax\DatabaseActiveRecord\ActiveRecordModel;
/**
 * A database driven model using the Active Record design pattern.
 */
class Answer extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Answer";
    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $question_id;
    public $userID;
    public $voteup;
    public $votedown;
    public $created;
    public $solution;
    public $answer;
}
