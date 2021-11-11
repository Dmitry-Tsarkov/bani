<?php

use app\modules\faq\models\Faq;
use yii\web\View;

/**
 * @var View $this
 * @var Faq $faq
 */

$this->title = 'Редактирование ' . $faq->question;
$this->params['breadcrumbs'] = [
    ['label' => 'Вопрос-ответ', 'url' => ['index']],
    $faq->question,
];

?>

<?= $this->render('_form', compact('faq')) ?>