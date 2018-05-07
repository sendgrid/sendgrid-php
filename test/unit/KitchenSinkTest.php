<?php

namespace SendGrid\Tests;

use SendGrid\Tests\BaseTestClass;

class KitchenSinkTest extends BaseTestClass
{
    // public function testKitchenSinkExampleWithoutObjects()
    // {
    //     $email = new Mail();

    //     // For a detailed description of each of these settings, please see the [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
    //     $email->setSubject("Sending with SendGrid is Fun 2");
    
    //     $email->addTo("test@example.com", "Example User");
    //     $email->addTo("test+1@example.com", "Example User1");
    //     $toEmails = [
    //         "test+2@example.com" => "Example User2",
    //         "test+3@example.com" => "Example User3"
    //     ];
    //     $email->addTos($toEmails);
    
    //     $email->addCc("test+4@example.com", "Example User4");
    //     $ccEmails = [
    //         "test+5@example.com" => "Example User5",
    //         "test+6@example.com" => "Example User6"
    //     ];
    //     $email->addCcs($ccEmails);
    
    //     $email->addBcc("test+7@example.com", "Example User7");
    //     $bccEmails = [
    //         "test+8@example.com" => "Example User8",
    //         "test+9@example.com" => "Example User9"
    //     ];
    //     $email->addBccs($bccEmails);
   
    //     $email->addHeader("X-Test1", "Test1");
    //     $email->addHeader("X-Test2", "Test2");
    //     $headers = [
    //         "X-Test3" => "Test3",
    //         "X-Test4" => "Test4",
    //     ];
    //     $email->addHeaders($headers);
     
    //     $email->addSubstitution("%name1%", "Example Name 1");
    //     $email->addSubstitution("%city1%", "Denver");
    //     $substitutions = [
    //         "%name2%" => "Example Name 2",
    //         "%city2%" => "Orange"
    //     ];
    //     $email->addSubstitutions($substitutions);

    //     $email->addCustomArg("marketing1", "false");
    //     $email->addCustomArg("transactional1", "true");
    //     $email->addCustomArg("category", "name");
    //     $customArgs = [
    //         "marketing2" => "true",
    //         "transactional2" => "false",
    //         "category" => "name"
    //     ];
    //     $email->addCustomArgs($customArgs);

    //     $email->setSendAt(1461775051);

    //     // The values below this comment are global to entire message

    //     $email->setFrom("test@example.com", "DX");

    //     $email->setGlobalSubject("Sending with SendGrid is Fun and Global 2");

    //     $email->addContent(MimeType::Text, "and easy to do anywhere, even with PHP");
    //     $email->addContent(MimeType::Html, "<strong>and easy to do anywhere, even with PHP</strong>");
    //     $contents = [
    //         "text/calendar" => "Party Time!!",
    //         "text/calendar2" => "Party Time 2!!"
    //     ];
    //     $email->addContents($contents);

    //     $email->addAttachment(
    //         "base64 encoded content1",
    //         "image/png",
    //         "banner.png",
    //         "inline",
    //         "Banner"
    //     );
    //     $attachments = [
    //         [   
    //             "base64 encoded content2",
    //             "banner2.jpeg",
    //             "image/jpeg",
    //             "attachment",
    //             "Banner 3"
    //         ],
    //         [
    //             "base64 encoded content3",
    //             "banner3.gif",
    //             "image/gif",
    //             "inline",
    //             "Banner 3"
    //         ]
    //     ];
    //     $email->addAttachments($attachments);

    //     $email->setTemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932");

    //     $email->addGlobalHeader("X-Day", "Monday");
    //     $globalHeaders = [
    //         "X-Month" => "January",
    //         "X-Year" => "2017"
    //     ];
    //     $email->addGlobalHeaders($globalHeaders);

    //     $email->addSection("%section1%", "Substitution for Section 1 Tag");
    //     $sections = [
    //         "%section3%" => "Substitution for Section 3 Tag",
    //         "%section4%" => "Substitution for Section 4 Tag"
    //     ];
    //     $email->addSections($sections);

    //     $email->addCategory("Category 1");
    //     $categories = [
    //         "Category 2",
    //         "Category 3"
    //     ];
    //     $email->addCategories($categories);

    //     $email->setBatchId("MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw");

    //     $email->setReplyTo("dx+replyto2@example.com", "DX Team Reply To 2");

    //     $email->setAsm(1, [1, 2, 3, 4]);

    //     $email->setIpPoolName("23");

    //     $mail_settings = new MailSettings();
    //     $mail_settings->setBccSettings(true, "bcc@example.com");
    //     $mail_settings->setBypassListManagement(true);
    //     $mail_settings->setFooter(true, "Footer", "<strong>Footer</strong>");
    //     $mail_settings->setSandBoxMode(true);
    //     $mail_settings->setSpamCheck(true, 1, "http://mydomain.com");
    //     $email->setMailSettings($mail_settings);

    //     $tracking_settings = new TrackingSettings();
    //     $tracking_settings->setClickTracking(true, true);
    //     $tracking_settings->setOpenTracking(true, "--sub--");
    //     $tracking_settings->setSubscriptionTracking(true, "subscribe", "<bold>subscribe</bold>", "%%sub%%");
    //     $tracking_settings->setGanalytics(true, "utm_source", "utm_medium", "utm_term", "utm_content", "utm_campaign");
    //     $email->setTrackingSettings($tracking_settings);

    //     $json = json_encode($email->jsonSerialize());

    //     $this->assertEquals($json, '{"personalizations":[{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User1","email":"test+1@example.com"},{"name":"Example User2","email":"test+2@example.com"},{"name":"Example User3","email":"test+3@example.com"}],"cc":[{"name":"Example User4","email":"test+4@example.com"},{"name":"Example User5","email":"test+5@example.com"},{"name":"Example User6","email":"test+6@example.com"}],"bcc":[{"name":"Example User7","email":"test+7@example.com"},{"name":"Example User8","email":"test+8@example.com"},{"name":"Example User9","email":"test+9@example.com"}],"subject":"Sending with SendGrid is Fun 2","headers":{"X-Test1":"Test1","X-Test2":"Test2","X-Test3":"Test3","X-Test4":"Test4"},"substitutions":{"%name1%":"Example Name 1","%city1%":"Denver","%name2%":"Example Name 2","%city2%":"Orange"},"custom_args":{"marketing1":"false","transactional1":"true","category":"name","marketing2":"true","transactional2":"false"},"send_at":1461775051}],"from":{"name":"DX","email":"test@example.com"},"reply_to":{"name":"DX Team Reply To 2","email":"dx+replyto2@example.com"},"subject":"Sending with SendGrid is Fun and Global 2","content":[{"type":"text\/plain","value":"and easy to do anywhere, even with PHP"},{"type":"text\/html","value":"<strong>and easy to do anywhere, even with PHP<\/strong>"},{"type":"text\/calendar","value":"Party Time!!"},{"type":"text\/calendar2","value":"Party Time 2!!"}],"attachments":[{"content":"base64 encoded content1","type":"image\/png","filename":"banner.png","disposition":"inline","content_id":"Banner"},{"content":"base64 encoded content2","type":"banner2.jpeg","filename":"image\/jpeg","disposition":"attachment","content_id":"Banner 3"},{"content":"base64 encoded content3","type":"banner3.gif","filename":"image\/gif","disposition":"inline","content_id":"Banner 3"}],"template_id":"13b8f94f-bcae-4ec6-b752-70d6cb59f932","sections":{"%section1%":"Substitution for Section 1 Tag","%section3%":"Substitution for Section 3 Tag","%section4%":"Substitution for Section 4 Tag"},"headers":{"X-Day":"Monday","X-Month":"January","X-Year":"2017"},"categories":["Category 1","Category 2","Category 3"],"batch_id":"MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw","asm":{"group_id":1,"groups_to_display":[[1,2,3,4]]},"ip_pool_name":"23","mail_settings":{"bcc":{"enable":true,"email":"bcc@example.com"},"bypass_list_management":{"enable":true},"footer":{"enable":true,"text":"Footer","html":"<strong>Footer<\/strong>"},"sandbox_mode":{"enable":true},"spam_check":{"enable":true,"threshold":1,"post_to_url":"http:\/\/mydomain.com"}},"tracking_settings":{"click_tracking":{"enable":true,"enable_text":true},"open_tracking":{"enable":true,"substitution_tag":"--sub--"},"subscription_tracking":{"enable":true,"text":"subscribe","html":"<bold>subscribe<\/bold>","substitution_tag":"%%sub%%"},"ganalytics":{"enable":true,"utm_source":"utm_source","utm_medium":"utm_medium","utm_term":"utm_term","utm_content":"utm_content","utm_campaign":"utm_campaign"}}}');
    // }

    // public function testKitchenSinkExampleWithObjects()
    // {
    //     $email = new Mail();

    //     // For a detailed description of each of these settings, please see the [documentation](https://sendgrid.com/docs/API_Reference/api_v3.html).
    //     $email->setSubject(new Subject("Sending with SendGrid is Fun 2"));

    //     $email->addTo(new To("test@example.com", "Example User"));
    //     $email->addTo(new To("test+1@example.com", "Example User1"));
    //     $toEmails = [ 
    //         new To("test+2@example.com", "Example User2"),
    //         new To("test+3@example.com", "Example User3")
    //     ];
    //     $email->addTos($toEmails);

    //     $email->addCc(new Cc("test+4@example.com", "Example User4"));
    //     $ccEmails = [ 
    //         new Cc("test+5@example.com", "Example User5"),
    //         new Cc("test+6@example.com", "Example User6")
    //     ];
    //     $email->addCcs($ccEmails);
 
    //     $email->addBcc(new Bcc("test+7@example.com", "Example User7"));
    //     $bccEmails = [ 
    //         new Bcc("test+8@example.com", "Example User8"),
    //         new Bcc("test+9@example.com", "Example User9")
    //     ];
    //     $email->addBccs($bccEmails);

    //     $email->addHeader(new Header("X-Test1", "Test1"));
    //     $email->addHeader(new Header("X-Test2", "Test2"));
    //     $headers = [
    //         new Header("X-Test3", "Test3"),
    //         new Header("X-Test4", "Test4")
    //     ];
    //     $email->addHeaders($headers);

    //     $email->addSubstitution(new Substitution("%name1%", "Example Name 1"));
    //     $email->addSubstitution(new Substitution("%city1%", "Denver"));
    //     $substitutions = [
    //         new Substitution("%name2%", "Example Name 2"),
    //         new Substitution("%city2%", "Orange")
    //     ];
    //     $email->addSubstitutions($substitutions);

    //     $email->addCustomArg(new CustomArg("marketing1", "false"));
    //     $email->addCustomArg(new CustomArg("transactional1", "true"));
    //     $email->addCustomArg(new CustomArg("category", "name"));
    //     $customArgs = [
    //         new CustomArg("marketing2", "true"),
    //         new CustomArg("transactional2", "false"),
    //         new CustomArg("category", "name")
    //     ];
    //     $email->addCustomArgs($customArgs);

    //     $email->setSendAt(new SendAt(1461775051));

    //     // The values below this comment are global to entire message

    //     $email->setFrom(new From("test@example.com", "DX"));

    //     $email->setGlobalSubject(new Subject("Sending with SendGrid is Fun and Global 2"));

    //     $plainTextContent = new PlainTextContent(
    //         "and easy to do anywhere, even with PHP"
    //     );
    //     $htmlContent = new HtmlContent(
    //         "<strong>and easy to do anywhere, even with PHP</strong>"
    //     );
    //     $email->addContent($plainTextContent);
    //     $email->addContent($htmlContent);
    //     $contents = [
    //         new Content("text/calendar", "Party Time!!"),
    //         new Content("text/calendar2", "Party Time 2!!")
    //     ];
    //     $email->addContents($contents);

    //     $email->addAttachment(
    //         new Attachment(
    //             "base64 encoded content1",
    //             "image/png",
    //             "banner.png",
    //             "inline",
    //             "Banner"
    //         )
    //     );
    //     $attachments = [
    //         new Attachment(
    //             "base64 encoded content2",
    //             "banner2.jpeg",
    //             "image/jpeg",
    //             "attachment",
    //             "Banner 3"
    //         ),
    //         new Attachment(
    //             "base64 encoded content3",
    //             "banner3.gif",
    //             "image/gif",
    //             "inline",
    //             "Banner 3"
    //         )
    //     ];
    //     $email->addAttachments($attachments);

    //     $email->setTemplateId(new TemplateId("13b8f94f-bcae-4ec6-b752-70d6cb59f932"));

    //     $email->addGlobalHeader(new Header("X-Day", "Monday"));
    //     $globalHeaders = [
    //         new Header("X-Month", "January"),
    //         new Header("X-Year", "2017")
    //     ];
    //     $email->addGlobalHeaders($globalHeaders);

    //     $email->addSection(new Section("%section1%", "Substitution for Section 1 Tag"));

    //     $sections = [
    //         new Section("%section3%", "Substitution for Section 3 Tag"),
    //         new Section("%section4%", "Substitution for Section 4 Tag")
    //     ];
    //     $email->addSections($sections);

    //     $email->addCategory(new Category("Category 1"));
    //     $categories = [
    //         new Category("Category 2"),
    //         new Category("Category 3")
    //     ];
    //     $email->addCategories($categories);

    //     $email->setBatchId(new BatchId("MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw"));

    //     $email->setReplyTo(new ReplyTo("dx+replyto2@example.com", "DX Team Reply To 2"));

    //     $asm = new Asm(
    //         new GroupId(1),
    //         new GroupsToDisplay([1,2,3,4])
    //     );
    //     $email->setAsm($asm);

    //     $email->setIpPoolName(new IpPoolName("23"));

    //     $mail_settings = new MailSettings();
    //     $mail_settings->setBccSettings(new BccSettings(true, "bcc@example.com"));
    //     $mail_settings->setBypassListManagement(new BypassListManagement(true));
    //     $mail_settings->setFooter(new Footer(true, "Footer", "<strong>Footer</strong>"));
    //     $mail_settings->setSandBoxMode(new SandBoxMode(true));
    //     $mail_settings->setSpamCheck(new SpamCheck(true, 1, "http://mydomain.com"));
    //     $email->setMailSettings($mail_settings);

    //     $tracking_settings = new TrackingSettings();
    //     $tracking_settings->setClickTracking(new ClickTracking(true, true));
    //     $tracking_settings->setOpenTracking(new OpenTracking(true, "--sub--"));
    //     $tracking_settings->setSubscriptionTracking(new SubscriptionTracking(true, "subscribe", "<bold>subscribe</bold>", "%%sub%%"));
    //     $tracking_settings->setGanalytics(new Ganalytics(true, "utm_source", "utm_medium", "utm_term", "utm_content", "utm_campaign"));
    //     $email->setTrackingSettings($tracking_settings);

    //     $json = json_encode($email->jsonSerialize());

    //     $this->assertEquals($json, '{"personalizations":[{"to":[{"name":"Example User","email":"test@example.com"},{"name":"Example User1","email":"test+1@example.com"},{"name":"Example User2","email":"test+2@example.com"},{"name":"Example User3","email":"test+3@example.com"}],"cc":[{"name":"Example User4","email":"test+4@example.com"},{"name":"Example User5","email":"test+5@example.com"},{"name":"Example User6","email":"test+6@example.com"}],"bcc":[{"name":"Example User7","email":"test+7@example.com"},{"name":"Example User8","email":"test+8@example.com"},{"name":"Example User9","email":"test+9@example.com"}],"subject":"Sending with SendGrid is Fun 2","headers":{"X-Test1":"Test1","X-Test2":"Test2","X-Test3":"Test3","X-Test4":"Test4"},"substitutions":{"%name1%":"Example Name 1","%city1%":"Denver","%name2%":"Example Name 2","%city2%":"Orange"},"custom_args":{"marketing1":"false","transactional1":"true","category":"name","marketing2":"true","transactional2":"false"},"send_at":1461775051}],"from":{"name":"DX","email":"test@example.com"},"reply_to":{"name":"DX Team Reply To 2","email":"dx+replyto2@example.com"},"subject":"Sending with SendGrid is Fun and Global 2","content":[{"type":"text\/plain","value":"and easy to do anywhere, even with PHP"},{"type":"text\/html","value":"<strong>and easy to do anywhere, even with PHP<\/strong>"},{"type":"text\/calendar","value":"Party Time!!"},{"type":"text\/calendar2","value":"Party Time 2!!"}],"attachments":[{"content":"base64 encoded content1","type":"image\/png","filename":"banner.png","disposition":"inline","content_id":"Banner"},{"content":"base64 encoded content2","type":"banner2.jpeg","filename":"image\/jpeg","disposition":"attachment","content_id":"Banner 3"},{"content":"base64 encoded content3","type":"banner3.gif","filename":"image\/gif","disposition":"inline","content_id":"Banner 3"}],"template_id":"13b8f94f-bcae-4ec6-b752-70d6cb59f932","sections":{"%section1%":"Substitution for Section 1 Tag","%section3%":"Substitution for Section 3 Tag","%section4%":"Substitution for Section 4 Tag"},"headers":{"X-Day":"Monday","X-Month":"January","X-Year":"2017"},"categories":["Category 1","Category 2","Category 3"],"batch_id":"MWQxZmIyODYtNjE1Ni0xMWU1LWI3ZTUtMDgwMDI3OGJkMmY2LWEzMmViMjYxMw","asm":{"group_id":1,"groups_to_display":[[1,2,3,4]]},"ip_pool_name":"23","mail_settings":{"bcc":{"enable":true,"email":"bcc@example.com"},"bypass_list_management":{"enable":true},"footer":{"enable":true,"text":"Footer","html":"<strong>Footer<\/strong>"},"sandbox_mode":{"enable":true},"spam_check":{"enable":true,"threshold":1,"post_to_url":"http:\/\/mydomain.com"}},"tracking_settings":{"click_tracking":{"enable":true,"enable_text":true},"open_tracking":{"enable":true,"substitution_tag":"--sub--"},"subscription_tracking":{"enable":true,"text":"subscribe","html":"<bold>subscribe<\/bold>","substitution_tag":"%%sub%%"},"ganalytics":{"enable":true,"utm_source":"utm_source","utm_medium":"utm_medium","utm_term":"utm_term","utm_content":"utm_content","utm_campaign":"utm_campaign"}}}');
    // }
}