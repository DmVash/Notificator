<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SendingBrowserNotifications */

$this->title = Yii::t('app', 'Create Sending Browser Notifications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sending Browser Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sending-browser-notifications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
