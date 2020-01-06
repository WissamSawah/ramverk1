<?php
namespace Anax\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLFORM\Login;
use Anax\User\HTMLFORM\Create;
use Anax\User\HTMLFORM\Update;
use Anax\Answer\Answer as Answer;
use Anax\Question\Question as Question;
use Anax\Comment\Comment as Comment;
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
 * A sample controller to show how a controller class can be implemented.
 */

class UserController implements ContainerInjectableInterface
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
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("email", $session->get("user"));
        $questions = new Question;
        $questions->setDb($this->di->get("dbqb"));
        $answers = new Answer;
        $answers->setDb($this->di->get("dbqb"));
        $comments = new Comment;
        $comments->setDb($this->di->get("dbqb"));
        $page->add("user/index", [
            "user" => $user,
            "questions" => $questions,
            "answers" => $answers,
            "comments" => $comments,
        ]);
        return $page->render([
            "title" => "Användare",
        ]);
    }
    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new Login($this->di);
        $form->check();
        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "A login page",
        ]);
    }
    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new Create($this->di);
        $form->check();
        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "A create user page",
        ]);
    }
    public function logoutAction() : object
    {
        $page = $this->di->get("page");
        $this->di->session->delete("user");
        $this->di->session->delete("login");
        $form = new Login($this->di);
        $form->check();
        $page->add("user/logout", [
            "content" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "A create user page",
        ]);
    }
    public function allAction() : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $page->add("user/view-all", [
            "items" => $user->findAll(),
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }
    public function viewAction(int $id) : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->findById($id);
        $questions = new Question;
        $questions->setDb($this->di->get("dbqb"));
        $answers = new Answer;
        $answers->setDb($this->di->get("dbqb"));
        $comments = new Comment;
        $comments->setDb($this->di->get("dbqb"));
        $page->add("user/view", [
            "user" => $user,
            "questions" => $questions,
            "answers" => $answers,
            "comments" => $comments,
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new Update($this->di, $id);
        $form->check();
        $page->add("user/update", [
            "form" => $form->getHTML(),
        ]);
        return $page->render([
            "title" => "Update an item",
        ]);
    }
}
