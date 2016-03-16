<?php

namespace Larabros\Elogram\Repositories;

use Larabros\Elogram\Http\Response;

/**
 * LikesRepository class.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class LikesRepository extends AbstractRepository
{

    /**
     * Get a list of likes on a media object.
     *
     * @param int $mediaId  The ID of the media object
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
     * Set a like on a media object by the currently authenticated user.
     *
     * @param int $mediaId  The ID of the media object
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
     * Remove a like on a media object by the currently authenticated user.
     *
     * @param int $mediaId  The ID of the media object
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
