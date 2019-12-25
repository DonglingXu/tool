<?php


namespace services\common\TencentCloud;

use Yii;
use common\components\Service;

class TencentCloudBaseService  extends Service
{
    /**
     * @var array
     */
    protected $tencentCloudConfig = [];

    public function init()
    {
        parent::init();

        $this->tencentCloudConfig = [
            'secretId' => Yii::$app->debris->config('tencent_cloud_secretId'),
            'secretKey' => Yii::$app->debris->config('tencent_cloud_secretKey'),
        ];
    }

}