<?php
/**
 * This file tests the request object generation for a /mail/send API call
 *
 * PHP Version - 5.6, 7.0, 7.1, 7.2
 *
 * @package   SendGrid\Tests
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2018 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */

namespace SendGrid\Tests;

/**
 * This class tests the request object generation for a /mail/send API call
 *
 * @package SendGrid\Tests
 */
class MultipleEmailToMulipleRecipientsTest extends BaseTestClass
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
        $from = new \SendGrid\Mail\From("test@example.com", "Example User");
        $tos = [
            new \SendGrid\Mail\To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Subject 1 -name-"
            ),
            new \SendGrid\Mail\To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Subject 2 -name-"
            ),
            new \SendGrid\Mail\To(
                "test+test3@example.com",
                "Example User3",
                [
                    '-name-' => 'Example User 3',
                    '-github-' => 'http://github.com/example_user3'
                ]
            )
        ];
        $subject = new \SendGrid\Mail\Subject("Hi -name-!"); // default subject
        $globalSubstitutions = [
            '-time-' => "2018-05-03 23:10:29"
        ];
        $plainTextContent = new \SendGrid\Mail\PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new \SendGrid\Mail\HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new \SendGrid\Mail\Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precendence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }

    /**
     * Test when we have individual subjects using dynamic templates for each Personalization object
     */ 
    public function testWithIndividualSubjectsDynamicTemplates()
    {
        $from = new \SendGrid\Mail\From("test@example.com", "Example User");
        $tos = [
            new \SendGrid\Mail\To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Subject 1 -name-"
            ),
            new \SendGrid\Mail\To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Subject 2 -name-"
            ),
            new \SendGrid\Mail\To(
                "test+test3@example.com",
                "Example User3",
                [
                    '-name-' => 'Example User 3',
                    '-github-' => 'http://github.com/example_user3'
                ]
            )
        ];
        $subject = new \SendGrid\Mail\Subject("Hi -name-!"); // default subject
        $globalSubstitutions = [
            '-time-' => "2018-05-03 23:10:29"
        ];
        $plainTextContent = new \SendGrid\Mail\PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new \SendGrid\Mail\HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new \SendGrid\Mail\Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precendence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $email->setTemplateId("d-13b8f94f-bcae-4ec6-b752-70d6cb59f932");
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_3);
        $this->assertTrue($isEqual);
    }

    /**
     * Test when we pass in an array of subjects
     *
     * @expectedException \SendGrid\Mail\TypeException
     */ 
    public function testWithCollectionOfSubjects()
    {
        $from = new \SendGrid\Mail\From("test@example.com", "Example User");
        $tos = [
            new \SendGrid\Mail\To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Example User1 -name-"
            ),
            new \SendGrid\Mail\To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Example User2 -name-"
            ),
            new \SendGrid\Mail\To(
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
        $plainTextContent = new \SendGrid\Mail\PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new \SendGrid\Mail\HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new \SendGrid\Mail\Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precendence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_2);
        $this->assertTrue($isEqual);
    }

    /**
     * Test when we pass in an array of subjects
     *
     * @expectedException \SendGrid\Mail\TypeException
     */ 
    public function testWithCollectionOfSubjectsDynamic()
    {
        $from = new \SendGrid\Mail\From("test@example.com", "Example User");
        $tos = [
            new \SendGrid\Mail\To(
                "test+test1@example.com",
                "Example User1",
                [
                    '-name-' => 'Example User 1',
                    '-github-' => 'http://github.com/example_user1'
                ],
                "Example User1 -name-"
            ),
            new \SendGrid\Mail\To(
                "test+test2@example.com",
                "Example User2",
                [
                    '-name-' => 'Example User 2',
                    '-github-' => 'http://github.com/example_user2'
                ],
                "Example User2 -name-"
            ),
            new \SendGrid\Mail\To(
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
        $plainTextContent = new \SendGrid\Mail\PlainTextContent(
            "Hello -name-, your github is -github- sent at -time-"
        );
        $htmlContent = new \SendGrid\Mail\HtmlContent(
            "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
        );
        $email = new \SendGrid\Mail\Mail(
            $from,
            $tos,
            $subject, // or array of subjects, these take precendence
            $plainTextContent,
            $htmlContent,
            $globalSubstitutions
        );
        $email->setTemplateId("d-13b8f94f-bcae-4ec6-b752-70d6cb59f932");
        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_2);
        $this->assertTrue($isEqual);
    }

}
