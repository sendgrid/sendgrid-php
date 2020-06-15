<?php
/**
 * This helper builds the EmailAddress object for a /mail/send API call
 */

namespace SendGrid\Mail;

/**
 * This class is used to construct a EmailAddress object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class EmailAddress implements \JsonSerializable
{
    /** @var $name string The name of the person associated with the email */
    private $name;
    /** @var $email string The email address */
    private $email;
    /** @var $substitutions Substitution[] An array of key/value substitutions
     * to be be applied to the text and html content of the email body
     */
    private $substitutions;
    /** @var $subject Subject The personalized subject of the email */
    private $subject;

    /**
     * Optional constructor
     *
     * @param string|null $emailAddress  The email address
     * @param string|null $name          The name of the person associated with
     *                                   the email
     * @param array|null  $substitutions An array of key/value substitutions to
     *                                   be be applied to the text and html content
     *                                   of the email body
     * @param string|null $subject       The personalized subject of the email
     * @throws TypeException
     */
    public function __construct(
        $emailAddress = null,
        $name = null,
        $substitutions = null,
        $subject = null
    ) {
        if (isset($emailAddress)) {
            $this->setEmailAddress($emailAddress);
        }
        if (isset($name) && $name !== null) {
            $this->setName($name);
        }
        if (isset($substitutions)) {
            $this->setSubstitutions($substitutions);
        }
        if (isset($subject)) {
            $this->setSubject($subject);
        }
    }

    /**
     * Validates given emailAddress against expected type and filter.
     * If given emailAddress is of format 'name <emailAddress>', parts will be
     * extracted and the given arguments will be updated for external use.
     * Note: Only the last occurrence of <emailAddress> will be used of above format.
     *
     * @param string $emailAddress The email address (may be updated)
     * @param string $name         Display name (may be updated if null is provided)
     *
     * @return bool Result of validating the email address
     */
    public static function isValidEmailAddress(&$emailAddress, &$name = null)
    {
        //  The emailAddress must be type of string
        if (!is_string($emailAddress)) {
            //  Its not! Reject
            return false;
        }

        //  Verify if this emailAddress has close tag
        $addressLastPosClose = strrpos($emailAddress, '>');

        //  Detect if this emailAddress has format 'name <emailAddress>'
        if (is_int($addressLastPosClose) && ($addressLastPosClose === (strlen($emailAddress) - 1))) {
            //  It should also contain the open tag - otherwise reject
            if (!is_int($addressLastPosOpen = strrpos($emailAddress, '<'))) {
                return false;
            }

            //  If having display name, only overwrite if not present yet
            if (($addressLastPosOpen > 0) && !is_string($name)) {
                //  Extract the name from emailAddress
                $addressName = trim(substr($emailAddress, 0, $addressLastPosOpen));

                //  If not empty, overwrite the name
                if ($addressName <> '') {
                    $name = $addressName;
                }
            }

            //  Overwrite address so it can be validated
            $emailAddress = substr(
                $emailAddress,
                $addressLastPosOpen + 1,
                $addressLastPosClose - $addressLastPosOpen - 1
            );
        }

        //  Define additional flags for filter_var to verify unicode characters on local part
        //  Constant FILTER_FLAG_EMAIL_UNICODE is available since PHP 7.1
        $flags = (defined('FILTER_FLAG_EMAIL_UNICODE')) ? FILTER_FLAG_EMAIL_UNICODE : null;

        //  Return result of having string type and valid emailAddress
        //  The filter_var returns the filtered data on success
        //  (which must be a string), otherwise bool(false)
        return (is_string(filter_var($emailAddress, FILTER_VALIDATE_EMAIL, $flags)));
    }

    /**
     * Add the email address to an EmailAddress object
     *
     * @param string $emailAddress The email address
     *
     * @throws TypeException
     */
    public function setEmailAddress($emailAddress)
    {
        //  Method isValidEmailAddress may extract name
        //  if provided emailAddress is of format '[name] <address>'
        $name = null;

        //  If emailAddress contains unexpected type/format, reject
        if (!static::isValidEmailAddress($emailAddress, $name)) {
            throw new TypeException(
                "{$emailAddress} must be valid and of type string."
            );
        }

        //  Assign the (possibly extracted and) validated emailAddress
        $this->email = $emailAddress;

        //  If having an extracted name, set it
        //  (If this method is called from constructor, it may be overwritten)
        if (is_string($name)) {
            $this->setName($name);
        }
    }

    /**
     * Retrieve the email address from a EmailAddress object
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->email;
    }

    /**
     * Retrieve the email address from a EmailAddress object
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getEmailAddress();
    }

    /**
     * Add a name to a EmailAddress object
     *
     * @param string $name The name of the person associated with the email
     *
     * @throws TypeException
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new TypeException('$name must be of type string.');
        }

        /*
            Issue #368
            ==========
            If the name is not wrapped in double quotes and contains a comma or
            semicolon, the API fails to parse it correctly.
            When wrapped in double quotes, commas, semicolons and unescaped single
            quotes are supported.
            Escaped double quotes are supported as well but will appear unescaped in
            the mail (e.g. "O\'Keefe").
            Double quotes will be shown in some email clients, so the name should
            only be wrapped when necessary.
        */
        // Only wrap in double quote if comma or semicolon are found
        if (false !== strpos($name, ',') || false !== strpos($name, ';')) {
            // Unescape quotes
            $name = stripslashes(html_entity_decode($name, ENT_QUOTES));
            // Escape only double quotes
            $name = str_replace('"', '\\"', $name);
            // Wrap in double quotes
            $name = '"' . $name . '"';
        }
        $this->name = (!empty($name)) ? $name : null;
    }

    /**
     * Retrieve the name from a EmailAddress object
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add substitutions to a EmailAddress object
     *
     * @param array $substitutions An array of key/value substitutions to
     *                             be be applied to the text and html content
     *                             of the email body
     *
     * @throws TypeException
     */
    public function setSubstitutions($substitutions)
    {
        if (!is_array($substitutions)) {
            throw new TypeException('$substitutions must be an array.');
        }

        $this->substitutions = $substitutions;
    }

    /**
     * Retrieve substitutions from a EmailAddress object
     */
    public function getSubstitutions()
    {
        return $this->substitutions;
    }

    /**
     * Add a subject to a EmailAddress object
     *
     * @param string $subject The personalized subject of the email
     *
     * @throws TypeException
     */
    public function setSubject($subject)
    {
        if (!is_string($subject)) {
            throw new TypeException('$subject must be of type string.');
        }
        // Now that we know it is a string, we can safely create a new subject
        $this->subject = new Subject($subject);
    }

    /**
     * Retrieve a subject from an EmailAddress object
     *
     * @return Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Return an array representing an EmailAddress object for the Twilio SendGrid API
     *
     * @return null|array
     */
    public function jsonSerialize()
    {
        return array_filter(
            [
                'name' => $this->getName(),
                'email' => $this->getEmail()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
