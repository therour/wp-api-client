<?php

namespace Therour\WpApiClient\Params;

class MediaParam extends AbstractParam
{
    const MEDIA_IMAGE = 'image';
    const MEDIA_VIDEO = 'video';
    const MEDIA_AUDIO = 'audio';
    const MEDIA_APP = 'application';

    /**
     * Specify a resource name.
     *
     * @var string
     */
    protected $resourceName = 'media';

    /**
     * media type
     *
     * @var string
     */
    protected $media_type;

    /**
     * Find by MIME type.
     *
     * @var string
     */
    protected $mime_type;
}
