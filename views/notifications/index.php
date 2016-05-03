<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ViewedNotifications;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$role = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
$this->title = Yii::t('app', 'Sending Browser Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sending-browser-notifications-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'code',
            [
                'attribute' => 'text',
                'format' =>'html',

            ],

            // 'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'    => '{view}',
            ],
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            if(!ViewedNotifications::findOne(['user_id' => Yii::$app->user->id, 'notice_id' => $model->id])/*$model->id == '3'*/) {
                return ['class' => 'alert alert-danger'];
            }

        }
    ]); ?>
</div>
