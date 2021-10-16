<?php

namespace app\modules\review\services;

use app\modules\review\models\Review;
use app\modules\review\repositories\ReviewRepository;

class ReviewService
{
    private $reviews;
    private $mailer;

    public function __construct(
        ReviewRepository $reviews,
        ReviewMailer $mailer
    )
    {
        $this->reviews = $reviews;
        $this->mailer = $mailer;
    }

    public function reviewSend($form)
    {
        $review = Review::feedback(
            $form->name,
            $form->email,
            $form->city,
            $form->description
        );

        $this->reviews->save($review);
        $this->mailer->reviewSend($review);

        return $review;
    }
}