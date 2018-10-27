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

use SendGrid\Helper\Assert;

/**
 * This class is used to construct a GroupsToDisplay object for
 * the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class GroupsToDisplay implements \JsonSerializable
{
    /**
     * @var int[]
     * An array containing the unsubscribe groups
     * that you would like to be displayed on the unsubscribe preferences page. Maximum of 25
     */
    private $groups_to_display;

    /**
     * Optional constructor
     *
     * @param int[]|null $groups_to_display An array containing
     *                                          the unsubscribe groups
     *                                          that you would like to
     *                                          be displayed on the
     *                                          unsubscribe preferences
     *                                          page. Maximum of 25
     *
     * @throws TypeException
     */
    public function __construct($groups_to_display = null)
    {
        if (isset($groups_to_display)) {
            $this->setGroupsToDisplay($groups_to_display);
        }
    }

    /**
     * Set groups list to display on a GroupsToDisplay object
     *
     * @param int[] $groups_to_display The unsubscribe group(s)
     *                                     that you would like to be
     *                                     displayed on the unsubscribe
     *                                     preferences page
     * 
     * @throws TypeException
     */ 
    public function setGroupsToDisplay($groups_to_display)
    {
        Assert::maxItems($groups_to_display, 'groups_to_display', 25);

        $this->groups_to_display = $groups_to_display;
    }

    /**
     * Add group to display on a GroupsToDisplay object
     *
     * @param int $group_to_display The unsubscribe group
     *                                     that you would like to be
     *                                     displayed on the unsubscribe
     *                                     preferences page
     *
     * @throws TypeException
     */
    public function addGroupToDisplay($group_to_display)
    {
        Assert::integer($group_to_display, 'group_to_display');
        Assert::satisfy($group_to_display, 'group_to_display', function () {
            return sizeof($this->groups_to_display) < 25;
        }, 'Number of elements in "$groups_to_display" can not exceed 25.');

        $this->groups_to_display[] = $group_to_display;
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
     * Return an array representing a GroupsToDisplay object for the SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return $this->getGroupsToDisplay();
    }
}
