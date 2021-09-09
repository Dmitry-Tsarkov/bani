<?php

namespace app\modules\feedback\repositories;

use app\modules\feedback\models\Feedback;
use DomainException;
use RuntimeException;

class FeedbackRepository
{
    public function save(Feedback $feedback)
    {
        if (!$feedback->save()) {
            throw new RuntimeException('Feedback saving error');
        }
    }

    public function delete(Feedback $feedback): void
    {
        if (!$feedback->delete()) {
            throw new RuntimeException('Feedback deleting error');
        }
    }

    public function getById($id): Feedback
    {
        $feedback = Feedback::find()->andWhere(['id' => $id])->limit(1)->one();

        if ($feedback === null) {
            throw new DomainException('Feedback not found');
        }

        return $feedback;
    }
}