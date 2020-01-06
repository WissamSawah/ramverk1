<?php
namespace Anax\Answer;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Answer\HTMLFORM\CreateForm;
use Anax\Answer\HTMLFORM\EditForm;
use Anax\Answer\HTMLFORM\DeleteForm;
use Anax\Answer\HTMLFORM\UpdateForm;
use Anax\User\User;
use Anax\Question\Question;
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
 * A sample controller to show how a controller class can be implemented.
 */
class AnswerController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    /**
     * @var $data description
     */
    //private $data;
    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }
    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $page->add("answer/crud/view-all", [
            "items" => $answer->findAll(),
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }
    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction(int $question_id) : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di, $question_id);
        $form->check();
        $question = new Question;
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $question_id);
        $page->add("answer/crud/create", [
            "form" => $form->getHTML(),
            "question" => $question,
        ]);
        return $page->render([
            "title" => "Create a item",
        ]);
    }
    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        $page = $this->di->get("page");
        $form = new DeleteForm($this->di);
        $form->check();
        $page->add("answer/crud/delete", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Delete an item",
        ]);
    }
    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();
        $page->add("answer/crud/update", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Update an item",
        ]);
    }
}
