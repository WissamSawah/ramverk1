<?php
namespace Anax\User;
use Anax\DatabaseActiveRecord\ActiveRecordModel;
/**
 * A database driven model.
 */
class User extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "User";
    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $email;
    public $acronym;
    public $password;
    public $created;
    public $updated;
    public $deleted;
    public $active;
    public $counter;
    public $firstname;
    public $lastname;
    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    /**
     * Verify the email and the password, if successful the object contains
     * all details from the database row.
     *
     * @param string $email  email to check.
     * @param string $password the password to use.
     *
     * @return boolean true if email and password matches, else false.
     */
    public function verifyPassword($email, $password)
    {
        $this->find("email", $email);
        return password_verify($password, $this->password);
    }
    public function verifyEmail($email)
    {
        $this->find("email", $email);
        if ($email == $this->email) {
            return false;
        }
        return true;
    }
}
