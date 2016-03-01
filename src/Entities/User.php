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
     * @see <https://instagram.com/developer/endpoints/users/#get_users>
     */
    public function get($id = 'self')
    {
        return $this->client->request('GET', "users/$id", []);
    }

    /**
     * Retrieves recent media for a user with `$id`. If `$id` is not provided,
     * then the ID of the owner of the access token is used instead.
     *
     * @param string   $id
     * @param int|null $count  Count of media to return
     * @param int|null $minId  Return media later than this min_id
     * @param int|null $maxId  Return media earlier than this max_id
     *
     * @return Response
     *
     * @see <https://instagram.com/developer/endpoints/users/#get_users_media_recent>
     */
    public function getMedia($id = 'self', $count = null, $minId = null, $maxId = null)
    {
        $params                    = [];
        $params['query']['count']  = $count;
        $params['query']['min_id'] = $minId;
        $params['query']['max_id'] = $maxId;


        return $this->client->request(
            'GET',
            "users/$id/media/recent",
            $params
        );
    }

    /**
     * Retrieves all media liked by this user. This method only works for the
     * owner of the access token being used to make the request.
     *
     * @param int|null $count      Count of media to return
     * @param int|null $maxLikeId  Return media liked before this id
     *
     * @return Response
     *
     * @see <https://instagram.com/developer/endpoints/users/#get_users_feed_liked>
     */
    public function getLikedMedia($count = null, $maxLikeId = null)
    {
        $params                         = [];
        $params['query']['count']       = $count;
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
     * @param  string   $query  A query string
     * @param  int|null $count  Number of users to return
     *
     * @return Response
     *
     * @throws Exception
     *
     * @see <https://instagram.com/developer/endpoints/users/#get_users_search>
     */
    public function search($query, $count = null)
    {
        $params = [
            'query' => [
                'q'     => $query,
                'count' => $count,
            ]
        ];

        return $this->client->request(
            'GET',
            'users/search',
            $params
        );
    }

    /**
     * Searches for and returns a single user's information for a user with
     * `$username`. If no results are found, `null` is returned.
     *
     * @param string $username  A username to search for
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
     * Returns a list of users this user follows. This method only works for the
     * owner of the access token being used to make the request.
     *
     * @return Response
     */
    public function follows()
    {
        return $this->client->request('GET', 'users/self/follows');
    }

    /**
     * Returns a list of users this user is followed by. This method only works
     * for the owner of the access token being used to make the request.
     *
     * @return Response
     */
    public function followedBy()
    {
        return $this->client->request('GET', 'users/self/followed-by');
    }

    /**
     * Returns a list of users who have requested this user's permission to
     * follow. This method only works for the owner of the access token being
     * used to make the request.
     *
     * @return Response
     */
    public function requestedBy()
    {
        return $this->client->request('GET', 'users/self/requested-by');
    }

    /**
     * Get information about the relationship of the owner of the access token
     * to another user.
     *
     * @param string $id
     *
     * @return Response
     */
    public function getRelationship($id)
    {
        return $this->client->request('GET', "users/$id/relationship");
    }

    /**
     * Modify the relationship between the owner of the access token and the
     * target user with `$id`. `$action` can be one of the following:
     *
     * - 'follow'
     * - 'unfollow'
     * - 'approve'
     * - 'ignore'
     *
     * @param string $id
     * @param string $action
     *
     * @return Response
     */
    public function setRelationship($id, $action)
    {
        $params = [
            'form_params' => [
                'action' => $action,
            ]
        ];
        return $this->client->request('POST', "users/$id/relationship", $params);
    }
}