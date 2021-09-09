<?php

namespace app\modules\feedback\services;

use app\modules\feedback\models\Feedback;
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

    public function calculateSend(Feedback $feedback)
    {
        try {
            $this->mailer->compose('feedback/calculation', compact('feedback'))
                ->setTo(Settings::getArray('mail_to'))
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }
}