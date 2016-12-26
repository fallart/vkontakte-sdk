<?php
/**
 * Created by PhpStorm.
 * User: afaller
 * Date: 12/25/16
 * Time: 9:35 PM
 */

namespace VkontakteSdkTests;

use VKontakteSdk\Options;

class OptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $config
     *
     * @dataProvider providerConfig
     */
    public function testOptions(array $config, $exceptionName = null, $exceptionMesage = null)
    {
        if ($exceptionName) {
            $this->setExpectedException($exceptionName, $exceptionMesage);
        }

        $options = new Options($config);

        $this->assertEquals($config['clientId'], $options->getClientId());
        $this->assertEquals($config['clientSecret'], $options->getClientSecret());
        $this->assertEquals($config['redirectUri'], $options->getRedirectUri());
        $this->assertEquals(implode(',', $config['scope']), $options->getScope());
    }

    public function providerConfig()
    {
        return [
            [
                [
                    'clientId' => '1558435',
                    'clientSecret' => 'cGaGIWbaYmqQBOmYMyDA',
                    'redirectUri' => 'http://localhost/',
                    'scope' => ['email'],
                ],
                null,
                null,
            ],
            [
                [
                    'clientSecret' => 'cGaGIWbaYmqQBOmYMyDA',
                    'redirectUri' => 'http://localhost/',
                    'scope' => ['email'],
                ],
                'VKontakteSdk\Exceptions\ConfigNotValidException',
                'clientId is (are) missing!',
            ],
            [
                [
                    'clientId' => '1558435',
                    'redirectUri' => 'http://localhost/',
                    'scope' => ['email'],
                ],
                'VKontakteSdk\Exceptions\ConfigNotValidException',
                'clientSecret is (are) missing!',
            ],
            [
                [
                    'clientId' => '1558435',
                    'clientSecret' => 'cGaGIWbaYmqQBOmYMyDA',
                    'scope' => ['email'],
                ],
                'VKontakteSdk\Exceptions\ConfigNotValidException',
                'redirectUri is (are) missing!',
            ],
            [
                [
                    'scope' => ['email'],
                ],
                'VKontakteSdk\Exceptions\ConfigNotValidException',
                'clientId, clientSecret, redirectUri is (are) missing!',
            ],
            [
                [],
                'VKontakteSdk\Exceptions\ConfigNotValidException',
                'clientId, clientSecret, redirectUri is (are) missing!',
            ],
        ];
    }
}