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

    <p>
        <?= Html::a(Yii::t('app', 'Create Sending Browser Notifications'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'code',
            'sender_id',
            [
                'attribute' => 'text',
                'format' =>'html',

            ],
            // 'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'    => '{view},{update}',
            ],
        ],
    ]); ?>
</div>
