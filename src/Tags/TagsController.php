<?php
namespace Anax\Tags;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Tags\HTMLFORM\CreateForm;
use Anax\Tags\HTMLFORM\EditForm;
use Anax\Tags\HTMLFORM\DeleteForm;
use Anax\Tags\HTMLFORM\UpdateForm;
use Anax\Question\Question;
use Anax\Answer\Answer;
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagsController implements ContainerInjectableInterface
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
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $tag = new Tags();
        $tag->setDb($this->di->get("dbqb"));
        $page->add("tags/crud/view-all", [
            "tags" => $tag->findAll(),
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
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();
        $page->add("tags/crud/create", [
            "form" => $form->getHTML(),
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
        $page->add("tags/crud/delete", [
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
        $page->add("tags/crud/update", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Update an item",
        ]);
    }
    public function questionsAction($id) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $answers = new Answer();
        $answers->setDb($this->di->get("dbqb"));

        $page->add("tags/crud/view-questions", [
            "questions" => $question->findAllWhere("tags LIKE ?", "%$id%"),
            "answers" => $answers,
        ]);
        return $page->render([
            "title" => "frågor kopplade till tag",
        ]);
    }
}
