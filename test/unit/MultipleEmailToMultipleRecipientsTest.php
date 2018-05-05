<?php

namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;



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
}
