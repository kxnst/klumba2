<?php

use Kl\User;
use Kl\UserPaymentsService;

require_once 'vendor/autoload.php';

$userPaymentService = new UserPaymentsService();

$testData = require_once 'test-data.php';

foreach ($testData as $testDataRow) {

    try {

        list($user, $amount) = $testDataRow;

        $userModel = new User($user['id'], $user['balance'], $user['email']);   //changed balance to email

        $userPaymentService->changeBalance($userModel, $amount);

        $expectedBalance = $user['balance'] + $amount;

        $resultBalance = $userModel->getBalance();

        $info = sprintf('User balance should be updated %s: %s', $expectedBalance, $expectedBalance);   #TODO change text of message

        $result = assert($expectedBalance === $resultBalance, $info);

    } catch (\Exception $e) {
        $result = false;

        $info = $e->getMessage();
    }

    echo sprintf("[%s] %s<br/>", $result ? 'SUCCESS' : 'FAIL', $info);
}