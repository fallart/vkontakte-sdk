<?php
/**
 * Created by PhpStorm.
 * User: afaller
 * Date: 12/25/16
 * Time: 11:22 AM
 */

namespace VkontakteSdk;

class Vkontakte
{
    /**
     * @var string
     */
    protected $authorizeUrl = 'https://oauth.vk.com/authorize';
    /**
     * @var string
     */
    protected $accessTokenUrl = 'https://oauth.vk.com/access_token';
    /**
     * @var string
     */
    protected $methodUrl = 'https://api.vk.com/method';

    /**
     * @var Options
     */
    protected $options;

    /**
     * Vkontakte constructor.
     * @param \VKontakteSdk\Options $options
     */
    public function __construct(Options $options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getAuthorizationDialogUrl() :string
    {
        $url = $this->authorizeUrl . '?';
        $url .= "client_id={$this->options->getClientId()}&";
        $url .= "scope={$this->options->getScope()}&";
        $url .= "redirect_uri={$this->options->getRedirectUri()}&";
        $url .= "response_type=code&";
        $url .= "v={$this->options->getVersion()}";

        return $url;
    }

    /**
     * @param null|string $code
     * @return string
     */
    public function getReceivingAccessTokenUrl(string $code = null) : string
    {
        $codeParam = $code ?? $this->options->getCode();

        $url = $this->accessTokenUrl . '?';
        $url .= "client_id={$this->options->getClientId()}&";
        $url .= "client_secret={$this->options->getClientSecret()}&";
        $url .= "redirect_uri={$this->options->getRedirectUri()}&";
        $url .= "code={$codeParam}";

        return $url;
    }

    /**
     * @param string|null $accessToken
     * @param array|null  $fields
     *
     * @return string
     */
    public function getInfoUrl(string $accessToken = null, array $fields = null) : string
    {
        $accessTokenParam = $accessToken ?? $this->options->getAccessToken();
        $fieldsParam = $fields ? implode(',', $fields) : $this->options->getFields();

        $url = $this->methodUrl . '/users.get?';
        $url .= "fields={$fieldsParam}&";
        $url .= "access_token={$accessTokenParam}";

        return $url;
    }

}