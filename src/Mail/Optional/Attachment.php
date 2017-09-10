<?php

namespace SendGrid\Mail\Optional;

final class Attachment implements \JsonSerializable
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $disposition;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @param string $content
     * @param string $type
     * @param string $name
     * @param string|null $disposition
     * @param string|null $id
     */
    public function __construct($content, $type, $name, $disposition = null, $id = null)
    {
        $this->validateScalar($content, $type, $name, $disposition, $id);
        $this->content     = $content;
        $this->type        = $type;
        $this->name        = $name;
        $this->disposition = $disposition;
        $this->id          = $id;
    }

    /**
     * @param string $content
     * @param string $type
     * @param string $name
     * @param string $disposition
     * @param string $id
     */
    private function validateScalar($content, $type, $name, $disposition, $id)
    {
        if (!is_string($content) ||
            !is_string($type) ||
            !is_string($name) ||
            null !== $disposition && !is_string($disposition) ||
            null !== $id && !is_string($id)
        ) {
            throw new \InvalidArgumentException('Arguments should be strings');
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $baseProperties = [
            'content'     => $this->content,
            'type'        => $this->type,
            'filename'    => $this->name,
            'disposition' => $this->disposition
        ];

        if (null !== $this->id) {
            $baseProperties['content_id'] = $this->id;
        }
        return $baseProperties;
    }
}
