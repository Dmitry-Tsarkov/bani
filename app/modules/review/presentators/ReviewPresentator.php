<?php

namespace app\modules\review\presentators;

use app\modules\page\models\Page;
use app\modules\review\models\Review;
use app\modules\review\readModels\ReviewReader;
use app\modules\review\readModels\ReviewTransformer;

class ReviewPresentator
{
    private $reviews;
    private $reviewTransformer;

    public function __construct(ReviewReader $reviews, ReviewTransformer $reviewTransformer)
    {
        $this->reviews = $reviews;
        $this->reviewTransformer = $reviewTransformer;
    }

    public function getReviews()
    {
        $dataProvider = $this->reviews->getReviews();
        $page = Page::getOrCreate('reviews');

        return [
            'meta' => $page->getMetaTags(),
            'reviews' => array_map(function (Review $review) {
                return $this->reviewTransformer->getFullReview($review);
            }, $dataProvider->getModels()),
            'pagination' => $dataProvider->pagination,
        ];
    }

}