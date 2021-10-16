<?php

namespace app\modules\review\services;

use app\modules\review\models\Review;
use Throwable;
use Yii;
use yii\mail\MailerInterface;

class ReviewMailer
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function reviewSend(Review $review)
    {
        try {
            $this->mailer->compose('review/reviewSend', compact('review'))
                ->send();
        } catch (Throwable $e) {
            Yii::$app->errorHandler->logException($e);
        }
    }

}