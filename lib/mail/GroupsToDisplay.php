<?php 
/**
 * This helper builds the GroupsToDisplay object for a /mail/send API call
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
 * This class is used to construct a GroupsToDisplay object for 
 * the /mail/send API call
 * 
 * @package SendGrid\Mail
 */
class GroupsToDisplay implements \JsonSerializable
{
    // @var int[] An array containing the unsubscribe groups that 
    // you would like to be displayed on the unsubscribe 
    // preferences page. Maximum of 25
    private $groups_to_display;

    /**
     * Optional constructor
     *
     * @param int[]|null $groups_to_display An array containing 
     *                                      the unsubscribe groups 
     *                                      that you would like to 
     *                                      be displayed on the 
     *                                      unsubscribe preferences 
     *                                      page. Maximum of 25
     */ 
    public function __construct($groups_to_display=null)
    {
        if (isset($groups_to_display)) {
            $this->setGroupsToDisplay($groups_to_display);
        }
    }

    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }

    public function setGroupsToDisplay($groups_to_display)
    {
        $this->groups_to_display[] = $groups_to_display;
    }

    /**
     * Return an array representing a GroupsToDisplay object for the SendGrid API
     * 
     * @return null|array
     */  
    public function jsonSerialize()
    {
        return $this->getGroupsToDisplay();
    }
}