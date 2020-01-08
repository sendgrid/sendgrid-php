<?php
/**
 * This file tests the dynamic/transactional template functionality for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018-19 Twilio SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Tests;

// Test each use case that uses substitutions

/**
 * This class tests the dynamic/transactional template functionality for a /mail/send API call
 *
 * @package SendGrid\Tests
 */
class DynamicTemplateTest extends BaseTestClass
{

    private $REQUEST_OBJECT_LEGACY = <<<'JSON'
{
  "content": [
    {
      "type": "text/plain",
      "value": "and easy to do anywhere, even with PHP"
    },
    {
      "type": "text/html",
      "value": "<strong>and easy to do anywhere, even with PHP</strong>"
    },
    {
      "type": "text/calendar",
      "value": "Party Time!!"
    },
    {
      "type": "text/calendar2",
      "value": "Party Time 2!!"
    }
  ],
  "from": {
    "email": "test@example.com",
    "name": "DX"
  },
  "subject": "Sending with Twilio SendGrid is Fun and Global 2",
  "personalizations": [
    {
      "bcc": [
        {
          "email": "test+7@example.com",
          "name": "Example User7"
        },
        {
          "email": "test+8@example.com",
          "name": "Example User8"
        },
        {
          "email": "test+9@example.com",
          "name": "Example User9"
        }
      ],
      "cc": [
        {
          "email": "test+4@example.com",
          "name": "Example User4"
        },
        {
          "email": "test+5@example.com",
          "name": "Example User5"
        },
        {
          "email": "test+6@example.com",
          "name": "Example User6"
        }
      ],
      "substitutions": {
        "%city1%": "Denver",
        "%city2%": "Orange",
        "%name1%": "Example Name 1",
        "%name2%": "Example Name 2"
      },
      "to": [
        {
          "email": "test@example.com",
          "name": "Example User"
        },
        {
          "email": "test+1@example.com",
          "name": "Example User1"
        },
        {
          "email": "test+2@example.com",
          "name": "Example User2"
        },
        {
          "email": "test+3@example.com",
          "name": "Example User3"
        }
      ]
    }
  ],
  "template_id": "13b8f94f-bcae-4ec6-b752-70d6cb59f932"
}
JSON;

    private $REQUEST_OBJECT = <<<'JSON'
{
  "content": [
    {
      "type": "text/plain",
      "value": "and easy to do anywhere, even with PHP"
    },
    {
      "type": "text/html",
      "value": "<strong>and easy to do anywhere, even with PHP</strong>"
    },
    {
      "type": "text/calendar",
      "value": "Party Time!!"
    },
    {
      "type": "text/calendar2",
      "value": "Party Time 2!!"
    }
  ],
  "from": {
    "email": "test@example.com",
    "name": "DX"
  },
  "subject": "Sending with Twilio SendGrid is Fun and Global 2",
  "personalizations": [
    {
      "bcc": [
        {
          "email": "test+7@example.com",
          "name": "Example User7"
        },
        {
          "email": "test+8@example.com",
          "name": "Example User8"
        },
        {
          "email": "test+9@example.com",
          "name": "Example User9"
        }
      ],
      "cc": [
        {
          "email": "test+4@example.com",
          "name": "Example User4"
        },
        {
          "email": "test+5@example.com",
          "name": "Example User5"
        },
        {
          "email": "test+6@example.com",
          "name": "Example User6"
        }
      ],
      "dynamic_template_data": {
        "%city1%": "Denver",
        "%city2%": "Orange",
        "%name1%": "Example Name 1",
        "%name2%": "Example Name 2"
      },
      "to": [
        {
          "email": "test@example.com",
          "name": "Example User"
        },
        {
          "email": "test+1@example.com",
          "name": "Example User1"
        },
        {
          "email": "test+2@example.com",
          "name": "Example User2"
        },
        {
          "email": "test+3@example.com",
          "name": "Example User3"
        }
      ]
    }
  ],
  "template_id": "d-13b8f94f-bcae-4ec6-b752-70d6cb59f932"
}
JSON;

    /**
     * Test all parameters without using objects
     */
    public function testKitchenSinkExampleWithoutObjectsAndLegacyTemplate()
    {
        $email = new \SendGrid\Mail\Mail();

        // For a detailed description of each of these settings,
        // please see the
        // [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
        $email->setSubject("Sending with Twilio SendGrid is Fun 2");

        $email->addTo("test@example.com", "Example User");
        $email->addTo("test+1@example.com", "Example User1");
        $toEmails = [
            "test+2@example.com" => "Example User2",
            "test+3@example.com" => "Example User3"
        ];
        $email->addTos($toEmails);

        $email->addCc("test+4@example.com", "Example User4");
        $ccEmails = [
            "test+5@example.com" => "Example User5",
            "test+6@example.com" => "Example User6"
        ];
        $email->addCcs($ccEmails);

        $email->addBcc("test+7@example.com", "Example User7");
        $bccEmails = [
            "test+8@example.com" => "Example User8",
            "test+9@example.com" => "Example User9"
        ];
        $email->addBccs($bccEmails);

        $email->addSubstitution("%name1%", "Example Name 1");
        $email->addSubstitution("%city1%", "Denver");
        $substitutions = [
            "%name2%" => "Example Name 2",
            "%city2%" => "Orange"
        ];
        $email->addSubstitutions($substitutions);

        // The values below this comment are global to entire message

        $email->setFrom("test@example.com", "DX");

        $email->setGlobalSubject("Sending with Twilio SendGrid is Fun and Global 2");

        $email->addContent(
            "text/plain",
            "and easy to do anywhere, even with PHP"
        );
        $email->addContent(
            "text/html",
            "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $contents = [
            "text/calendar" => "Party Time!!",
            "text/calendar2" => "Party Time 2!!"
        ];
        $email->addContents($contents);

        $email->setTemplateId("d-13b8f94f-bcae-4ec6-b752-70d6cb59f932");

        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }

    /**
     * Test all parameters without using objects with Dynamic Templates
     */
    public function testKitchenSinkExampleWithoutObjectsAndDynamicTemplate()
    {
        $email = new \SendGrid\Mail\Mail();

        // For a detailed description of each of these settings,
        // please see the
        // [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
        $email->setSubject("Sending with Twilio SendGrid is Fun 2");

        $email->addTo("test@example.com", "Example User");
        $email->addTo("test+1@example.com", "Example User1");
        $toEmails = [
            "test+2@example.com" => "Example User2",
            "test+3@example.com" => "Example User3"
        ];
        $email->addTos($toEmails);

        $email->addCc("test+4@example.com", "Example User4");
        $ccEmails = [
            "test+5@example.com" => "Example User5",
            "test+6@example.com" => "Example User6"
        ];
        $email->addCcs($ccEmails);

        $email->addBcc("test+7@example.com", "Example User7");
        $bccEmails = [
            "test+8@example.com" => "Example User8",
            "test+9@example.com" => "Example User9"
        ];
        $email->addBccs($bccEmails);

        $email->addSubstitution("%name1%", "Example Name 1");
        $email->addSubstitution("%city1%", "Denver");
        $substitutions = [
            "%name2%" => "Example Name 2",
            "%city2%" => "Orange"
        ];
        $email->addSubstitutions($substitutions);

        // The values below this comment are global to entire message

        $email->setFrom("test@example.com", "DX");

        $email->setGlobalSubject("Sending with Twilio SendGrid is Fun and Global 2");

        $email->addContent(
            "text/plain",
            "and easy to do anywhere, even with PHP"
        );
        $email->addContent(
            "text/html",
            "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $contents = [
            "text/calendar" => "Party Time!!",
            "text/calendar2" => "Party Time 2!!"
        ];
        $email->addContents($contents);

        $email->setTemplateId("d-13b8f94f-bcae-4ec6-b752-70d6cb59f932");

        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }    

    /**
     * Test all parameters using objects
     */
    public function testKitchenSinkExampleWithObjectsAndLegacyTemplate()
    {
        $email = new \SendGrid\Mail\Mail();

        // For a detailed description of each of these settings,
        // please see the
        // [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
        $email->setSubject(
            new \SendGrid\Mail\Subject("Sending with Twilio SendGrid is Fun 2")
        );

        $email->addTo(new \SendGrid\Mail\To("test@example.com", "Example User"));
        $email->addTo(new \SendGrid\Mail\To("test+1@example.com", "Example User1"));
        $toEmails = [
            new \SendGrid\Mail\To("test+2@example.com", "Example User2"),
            new \SendGrid\Mail\To("test+3@example.com", "Example User3")
        ];
        $email->addTos($toEmails);

        $email->addCc(new \SendGrid\Mail\Cc("test+4@example.com", "Example User4"));
        $ccEmails = [
            new \SendGrid\Mail\Cc("test+5@example.com", "Example User5"),
            new \SendGrid\Mail\Cc("test+6@example.com", "Example User6")
        ];
        $email->addCcs($ccEmails);

        $email->addBcc(
            new \SendGrid\Mail\Bcc("test+7@example.com", "Example User7")
        );
        $bccEmails = [
            new \SendGrid\Mail\Bcc("test+8@example.com", "Example User8"),
            new \SendGrid\Mail\Bcc("test+9@example.com", "Example User9")
        ];
        $email->addBccs($bccEmails);

        $email->addSubstitution(
            new \SendGrid\Mail\Substitution("%name1%", "Example Name 1")
        );
        $email->addSubstitution(
            new \SendGrid\Mail\Substitution("%city1%", "Denver")
        );
        $substitutions = [
            new \SendGrid\Mail\Substitution("%name2%", "Example Name 2"),
            new \SendGrid\Mail\Substitution("%city2%", "Orange")
        ];
        $email->addSubstitutions($substitutions);

        // The values below this comment are global to entire message

        $email->setFrom(new \SendGrid\Mail\From("test@example.com", "DX"));

        $email->setGlobalSubject(
            new \SendGrid\Mail\Subject("Sending with Twilio SendGrid is Fun and Global 2")
        );

        $plainTextContent = new \SendGrid\Mail\PlainTextContent(
            "and easy to do anywhere, even with PHP"
        );
        $htmlContent = new \SendGrid\Mail\HtmlContent(
            "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $email->addContent($plainTextContent);
        $email->addContent($htmlContent);
        $contents = [
            new \SendGrid\Mail\Content("text/calendar", "Party Time!!"),
            new \SendGrid\Mail\Content("text/calendar2", "Party Time 2!!")
        ];
        $email->addContents($contents);

        $email->setTemplateId(
            new \SendGrid\Mail\TemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932")
        );

        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_LEGACY);
        $this->assertTrue($isEqual);
    }
}
