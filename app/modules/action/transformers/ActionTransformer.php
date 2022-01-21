<?php


namespace app\modules\action\transformers;


use app\helpers\DateHelper;
use app\modules\action\models\Action;

class ActionTransformer
{
    public function card(Action $action)
    {
        return [
            'title' => $action->preview_title,
            'date' => DateHelper::forHuman($action->created_at, 'd n Y'),
            'description' => $action->preview_description,
            'image' => $action->getImageSrc(),
            'alias' => $action->alias,
        ];
    }
    
    public function view(Action $action)
    {
        return [
            'card' => $this->card($action),
            'title' => $action->title,
            'description' => $action->description,
            'activity_period' => $action->activity_period,
        ];
    }
}