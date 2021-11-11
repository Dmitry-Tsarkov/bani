<?php

use app\modules\faq\models\Faq;
use yii\web\View;

/**
 * @var View $this
 * @var Faq $faq
 */

$this->title = 'Добавление вопрос-ответа';
$this->params['breadcrumbs'] = [
    ['label' => 'Вопрос-ответ', 'url' => ['/faq/backend/faq/index']],
    $this->title,
];

?>

<?= $this->render('_form', compact('faq')) ?>