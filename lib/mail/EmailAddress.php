<?php namespace SendGrid\Mail;

class EmailAddress implements \JsonSerializable
{
    private $name;
    private $email;

    public function __construct(
        $emailAddress=null,
        $name=null,
        $substitutions=null,
        $subject=null
    ) {
        if(isset($emailAddress)) $this->setEmailAddress($emailAddress);
        if(isset($name)) $this->setName($name);
        if(isset($substitutions)) $this->setSubstitutions($substitutions);
        if(isset($subject)) $this->setSubject($subject);
    }

    public function getEmail()
    {
        return $this->getEmailAddress();
    }

    public function getEmailAddress()
    {
        return $this->email;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->email = $emailAddress;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
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
        // Only wrapp in double quote if comma or semicolon are found
        if (false !== strpos($name, ',') || false !== strpos($name, ';')) {
            // Unescape quotes
            $name = stripslashes(html_entity_decode($name, ENT_QUOTES));
            // Escape only double quotes
            $name = str_replace('"', '\\"', $name);
            // Wrapp in double quotes
            $name = '"' . $name . '"';
        }
        $this->name = (!empty($name)) ? $name : null;
    }

    public function getSubstitions()
    {
        return $this->substitutions;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'name'  => $this->getName(),
                'email' => $this->getEmail()
            ],
            function ($value) {
                return $value !== null;
            }
        ) ?: null;
    }
}
