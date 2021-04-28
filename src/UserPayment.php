<?php


namespace Kl;


class UserPayment
{
    use ArrayConvertable;

    private $id;

    private $userId;

    private $type;

    private $balanceBefore;

    private $amount;

    /**
     * @return
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return clone $this->type;
    }

    /**
     * @return mixed
     */
    public function getBalanceBefore()
    {
        return $this->balanceBefore;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }



    public function __construct($userId, $type, $balanceBefore, $amount, $id = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->type = $type;
        $this->balanceBefore = $balanceBefore;
        $this->amount = $amount;
    }

}