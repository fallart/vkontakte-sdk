<?php
/**
 * Created by PhpStorm.
 * User: afaller
 * Date: 12/25/16
 * Time: 11:25 AM
 */

namespace VkontakteSdk;

class Options
{
    /**
     * @var int
     */
    protected $clientId;
    /**
     * @var string
     */
    protected $clientSecret;
    /**
     * @var string
     */
    protected $scope = 'email';
    /**
     * @var string
     */
    protected $redirectUri;
    /**
     * @var string
     */
    protected $version = '5.60';
    /**
     * @var string
     */
    protected $code;
    /**
     * @var string
     */
    protected $accessToken;
    /**
     * @var string
     */
    protected $fields = 'photo_50';

    /**
     * @var array
     */
    protected $requiredOptions = [
        'clientId',
        'clientSecret',
        'redirectUri',
    ];

    protected $scopeParams = [
        'notify',
        'friends',
        'photos',
        'audio',
        'video',
        'pages',
        'status',
        'notes',
        'messages',
        'wall',
        'ads',
        'offline',
        'docs',
        'groups',
        'notifications',
        'stats',
        'email',
        'market',
    ];

    protected $fieldsParams = [
        'sex',
        'bdate',
        'city',
        'country',
        'home_town',
        'photo_50',
        'photo_100',
        'photo_200_orig',
        'photo_200',
        'photo_400_orig',
        'photo_max',
        'photo_max_orig',
        'online',
        'contacts',
        'site',
        'education',
        'universities',
        'schools',
        'status',
        'last_seen',
        'followers_count',
    ];

    /**
     * Options constructor.
     * @param array $options
     * @throws ConfigNotValidException
     */
    public function __construct(array $options)
    {
        $this->validate($options);

        $this->clientId = $options['clientId'];
        $this->clientSecret = $options['clientSecret'];
        $this->redirectUri = $options['redirectUri'];
        $this->version = $options['version'] ?? $this->version;
        $this->code = $options['code'] ?? '';
        $this->accessToken = $options['accessToken'] ?? '';

    }

    /**
     * @param array $options
     * @throws Exceptions\ConfigNotValidException
     */
    protected function validate(array $options)
    {
        $missingOptions = [];

        foreach ($this->requiredOptions as $requiredOption) {
            if (!isset($options[$requiredOption])) {
                $missingOptions[] = $requiredOption;
            }
        }

        if (!empty($missingOptions)) {
            $message = implode(', ', $missingOptions) . ' is (are) missing!';
            throw new Exceptions\ConfigNotValidException($message);
        }
    }

    /**
     * @return int
     */
    public function getClientId() : int
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret() : string
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getScope() : string
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getRedirectUri() :string
    {
        return $this->redirectUri;
    }

    /**
     * @return string
     */
    public function getVersion() :string
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getCode() :string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getAccessToken() :string
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getFields() :string
    {
        return $this->fields;
    }

    /**
     * @param array $scopes
     *
     * @return $this
     */
    public function setScope(array $scopes)
    {
        $this->scope = implode(
            ',',
            array_intersect($this->scopeParams, $scopes)
        );

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = implode(
            ',',
            array_intersect($this->fieldsParams, $fields)
        );

        return $this;
    }
}