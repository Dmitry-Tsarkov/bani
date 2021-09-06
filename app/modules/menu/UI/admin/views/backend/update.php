<?php

use app\modules\menu\models\MenuItem;
use yii\web\View;

/**
 * @var View $this
 * @var MenuItem $menuItem
 */

$this->title = $menuItem->text;
$this->params['breadcrumbs'] = [
    ['label' => 'Меню', 'url' => ['index']],
    'Редактирование ' . '"' . $menuItem->text . '"'
];

?>

<?= $this->render('_form', compact('menuItem', 'breadcrumbs')) ?>