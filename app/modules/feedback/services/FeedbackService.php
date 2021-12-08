<?php

namespace app\modules\feedback\services;

use app\modules\feedback\forms\QuestionForm;
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

    public function questionSend(QuestionForm $form): Feedback
    {
        $feedback = Feedback::question(
            $form->name,
            $form->phone,
            $form->referer,
            $form->description
        );

        $this->feedbacks->save($feedback);
        $this->mailer->calculateSend($feedback);

        return $feedback;
    }
}