<?php
use yii\bootstrap\ActiveForm;
use \yii\helpers\Url;
use yii\helpers\Html;
?>

<div id="create-user-nick">
    <?php if (Yii::$app->user->getIsGuest()) :?>
    <?php  $form = ActiveForm::begin([
        'id' => 'create-user',
    'action' => Url::to(['user/create']),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(['user/validate'])
    ]);
    echo $form->field($user, 'nick')->textInput(['maxlength' => 64]) ?>

    <div class="form-group">
        <?= Html::submitButton('Create',
                        ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>