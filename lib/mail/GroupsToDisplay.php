<?php
/**
 * This helper builds the GroupsToDisplay object for a /mail/send API call
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
     * @var $groups_to_display int[] An array containing the unsubscribe groups that you would like to be displayed
     *                               on the unsubscribe preferences page. Maximum of 25
     */
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
     * @throws \SendGrid\Mail\TypeException
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
     * @throws \SendGrid\Mail\TypeException
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
        Assert::accept($group_to_display, 'group_to_display', function () {
            $groups = $this->groups_to_display;
            if (!\is_array($groups)) {
                $groups = [];
            }
            return \count($groups) < 25;
        }, 'Number of elements in "$groups_to_display" can not be more than 25.');

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
     * Return an array representing a GroupsToDisplay object for the Twilio SendGrid API
     *
     * @return null|array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->getGroupsToDisplay();
    }
}
