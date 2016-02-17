<?php

namespace Instagram;

use Noodlehaus\AbstractConfig;

/**
 * Config
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/noodlehaus/config
 * @license    MIT
 */
class Config extends AbstractConfig
{
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
