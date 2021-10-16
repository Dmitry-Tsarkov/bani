<?php

namespace app\modules\review\services;

use app\modules\review\forms\ReviewManageForm;
use app\modules\review\models\Review;
use app\modules\review\repositories\ReviewRepository;
use DomainException;

class ReviewManageService
{
    private $reviews;

    public function __construct(ReviewRepository $reviews)
    {
        $this->reviews = $reviews;
    }

    public function create(ReviewManageForm $createForm): Review
    {

        $review = Review::create(
            $createForm->name,
            $createForm->description,
            $createForm->city,
            $createForm->email
        );

        $this->reviews->save($review);

        return $review;
    }

    public function edit(int $id, ReviewManageForm $editForm): void
    {
        $review = $this->reviews->getById($id);

        $review->edit(
            $editForm->name,
            $editForm->description,
            $editForm->city,
            $editForm->email
        );

        $this->reviews->save($review);
    }

    public function delete($id): void
    {
        $review = $this->reviews->getById($id);
        if ($review->isActive()) {
            throw new DomainException('Нельзя удалить активный отзыв');
        }
        $this->reviews->delete($review);
    }

    public function activate($id)
    {
        $review = $this->reviews->getById($id);
        $review->activate();
        $this->reviews->save($review);
    }

    public function deactivate($id)
    {
        $review = $this->reviews->getById($id);
        $review->deactivate();
        $this->reviews->save($review);
    }
}