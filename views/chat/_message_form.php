<?php
use yii\bootstrap\ActiveForm;
use \yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
?>

<div id="create-message" style="<?php echo Yii::$app->user->getIsGuest() ? 'display:none': ''?>">
    <div>
        <?php  $form = ActiveForm::begin([
            'id' => 'form-create-message',
            'action' => Url::to(['chat/create']),
            'enableAjaxValidation' => true,
            'validationUrl' => Url::to(['chat/validate'])
        ]);
        echo $form->field($chat, 'message')->widget(CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'basic'
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('Send Message',
                ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>