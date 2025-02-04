<?php

namespace AsyncAws\Iot\Input;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\Core\Input;
use AsyncAws\Core\Request;
use AsyncAws\Core\Stream\StreamFactory;

final class ListThingsInThingGroupRequest extends Input
{
    /**
     * The thing group name.
     *
     * @required
     *
     * @var string|null
     */
    private $thingGroupName;

    /**
     * When true, list things in this thing group and in all child groups as well.
     *
     * @var bool|null
     */
    private $recursive;

    /**
     * To retrieve the next set of results, the `nextToken` value from a previous response; otherwise **null** to receive
     * the first set of results.
     *
     * @var string|null
     */
    private $nextToken;

    /**
     * The maximum number of results to return at one time.
     *
     * @var int|null
     */
    private $maxResults;

    /**
     * @param array{
     *   thingGroupName?: string,
     *   recursive?: bool,
     *   nextToken?: string,
     *   maxResults?: int,
     *
     *   @region?: string,
     * } $input
     */
    public function __construct(array $input = [])
    {
        $this->thingGroupName = $input['thingGroupName'] ?? null;
        $this->recursive = $input['recursive'] ?? null;
        $this->nextToken = $input['nextToken'] ?? null;
        $this->maxResults = $input['maxResults'] ?? null;
        parent::__construct($input);
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getMaxResults(): ?int
    {
        return $this->maxResults;
    }

    public function getNextToken(): ?string
    {
        return $this->nextToken;
    }

    public function getRecursive(): ?bool
    {
        return $this->recursive;
    }

    public function getThingGroupName(): ?string
    {
        return $this->thingGroupName;
    }

    /**
     * @internal
     */
    public function request(): Request
    {
        // Prepare headers
        $headers = ['content-type' => 'application/json'];

        // Prepare query
        $query = [];
        if (null !== $this->recursive) {
            $query['recursive'] = $this->recursive ? 'true' : 'false';
        }
        if (null !== $this->nextToken) {
            $query['nextToken'] = $this->nextToken;
        }
        if (null !== $this->maxResults) {
            $query['maxResults'] = (string) $this->maxResults;
        }

        // Prepare URI
        $uri = [];
        if (null === $v = $this->thingGroupName) {
            throw new InvalidArgument(sprintf('Missing parameter "thingGroupName" for "%s". The value cannot be null.', __CLASS__));
        }
        $uri['thingGroupName'] = $v;
        $uriString = '/thing-groups/' . rawurlencode($uri['thingGroupName']) . '/things';

        // Prepare Body
        $body = '';

        // Return the Request
        return new Request('GET', $uriString, $query, $headers, StreamFactory::create($body));
    }

    public function setMaxResults(?int $value): self
    {
        $this->maxResults = $value;

        return $this;
    }

    public function setNextToken(?string $value): self
    {
        $this->nextToken = $value;

        return $this;
    }

    public function setRecursive(?bool $value): self
    {
        $this->recursive = $value;

        return $this;
    }

    public function setThingGroupName(?string $value): self
    {
        $this->thingGroupName = $value;

        return $this;
    }
}
