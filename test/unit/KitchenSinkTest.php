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
class KitchenSinkTest extends BaseTestClass
{

    private $REQUEST_OBJECT_DYNAMIC = <<<'JSON'
{
  "asm": {
    "group_id": 1,
    "groups_to_display": [
      1,
      2,
      3,
      4
    ]
  },
  "attachments": [ 
    {
      "content": "YmFzZTY0IGVuY29kZWQgY29udGVudDE=",
      "content_id": "Banner",
      "disposition": "inline",
      "filename": "banner.png",
      "type": "image/png"
    },
    {
      "content": "YmFzZTY0IGVuY29kZWQgY29udGVudDI=",
      "content_id": "Banner 3",
      "disposition": "attachment",
      "filename": "image/jpeg",
      "type": "banner2.jpeg"
    },
    {
      "content": "YmFzZTY0IGVuY29kZWQgY29udGVudDM=",
      "content_id": "Banner 3",
      "disposition": "inline",
      "filename": "image/gif",
      "type": "banner3.gif"
    }
  ],
  "batch_id": "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw",
  "categories": [
    "Category 1",
    "Category 2",
    "Category 3"
  ],
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
  "headers": {
    "X-Day": "Monday",
    "X-Month": "January",
    "X-Year": "2017"
  },
  "ip_pool_name": "23",
  "mail_settings": {
    "bcc": {
      "email": "bcc@example.com",
      "enable": true
    },
    "bypass_list_management": {
      "enable": true
    },
    "footer": {
      "enable": true,
      "html": "<strong>Footer</strong>",
      "text": "Footer"
    },
    "sandbox_mode": {
      "enable": true
    },
    "spam_check": {
      "enable": true,
      "post_to_url": "http://mydomain.com",
      "threshold": 1
    }
  },
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
      "custom_args": {
        "category": "name",
        "marketing1": "false",
        "marketing2": "true",
        "transactional1": "true",
        "transactional2": "false"
      },
      "headers": {
        "X-Test1": "Test1",
        "X-Test2": "Test2",
        "X-Test3": "Test3",
        "X-Test4": "Test4"
      },
      "send_at": 1461775051,
      "dynamic_template_data": {
        "object": {
          "key1": "Key 1",
          "key2": "Key 2"
        },
        "boolean": false,
        "array": [
          "index0",
          "index1"
        ],
        "number": 1
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
  "reply_to": {
    "email": "dx+replyto2@example.com",
    "name": "DX Team Reply To 2"
  },
  "sections": {
    "%section1%": "Substitution for Section 1 Tag",
    "%section3%": "Substitution for Section 3 Tag",
    "%section4%": "Substitution for Section 4 Tag"
  },
  "subject": "Sending with SendGrid is Fun and Global 2",
  "template_id": "d-13b8f94fbcae4ec6b75270d6cb59f932",
  "tracking_settings": {
    "click_tracking": {
      "enable": true,
      "enable_text": true
    },
    "ganalytics": {
      "enable": true,
      "utm_campaign": "utm_campaign",
      "utm_content": "utm_content",
      "utm_medium": "utm_medium",
      "utm_source": "utm_source",
      "utm_term": "utm_term"
    },
    "open_tracking": {
      "enable": true,
      "substitution_tag": "--sub--"
    },
    "subscription_tracking": {
      "enable": true,
      "html": "<bold>subscribe</bold>",
      "substitution_tag": "%%sub%%",
      "text": "subscribe"
    }
  }
}
JSON;

    private $REQUEST_OBJECT = <<<'JSON'
{
  "asm": {
    "group_id": 1,
    "groups_to_display": [
      1,
      2,
      3,
      4
    ]
  },
  "attachments": [ 
    {
      "content": "YmFzZTY0IGVuY29kZWQgY29udGVudDE=",
      "content_id": "Banner",
      "disposition": "inline",
      "filename": "banner.png",
      "type": "image/png"
    },
    {
      "content": "YmFzZTY0IGVuY29kZWQgY29udGVudDI=",
      "content_id": "Banner 3",
      "disposition": "attachment",
      "filename": "image/jpeg",
      "type": "banner2.jpeg"
    },
    {
      "content": "YmFzZTY0IGVuY29kZWQgY29udGVudDM=",
      "content_id": "Banner 3",
      "disposition": "inline",
      "filename": "image/gif",
      "type": "banner3.gif"
    }
  ],
  "batch_id": "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw",
  "categories": [
    "Category 1",
    "Category 2",
    "Category 3"
  ],
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
  "headers": {
    "X-Day": "Monday",
    "X-Month": "January",
    "X-Year": "2017"
  },
  "ip_pool_name": "23",
  "mail_settings": {
    "bcc": {
      "email": "bcc@example.com",
      "enable": true
    },
    "bypass_list_management": {
      "enable": true
    },
    "footer": {
      "enable": true,
      "html": "<strong>Footer</strong>",
      "text": "Footer"
    },
    "sandbox_mode": {
      "enable": true
    },
    "spam_check": {
      "enable": true,
      "post_to_url": "http://mydomain.com",
      "threshold": 1
    }
  },
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
      "custom_args": {
        "category": "name",
        "marketing1": "false",
        "marketing2": "true",
        "transactional1": "true",
        "transactional2": "false"
      },
      "headers": {
        "X-Test1": "Test1",
        "X-Test2": "Test2",
        "X-Test3": "Test3",
        "X-Test4": "Test4"
      },
      "send_at": 1461775051,
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
  "reply_to": {
    "email": "dx+replyto2@example.com",
    "name": "DX Team Reply To 2"
  },
  "sections": {
    "%section1%": "Substitution for Section 1 Tag",
    "%section3%": "Substitution for Section 3 Tag",
    "%section4%": "Substitution for Section 4 Tag"
  },
  "subject": "Sending with SendGrid is Fun and Global 2",
  "template_id": "13b8f94f-bcae-4ec6-b752-70d6cb59f932",
  "tracking_settings": {
    "click_tracking": {
      "enable": true,
      "enable_text": true
    },
    "ganalytics": {
      "enable": true,
      "utm_campaign": "utm_campaign",
      "utm_content": "utm_content",
      "utm_medium": "utm_medium",
      "utm_source": "utm_source",
      "utm_term": "utm_term"
    },
    "open_tracking": {
      "enable": true,
      "substitution_tag": "--sub--"
    },
    "subscription_tracking": {
      "enable": true,
      "html": "<bold>subscribe</bold>",
      "substitution_tag": "%%sub%%",
      "text": "subscribe"
    }
  }
}
JSON;

    /**
     * Test all parameters without using objects
     */
    public function testKitchenSinkExampleWithoutObjects()
    {
        $email = new \SendGrid\Mail\Mail();

        // For a detailed description of each of these settings,
        // please see the
        // [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
        $email->setSubject("Sending with SendGrid is Fun 2");

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

        $email->addHeader("X-Test1", "Test1");
        $email->addHeader("X-Test2", "Test2");
        $headers = [
            "X-Test3" => "Test3",
            "X-Test4" => "Test4",
        ];
        $email->addHeaders($headers);

        $email->addSubstitution("%name1%", "Example Name 1");
        $email->addSubstitution("%city1%", "Denver");
        $substitutions = [
            "%name2%" => "Example Name 2",
            "%city2%" => "Orange"
        ];
        $email->addSubstitutions($substitutions);

        $email->addCustomArg("marketing1", "false");
        $email->addCustomArg("transactional1", "true");
        $email->addCustomArg("category", "name");
        $customArgs = [
            "marketing2" => "true",
            "transactional2" => "false",
            "category" => "name"
        ];
        $email->addCustomArgs($customArgs);

        $email->setSendAt(1461775051);

        // The values below this comment are global to entire message

        $email->setFrom("test@example.com", "DX");

        $email->setGlobalSubject("Sending with SendGrid is Fun and Global 2");

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

        $email->addAttachment(
            "base64 encoded content1",
            "image/png",
            "banner.png",
            "inline",
            "Banner"
        );
        $attachments = [
            [
                "base64 encoded content2",
                "banner2.jpeg",
                "image/jpeg",
                "attachment",
                "Banner 3"
            ],
            [
                "base64 encoded content3",
                "banner3.gif",
                "image/gif",
                "inline",
                "Banner 3"
            ]
        ];
        $email->addAttachments($attachments);

        $email->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");

        $email->addGlobalHeader("X-Day", "Monday");
        $globalHeaders = [
            "X-Month" => "January",
            "X-Year" => "2017"
        ];
        $email->addGlobalHeaders($globalHeaders);

        $email->addSection("%section1%", "Substitution for Section 1 Tag");
        $sections = [
            "%section3%" => "Substitution for Section 3 Tag",
            "%section4%" => "Substitution for Section 4 Tag"
        ];
        $email->addSections($sections);

        $email->addCategory("Category 1");
        $categories = [
            "Category 2",
            "Category 3"
        ];
        $email->addCategories($categories);

        $email->setBatchId(
            "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"
        );

        $email->setReplyTo("dx+replyto2@example.com", "DX Team Reply To 2");

        $email->setAsm(1, [1, 2, 3, 4]);

        $email->setIpPoolName("23");

        // Mail Settings
        $email->setBccSettings(true, "bcc@example.com");
        $email->enableBypassListManagement();
        //$email->disableBypassListManagement();
        $email->setFooter(true, "Footer", "<strong>Footer</strong>");
        $email->enableSandBoxMode();
        //$email->disableSandBoxMode();
        $email->setSpamCheck(true, 1, "http://mydomain.com");

        // Tracking Settings
        $email->setClickTracking(true, true);
        $email->setOpenTracking(true, "--sub--");
        $email->setSubscriptionTracking(
            true,
            "subscribe",
            "<bold>subscribe</bold>",
            "%%sub%%"
        );
        $email->setGanalytics(
            true,
            "utm_source",
            "utm_medium",
            "utm_term",
            "utm_content",
            "utm_campaign"
        );

        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }

    /**
     * Test all parameters without using objects with dynamic templates
     */
    public function testKitchenSinkExampleWithoutObjectsWithDynamicTemplates()
    {
        $email = new \SendGrid\Mail\Mail();

        // For a detailed description of each of these settings,
        // please see the
        // [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
        $email->setSubject("Sending with SendGrid is Fun 2");

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

        $email->addHeader("X-Test1", "Test1");
        $email->addHeader("X-Test2", "Test2");
        $headers = [
            "X-Test3" => "Test3",
            "X-Test4" => "Test4",
        ];
        $email->addHeaders($headers);

        $email->addDynamicTemplateData('object', [
            'key1' => 'Key 1',
            'key2' => 'Key 2',
        ]);
        $email->addDynamicTemplateData('boolean', false);
        $email->addDynamicTemplateData('array', [
            'index0',
            'index1',
        ]);
        $email->addDynamicTemplateData('number', 1);

        $email->addCustomArg("marketing1", "false");
        $email->addCustomArg("transactional1", "true");
        $email->addCustomArg("category", "name");
        $customArgs = [
            "marketing2" => "true",
            "transactional2" => "false",
            "category" => "name"
        ];
        $email->addCustomArgs($customArgs);

        $email->setSendAt(1461775051);

        // The values below this comment are global to entire message

        $email->setFrom("test@example.com", "DX");

        $email->setGlobalSubject("Sending with SendGrid is Fun and Global 2");

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

        $email->addAttachment(
            "base64 encoded content1",
            "image/png",
            "banner.png",
            "inline",
            "Banner"
        );
        $attachments = [
            [
                "base64 encoded content2",
                "banner2.jpeg",
                "image/jpeg",
                "attachment",
                "Banner 3"
            ],
            [
                "base64 encoded content3",
                "banner3.gif",
                "image/gif",
                "inline",
                "Banner 3"
            ]
        ];
        $email->addAttachments($attachments);

        $email->setTemplateId("d-13b8f94fbcae4ec6b75270d6cb59f932");

        $email->addGlobalHeader("X-Day", "Monday");
        $globalHeaders = [
            "X-Month" => "January",
            "X-Year" => "2017"
        ];
        $email->addGlobalHeaders($globalHeaders);

        $email->addSection("%section1%", "Substitution for Section 1 Tag");
        $sections = [
            "%section3%" => "Substitution for Section 3 Tag",
            "%section4%" => "Substitution for Section 4 Tag"
        ];
        $email->addSections($sections);

        $email->addCategory("Category 1");
        $categories = [
            "Category 2",
            "Category 3"
        ];
        $email->addCategories($categories);

        $email->setBatchId(
            "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"
        );

        $email->setReplyTo("dx+replyto2@example.com", "DX Team Reply To 2");

        $email->setAsm(1, [1, 2, 3, 4]);

        $email->setIpPoolName("23");

        // Mail Settings
        $email->setBccSettings(true, "bcc@example.com");
        $email->enableBypassListManagement();
        //$email->disableBypassListManagement();
        $email->setFooter(true, "Footer", "<strong>Footer</strong>");
        $email->enableSandBoxMode();
        //$email->disableSandBoxMode();
        $email->setSpamCheck(true, 1, "http://mydomain.com");

        // Tracking Settings
        $email->setClickTracking(true, true);
        $email->setOpenTracking(true, "--sub--");
        $email->setSubscriptionTracking(
            true,
            "subscribe",
            "<bold>subscribe</bold>",
            "%%sub%%"
        );
        $email->setGanalytics(
            true,
            "utm_source",
            "utm_medium",
            "utm_term",
            "utm_content",
            "utm_campaign"
        );

        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_DYNAMIC);
        $this->assertTrue($isEqual);
    }


    /**
     * Test all parameters using objects
     */
    public function testKitchenSinkExampleWithObjects()
    {
        $email = new \SendGrid\Mail\Mail();

        // For a detailed description of each of these settings,
        // please see the
        // [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
        $email->setSubject(
            new \SendGrid\Mail\Subject("Sending with SendGrid is Fun 2")
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

        $email->addHeader(new \SendGrid\Mail\Header("X-Test1", "Test1"));
        $email->addHeader(new \SendGrid\Mail\Header("X-Test2", "Test2"));
        $headers = [
            new \SendGrid\Mail\Header("X-Test3", "Test3"),
            new \SendGrid\Mail\Header("X-Test4", "Test4")
        ];
        $email->addHeaders($headers);

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

        $email->addCustomArg(new \SendGrid\Mail\CustomArg("marketing1", "false"));
        $email->addCustomArg(new \SendGrid\Mail\CustomArg("transactional1", "true"));
        $email->addCustomArg(new \SendGrid\Mail\CustomArg("category", "name"));
        $customArgs = [
            new \SendGrid\Mail\CustomArg("marketing2", "true"),
            new \SendGrid\Mail\CustomArg("transactional2", "false"),
            new \SendGrid\Mail\CustomArg("category", "name")
        ];
        $email->addCustomArgs($customArgs);

        $email->setSendAt(new \SendGrid\Mail\SendAt(1461775051));

        // The values below this comment are global to entire message

        $email->setFrom(new \SendGrid\Mail\From("test@example.com", "DX"));

        $email->setGlobalSubject(
            new \SendGrid\Mail\Subject("Sending with SendGrid is Fun and Global 2")
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

        $email->addAttachment(
            new \SendGrid\Mail\Attachment(
                "base64 encoded content1",
                "image/png",
                "banner.png",
                "inline",
                "Banner"
            )
        );
        $attachments = [
            new \SendGrid\Mail\Attachment(
                "base64 encoded content2",
                "banner2.jpeg",
                "image/jpeg",
                "attachment",
                "Banner 3"
            ),
            new \SendGrid\Mail\Attachment(
                "base64 encoded content3",
                "banner3.gif",
                "image/gif",
                "inline",
                "Banner 3"
            )
        ];
        $email->addAttachments($attachments);

        $email->setTemplateId(
            new \SendGrid\Mail\TemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932")
        );

        $email->addGlobalHeader(new \SendGrid\Mail\Header("X-Day", "Monday"));
        $globalHeaders = [
            new \SendGrid\Mail\Header("X-Month", "January"),
            new \SendGrid\Mail\Header("X-Year", "2017")
        ];
        $email->addGlobalHeaders($globalHeaders);

        $email->addSection(
            new \SendGrid\Mail\Section(
                "%section1%",
                "Substitution for Section 1 Tag"
            )
        );

        $sections = [
            new \SendGrid\Mail\Section(
                "%section3%",
                "Substitution for Section 3 Tag"
            ),
            new \SendGrid\Mail\Section(
                "%section4%",
                "Substitution for Section 4 Tag"
            )
        ];
        $email->addSections($sections);

        $email->addCategory(new \SendGrid\Mail\Category("Category 1"));
        $categories = [
            new \SendGrid\Mail\Category("Category 2"),
            new \SendGrid\Mail\Category("Category 3")
        ];
        $email->addCategories($categories);

        $email->setBatchId(
            new \SendGrid\Mail\BatchId(
                "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"
            )
        );

        $email->setReplyTo(
            new \SendGrid\Mail\ReplyTo(
                "dx+replyto2@example.com",
                "DX Team Reply To 2"
            )
        );

        $asm = new \SendGrid\Mail\Asm(
            new \SendGrid\Mail\GroupId(1),
            new \SendGrid\Mail\GroupsToDisplay([1, 2, 3, 4])
        );
        $email->setAsm($asm);

        $email->setIpPoolName(new \SendGrid\Mail\IpPoolName("23"));

        $mail_settings = new \SendGrid\Mail\MailSettings();
        $mail_settings->setBccSettings(
            new \SendGrid\Mail\BccSettings(true, "bcc@example.com")
        );
        $mail_settings->setBypassListManagement(
            new \SendGrid\Mail\BypassListManagement(true)
        );
        $mail_settings->setFooter(
            new \SendGrid\Mail\Footer(true, "Footer", "<strong>Footer</strong>")
        );
        $mail_settings->setSandBoxMode(new \SendGrid\Mail\SandBoxMode(true));
        $mail_settings->setSpamCheck(
            new \SendGrid\Mail\SpamCheck(true, 1, "http://mydomain.com")
        );
        $email->setMailSettings($mail_settings);

        $tracking_settings = new \SendGrid\Mail\TrackingSettings();
        $tracking_settings->setClickTracking(
            new \SendGrid\Mail\ClickTracking(true, true)
        );
        $tracking_settings->setOpenTracking(
            new \SendGrid\Mail\OpenTracking(true, "--sub--")
        );
        $tracking_settings->setSubscriptionTracking(
            new \SendGrid\Mail\SubscriptionTracking(
                true,
                "subscribe",
                "<bold>subscribe</bold>",
                "%%sub%%"
            )
        );
        $tracking_settings->setGanalytics(
            new \SendGrid\Mail\Ganalytics(
                true,
                "utm_source",
                "utm_medium",
                "utm_term",
                "utm_content",
                "utm_campaign"
            )
        );
        $email->setTrackingSettings($tracking_settings);

        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT);
        $this->assertTrue($isEqual);
    }

    /**
     * Test all parameters using objects with dynamic templates
     */
    public function testKitchenSinkExampleWithObjectsWithDynamicTemplate()
    {
        $email = new \SendGrid\Mail\Mail();

        // For a detailed description of each of these settings,
        // please see the
        // [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
        $email->setSubject(
            new \SendGrid\Mail\Subject("Sending with SendGrid is Fun 2")
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

        $email->addHeader(new \SendGrid\Mail\Header("X-Test1", "Test1"));
        $email->addHeader(new \SendGrid\Mail\Header("X-Test2", "Test2"));
        $headers = [
            new \SendGrid\Mail\Header("X-Test3", "Test3"),
            new \SendGrid\Mail\Header("X-Test4", "Test4")
        ];
        $email->addHeaders($headers);

        $email->addDynamicTemplateData(
            new \SendGrid\Mail\Substitution('object', [
                'key1' => 'Key 1',
                'key2' => 'Key 2',
            ])
        );
        $email->addDynamicTemplateData(
            new \SendGrid\Mail\Substitution('boolean', false)
        );
        $email->addDynamicTemplateDatas([
            new \SendGrid\Mail\Substitution('array', [
                'index0',
                'index1',
            ]),
            new \SendGrid\Mail\Substitution('number', 1),
        ]);

        $email->addCustomArg(new \SendGrid\Mail\CustomArg("marketing1", "false"));
        $email->addCustomArg(new \SendGrid\Mail\CustomArg("transactional1", "true"));
        $email->addCustomArg(new \SendGrid\Mail\CustomArg("category", "name"));
        $customArgs = [
            new \SendGrid\Mail\CustomArg("marketing2", "true"),
            new \SendGrid\Mail\CustomArg("transactional2", "false"),
            new \SendGrid\Mail\CustomArg("category", "name")
        ];
        $email->addCustomArgs($customArgs);

        $email->setSendAt(new \SendGrid\Mail\SendAt(1461775051));

        // The values below this comment are global to entire message

        $email->setFrom(new \SendGrid\Mail\From("test@example.com", "DX"));

        $email->setGlobalSubject(
            new \SendGrid\Mail\Subject("Sending with SendGrid is Fun and Global 2")
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

        $email->addAttachment(
            new \SendGrid\Mail\Attachment(
                "base64 encoded content1",
                "image/png",
                "banner.png",
                "inline",
                "Banner"
            )
        );
        $attachments = [
            new \SendGrid\Mail\Attachment(
                "base64 encoded content2",
                "banner2.jpeg",
                "image/jpeg",
                "attachment",
                "Banner 3"
            ),
            new \SendGrid\Mail\Attachment(
                "base64 encoded content3",
                "banner3.gif",
                "image/gif",
                "inline",
                "Banner 3"
            )
        ];
        $email->addAttachments($attachments);

        $email->setTemplateId(
            new \SendGrid\Mail\TemplateId("d-13b8f94fbcae4ec6b75270d6cb59f932")
        );

        $email->addGlobalHeader(new \SendGrid\Mail\Header("X-Day", "Monday"));
        $globalHeaders = [
            new \SendGrid\Mail\Header("X-Month", "January"),
            new \SendGrid\Mail\Header("X-Year", "2017")
        ];
        $email->addGlobalHeaders($globalHeaders);

        $email->addSection(
            new \SendGrid\Mail\Section(
                "%section1%",
                "Substitution for Section 1 Tag"
            )
        );

        $sections = [
            new \SendGrid\Mail\Section(
                "%section3%",
                "Substitution for Section 3 Tag"
            ),
            new \SendGrid\Mail\Section(
                "%section4%",
                "Substitution for Section 4 Tag"
            )
        ];
        $email->addSections($sections);

        $email->addCategory(new \SendGrid\Mail\Category("Category 1"));
        $categories = [
            new \SendGrid\Mail\Category("Category 2"),
            new \SendGrid\Mail\Category("Category 3")
        ];
        $email->addCategories($categories);

        $email->setBatchId(
            new \SendGrid\Mail\BatchId(
                "MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"
            )
        );

        $email->setReplyTo(
            new \SendGrid\Mail\ReplyTo(
                "dx+replyto2@example.com",
                "DX Team Reply To 2"
            )
        );

        $asm = new \SendGrid\Mail\Asm(
            new \SendGrid\Mail\GroupId(1),
            new \SendGrid\Mail\GroupsToDisplay([1, 2, 3, 4])
        );
        $email->setAsm($asm);

        $email->setIpPoolName(new \SendGrid\Mail\IpPoolName("23"));

        $mail_settings = new \SendGrid\Mail\MailSettings();
        $mail_settings->setBccSettings(
            new \SendGrid\Mail\BccSettings(true, "bcc@example.com")
        );
        $mail_settings->setBypassListManagement(
            new \SendGrid\Mail\BypassListManagement(true)
        );
        $mail_settings->setFooter(
            new \SendGrid\Mail\Footer(true, "Footer", "<strong>Footer</strong>")
        );
        $mail_settings->setSandBoxMode(new \SendGrid\Mail\SandBoxMode(true));
        $mail_settings->setSpamCheck(
            new \SendGrid\Mail\SpamCheck(true, 1, "http://mydomain.com")
        );
        $email->setMailSettings($mail_settings);

        $tracking_settings = new \SendGrid\Mail\TrackingSettings();
        $tracking_settings->setClickTracking(
            new \SendGrid\Mail\ClickTracking(true, true)
        );
        $tracking_settings->setOpenTracking(
            new \SendGrid\Mail\OpenTracking(true, "--sub--")
        );
        $tracking_settings->setSubscriptionTracking(
            new \SendGrid\Mail\SubscriptionTracking(
                true,
                "subscribe",
                "<bold>subscribe</bold>",
                "%%sub%%"
            )
        );
        $tracking_settings->setGanalytics(
            new \SendGrid\Mail\Ganalytics(
                true,
                "utm_source",
                "utm_medium",
                "utm_term",
                "utm_content",
                "utm_campaign"
            )
        );
        $email->setTrackingSettings($tracking_settings);

        $json = json_encode($email->jsonSerialize());
        $isEqual = BaseTestClass::compareJSONObjects($json, $this->REQUEST_OBJECT_DYNAMIC);
        $this->assertTrue($isEqual);
    }
}