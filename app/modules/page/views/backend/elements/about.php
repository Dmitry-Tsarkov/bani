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
<?= $form->field($page, 'elements[subtitle][value]')->textarea(['rows' => 5])->label('Подзаголовок') ; ?>
<div class="row">
    <div class="col-xs-6">
        <div class="box box-default box-solid">
            <div class="box-header">
                <h3 class="box-title">Наша миссия</h3>
            </div>
            <div class="box-body">
                <?= $form->field($page, 'elements[mission_text][value]')->textarea(['rows' => 10])->label(false) ; ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="box box-default box-solid">
            <div class="box-header">
                <h3 class="box-title">Текст справа</h3>
            </div>
            <div class="box-body">
                <?= $form->field($page, 'elements[photos_block_text][value]')->textarea(['rows' => 10])->label(false) ; ?>
            </div>
        </div>
    </div>
</div>
