<?php

namespace AsyncAws\Athena\Input;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\Core\Input;
use AsyncAws\Core\Request;
use AsyncAws\Core\Stream\StreamFactory;

final class GetTableMetadataInput extends Input
{
    /**
     * The name of the data catalog that contains the database and table metadata to return.
     *
     * @required
     *
     * @var string|null
     */
    private $catalogName;

    /**
     * The name of the database that contains the table metadata to return.
     *
     * @required
     *
     * @var string|null
     */
    private $databaseName;

    /**
     * The name of the table for which metadata is returned.
     *
     * @required
     *
     * @var string|null
     */
    private $tableName;

    /**
     * @param array{
     *   CatalogName?: string,
     *   DatabaseName?: string,
     *   TableName?: string,
     *
     *   @region?: string,
     * } $input
     */
    public function __construct(array $input = [])
    {
        $this->catalogName = $input['CatalogName'] ?? null;
        $this->databaseName = $input['DatabaseName'] ?? null;
        $this->tableName = $input['TableName'] ?? null;
        parent::__construct($input);
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getCatalogName(): ?string
    {
        return $this->catalogName;
    }

    public function getDatabaseName(): ?string
    {
        return $this->databaseName;
    }

    public function getTableName(): ?string
    {
        return $this->tableName;
    }

    /**
     * @internal
     */
    public function request(): Request
    {
        // Prepare headers
        $headers = [
            'Content-Type' => 'application/x-amz-json-1.1',
            'X-Amz-Target' => 'AmazonAthena.GetTableMetadata',
        ];

        // Prepare query
        $query = [];

        // Prepare URI
        $uriString = '/';

        // Prepare Body
        $bodyPayload = $this->requestBody();
        $body = empty($bodyPayload) ? '{}' : json_encode($bodyPayload, 4194304);

        // Return the Request
        return new Request('POST', $uriString, $query, $headers, StreamFactory::create($body));
    }

    public function setCatalogName(?string $value): self
    {
        $this->catalogName = $value;

        return $this;
    }

    public function setDatabaseName(?string $value): self
    {
        $this->databaseName = $value;

        return $this;
    }

    public function setTableName(?string $value): self
    {
        $this->tableName = $value;

        return $this;
    }

    private function requestBody(): array
    {
        $payload = [];
        if (null === $v = $this->catalogName) {
            throw new InvalidArgument(sprintf('Missing parameter "CatalogName" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['CatalogName'] = $v;
        if (null === $v = $this->databaseName) {
            throw new InvalidArgument(sprintf('Missing parameter "DatabaseName" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['DatabaseName'] = $v;
        if (null === $v = $this->tableName) {
            throw new InvalidArgument(sprintf('Missing parameter "TableName" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['TableName'] = $v;

        return $payload;
    }
}
