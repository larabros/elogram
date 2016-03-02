<?php

namespace Instagram\Entities;

use Instagram\Http\Response;

/**
 * Tag
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class Tag extends AbstractEntity
{

    /**
     * Get information about a tag object with name `$tag`.
     *
     * @param string $tag
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/tags/#get_tags
     */
    public function get($tag)
    {
        return $this->client->request('GET', "tags/$tag");
    }

    /**
     * Set a like on a media object with `$id` by the currently authenticated user.
     *
     * @param string      $tag
     * @param int|null    $count
     * @param string|null $minTagId
     * @param string|null $maxTagId
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/tags/#get_tags_media_recent
     */
    public function getRecentMedia($tag, $count = null, $minTagId = null, $maxTagId = null)
    {
        $params = ['query' => [
            'count'      => $count,
            'min_tag_id' => $minTagId,
            'max_tag_id' => $maxTagId,
        ]];
        return $this->client->request('GET', "tags/$tag/media/recent", $params);
    }

    /**
     * Search for tags with name `$tag`.
     *
     * @param $tag
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/tags/#get_tags_search
     */
    public function search($tag)
    {
        $params = ['query' => ['q' => $tag]];
        return $this->client->request('GET', 'tags/search', $params);
    }
}