<?php
namespace Anax\Question\HTMLForm;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Question\Question;
/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $questions = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $questions->id,
                ],
                "question" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $questions->question,
                ],
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $questions->title,
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],
                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }
    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Questions
     */
    public function getItemDetails($id) : object
    {
        $questions = new Question();
        $questions->setDb($this->di->get("dbqb"));
        $questions->find("id", $id);
        return $questions;
    }
    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $questions = new Question();
        $questions->setDb($this->di->get("dbqb"));
        $questions->find("id", $this->form->value("id"));
        $questions->question = $this->form->value("question");
        $questions->title = $this->form->value("title");
        $questions->save();
        return true;
    }
}
