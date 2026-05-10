<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

/**
 * Data Transfer Object representing a stored Commercial Approval document in the file system.
 *
 * This class encapsulates the parsed XML, its file path, and the raw DGII response.
 */
readonly class CommercialApprovalData
{
    /**
     * Create a new CommercialApprovalData instance.
     *
     * @param  CommercialApprovalXml  $xml  The parsed commercial approval XML object.
     * @param  string  $path  The absolute path where the XML file is stored.
     * @param  array  $response  The raw JSON response received from DGII.
     */
    public function __construct(
        public CommercialApprovalXml $xml,
        public string $path,
        public array $response,
    ) {
        //
    }
}
