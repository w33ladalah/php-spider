<?php
namespace VDB\Spider\Filter\Postfetch;

use VDB\Spider\Filter\PostFetchFilterInterface;
use VDB\Spider\Resource;

/**
 * @author matthijs
 */
class MimeTypeFilter implements PostFetchFilterInterface
{
    protected $allowedMimeType = 'text/html';

    public function __construct($allowedMimeType)
    {
        $this->allowedMimeType = $allowedMimeType;
    }

    public function match(Resource $resource)
    {
        if (!$resource->getResponse()->isContentType($this->allowedMimeType)) {
            $mime = $resource->getResponse()->getContentType();
            $resource->setFiltered(true, "Mime type '$mime' not allowed");
            return true;
        }
        return false;
    }
}
