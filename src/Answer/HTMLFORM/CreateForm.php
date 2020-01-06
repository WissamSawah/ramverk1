<?php

namespace Anax\Answer\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Question\Question as Question;
use Anax\Answer\Answer;
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
    private $question = "";
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $this->question = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Skapa svar",
            ],
            [
                "answer" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],
                "question" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "value" => $this->question->id,
                ],
                "user" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "value" => $di->session->get("userID"),
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Publicera svar",
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
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->answer  = $this->form->value("answer");
        $answer->userID = $this->form->value("user");
        $answer->question_id = $this->form->value("question");
        $answer->username = $this->di->session->get("username");
        $answer->save();
        return true;
    }
    public function getItemDetails($id) : object
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $id);
        return $question;
    }
    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("questions/view/". $this->question->id)->send();
    }
    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    // public function callbackFail()
    // {
    //     $this->di->get("response")->redirectSelf()->send();
    // }
}
