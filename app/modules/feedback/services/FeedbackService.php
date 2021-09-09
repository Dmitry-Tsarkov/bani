<?php

namespace app\modules\feedback\services;

use app\modules\feedback\forms\FeedbackForm;
use app\modules\feedback\models\Feedback;
use app\modules\feedback\repositories\FeedbackRepository;

class FeedbackService
{
    private $feedbacks;
    private $mailer;

    public function __construct(FeedbackRepository $feedbacks, MailerService $mailer)
    {
        $this->feedbacks = $feedbacks;
        $this->mailer = $mailer;
    }
    
    public function calculationSend(FeedbackForm $form): Feedback
    {
        $feedabck = Feedback::create(
            $form->name,
            $form->phone,
            $form->referer
        );

        $this->feedbacks->save($feedabck);
        $this->mailer->calculateSend($feedabck);

        return $feedabck;
    }
}