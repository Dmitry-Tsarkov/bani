<?php

namespace app\modules\order\services;

use app\modules\order\models\Order;
use app\modules\setting\components\Settings;
use Throwable;
use Yii;
use yii\mail\MailerInterface;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function productOrderSend(Order $order)
    {
        try {
            $this->mailer->compose('order/productOrder', compact('order'))
                ->setTo(Settings::getArray('mail_to'))
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }

    public function serviceOrderSend(Order $order)
    {
        try {
            $this->mailer->compose('order/serviceOrder', compact('order'))
                ->setTo(Settings::getArray('mail_to'))
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }
}