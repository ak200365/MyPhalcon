<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength as StringLengthValidator;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $login;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $role;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $is_active;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var integer
     */
    protected $balance;

    /**
     * Method to set the value of field id
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field login
     *
     * @param string $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field role
     *
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = ($password) ? md5($password) : null;

        return $this;
    }

    /**
     * Method to set the value of field is_active
     *
     * @param string $is_active
     * @return $this
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field balance
     *
     * @param integer $balance
     * @return $this
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field is_active
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    public function checkPassword($password)
    {
        return ($this->password == md5($password));
    }
    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );
        $validator->add(
            'name',
            new StringLengthValidator(
                [
                    'model' => $this,
                    'min' => 2,
                    'max' => 40,
                    'messageMinimum' => 'We want more than just their initials',
                    'messageMaximum' => 'Your name must be less than 40 characters'
                ]
            )
        );
        $validator->add(
            'login',
            new UniquenessValidator(
                [
                    'model'   => $this,
                    'message' => 'Your login is already in use'
                ]
            )
        );
        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wbc_db");
        $this->setSource("users");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'login' => 'login',
            'email' => 'email',
            'role' => 'role',
            'password' => 'password',
            'is_active' => 'is_active',
            'name' => 'name',
            'balance' => 'balance'
        ];
    }

}
