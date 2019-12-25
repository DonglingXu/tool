<?php


namespace addons\RfHelpers\backend\controllers;


use Yii;
use addons\RfHelpers\common\models\OcrForm;
use services\common\TencentCloud\OcrService;

class OcrController extends BaseController
{
    public function actionIndex()
    {
        $model = new OcrForm();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionRequestApi()
    {
        try {
            $request = Yii::$app->request;
            $form = $request->post("OcrForm");
            $path = substr($form['image'],7);
            $base64_img = $this->base64EncodeImage('../'.$path);

            $ocr = new OcrService();
            $data = $ocr->ocr($base64_img);
            $strstr = '';
            if (is_array($data) && !empty($data['TextDetections'])) {
                foreach ($data['TextDetections'] as $item) {
                    $strstr .= $item['DetectedText'];
                    $strstr .= "\n";
                }
                $strstr .= "#####识别语言: {$data['Language']} #####";
            }
            p($strstr);die;
        } catch (\Exception $e) {
            p("error: ".$e);die;
        }

    }

    public function base64EncodeImage ($image_file) {
        $base64_image = '';
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
        return $base64_image;
    }

}