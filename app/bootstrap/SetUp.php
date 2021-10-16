<?php


namespace app\bootstrap;

use app\modules\review\services\SocialService;
use app\modules\setting\components\Settings;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function () {
            /** @var \yii\swiftmailer\Mailer $mailer */
            $mailer = \Yii::$app->mailer;
            $mailer->messageConfig['to'] = Settings::getArray('mail_to');
            return $mailer;
        });

    }
}