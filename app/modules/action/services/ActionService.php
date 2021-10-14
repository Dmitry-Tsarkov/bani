<?php

namespace app\modules\action\services;

use app\modules\action\forms\ActionForm;
use app\modules\action\models\Action;
use app\modules\seo\valueObjects\Seo;

class ActionService
{

    public function edit(int $id, ActionForm $form)
    {
        $action = Action::find()->andWhere(['id' => $id])->one();

//        if (!empty($form->alias) && $this->products->hasByAliasExceptSelf($action->id, $form->alias)) {
//            throw new DomainException('Такой алиас уже есть');
//        }

        $action->edit(
            $form->preview_description,
            $form->preview_title,
            $form->title,
            $form->description,
            $form->active_from,
            $form->active_to,
            $form->activity_period,
            $form->image,
            $form->status,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );
        $action->save();
//        $this->products->save($action);
    }
}