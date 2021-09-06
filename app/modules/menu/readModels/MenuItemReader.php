<?php


namespace app\modules\menu\readModels;


use app\modules\menu\enums\StatusEnum;
use app\modules\menu\models\MenuItem;

class MenuItemReader
{
    public function getMenuItems()
    {
        $topMenuItems = MenuItem::find()
            ->andWhere(['status' => StatusEnum::IS_ACTIVE])
            ->orderBy(['position' => SORT_ASC])
            ->all();

        return array_map(function (MenuItem $menuItem) {
            return [
                'text' => $menuItem->text,
                'link' => $menuItem->link,
            ];
        }, $topMenuItems);
    }
}