<?php
/**
 * This file tests the request object generation for a /mail/send API call.
 */

namespace SendGrid\Tests\Unit;

use SendGrid\Mail\From;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;
use SendGrid\Tests\BaseTestClass;

/**
 * This class tests the request object generation for a /mail/send API call.
 *
 * @package SendGrid\Tests\Unit
 */
class MultipleEmailToMultipleRecipientsTest extends BaseTestClass
{

    private $REQUEST_OBJECT = <<<'JSON'
{
  "content": [
    {
      "type": "text/plain",
      "value": "Hello -name-, your github is -github- sent at -time-"
    },
    {
      "type": "text/html",
      "value": "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
    }
  ],
  "from": {
    "email": "test@example.com",
    "name": "Example User"
  },
  "personalizations": [
    {
      "subject": "Subject 1 -name-",
      "substitutions": {
        "-github-": "http://github.com/example_user1",
        "-name-": "Example User 1",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test1@example.com",
          "name": "Example User1"
        }
      ]
    },
    {
      "subject": "Subject 2 -name-",
      "substitutions": {
        "-github-": "http://github.com/example_user2",
        "-name-": "Example User 2",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test2@example.com",
          "name": "Example User2"
        }
      ]
    },
    {
      "substitutions": {
        "-github-": "http://github.com/example_user3",
        "-name-": "Example User 3",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test3@example.com",
          "name": "Example User3"
        }
      ]
    }
  ],
  "subject": "Hi -name-!"
}
JSON;

    private $REQUEST_OBJECT_2 = <<<'JSON'
{
  "content": [
    {
      "type": "text/plain",
      "value": "Hello -name-, your github is -github- sent at -time-"
    },
    {
      "type": "text/html",
      "value": "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
    }
  ],
  "from": {
    "email": "test@example.com",
    "name": "Example User"
  },
  "personalizations": [
    {
      "subject": "Subject 1 -name-",
      "substitutions": {
        "-github-": "http://github.com/example_user1",
        "-name-": "Example User 1",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test1@example.com",
          "name": "Example User1"
        }
      ]
    },
    {
      "subject": "Subject 2 -name-",
      "substitutions": {
        "-github-": "http://github.com/example_user2",
        "-name-": "Example User 2",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test2@example.com",
          "name": "Example User2"
        }
      ]
    },
    {
      "substitutions": {
        "-github-": "http://github.com/example_user3",
        "-name-": "Example User 3",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test3@example.com",
          "name": "Example User3"
        }
      ]
    }
  ]
}
JSON;

    private $REQUEST_OBJECT_3 = <<<'JSON'
{
  "content": [
    {
      "type": "text/plain",
      "value": "Hello -name-, your github is -github- sent at -time-"
    },
    {
      "type": "text/html",
      "value": "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
    }
  ],
  "from": {
    "email": "test@example.com",
    "name": "Example User"
  },
  "personalizations": [
    {
      "subject": "Subject 1 -name-",
      "dynamic_template_data": {
        "-github-": "http://github.com/example_user1",
        "-name-": "Example User 1",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test1@example.com",
          "name": "Example User1"
        }
      ]
    },
    {
      "subject": "Subject 2 -name-",
      "dynamic_template_data": {
        "-github-": "http://github.com/example_user2",
        "-name-": "Example User 2",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test2@example.com",
          "name": "Example User2"
        }
      ]
    },
    {
      "dynamic_template_data": {
        "-github-": "http://github.com/example_user3",
        "-name-": "Example User 3",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test3@example.com",
          "name": "Example User3"
        }
      ]
    }
  ],
  "template_id": "d-13b8f94f-bcae-4ec6-b752-70d6cb59f932",
  "subject": "Hi -name-!"
}
JSON;

    private $REQUEST_OBJECT_4 = <<<'JSON'
{
  "content": [
    {
      "type": "text/plain",
      "value": "Hello -name-, your github is -github- sent at -time-"
    },
    {
      "type": "text/html",
      "value": "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
    }
  ],
  "from": {
    "email": "test@example.com",
    "name": "Example User"
  },
  "personalizations": [
    {
      "subject": "Subject 1 -name-",
      "dynamic_template_data": {
        "-github-": "http://github.com/example_user1",
        "-name-": "Example User 1",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test1@example.com",
          "name": "Example User1"
        }
      ]
    },
    {
      "subject": "Subject 2 -name-",
      "dynamic_template_data": {
        "-github-": "http://github.com/example_user2",
        "-name-": "Example User 2",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test2@example.com",
          "name": "Example User2"
        }
      ]
    },
    {
      "dynamic_template_data": {
        "-github-": "http://github.com/example_user3",
        "-name-": "Example User 3",
        "-time-": "2018-05-03 23:10:29"
      },
      "to": [
        {
          "email": "test+test3@example.com",
          "name": "Example User3"
        }
      ]
    }
  ],
  "template_id": "d-13b8f94f-bcae-4ec6-b752-70d6cb59f932"
}
JSON;

    /**
     * Test when we have individual subjects for each Personalization object
     */
    public function testWithIndividualSubjects()
    {
        $from = new From("test@example.com", "Example User");
        $tos = [
            new To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Subject 1 -name-"
            ),
            new To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Subject 2 -name-"
            ),
            new To(
                "test+test3@example.com",
                "Example User3",
                [
                    '-name-' => 'Example User 3',
                    '-github-' => 'http://github.com/example_user3'
                ]
            )
        ];
        $subject = new Subject("Hi -name-!"); // default subject
        $globalSubstitutions = [
            '-time-' => "2018-05-03 23:10:29"
        ];
        $plainTextContent = new PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precedence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        self::assertTrue($isEqual);
    }

    /**
     * Test when we have individual subjects using dynamic templates for each Personalization object
     */
    public function testWithIndividualSubjectsDynamicTemplates()
    {
        $from = new From("test@example.com", "Example User");
        $tos = [
            new To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Subject 1 -name-"
            ),
            new To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Subject 2 -name-"
            ),
            new To(
                "test+test3@example.com",
                "Example User3",
                [
                    '-name-' => 'Example User 3',
                    '-github-' => 'http://github.com/example_user3'
                ]
            )
        ];
        $subject = new Subject("Hi -name-!"); // default subject
        $globalSubstitutions = [
            '-time-' => "2018-05-03 23:10:29"
        ];
        $plainTextContent = new PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precedence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $email->setTemplateId("d-13b8f94f-bcae-4ec6-b752-70d6cb59f932");
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_3);
        self::assertTrue($isEqual);
    }

    /**
     * Test when we pass in an array of subjects
     */
    public function testWithCollectionOfSubjects()
    {
        $from = new From("test@example.com", "Example User");
        $tos = [
            new To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Example User1 -name-"
            ),
            new To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Example User2 -name-"
            ),
            new To(
                "test+test3@example.com",
                "Example User3",
                [
                    '-name-' => 'Example User 3',
                    '-github-' => 'http://github.com/example_user3'
                ]
            )
        ];
        $subject = [
            "Subject 1 -name-",
            "Subject 2 -name-"
        ];
        $globalSubstitutions = [
            '-time-' => "2018-05-03 23:10:29"
        ];
        $plainTextContent = new PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precedence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_2);
        self::assertTrue($isEqual);
    }

    /**
     * Test when we pass in an array of subjects
     */
    public function testWithCollectionOfSubjectsDynamic()
    {
        $from = new From("test@example.com", "Example User");
        $tos = [
            new To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Example User1 -name-"
            ),
            new To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Example User2 -name-"
            ),
            new To(
                "test+test3@example.com",
                "Example User3",
                [
                    '-name-' => 'Example User 3',
                    '-github-' => 'http://github.com/example_user3'
                ]
            )
        ];
        $subject = [
            "Subject 1 -name-",
            "Subject 2 -name-"
        ];
        $globalSubstitutions = [
            '-time-' => "2018-05-03 23:10:29"
        ];
        $plainTextContent = new PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precedence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $email->setTemplateId("d-13b8f94f-bcae-4ec6-b752-70d6cb59f932");
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_4);
        self::assertTrue($isEqual);
    }

    public function testAddTosWithSubjects()
    {
        $expectedPayload = <<<'JSON'
{
  "personalizations": [
    {
      "subject": "Example User1 -name-",
      "to": [
        {
          "email": "test+test1@example.com",
          "name": "Example User1"
        }
      ]
    },
    {
      "subject": "Example User2 -name-",
      "to": [
        {
          "email": "test+test2@example.com",
          "name": "Example User2"
        }
      ]
    }
  ]
}
JSON;

        $tos = [
            new To(
                "test+test1@example.com",
                "Example User1",
                null,
                "Example User1 -name-"
            ),
            new To(
                "test+test2@example.com",
                "Example User2",
                null,
                "Example User2 -name-"
            )
        ];
        $email = new Mail();
        $email->addTos($tos);
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $expectedPayload);
        self::assertTrue($isEqual);
    }
}
