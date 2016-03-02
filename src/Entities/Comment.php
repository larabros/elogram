<?php

namespace Instagram\Entities;

use Instagram\Http\Response;

/**
 * Media
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class Comment extends AbstractEntity
{

    /**
     * Get a list of recent comments on a media object with `$mediaId`.
     *
     * @param string $mediaId
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/comments/#get_media_comments
     */
    public function get($mediaId)
    {
        return $this->client->request('GET', "media/$mediaId/comments");
    }

    /**
     * Create a comment on a media object with `$mediaId` using the following rules:
     *
     * - The total length of the comment cannot exceed 300 characters.
     * - The comment cannot contain more than 4 hashtags.
     * - The comment cannot contain more than 1 URL.
     * - The comment cannot consist of all capital letters.
     *
     * @param string $mediaId
     * @param string $text
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/comments/#post_media_comments
     */
    public function create($mediaId, $text)
    {
        $params = ['form_params' => ['text' => $text]];
        return $this->client->request('POST', "media/$mediaId/comments", $params);
    }

    /**
     * Remove a comment either on a media object with `$id`.
     *
     * @param $mediaId
     * @param $commentId
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/comments/#delete_media_comments
     */
    public function delete($mediaId, $commentId)
    {
        return $this->client->request('DELETE', "media/$mediaId/comments/$commentId");
    }
}