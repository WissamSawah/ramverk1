<?php
namespace Anax\Tags\HTMLForm;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Tags\Tags;
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
        $tag = $this->getItemDetails($id);
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
                    "value" => $tag->id,
                ],
                "tag" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $tag->column1,
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
     * @return Tags
     */
    public function getItemDetails($id) : object
    {
        $tag = new Tags();
        $tag->setDb($this->di->get("dbqb"));
        $tag->find("id", $id);
        return $tag;
    }
    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $tag = new Tags();
        $tag->setDb($this->di->get("dbqb"));
        $tag->find("id", $this->form->value("id"));
        $tag->column1 = $this->form->value("column1");
        $tag->column2 = $this->form->value("column2");
        $tag->save();
        return true;
    }
}
