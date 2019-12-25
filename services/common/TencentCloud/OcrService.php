<?php
namespace services\common\TencentCloud;

use yii\helpers\Json;
use TencentCloud\Ocr\V20181119\Models\InstitutionOCRRequest;
use TencentCloud\Ocr\V20181119\OcrClient;
use Yii;
use TencentCloud\Common\Credential;

/**
 * Class OcrService
 * @package services\common\TencentCloud
 */
class OcrService extends TencentCloudBaseService
{
    /**
     * @var array
     */
    protected $config = [];

    public function init()
    {
        parent::init();
    }

    public function ocr($base64_img)
    {
        try {
            // 实例化一个证书对象，入参需要传入腾讯云账户secretId，secretKey
            $cred = new Credential($this->tencentCloudConfig['secretId'], $this->tencentCloudConfig['secretKey']);
            // # 实例化要请求产品的client对象
            $client = new OcrClient($cred, "ap-shanghai");

            // 实例化一个请求对象
            $req = new InstitutionOCRRequest();
            $req->ImageBase64 = $base64_img;

            // 通过client对象调用想要访问的接口，需要传入请求对象
            $resp = $client->GeneralBasicOCR($req);
            return Json::decode($resp->toJsonString());

        } catch (\Exception $e) {
            return $e;
        }
    }

}