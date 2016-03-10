<?php

namespace Larabros\Elogram\Http\Clients;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Larabros\Elogram\Http\Response;

/**
 * A HTTP client adapter for Guzzle.
 *
 * @package    Elogram
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/elogram
 * @license    MIT
 */
final class GuzzleAdapter extends AbstractAdapter
{
    /**
     * The Guzzle client instance.
     *
     * @var ClientInterface
     */
    protected $guzzle;

    /**
     * Creates a new instance of :php:class:`GuzzleAdapter`.
     *
     * @param ClientInterface $guzzle
     */
    public function __construct(ClientInterface $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * {@inheritDoc}
     */
    public function request($method, $uri, array $parameters = [])
    {
        try {
            $response = $this->guzzle->request($method, $uri, $parameters);
        } catch (ClientException $e) {
            if (!$e->hasResponse()) {
                throw $e;
            }

            throw $this->resolveExceptionClass($e);
        } catch (Exception $e) {
            throw $e;
        }

        return Response::createFromJson(json_decode($response->getBody()->getContents(), true));
    }
}
