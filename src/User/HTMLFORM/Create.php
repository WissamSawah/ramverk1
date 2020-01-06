<?php
namespace Anax\User\HTMLForm;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\User\User;
/**
 * Example of FormModel implementation.
 */
class Create extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create user",
            ],
            [
                "email" => [
                    "type"        => "email",
                ],
                "acronym" => [
                    "type"        => "text",
                ],
                "firstname" => [
                    "type"        => "text",
                ],
                "lastname" => [
                    "type"        => "text",
                ],
                "password" => [
                    "type"        => "password",
                ],
                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }
    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
         // Get values from the submitted form
        $email          = $this->form->value("email");
        $acronym        = $this->form->value("acronym");
        $firstname      = $this->form->value("firstname");
        $lastname       = $this->form->value("lastname");
        $password       = $this->form->value("password");
        $passwordAgain  = $this->form->value("password-again");
        // Check password matches
        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }
         $user = new User();
         $user->setDb($this->di->get("dbqb"));
        if (!$user->verifyEmail($email)) {
             $this->form->rememberValues();
             $this->form->addOutput("User allready exists");
             return false;
        }
        $user->email = $email;
        $user->firstname = $firstname;
        $user->acronym = $acronym;
        $user->lastname = $lastname;
        $user->setPassword($password);
        $user->save();
        $this->form->addOutput("User created");
        return true;
    }
    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user/login")->send();
    }
}
