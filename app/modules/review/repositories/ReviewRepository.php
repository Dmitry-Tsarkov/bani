<?php

namespace app\modules\review\repositories;

use app\modules\review\models\Review;
use DomainException;
use RuntimeException;

class ReviewRepository
{
    public function save(Review $review)
    {
        if (!$review->save()) {
            throw new\RuntimeException('Review saving error');
        }
    }

    public function delete(Review $review): void
    {
        if (!$review->delete()) {
            throw new RuntimeException('Review deleting error');
        }
    }

    public function getById($id): Review
    {
        $review = Review::find()->andWhere(['id' => $id])->limit(1)->one();

        if ($review === null) {
            throw new DomainException('Review is not found');
        }

        return $review;
    }
}