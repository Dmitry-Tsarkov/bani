<?php

use app\modules\order\helpers\OrderHelper;
use app\modules\Order\models\Order;
use app\modules\Order\models\OrderStatus;
use app\modules\order\searchModels\OrderSearch;
use kartik\grid\CheckboxColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var DataProviderInterface $dataProvider
 * @var OrderSearch $searchModel
 */

?>

<?= GridView::widget([
    'id' => 'grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'bordered' => false,
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'id' => 'pjax-widget'
        ],
    ],
    'striped' => false,
    'hover' => true,
    'panel' => [
        'after' => false,
    ],
    'export' => false,
    'toggleDataOptions' => [
        'all' => [
            'icon' => 'resize-full',
            'label' => 'Показать все',
            'class' => 'btn btn-default',
            'title' => 'Показать все'
        ],
        'page' => [
            'icon' => 'resize-small',
            'label' => 'Страницы',
            'class' => 'btn btn-default',
            'title' => 'Постаничная разбивка'
        ],
    ],
    'columns' => [
        [
            'class' => CheckboxColumn::class,
            'checkboxOptions' => ['onchange' => 'appMassiveActions.updateActions()'],
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'created_at',
            'value' => function (Order $order) {
                return date('d.m.Y H:i', $order->created_at);
            }
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
//            'filter' => OrderStatus::list(),
            'format' => 'raw',
            'value' => function (Order $order) {
                return Html::a($order->status->getLabel(), ['view', 'id' => $order->id], [
                    'class' => 'btn btn-' . $order->status->getClass() . ' btn-xs',
                    'data-pjax' => '0',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal-lg'
                ]);
            },
        ],
        'name',
        'phone',
        [
            'class' => DataColumn::class,
            'attribute' => 'type',
            'format' => 'raw',
            'filter' => OrderHelper::getList(),
            'value' => function (Order $order) {
                return OrderHelper::getType($order);
            }
        ],
    ]
]) ?>

<style>
    #actions {
        visibility: hidden;
        padding: 5px;
        background: rgb(248, 248, 248);
        border: 1px solid rgb(221, 221, 221);
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 2000;
    }
</style>

<div id="actions" :style="{ visibility: isActive ? 'visible' : 'hidden' }" class="form-inline">
    <div class="container">
        <div class="form-group" style="width: 100px;">
            <span>Выбрано:</span>
            <b class="form-control-static">{{ ids.length }}</b>
        </div>
        <select v-bind:disabled="!isActive" v-model="action" class="form-control input-sm">
            <option disabled selected hidden :value="null">- Действия -</option>
            <option v-for="(action, index) in actions" v-bind:value="index">{{ action.title }}</option>
        </select>
        <div class="form-group">
            <select v-if="showStatusList" v-model="statusId" class="form-control input-sm">.
                <option disabled selected hidden :value="null">- Выберите статус -</option>
                <?php foreach (OrderStatus::list() as $id => $title): ?>
                    <option value="<?= $id ?>"><?= $title ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button v-if="showButton" type="button" @click="send" class="btn btn-sm btn-primary">Применить</button>
    </div>

</div>


<?php $js = <<<JS

   appMassiveActions = new Vue({
      el: '#actions',
      data: {
          isReady: true,
        statusId: null,
        action: null,
        ids: [],
        actions: [
            {
                'title': 'Сменить статус',
                'url': '/admin/order/massive/status',
                'is_status_list' : true,
            },
            {
                'title': 'Удалить',
                'url': '/admin/order/massive/delete',
                'confirm': 'Подтвердите удаление',
            },
        ],
      },

      computed: {
          showButton: function() {
              let action =  this.actions[this.action];
              return this.isActive && action && (action.is_status_list ? this.statusId : true);
          },
          showStatusList: function() {
              let action =  this.actions[this.action];
              return this.isActive && action && action.is_status_list;
          },
          isActive: function() {
              return this.ids.length > 0;
          }
      },

      methods: {
          updateActions: function() {
              this.ids = $("#grid").yiiGridView("getSelectedRows");
          },
          send: function() {
              let _this = this;
              let action =  this.actions[this.action];
              let data = {ids: this.ids};

              if (action.is_status_list) {
                  data.statusId = this.statusId;
              }

              if (!action.confirm || confirm(action.confirm)) {
                   $.post(action.url, data, function(data) {
                        $.pjax.reload('#pjax-widget');
                        _this.ids = [];
                        _this.action = null;
                  });
              }

          }
      }
    });
    $(document).on('change', '.select-on-check-all', appMassiveActions.updateActions)
JS
?>

<?php $this->registerJs($js, View::POS_END) ?>

