<?php 
/**
 * This helper builds the Attachment object for a /mail/send API call
 * 
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid 
 */
namespace SendGrid\Mail;

/**
 * This class is used to construct a Attachment object for the /mail/send API call
 * 
 * @package SendGrid\Mail
 */
class Attachment implements \JsonSerializable
{
    // @var string Base64 encoded content
    private $content;
    // @var string Mime type of the attachment
    private $type;
    // @var string File name of the attachment
    private $filename;
    // @var string How the attachment should be displayed: inline or attachment,
    // default is attachment
    private $disposition;
    // @var string Used when disposition is inline to diplay the file within the
    // body of the email
    private $content_id;
 
    /**
     * Optional constructor
     *
     * @param string $content     Base64 encoded content
     * @param string $type        Mime type of the attachment
     * @param string $filename    File name of the attachment
     * @param string $disposition How the attachment should be displayed: inline 
     *                            or attachment, default is attachment
     * @param string $content_id  Used when disposition is inline to diplay the 
     *                            file within the body of the email
     */
    public function __construct(
        $content=null,
        $type=null,
        $filename=null,
        $disposition=null,
        $content_id=null
    ) {
        if (isset($content)) {
            $this->setContent($content);
        }
        if (isset($type)) {
            $this->setType($type);
        }
        if (isset($filename)) {
            $this->setFilename($filename);
        }
        if (isset($disposition)) {
            $this->setDisposition($disposition);
        }
        if (isset($content_id)) {
            $this->setContentID($content_id);
        }
    }

    /**
     * Add the content to a Attachment object
     *
     * @param string $content Base64 encoded content
     * 
     * @return null
     */  
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Retrieve the content from a Attachment object
     * 
     * @return string
     */  
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add the mime type to a Attachment object
     *
     * @param string $type Mime type of the attachment
     * 
     * @return null
     */  
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Retrieve the mime type from a Attachment object
     * 
     * @return string
     */  
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add the file name to a Attachment object
     *
     * @param string $filename File name of the attachment
     * 
     * @return null
     */  
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Retrieve the file name from a Attachment object
     * 
     * @return string
     */  
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Add the disposition to a Attachment object
     *
     * @param string $disposition How the attachment should be displayed: 
     *                            inline or attachment, default is attachment
     * 
     * @return null
     */  
    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;
    }

    /**
     * Retrieve the disposition from a Attachment object
     * 
     * @return string
     */  
    public function getDisposition()
    {
        return $this->disposition;
    }

    /**
     * Add the content id to a Attachment object
     *
     * @param string $content_id Used when disposition is inline to diplay 
     *                           the file within the body of the email
     * 
     * @return null
     */  
    public function setContentID($content_id)
    {
        $this->content_id = $content_id;
    }

    /**
     * Retrieve the content id from a Attachment object
     * 
     * @return string
     */  
    public function getContentID()
    {
        return $this->content_id;
    }

    /**
     * Return an array representing a Attachment object for the SendGrid API
     * 
     * @return null|array
     */  
    public function jsonSerialize()
    {
        return array_filter(
            [
                'content'     => $this->getContent(),
                'type'        => $this->getType(),
                'filename'    => $this->getFilename(),
                'disposition' => $this->getDisposition(),
                'content_id'  => $this->getContentID()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
