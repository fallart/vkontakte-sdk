<?php
/**
 * Created by PhpStorm.
 * User: afaller
 * Date: 12/26/16
 * Time: 10:45 AM
 */

namespace VkontakteSdkTests;

use VKontakteSdk\Options;
use VKontakteSdk\Vkontakte;

class VkontakteTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Vkontakte */
    protected $vk;

    protected function setUp()
    {
        $this->vk = new Vkontakte($this->getOptions());
    }


    public function testGetAuthorizationDialogUrl()
    {
        $this->assertEquals(
            $this->vk->getAuthorizationDialogUrl(),
            'https://oauth.vk.com/authorize'
            . '?client_id=1558435'
            . '&scope=email'
            . '&redirect_uri=http://localhost/'
            . '&response_type=code'
            . '&v=5.60'
        );
    }

    public function testGetReceivingAccessTokenUrl()
    {
        $this->assertEquals(
            $this->vk->getReceivingAccessTokenUrl(),
            'https://oauth.vk.com/access_token'
            . '?client_id=1558435'
            . '&client_secret=cGaGIWbaYmqQBOmYMyDA'
            . '&redirect_uri=http://localhost/'
            . '&code='
        );
        $this->assertEquals(
            $this->vk->getReceivingAccessTokenUrl('ADAasFaAKLmNSUbMdsVyWe'),
            'https://oauth.vk.com/access_token'
            . '?client_id=1558435'
            . '&client_secret=cGaGIWbaYmqQBOmYMyDA'
            . '&redirect_uri=http://localhost/'
            . '&code=ADAasFaAKLmNSUbMdsVyWe'
        );
    }

    public function testGetInfoUrl()
    {
        $this->assertEquals(
            $this->vk->getInfoUrl(),
            'https://api.vk.com/method/users.get'
            . '?fields=photo_50'
            . '&access_token='
        );
        $this->assertEquals(
            $this->vk->getInfoUrl('jklNasFF6fsHasSzSdf'),
            'https://api.vk.com/method/users.get'
            . '?fields=photo_50'
            . '&access_token=jklNasFF6fsHasSzSdf'
        );
        $this->assertEquals(
            $this->vk->getInfoUrl(null, ['photo_50', 'photo_200']),
            'https://api.vk.com/method/users.get'
            . '?fields=photo_50,photo_200'
            . '&access_token='
        );
        $this->assertEquals(
            $this->vk->getInfoUrl('jklNasFF6fsHasSzSdf', ['photo_50', 'photo_200']),
            'https://api.vk.com/method/users.get'
            . '?fields=photo_50,photo_200'
            . '&access_token=jklNasFF6fsHasSzSdf'
        );
    }

    protected function getOptions()
    {
        return new Options([
            'clientId' => '1558435',
            'clientSecret' => 'cGaGIWbaYmqQBOmYMyDA',
            'redirectUri' => 'http://localhost/',
            'scope' => ['email']
        ]);
    }
}