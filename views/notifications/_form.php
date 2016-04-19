<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Notifications;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SendingNotifications */
/* @var $form yii\widgets\ActiveForm */

$users = User::find()->all();
$items = ArrayHelper::map($users, 'id', 'username');

$query = new yii\db\Query();
$data = $query->select(['code'])
    ->from('notifications')
    ->distinct()
    ->all();
$codes = ArrayHelper::map($data, 'code', 'code');


?>

<div class="sending-browser-notifications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->dropDownList($codes) ?>

    <?= $form->field($model, 'sender_id')->dropDownList($items) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropDownList($items) ?>

    <?= $form->field($model, 'all_users')->checkbox() ?>

    <?= $form->field($model, 'type')->dropDownList(['browser'=>'Browser', 'email'=>'Email'], ['multiple' => 'true']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Send Notification') : Yii::t('app', 'Resend Notification'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
