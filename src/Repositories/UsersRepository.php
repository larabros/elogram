<?php

namespace Larabros\Elogram\Repositories;

use Larabros\Elogram\Http\Response;

/**
 * UsersRepository
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
class UsersRepository extends AbstractRepository
{
    /**
     * Get information about a user.
     *
     * @param string $id  The ID of the user. Default is ``self``
     *
     * @return Response
     *
     * @link https://instagram.com/developer/endpoints/users/#get_users
     */
    public function get($id = 'self')
    {
        return $this->client->request('GET', "users/$id", []);
    }

    /**
     * Get the most recent media published by a user.
     *
     * @param string   $id     The ID of the user. Default is ``self``
     * @param int|null $count  Count of media to return
     * @param int|null $minId  Return media later than this min_id
     * @param int|null $maxId  Return media earlier than this max_id
     *
     * @return Response
     *
     * @link https://instagram.com/developer/endpoints/users/#get_users_media_recent
     */
    public function getMedia($id = 'self', $count = null, $minId = null, $maxId = null)
    {
        $params = ['query' => [
            'count'       => $count,
            'min_id' => $minId,
            'max_id' => $maxId,
        ]];

        return $this->client->request(
            'GET',
            "users/$id/media/recent",
            $params
        );
    }

    /**
     * Get the list of recent media liked by the owner of the access token.
     *
     * @param int|null $count      Count of media to return
     * @param int|null $maxLikeId  Return media liked before this id
     *
     * @return Response
     *
     * @link https://instagram.com/developer/endpoints/users/#get_users_feed_liked
     */
    public function getLikedMedia($count = null, $maxLikeId = null)
    {
        $params = ['query' => [
            'count'       => $count,
            'max_like_id' => $maxLikeId
        ]];

        return $this->client->request(
            'GET',
            'users/self/media/liked',
            $params
        );
    }

    /**
     * Get a list of users matching the query.
     *
     * @param  string   $query  A query string to search for
     * @param  int|null $count  Number of users to return
     *
     * @return Response
     *
     * @link https://instagram.com/developer/endpoints/users/#get_users_search
     */
    public function search($query, $count = null)
    {
        $params = ['query' => [
            'q'     => $query,
            'count' => $count,
        ]];

        return $this->client->request(
            'GET',
            'users/search',
            $params
        );
    }

    /**
     * Searches for and returns a single user's information. If no results
     * are found, ``null`` is returned.
     *
     * @param string $username  A username to search for
     *
     * @return Response|null
     */
    public function find($username)
    {
        $response = $this->search($username);
        foreach ($response->get() as $user) {
            if ($username === $user['username']) {
                return $this->get($user['id']);
            }
        }
        return null;
    }

    /**
     * Get the list of users this user follows.
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/relationships/#get_users_follows
     */
    public function follows()
    {
        return $this->client->request('GET', 'users/self/follows');
    }

    /**
     * Get the list of users this user is followed by.
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/relationships/#get_users_followed_by
     */
    public function followedBy()
    {
        return $this->client->request('GET', 'users/self/followed-by');
    }

    /**
     * List the users who have requested this user's permission to follow.
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/relationships/#get_incoming_requests
     */
    public function requestedBy()
    {
        return $this->client->request('GET', 'users/self/requested-by');
    }

    /**
     * Get information about the relationship of the owner of the access token
     * to another user.
     *
     * @param string $targetUserId  The ID of the target user
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/relationships/#get_relationship
     */
    public function getRelationship($targetUserId)
    {
        return $this->client->request('GET', "users/$targetUserId/relationship");
    }

    /**
     * Modify the relationship between the owner of the access token and the
     * target user.
     *
     * @param string $targetUserId  The ID of the target user
     * @param string $action        Can be one of:  ``follow | unfollow | approve | ignore``
     *
     * @return Response
     *
     * @link https://www.instagram.com/developer/endpoints/relationships/#post_relationship
     */
    public function setRelationship($targetUserId, $action)
    {
        $params = ['form_params' => ['action' => $action]];
        return $this->client->request('POST', "users/$targetUserId/relationship", $params);
    }
}
