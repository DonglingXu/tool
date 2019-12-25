<?php

use common\helpers\Url;
use common\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'OCR 识别';
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<?php $form = ActiveForm::begin([
    'id' => 'qr',
    'action'=>"request-api",
    'fieldConfig' => [
        'template' => "<div class='col-sm-3 text-right'>{label}</div><div class='col-sm-9'>{input}\n{hint}\n{error}</div>",
    ]
]); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="col-md-6">

                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button class="btn btn-primary" type="submit">保存</button>
                            <input type="reset" name="button" class="btn btn-white" value="重置" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'image')->widget('common\widgets\webuploader\Files', [
                            'themeConfig' => [
                                'select' => false,// 选择在线图片
                            ],
                            'config' => [
                                'pick' => [
                                    'multiple' => false,
                                ],
                                'accept' => [
                                    'extensions' => ['png', 'jpeg', 'jpg'],
                                ],
                                'formData' => [
                                    'drive' => 'local',
                                ],
                                'fileSingleSizeLimit' => 1024 * 500,// 图片大小限制
                                'independentUrl' => false,
                            ]
                        ])->hint('只支持 png/jpeg/jpg 格式,大小不超过为500K'); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


