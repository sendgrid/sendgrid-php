<?php 
/**
 * This helper builds the MailSettings object for a /mail/send API call
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
 * This class is used to construct a MailSettings object for the /mail/send API call
 * 
 * A collection of different mail settings that you can use to specify how you would 
 * like this email to be handled
 * 
 * @package SendGrid\Mail
 */
class MailSettings implements \JsonSerializable
{
    // @var Bcc object
    private $bcc;
    // @var BypassListManagement object
    private $bypass_list_management;
    // @var Footer object
    private $footer;
    // @var SandBoxMode object
    private $sandbox_mode;
    // @var SpamCheck object
    private $spam_check;

    /**
     * Optional constructor
     *
     * @param Bcc|null                  $bcc                    Bcc object
     * @param BypassListManagement|null $bypass_list_management BypassListManagement 
     *                                                          object
     * @param Footer|null               $footer                 Footer object
     * @param SandBoxMode|null          $sandbox_mode           SandBoxMode object
     * @param SpamCheck|null            $spam_check             SpamCheck object
     */ 
    public function __construct(
        $bcc=null,
        $bypass_list_management=null,
        $footer=null,
        $sandbox_mode=null,
        $spam_check=null
    ) {
        if (isset($bcc)) {
            $this->setBccSettings($bcc);
        }
        if (isset($bypass_list_management)) {
            $this->setBypassListManagement($bypass_list_management);
        }
        if (isset($footer)) {
            $this->setFooter($footer);
        }
        if (isset($sandbox_mode)) {
            $this->setSandboxMode($sandbox_mode);
        }
        if (isset($spam_check)) {
            $this->setSpamCheck($spam_check);
        }
    }
    
    public function setBccSettings($enable, $email=null)
    {
        if ($enable instanceof BccSettings) {
            $bcc = $enable;
            $this->bcc = $bcc;
            return;
        }
        $this->bcc = new BccSettings($enable, $email);
        return;
    }

    public function getBccSettings()
    {
        return $this->bcc;
    }

    public function setBypassListManagement($bypass_list_management)
    {
        if ($bypass_list_management instanceof BypassListManagement) {
            $this->bypass_list_management = $bypass_list_management;
            return;
        }
        $this->bypass_list_management = new BypassListManagement($bypass_list_management);
    }

    public function getBypassListManagement()
    {
        return $this->bypass_list_management;
    }

    public function setFooter($enable, $text=null, $html=null)
    {
        if ($enable instanceof Footer) {
            $footer = $enable;
            $this->footer = $footer;
            return;
        }
        $this->footer = new Footer($enable, $text, $html);
        return;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function setSandboxMode($sandbox_mode)
    {
        if ($sandbox_mode instanceof SandBoxMode) {
            $this->sandbox_mode = $sandbox_mode;
        } else {
            $this->sandbox_mode = new SandBoxMode($sandbox_mode);
        }
    }

    public function getSandboxMode()
    {
        return $this->sandbox_mode;
    }

    public function enableSandboxMode()
    {
        $this->setSandboxMode(true);
    }

    public function disableSandboxMode()
    {
        $this->setSandboxMode(false);
    }

    public function setSpamCheck($enable, $threshold=null, $post_to_url=null)
    {
        if ($enable instanceof SpamCheck) {
            $spam_check = $enable;
            $this->spam_check = $spam_check;
            return;
        }
        $this->spam_check = new SpamCheck($enable, $threshold, $post_to_url);
        return;
    }

    public function getSpamCheck()
    {
        return $this->spam_check;
    }

    /**
     * Return an array representing a MailSettings object for the SendGrid API
     * 
     * @return null|array
     */  
    public function jsonSerialize()
    {
        return array_filter(
            [
                'bcc'                    => $this->getBccSettings(),
                'bypass_list_management' => $this->getBypassListManagement(),
                'footer'                 => $this->getFooter(),
                'sandbox_mode'           => $this->getSandboxMode(),
                'spam_check'             => $this->getSpamCheck()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
