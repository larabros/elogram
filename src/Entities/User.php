<?php

namespace Instagram\Entities;

use Instagram\Http\Response;

class User extends AbstractEntity
{
    /**
     * Retrieves user information for a user with `$id`.
     *
     * @param string $id
     *
     * @return Response
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users
     */
    public function getUser($id = 'self')
    {
        return $this->client->request('GET', "users/$id", []);
    }

    /**
     * Retrieves a single user's information for a user with `$username`.
     *
     * @param $username
     *
     * @return Response|null
     */
    public function getUserByName($username)
    {
        $response = $this->searchUser($username);
        foreach($response->get() as $user) {
            if($username === $user['username']) {
                return new Response($response->getMeta(), $user);
            }
        }
        return null;
    }

    /**
     * Retrieves the feed for a user with `$id`.
     *
     * @param string $id
     *
     * @param int|null    $limit
     * @param string|null $minId
     * @param string|null $maxId
     *
     * @return Response
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users_feed
     */
    public function getUserFeed($id = 'self', $limit = null, $minId = null, $maxId = null)
    {
        $params = [
            'query' => [
                'count' => $limit,
                'minId' => $minId,
                'maxId' => $maxId,
            ]
        ];

        return $this->client->request(
            'GET',
            "users/$id/feed",
            $params
        );
    }

    /**
     * Retrieves recent media for a user with `$id`. If `$id` is not provided,
     * then the access token's owner's user ID is used.
     *
     * @param string   $id
     * @param int|null $limit
     *
     * @return Response
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users_media_recent
     */
    public function getUserMedia($id = 'self', $limit = null)
    {
        $params                   = [];
        $params['query']['count'] = $limit;

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
     *
     * @return Response
     *
     * @see https://instagram.com/developer/endpoints/users/#get_users_feed_liked
     */
    public function getUserLikedMedia($limit = null)
    {
        $params                   = [];
        $params['query']['count'] = $limit;

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
    public function searchUser($username, $limit = null)
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