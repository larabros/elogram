<?php

namespace Instagram\Entities;

use Instagram\Http\Response;

/**
 * User
 *
 * @package    Instagram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/instagram-sdk
 * @license    MIT
 */
class User extends AbstractEntity
{
    /**
     * Retrieves user information for a user with `$id`. If no `$id` is provided,
     * then the ID of the owner of the access token is used instead.
     *
     * @param string $id
     *
     * @return Response
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users
     */
    public function get($id = 'self')
    {
        return $this->client->request('GET', "users/$id", []);
    }

    /**
     * Searches for and returns a single user's information for a user with
     * `$username`. If no results are found, `null` is returned.
     *
     * @param $username
     *
     * @return Response|null
     */
    public function find($username)
    {
        $response = $this->search($username);
        foreach($response->get() as $user) {
            if($username === $user['username']) {
                return $this->get($user['id']);
            }
        }
        return null;
    }

    /**
     * Retrieves recent media for a user with `$id`. If `$id` is not provided,
     * then the ID of the owner of the  access token is used instead.
     *
     * @param string $id
     * @param int|null $limit
     * @param int|null $minId
     * @param int|null $maxId
     *
     * @return Response
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users_media_recent
     */
    public function getMedia($id = 'self', $limit = null, $minId = null, $maxId = null)
    {
        $params                    = [];
        $params['query']['count']  = $limit;
        $params['query']['min_id'] = $minId;
        $params['query']['max_id'] = $maxId;


        return $this->client->request(
            'GET',
            "users/$id/media/recent",
            $params
        );
    }

    /**
     * Retrieves all media liked by a user. This method only works for the user
     * whose access token is being used to make the request.
     *
     * @param int|null $limit
     * @param int|null $maxLikeId
     *
     * @return Response
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users_feed_liked
     */
    public function getLikedMedia($limit = null, $maxLikeId = null)
    {
        $params                         = [];
        $params['query']['count']       = $limit;
        $params['query']['max_like_id'] = $maxLikeId;

        return $this->client->request(
            'GET',
            'users/self/media/liked',
            $params
        );
    }

    /**
     * Searches the Instagram API for any users with `$username`.
     *
     * @param  string $username
     * @param  integer $limit
     *
     * @return Response
     *
     * @throws Exception
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users_search
     */
    public function search($username, $limit = null)
    {
        $params = [
            'query' => [
                'q'     => $username,
                'count' => $limit,
            ]
        ];

        return $this->client->request(
            'GET',
            'users/search',
            $params
        );
    }
}