<?php

namespace Instagram\Entities;

use Instagram\Http\Response;

/**
 * Like
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class Like extends AbstractEntity
{

    /**
     * Get a list of likes on a media object with `$mediaId`.
     *
     * @param string $mediaId
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/likes/#get_media_likes
     */
    public function get($mediaId)
    {
        return $this->client->request('GET', "media/$mediaId/likes");
    }

    /**
     * Set a like on a media object with `$id` by the currently authenticated user.
     *
     * @param string $mediaId
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/likes/#post_likes
     */
    public function like($mediaId)
    {
        return $this->client->request('POST', "media/$mediaId/likes");
    }

    /**
     * Remove a like on a media object with `$id` by the currently authenticated user.
     *
     * @param $mediaId
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/likes/#delete_likes
     */
    public function unlike($mediaId)
    {
        return $this->client->request('DELETE', "media/$mediaId/likes");
    }
}