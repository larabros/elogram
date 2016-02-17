<?php

namespace Instagram\Http;

class Response
{
    protected $raw;
    protected $meta;
    protected $data;
    protected $pagination;

    /**
     * Creates a new instance of `Response`.
     *
     * @param array $meta
     * @param array $data
     * @param array $pagination
     */
    public function __construct($meta = [], $data = [], $pagination = [])
    {
        $this->meta       = $meta;
        $this->data       = $data;
        $this->pagination = $pagination;
    }

    public static function createFromResponse(array $response)
    {
        return new static($response['meta'], $response['data'], $response['pagination'] ?: []);
    }

    public function getRaw()
    {
        return ['meta' => $this->meta, 'data' => $data, 'pagination' => $this->pagination];
    }

    public function get()
    {
        return $this->data;
    }

    public function next()
    {
        return array_key_exists('next_url', $this->pagination)
            ? $this->pagination['next_url']
            : null;
    }

//    public function paginate()
//    {
//        if (empty($this->pagination)) {
//            throw new Exception();
//        }
//    }

    public function toArray()
    {
        return $this->data;
    }

    public function __toString()
    {
        return json_encode($this->getRaw());
    }

    /**
     * @inheritDoc
     */
//     public function paginate($response)
//     {
//         $responses   = [];
//         $responses[] = $response;
//         $pagination  = $this->toArray($response->pagination);
//         $nextUrl     = str_replace(self::BASE_URL, '', $pagination['next_url']);

//         do {
//             $response    = $this->sendRequest('GET', $nextUrl);
//             $responses[] = $response;
//             $pagination  = $this->toArray($response->pagination);
//             $nextUrl     = str_replace(self::BASE_URL, '', $pagination['next_url']);
//         } while($pagination);
// //        var_dump($pagination);

//         return $responses;

// //        do {
// //
// //        } while(true);

// //        $nextUrlParams = [];
// //        parse_str($pagination['next_url'], $nextUrlParams);
//     }

//     protected function checkForPagination($response)
//     {

//     }
}
