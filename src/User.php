<?php

namespace Kl;

use Kl\Exceptions\WrongEmailException;


class User
{

    use ArrayConvertable;

    private $id;

    private $balance;

    private $email;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }


    public function __construct($id, $balance, $email)
    {
        if($balance < 0){

            throw new NegativeBalanceException;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

            throw new WrongEmailException;
        }
        $this->id = $id;
        $this->balance = $balance;
        $this->email = $email;
    }

}
