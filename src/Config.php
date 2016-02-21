<?php

namespace Instagram;

use League\OAuth2\Client\Token\AccessToken;
use Noodlehaus\AbstractConfig;

/**
 * Config
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class Config extends AbstractConfig
{
    /**
     * Constructor method and sets default options, if any
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $filteredData = array_merge(array_filter($this->getDefaults()), array_filter($data));

        if (array_key_exists('access_token', $filteredData)) {
            $filteredData['access_token'] = new AccessToken(json_decode($filteredData['access_token'], true));
        }

        $this->data = $filteredData;
    }

    /**
     * @inheritDoc
     */
    protected function getDefaults()
    {
        return [
            'base_uri'      => 'https://api.instagram.com/v1/',
            'client_id'     => '',
            'client_secret' => '',
            'access_token'  => null,
            'redirect_url'  => '',
        ];
    }
}
