<?php

namespace app\services;

use yii\base\Component;

class ParseService extends Component
{
//    const DEFAULT_URL = 'www.srubimbanu.ru/proekty-ban/access_token?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';
//    const DEFAULT_URL = 'www.srubimbanu.ru/proekty-ban';
//    public $lastResponse;
//    public $client;
//    public $lastRequest;
//
//    public function __construct($config = [])
//    {
//        $this->client = $client = new Client([
//            'transport' => 'yii\httpclient\CurlTransport',
//            'baseUrl' => self::DEFAULT_URL,
//        ]);
//        $this->init();
//        parent::__construct($config);
//    }

//    public function init()
//    {
//        $this->client = $client = new Client([
//            'transport' => 'yii\httpclient\CurlTransport',
//            'baseUrl' => self::DEFAULT_URL,
//        ]);
//        parent::init();
//    }

//    public function parseProducts($url = self::DEFAULT_URL)
//    {
//        try {
//            $response = $this->client->createRequest()
//                ->setMethod('GET')
//                ->setUrl('https://www.srubimbanu.ru/proekty-ban/gotovye-proekty/' .  http_build_query([
//                        'access_token' => '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',
//                    ]))
//                ->send();
//            $request = $this->client->get($url);
//            $this->lastResponse = $request->send();
//            $page = SimpleHTMLDom::str_get_html($this->lastResponse);
//            var_dump($page->find('.catalogbox__price'));die();
//            foreach ($page as $product){
//                var_dump($product[]);die();
//            }
//        } catch (\Exception $e) {
//            echo $e->getMessage() . ' ' . $e->getCode() . ' ' . $e->getLine() . ' ' . $e->getFile();
//        }
//    }
}