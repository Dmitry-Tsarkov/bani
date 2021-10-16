<?php

use app\modules\slider\models\Slide;
use yii\web\View;

/**
 * @var View $this
 * @var Slide $slide
 */

$this->title = 'Добавление нового слайда';
$this->params['breadcrumbs'] = [
    ['label' => 'Слайды', 'url' => ['/slider/review/slider/index']],
    $this->title,
];

?>

<?= $this->render('_form', compact('slide')) ?>

