<?php

use app\modules\page\models\Page;
use kartik\form\ActiveForm;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var Page $page
 */

?>

<?= $form->field($page, 'elements[title][value]')->textarea()->label('Заголовок') ?>
<?= $form->field($page, 'elements[subtitle][value]')->textarea()->label('Подзаголовок') ?>
