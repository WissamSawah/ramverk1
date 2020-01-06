<?php

namespace Anax\Comment\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Question\Question as Question;
use Anax\Comment\Comment;
use Anax\Answer\Answer as Answer;
/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    private $callbackID = "1";
    public function __construct(ContainerInterface $di, $id, $type)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Ny kommentar",
            ],
            [
                "comment" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],
                "id" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "value" => $id,
                ],
                "type" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "value" => $type,
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Publicera kommentar",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }
    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->comment  = $this->form->value("comment");
        $comment->username  = $this->di->session->get("username");
        $comment->userID  = $this->di->session->get("userID");
        $comment->created  = $this->di->session->get("created");

        if ($this->form->value("type") == "answerID") {
            $comment->answerID = $this->form->value("id");
            $answer = new Answer();
            $answer->setDb($this->di->get("dbqb"));
            $answer->findById($comment->answerID);
            $this->callbackID = $answer->question_id;
        } else {
            $comment->questionID = $this->form->value("id");
            $this->callbackID = $comment->questionID ;
        }
        $comment->save();
        return true;
    }
    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("questions/view/$this->callbackID")->send();
    }
    /**
     * Callback what to do if the form was unsuccessfully submitted, this
     * happen when the submit callback method returns false or if validation
     * fails. This method can/should be implemented by the subclass for a
     * different behaviour.
     */
    public function callbackFail()
    {
        $this->di->get("response")->redirectSelf()->send();
        $this->form->addOutput("failed to add comment");
    }
}
