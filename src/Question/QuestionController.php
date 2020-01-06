<?php
namespace Anax\Question;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Question\HTMLFORM\CreateForm;
use Anax\Question\HTMLFORM\EditForm;
use Anax\Question\HTMLFORM\DeleteForm;
use Anax\Question\HTMLFORM\UpdateForm;
use Anax\Answer\Answer;
use Anax\User\User;
use Anax\Comment\Comment;
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionController implements ContainerInjectableInterface
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
        $questions = new Question();
        $answers = new Answer();
        $answers->setDb($this->di->get("dbqb"));
        $questions->setDb($this->di->get("dbqb"));
        $page->add("questions/crud/view-all", [
            "questions" => $questions->findAll(),
            "answers" => $answers
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
        $page->add("questions/crud/create", [
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
        $page->add("questions/crud/delete", [
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
        $page->add("questions/crud/update", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Update an item",
        ]);
    }
    public function viewAction(int $id) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $answers = new Answer();
        $user = new User();
        $comment = new Comment();
        $question->setDb($this->di->get("dbqb"));
        $user->setDb($this->di->get("dbqb"));
        $answers->setDb($this->di->get("dbqb"));
        $comment->setDb($this->di->get("dbqb"));

        $question->find("id", $id);
        $user->find("id", $question->userID);
        $answers = $answers->findAllWhere("question_id = ?", $question->id);
        $page->add("questions/crud/view", [
            "question" => $question,
            "answers" => $answers,
            "user" => $user,
            "questionComment" => $comment->findAllWhere("questionID = ?", $question->id),
            "comment" => $comment,
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }


}
