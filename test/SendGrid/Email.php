<?php 

class SendGridTest_Email extends PHPUnit_Framework_TestCase {
  
  public function testConstructionEmail() {
    $email = new SendGrid\Email();
    $this->assertEquals(get_class($email), "SendGrid\Email");
  }

  public function testConstructionEmailIsSendGridEmail() {
    $email = new SendGrid\Email();
    $this->assertEquals(get_class($email), "SendGrid\Email");
  }

  public function testAddToWithDeprectedEmailClass() {
    $mail = new SendGrid\Email();

    $mail->addTo('p1@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com'), $mail->smtpapi->to);

    $mail->addTo('p2@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com', 'p2@mailinator.com'), $mail->smtpapi->to);
  }

  public function testAddTo() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com'), $email->smtpapi->to);

    $email->addTo('p2@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com', 'p2@mailinator.com'), $email->smtpapi->to);
  }

  public function testAddToWithName() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com', 'Person One');
    $this->assertEquals(array('Person One <p1@mailinator.com>'), $email->smtpapi->to);

    $email->addTo('p2@mailinator.com');
    $this->assertEquals(array('Person One <p1@mailinator.com>', 'p2@mailinator.com'), $email->smtpapi->to);
  }

  public function testSetTo() {
    $email = new SendGrid\Email();

    $email->setTos(array('p1@mailinator.com'));
    $this->assertEquals(array('p1@mailinator.com'), $email->smtpapi->to);
  }

  public function testSetTos() {
    $email = new SendGrid\Email();

    $email->setTos(array('p1@mailinator.com'));
    $this->assertEquals(array('p1@mailinator.com'), $email->smtpapi->to);
  }

  public function testRemoveTo() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com'), $email->smtpapi->to);
  }

  public function testSetFrom() {
    $email = new SendGrid\Email();

    $email->setFrom("foo@bar.com");
    $email->setFromName("John Doe");

    $this->assertEquals("foo@bar.com", $email->getFrom());
    $this->assertEquals(array("foo@bar.com" => "John Doe"), $email->getFrom(true));
  }

  public function testSetFromName() {
    $email = new SendGrid\Email();

    $this->assertFalse($email->getFromName());
    $email->setFromName("Swift");
    $this->assertEquals("Swift", $email->getFromName());
  }

  public function testSetReplyTo() {
    $email = new SendGrid\Email();

    $this->assertFalse($email->getReplyTo());
    $email->setReplyTo("swift@sendgrid.com");
    $this->assertEquals("swift@sendgrid.com", $email->getReplyTo());
  }

  public function testSetCc() {
    $email = new SendGrid\Email();

    $email->setCc('p1@mailinator.com');
    $email->setCc('p2@mailinator.com');

    $this->assertEquals(1, count($email->getCcs()));
    $cc_list = $email->getCcs();
    $this->assertEquals('p2@mailinator.com', $cc_list[0]);
  }

  public function testSetCcs() {
    $email = new SendGrid\Email();

    $email->setCcs(array('raz@mailinator.com', 'ber@mailinator.com'));

    $this->assertEquals(2, count($email->getCcs()));

    $cc_list = $email->getCcs();

    $this->assertEquals('raz@mailinator.com', $cc_list[0]);
    $this->assertEquals('ber@mailinator.com', $cc_list[1]);
  }

  public function testAddCc() {
    $email = new SendGrid\Email();

    $email->addCc('foo');
    $email->addCc('raz');

    $this->assertEquals(2, count($email->getCcs()));

    $cc_list = $email->getCcs();

    $this->assertEquals('foo', $cc_list[0]);
    $this->assertEquals('raz', $cc_list[1]);

    // removeTo removes all occurences of data
    $email->removeCc('raz');

    $this->assertEquals(1, count($email->getCcs()));

    $cc_list = $email->getCcs();

    $this->assertEquals('foo', $cc_list[0]);
  }

  public function testSetBcc() {
    $email = new SendGrid\Email();

    $email->setBcc('bar');
    $email->setBcc('foo');
    $this->assertEquals(1, count($email->getBccs()));

    $bcc_list = $email->getBccs();
    $this->assertEquals('foo', $bcc_list[0]);
  }

  public function testSetBccs() {
    $email = new SendGrid\Email();

    $email->setBccs(array('raz', 'ber'));
    $this->assertEquals(2, count($email->getBccs()));

    $bcc_list = $email->getBccs();
    $this->assertEquals('raz', $bcc_list[0]);
    $this->assertEquals('ber', $bcc_list[1]);
  }

  public function testAddBcc() {
    $email = new SendGrid\Email();

    $email->addBcc('foo');
    $email->addBcc('raz');
    $this->assertEquals(2, count($email->getBccs()));

    $bcc_list = $email->getBccs();
    $this->assertEquals('foo', $bcc_list[0]);
    $this->assertEquals('raz', $bcc_list[1]);

    $email->removeBcc('raz');

    $this->assertEquals(1, count($email->getBccs()));
    $bcc_list = $email->getBccs();
    $this->assertEquals('foo', $bcc_list[0]);
  }

  public function testSetSubject() {
    $email = new SendGrid\Email();

    $email->setSubject("Test Subject");
    $this->assertEquals("Test Subject", $email->getSubject());
  }
  
  public function testSetDate() {
    $email = new SendGrid\Email();

    date_default_timezone_set('America/Los_Angeles');
    $date = date('r');
    $email->setDate($date);
    $this->assertEquals($date, $email->getDate());
  }
  
  public function testSetSendAt() {
    $email = new SendGrid\Email();
    
    $email->setSendAt(1409348513);
    $this->assertEquals("{\"send_at\":1409348513}", $email->smtpapi->jsonString());
  }
  
  public function testSetSendEachAt() {
    $email = new SendGrid\Email();
    
    $email->setSendEachAt(array(1409348513, 1409348514, 1409348515));
    $this->assertEquals("{\"send_each_at\":[1409348513,1409348514,1409348515]}", $email->smtpapi->jsonString());
  }
  
  public function testAddSendEachAt() {
    $email = new SendGrid\Email();
    $email->addSendEachAt(1409348513);
    $email->addSendEachAt(1409348514);
    $email->addSendEachAt(1409348515);
    $this->assertEquals("{\"send_each_at\":[1409348513,1409348514,1409348515]}", $email->smtpapi->jsonString());
  }

  public function testSetText() {
    $email = new SendGrid\Email();

    $text = "sample plain text";
    $email->setText($text);
    $this->assertEquals($text, $email->getText());
  }

  public function testSetHtml() {
    $email = new SendGrid\Email();

    $html = "<p style = 'color:red;'>Sample HTML text</p>";
    $email->setHtml($html);
    $this->assertEquals($html, $email->getHtml());
  }

  public function testSetAttachments() {
    $email = new SendGrid\Email();

    $attachments = 
      array(
        "path/to/file/file_1.txt", 
        "../file_2.txt", 
        "../file_3.txt"
      );

    $email->setAttachments($attachments);
    $msg_attachments = $email->getAttachments();
    $this->assertEquals(count($attachments), count($msg_attachments));

    for($i = 0; $i < count($attachments); $i++) {
      $this->assertEquals($attachments[$i], $msg_attachments[$i]['file']);
    }
  }

  public function testSetAttachmentsWithCustomFilename() {
    $email = new SendGrid\Email();

    $array_of_attachments = 
      array(
        "customName.txt" => "path/to/file/file_1.txt", 
        'another_name_|.txt' => "../file_2.txt", 
        'custom_name_2.zip' => "../file_3.txt"
      );

    $email->setAttachments($array_of_attachments);
    $attachments = $email->getAttachments();

    $this->assertEquals($attachments[0]['custom_filename'], 'customName.txt');
    $this->assertEquals($attachments[1]['custom_filename'], 'another_name_|.txt');
    $this->assertEquals($attachments[2]['custom_filename'], 'custom_name_2.zip');
  }

  public function testAddAttachment() {
    $email = new SendGrid\Email();

    //ensure that addAttachment appends to the list of attachments
    $email->addAttachment("../file_4.png");

    $attachments[] = "../file_4.png";

    $msg_attachments = $email->getAttachments();
    $this->assertEquals($attachments[count($attachments) - 1], $msg_attachments[count($msg_attachments) - 1]['file']);
  }

  public function testAddAttachmentCustomFilename() {
    $email = new SendGrid\Email();

    $email->addAttachment("../file_4.png", "different.png");

    $attachments = $email->getAttachments();
    $this->assertEquals($attachments[0]['custom_filename'], 'different.png');
    $this->assertEquals($attachments[0]['filename'], 'file_4');
  }


  public function testSetAttachment() {
    $email = new SendGrid\Email();

    //Setting an attachment removes all other files
    $email->setAttachment("only_attachment.sad");

    $this->assertEquals(1, count($email->getAttachments()));

    //Remove an attachment
    $email->removeAttachment("only_attachment.sad");
    $this->assertEquals(0, count($email->getAttachments()));
  }

  public function testSetAttachmentCustomFilename() {
    $email = new SendGrid\Email();

    //Setting an attachment removes all other files
    $email->setAttachment("only_attachment.sad", "different");

    $attachments = $email->getAttachments();
    $this->assertEquals(1, count($attachments));
    $this->assertEquals($attachments[0]['custom_filename'], 'different');

    //Remove an attachment
    $email->removeAttachment("only_attachment.sad");
    $this->assertEquals(0, count($email->getAttachments()));
  }

  public function testAddAttachmentWithoutExtension() {
    $email = new SendGrid\Email();

    //ensure that addAttachment appends to the list of attachments
    $email->addAttachment("../file_4");

    $attachments[] = "../file_4";

    $msg_attachments = $email->getAttachments();
    $this->assertEquals($attachments[count($attachments) - 1], $msg_attachments[count($msg_attachments) - 1]['file']);
  }

  public function testCategoryAccessors() {
    $email = new SendGrid\Email();

    $email->setCategories(array('category_0'));
    $this->assertEquals("{\"category\":[\"category_0\"]}", $email->smtpapi->jsonString());

    $categories = array(
                    "category_1", 
                    "category_2", 
                    "category_3", 
                    "category_4"
                  );

    $email->setCategories($categories);

    // uses valid json
    $this->assertEquals("{\"category\":[\"category_1\",\"category_2\",\"category_3\",\"category_4\"]}", $email->smtpapi->jsonString());
  }

  public function testSubstitutionAccessors() {
    $email = new SendGrid\Email();

    $substitutions = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $email->setSubstitutions($substitutions);

    $this->assertEquals("{\"sub\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $email->smtpapi->jsonString());
  }

  public function testSectionAccessors()
  {
    $email = new SendGrid\Email();

    $sections = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $email->setSections($sections);

    $this->assertEquals("{\"section\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $email->smtpapi->jsonString());
  }

  public function testUniqueArgsAccessors() {
    $email = new SendGrid\Email();

    $unique_arguments = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $email->setUniqueArgs($unique_arguments);

    $this->assertEquals("{\"unique_args\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $email->smtpapi->jsonString());

    $email->addUniqueArg('uncle', 'bob');

    $this->assertEquals("{\"unique_args\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"],\"uncle\":\"bob\"}}", $email->smtpapi->jsonString());
  }

  public function testHeaderAccessors() {
    // A new message shouldn't have any RFC-822 headers set
    $message = new SendGrid\Email();
    $this->assertEquals('{}', $message->smtpapi->jsonString());

    // Add some message headers, check they are correctly stored
    $headers = array(
    'X-Sent-Using' => 'SendGrid-API',
    'X-Transport'  => 'web',
    );
    $message->setHeaders($headers);
    $this->assertEquals($headers, $message->getHeaders());

    // Add another header, check if it is stored
    $message->addHeader('X-Another-Header', 'first_value');
    $headers['X-Another-Header'] = 'first_value';
    $this->assertEquals($headers, $message->getHeaders());

    // Replace a header
    $message->addHeader('X-Another-Header', 'second_value');
    $headers['X-Another-Header'] = 'second_value';
    $this->assertEquals($headers, $message->getHeaders());

    // Get the encoded headers; they must be a valid JSON
    $json = $message->getHeadersJson();
    $decoded = json_decode($json, TRUE);
    $this->assertInternalType('array', $decoded);
    // Test we get the same message headers we put in the message
    $this->assertEquals($headers, $decoded);

    // Remove a header
    $message->removeHeader('X-Transport');
    unset($headers['X-Transport']);
    $this->assertEquals($headers, $message->getHeaders());
  }

  public function testToWebFormatWithDate() {
    $email    = new SendGrid\Email();
    date_default_timezone_set('America/Los_Angeles');
    $date = date('r');
    $email->setDate($date);
    $json     = $email->toWebFormat(); 

    $this->assertEquals($json['date'], $date);
  }
  
  public function testToWebFormatWithSetSendAt() {
    $email = new SendGrid\Email();
    $email->setSendAt(1409348513);
    $json     = $email->toWebFormat(); 
    $xsmtpapi = json_decode($json["x-smtpapi"]);
    
    $this->assertEquals(1409348513, $xsmtpapi->send_at);
  }

  public function testToWebFormatWithSetSendEachAt() {
    $email = new SendGrid\Email();
    $email->setSendEachAt(array(1409348513, 1409348514));
    $json     = $email->toWebFormat(); 
    $xsmtpapi = json_decode($json["x-smtpapi"]);
    
    $this->assertEquals(array(1409348513, 1409348514), $xsmtpapi->send_each_at);
  }
  
  public function testToWebFormatWithAddSendEachAt() {
    $email = new SendGrid\Email();
    $email->addSendEachAt(1409348513);
    $email->addSendEachAt(1409348514);
    $json     = $email->toWebFormat(); 
    $xsmtpapi = json_decode($json["x-smtpapi"]);
    
    $this->assertEquals(array(1409348513, 1409348514), $xsmtpapi->send_each_at);
  }

  public function testToWebFormatWithTo() {
    $email    = new SendGrid\Email();
    $email->addTo('foo@bar.com');
    $email->setFrom('from@site.com');
    $json     = $email->toWebFormat();
    $xsmtpapi = json_decode($json["x-smtpapi"]); 

    $this->assertEquals($xsmtpapi->to, array('foo@bar.com'));
    $this->assertEquals($json['to'], 'from@site.com');
  }

  public function testToWebFormatWithToAndBcc() {
    $email    = new SendGrid\Email();
    $email->addTo('p1@mailinator.com');
    $email->addBcc('p2@mailinator.com');
    $json     = $email->toWebFormat();

    $this->assertEquals($json['bcc'], array('p2@mailinator.com'));
    $this->assertEquals($json["x-smtpapi"], '{"to":["p1@mailinator.com"]}');
  }

  public function testToWebFormatWithAttachment() {
    $email    = new SendGrid\Email();
    $email->addAttachment('./gif.gif');
    $json     = $email->toWebFormat();

    // php 5.5 works differently. @filename has been deprecated for CurlFile in 5.5
    if (class_exists('CurlFile')) {
      $content = new \CurlFile('./gif.gif', 'gif', 'gif');
      $this->assertEquals($json["files[gif.gif]"], $content);
    } else {
      $this->assertEquals($json["files[gif.gif]"], "@./gif.gif");
    }
  }
  
  public function testToWebFormatWithAttachmentAndCid() {
    $email    = new SendGrid\Email();
    $email->addAttachment('./gif.gif', null, 'sample-cid');
    $email->addAttachment('./gif.gif', 'gif2.gif', 'sample-cid-2');
    $json     = $email->toWebFormat();

    // php 5.5 works differently. @filename has been deprecated for CurlFile in 5.5
    if (class_exists('CurlFile')) {
      $content = new \CurlFile('./gif.gif', 'gif', 'gif');
      $this->assertEquals($json["files[gif.gif]"], $content);
    } else {
      $this->assertEquals($json["files[gif.gif]"], "@./gif.gif");
    }
    $this->assertEquals($json["content[gif.gif]"], "sample-cid");
    $this->assertEquals($json["content[gif2.gif]"], "sample-cid-2");
  }
  
  public function testToWebFormatWithSetAttachmentAndCid() {
    $email    = new SendGrid\Email();
    $email->setAttachment('./gif.gif', null, 'sample-cid');
    $json     = $email->toWebFormat();

    // php 5.5 works differently. @filename has been deprecated for CurlFile in 5.5
    if (class_exists('CurlFile')) {
      $content = new \CurlFile('./gif.gif', 'gif', 'gif');
      $this->assertEquals($json["files[gif.gif]"], $content);
    } else {
      $this->assertEquals($json["files[gif.gif]"], "@./gif.gif");
    }
    $this->assertEquals($json["content[gif.gif]"], "sample-cid");
  }

  public function testToWebFormatWithAttachmentCustomFilename() {
    $email    = new SendGrid\Email();
    $email->addAttachment('./gif.gif', 'different.jpg');
    $json     = $email->toWebFormat();

    // php 5.5 works differently. @filename has been deprecated for CurlFile in 5.5
    if (class_exists('CurlFile')) {
      $content = new \CurlFile('./gif.gif', 'gif', 'gif');
      $this->assertEquals($json["files[different.jpg]"], $content);
    } else {
      $this->assertEquals($json["files[different.jpg]"], "@./gif.gif");
    }
  }

  public function testToWebFormatWithHeaders() {
    $email    = new SendGrid\Email();
    $email->addHeader('X-Sent-Using', 'SendGrid-API');
    $json     = $email->toWebFormat();

    $headers = json_decode($json['headers'], TRUE);
    $this->assertEquals('SendGrid-API', $headers['X-Sent-Using']);
  }

  public function testToWebFormatWithFilters() {
    $email    = new SendGrid\Email();
    $email->addFilter("footer", "text/plain", "Here is a plain text footer");
    $json     = $email->toWebFormat();

    $xsmtpapi = json_decode($json['x-smtpapi'], TRUE);
    $this->assertEquals('Here is a plain text footer', $xsmtpapi['filters']['footer']['settings']['text/plain']);
  }
}
