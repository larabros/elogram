<?php

namespace Larabros\Elogram\Repositories;

use Larabros\Elogram\Http\Response;

/**
 * CommentsRepository
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class CommentsRepository extends AbstractRepository
{

    /**
     * Get a list of recent comments on a media object.
     *
     * @param int $mediaId  The ID of the media object
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
     * Create a comment on a media object using the following rules:
     *
     * - The total length of the comment cannot exceed 300 characters.
     * - The comment cannot contain more than 4 hashtags.
     * - The comment cannot contain more than 1 URL.
     * - The comment cannot consist of all capital letters.
     *
     * @param int    $mediaId  The ID of the media object
     * @param string $text     Text to post as a comment on the media object
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
     * Remove a comment either on the owner of the access token's media object
     * or authored by the owner of the access token.
     *
     * @param int    $mediaId    The ID of the media object
     * @param string $commentId  The ID of the comment
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
