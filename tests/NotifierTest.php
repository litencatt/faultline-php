<?php

namespace Faultline\Tests;

use PHPUnit\Framework\TestCase;
use Faultline\Notifier;

class NotifierTest extends TestCase
{
    /**
     * testNotify
     *
     */
    public function testNotify()
    {
        $notifier = new NotifierMock([
            'project' => 'faultline-test',
            'apiKey' => 'xxxxXXXXXxXxXXxxXXXXXXXxxxxXXXXXX',
            'endpoint' => 'https://xxxxxxxxx.execute-api.ap-northeast-1.amazonaws.com/v0',
            'notifications' => [
                [
                    'type'=> 'slack',
                    'endpoint'=> 'https://hooks.slack.com/services/XXXXXXXXXX/B2RAD9423/WC2uTs3MyGldZvieAtAA7gQq',
                    'channel'=> '#random',
                    'username'=> 'faultline-notify',
                    'notifyInterval'=> 5,
                    'threshold'=> 10
                ],
                [
                    'type'=> 'github',
                    'userToken'=> 'XXXXXXXxxxxXXXXXXxxxxxXXXXXXXXXX',
                    'owner'=> 'k1LoW',
                    'repo'=> 'faultline',
                    'threshold'=> -1
                ]
            ]
        ]);
        $response = $notifier->notify(Troublemaker::newException());
        $this->assertTrue($response);
    }

    /**
     * testNotifyErrorShouldBeBoolean
     *
     */
    public function testNotifyErrorShouldBeBoolean()
    {
        $notifier = new Notifier([
            'project' => 'faultline-test',
            'apiKey' => 'xxxxXXXXXxXxXXxxXXXXXXXxxxxXXXXXX',
            'endpoint' => 'https://example.com/v0',
            'notifications' => [
                [
                    'type'=> 'slack',
                    'endpoint'=> 'https://hooks.slack.com/services/XXXXXXXXXX/B2RAD9423/WC2uTs3MyGldZvieAtAA7gQq',
                    'channel'=> '#random',
                    'username'=> 'faultline-notify',
                    'notifyInterval'=> 5,
                    'threshold'=> 10
                ],
                [
                    'type'=> 'github',
                    'userToken'=> 'XXXXXXXxxxxXXXXXXxxxxxXXXXXXXXXX',
                    'owner'=> 'k1LoW',
                    'repo'=> 'faultline',
                    'threshold'=> -1
                ]
            ]
        ]);
        $response = $notifier->notify(Troublemaker::newException());
        $this->assertFalse($response);
    }
}
