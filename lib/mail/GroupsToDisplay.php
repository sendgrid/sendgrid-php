<?php
/**
 * This helper builds the GroupsToDisplay object for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Mail
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
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
    /** @var $groups_to_display int[] An array containing the unsubscribe groups that you would like to be displayed on the unsubscribe preferences page. Maximum of 25 */
    private $groups_to_display;

    /**
     * Optional constructor
     *
     * @param int[]|int|null $groups_to_display An array containing
     *                                          the unsubscribe groups
     *                                          that you would like to
     *                                          be displayed on the
     *                                          unsubscribe preferences
     *                                          page. Maximum of 25
     */
    public function __construct($groups_to_display = null)
    {
        if (isset($groups_to_display)) {
            $this->setGroupsToDisplay($groups_to_display);
        }
    }

    /**
     * Add a group to display on a GroupsToDisplay object
     *
     * @param int|int[] $groups_to_display The unsubscribe group(s)
     *                                     that you would like to be
     *                                     displayed on the unsubscribe
     *                                     preferences page
     * 
     * @throws TypeException
     * @return null
     */ 
    public function setGroupsToDisplay($groups_to_display)
    {
        if (!is_array($groups_to_display)) {
            throw new TypeException('$groups_to_display must be an array.');
        }
        if (is_array($groups_to_display)) {
            $this->groups_to_display = $groups_to_display;
        } else {
            $this->groups_to_display[] = $groups_to_display;
        }
    }

    /**
     * Return the group(s) to display on a GroupsToDisplay object
     *
     * @return int[]
     */
    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }

    /**
     * Return an array representing a GroupsToDisplay object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return $this->getGroupsToDisplay();
    }
}
