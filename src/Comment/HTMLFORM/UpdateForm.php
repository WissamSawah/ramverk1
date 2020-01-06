<?php
namespace Anax\Comment\HTMLForm;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Comment\Comment;
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
        $comment = $this->getItemDetails($id);
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
                    "value" => $comment->id,
                ],
                "comment" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $comment->comment,
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
     * @return Comment
     */
    public function getItemDetails($id) : object
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->find("id", $id);
        return $comment;
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
        $comment->find("id", $this->form->value("id"));
        $comment->column1 = $this->form->value("column1");
        $comment->column2 = $this->form->value("column2");
        $comment->save();
        return true;
    }
   
}
