<?php


namespace Kl;


use Kl\Exceptions\BalancePopUpException;
use Kl\Exceptions\NegativeBalanceException;

class UserPaymentsService
{
    private $userPaymentsDbTable;

    private $userDbTable;

    public function getUserPaymentsDbTable()
    {
        if (!$this->userPaymentsDbTable) {
            $this->userPaymentsDbTable = new UserPaymentDbTable();
        }

        return $this->userPaymentsDbTable;
    }

    public function getUserDbTable()
    {
        if (!$this->userDbTable) {
            $this->userDbTable = new UserDbTable();
        }

        return $this->userDbTable;
    }

    public function changeBalance(User $user, $amount)
    {
        $userDbTable = $this->getUserDbTable();

        $userPaymentsDbTable = $this->getUserPaymentsDbTable();

        $paymentType = $amount >= 0 ? 'in' : 'out';

        $userBalance = $user->getBalance();

        $payment = new UserPayment($user->getId(), $paymentType, $userBalance, abs($amount));

        // add payment transaction
        if (!$userPaymentsDbTable->add($payment->toArray())) {

            throw new BalancePopUpException;

        }

        if (!$userPaymentsDbTable->add($payment->toArray())) {

            throw new BalancePopUpException;

        }

        if(($user->getBalance() + $amount) < 0){

            throw new NegativeBalanceException;
        }

        $user->setBalance($user->getBalance() + $amount);

        // send email
        $this->sendEmail($user->getEmail());

        // update user balance in db
        $userDbTable->updateUser($user->toArray());

        return true;
    }

    public function sendEmail($userEmail)
    {
        $adminEmail = 'admin@test.com';

        $subject = 'Balance update';

        $message = 'Hello! Your balance has been successfully updated!';

        $headers = 'From: ' . $adminEmail . "\r\n" .
            'Reply-To: ' . $adminEmail . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($userEmail, $subject, $message, $headers);

        return true;
    }
}
