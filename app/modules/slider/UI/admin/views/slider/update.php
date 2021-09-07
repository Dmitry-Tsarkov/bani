<?php

use app\modules\slider\models\Slide;
use yii\web\View;

/**
 * @var View $this
 * @var Slide $slide
 */

$this->title = 'Редактирование ' . $slide->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Слайды', 'url' => ['index']],
    $slide->title,
];

?>

<?= $this->render('_form', compact('slide')) ?>

