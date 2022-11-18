<?php

namespace Semaphore\Transformers;

use Semaphore\DataTransferObjects\VersionDTO;

class VersionTransformer implements TransformerInterface
{
    public function transform($data): VersionDTO
    {
        /** @var array $version */
        $version = explode('.', $data);

        $major = intval($version[0]);
        $minor = isset($version[1]) ? intval($version[1]) : null;
        $patch = isset($version[2]) ? intval($version[2]) : null;

        return new VersionDTO($major, $minor, $patch);
    }
}
