# Endpoints

## Users

| Method | URL | Description | Implemented? | Tested? |
|---|---|---|---|---|
| GET | /users/self | Get information about the owner of the access token. | [X] | [ ]
| GET | /users/user-id | Get information about a user. | [X] | [ ] |
| GET | /users/self/media/recent | Get the most recent media of the user. | [X] | [ ] |
| GET | /users/user-id/media/recent | Get the most recent media of a user. | [X] | [ ] |
| GET | /users/self/media/liked | Get the recent media liked by the user. | [X] | [ ] |
| GET | /users/search | Search for a user by name. | [X] | [ ] |

## Relationships

| Method | URL | Description | Implemented? | Tested? |
|---|---|---|---|---|
| GET | /users/self/follows | Get the list of users this user follows. | [ ] | [ ] |
| GET | /users/self/followed-by | Get the list of users this user is followed by. | [ ] | [ ] |
| GET | /users/self/requested-by | List the users who have requested to follow. | [ ] | [ ] |
| GET | /users/user-id/relationship | Get information about a relationship to another user. | [ ] | [ ] |
| POST | /users/user-id/relationship | Modify the relationship with target user. | [ ] | [ ] |

## Media

| Method | URL | Description | Implemented? | Tested? |
|---|---|---|---|---|
| GET /media/media-id Get information about a media object. | [X] | [ ] |
| GET /media/shortcode/shortcode Get information about a media object. | [X] | [ ] |
| GET /media/search Search for recent media in a given area. | [X] | [ ] |

## Comments

| Method | URL | Description | Implemented? | Tested? |
|---|---|---|---|---|
| GET | /media/media-id/comments | Get a list of recent comments on a media object. | [ ] | [ ] |
| POST | /media/media-id/comments | Create a comment on a media object. | [ ] | [ ] |
| DEL | /media/media-id/comments/comment-id | Remove a comment. | [ ] | [ ] |

## Likes

| Method | URL | Description | Implemented? | Tested? |
|---|---|---|---|---|
| GET | /media/media-id/likes | Get a list of users who have liked this media. | [ ] | [ ] |
| POST | /media/media-id/likes | Set a like on this media by the current user. | [ ] | [ ] |
| DEL | /media/media-id/likes | Remove a like on this media by the current user. | [ ] | [ ] |

## Tags

| Method | URL | Description | Implemented? | Tested? |
|---|---|---|---|---|
| GET | /tags/tag-name | Get information about a tag object. | [ ] | [ ] |
| GET | /tags/tag-name/media/recent | Get a list of recently tagged media. | [ ] | [ ] |
| GET | /tags/search | Search for tags by name. | [ ] | [ ] |

## Locations

| Method | URL | Description | Implemented? | Tested? |
|---|---|---|---|---|
| GET | /locations/location-id | Get information about a location. | [ ] | [ ] |
| GET | /locations/location-id/media/recent | Get a list of media objects from a given location. | [ ] | [ ] |
| GET | /locations/search | Search for a location by geographic coordinate. | [ ] | [ ] |
