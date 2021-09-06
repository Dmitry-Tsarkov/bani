<?php

/**
 * @var \yii\web\View $this
 * @var \kartik\form\ActiveForm $form
 * @var \app\modules\page\models\Page $page
 */

use mihaildev\ckeditor\CKEditor;

?>

<?= $form->field($page, 'elements[delivery_top][value]')->widget(CKEditor::class)->label('Доставка верхний текст') ; ?>
<?= $form->field($page, 'elements[delivery_bottom][value]')->widget(CKEditor::class)->label('Доставка нижний текст') ; ?>
<?= $form->field($page, 'elements[payment][value]')->widget(CKEditor::class)->label('Оплата') ?>
