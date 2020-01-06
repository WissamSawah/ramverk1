<?php
namespace Anax\Content;
/**
 *kontroller klass för content
 */
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Answer\Answer;
use Anax\User\User;
use Anax\Question\Question;
use Anax\Tags\Tags;
use Anax\Latest\Latest;
use Anax\Comment\Comment;


class ContentController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    // filter text funktion (använder ramverkets)
    // rendera startsidan inuti content
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $questions = new Question();
        $question3 = new Question();
        $answers = new Answer();
        $tags = new Tags;
        $users = new User;

        $comment = new Comment;

        $answers->setDb($this->di->get("dbqb"));
        $questions->setDb($this->di->get("dbqb"));
        $question3->setDb($this->di->get("dbqb"));

        $tags->setDb($this->di->get("dbqb"));
        $users->setDb($this->di->get("dbqb"));
        $comment->setDb($this->di->get("dbqb"));

        $postDb = new Latest();
        $page->add("content/index", [
            "questions" => $postDb->getLatestPosts($this->di, 2),
            "tags" => $postDb->getLatestTags($this->di, 2),
            "users" => $postDb->getLatestUsers($this->di, 2),
            "answers" => $answers,
            "comment" => $comment,
            "question3" => $question3,



        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }
    public function omActionGet() : object
    {
        $page = $this->di->get("page");
        $page->add("content/om", [
            "items" => "test"
        ]);
        return $page->render([
            "title" => "A collection of items",
        ]);
    }
}
