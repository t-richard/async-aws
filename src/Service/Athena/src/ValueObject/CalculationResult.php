<?php

namespace AsyncAws\Athena\ValueObject;

/**
 * Contains result information. This field is populated only if the calculation is completed.
 */
final class CalculationResult
{
    /**
     * The Amazon S3 location of the `stdout` file for the calculation.
     */
    private $stdOutS3Uri;

    /**
     * The Amazon S3 location of the `stderr` error messages file for the calculation.
     */
    private $stdErrorS3Uri;

    /**
     * The Amazon S3 location of the folder for the calculation results.
     */
    private $resultS3Uri;

    /**
     * The data format of the calculation result.
     */
    private $resultType;

    /**
     * @param array{
     *   StdOutS3Uri?: null|string,
     *   StdErrorS3Uri?: null|string,
     *   ResultS3Uri?: null|string,
     *   ResultType?: null|string,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->stdOutS3Uri = $input['StdOutS3Uri'] ?? null;
        $this->stdErrorS3Uri = $input['StdErrorS3Uri'] ?? null;
        $this->resultS3Uri = $input['ResultS3Uri'] ?? null;
        $this->resultType = $input['ResultType'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getResultS3Uri(): ?string
    {
        return $this->resultS3Uri;
    }

    public function getResultType(): ?string
    {
        return $this->resultType;
    }

    public function getStdErrorS3Uri(): ?string
    {
        return $this->stdErrorS3Uri;
    }

    public function getStdOutS3Uri(): ?string
    {
        return $this->stdOutS3Uri;
    }
}
