<?php

namespace Instagram;

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
        $this->data = array_merge(array_filter($this->getDefaults()), array_filter($data));
    }

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
