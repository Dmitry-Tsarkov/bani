<?php


namespace app\modules\faq\readModels;


use app\modules\faq\models\Faq;

class FaqReadRepository
{
    /**
     * @return Faq[]
     */
    public function getActive(): array
    {
        return Faq::find()
            ->andWhere(['status' => 1])
            ->orderBy(['position' => SORT_ASC])
            ->all();
    }
}
