<?php

namespace app\modules\review\readModels;

use app\helpers\DateHelper;
use app\modules\review\models\Review;

class ReviewTransformer
{
    public function getFullReview(Review $review)
    {
        return [
            'id' => $review->id,
            'name' => $review->name,
            'email' => $review->email,
            'city' => $review->city,
            'description' => $review->description,
            'created_at' => DateHelper::forHuman($review->created_at, 'd n Y')
        ];
    }
}