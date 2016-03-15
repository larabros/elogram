<?php

namespace Larabros\Elogram\Repositories;

use Larabros\Elogram\Http\Response;

/**
 * TagsRepository
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class TagsRepository extends AbstractRepository
{
    /**
     * Get information about a tag object.
     *
     * @param string $tag  Name of the tag
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
     * Get a list of recently tagged media.
     *
     * @param string      $tag       Name of the tag
     * @param int|null    $count     Count of tagged media to return
     * @param string|null $minTagId  Return media before this min_tag_id
     * @param string|null $maxTagId  Return media after this max_tag_id
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
     * Search for tags by name.
     *
     * @param string $tag  Name of the tag
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
