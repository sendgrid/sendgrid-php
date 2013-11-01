<?php 

class SendGridTest_Email extends PHPUnit_Framework_TestCase {
  
  public function testConstructionEmail() {
    $email = new SendGrid\Email();
    $this->assertEquals(get_class($email), "SendGrid\Email");
  }

  public function testConstructionMailIsSendGridEmail() {
    $email = new SendGrid\Mail();
    $this->assertEquals(get_class($email), "SendGrid\Mail");
  }

  public function testAddToWithDeprectedMailClass() {
    $mail = new SendGrid\Mail();

    $mail->addTo('p1@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com'), $mail->getTos());

    $mail->addTo('p2@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com', 'p2@mailinator.com'), $mail->getTos());

  }

  public function testAddTo() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com'), $email->getTos());

    $email->addTo('p2@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com', 'p2@mailinator.com'), $email->getTos());
  }

  public function testAddToWithName() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com', 'Person One');
    $this->assertEquals(array('Person One <p1@mailinator.com>'), $email->getTos());

    $email->addTo('p2@mailinator.com');
    $this->assertEquals(array('Person One <p1@mailinator.com>', 'p2@mailinator.com'), $email->getTos());
  }

  public function testSetTo() {
    $email = new SendGrid\Email();

    $email->setTo('p1@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com'), $email->getTos());
  }

  public function testRemoveTo() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com');
    $this->assertEquals(array('p1@mailinator.com'), $email->getTos());

    $email->removeTo('p1@mailinator.com');
    $this->assertEquals(array(), $email->getTos());
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

  public function testAddAttachment() {
    $email = new SendGrid\Email();

    //ensure that addAttachment appends to the list of attachments
    $email->addAttachment("../file_4.png");

    $attachments[] = "../file_4.png";

    $msg_attachments = $email->getAttachments();
    $this->assertEquals($attachments[count($attachments) - 1], $msg_attachments[count($msg_attachments) - 1]['file']);
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

  public function testCategoryAccessors() {
    $email = new SendGrid\Email();

    $email->setCategory('category_0');
    $this->assertEquals("{\"category\":[\"category_0\"]}", $email->getHeadersJson());

    $categories = array(
                    "category_1", 
                    "category_2", 
                    "category_3", 
                    "category_4"
                  );

    $email->setCategories($categories);

    $header = $email->getHeaders();

    // ensure that the array is the same
    $this->assertEquals($categories, $header['category']);

    // uses valid json
    $this->assertEquals("{\"category\":[\"category_1\",\"category_2\",\"category_3\",\"category_4\"]}", $email->getHeadersJson());

    // ensure that addCategory appends to the list of categories
    $category = "category_5";
    $email->addCategory($category);

    $header = $email->getHeaders();

    $this->assertEquals(5, count($header['category']));

    $categories[] = $category;

    $this->assertEquals($categories, $header['category']);


    // removeCategory removes all occurrences of a category
    $email->removeCategory("category_3");

    $header = $email->getHeaders();

    unset($categories[2]);
    $categories = array_values($categories);

    $this->assertEquals(4, count($header['category']));

    $this->assertEquals($categories, $header['category']);
  }

  public function testSubstitutionAccessors()
  {
    $email = new SendGrid\Email();

    $substitutions = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $email->setSubstitutions($substitutions);

    $header = $email->getHeaders();

    $this->assertEquals($substitutions, $header['sub']);

    $this->assertEquals("{\"sub\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $email->getHeadersJson());

    // ensure that addSubstitution appends to the list of substitutions
    
    $sub_vals = array("val_5.1", "val_5.2", "val_5.3", "val_5.4");
    $email->addSubstitution("sub_5", $sub_vals);

    $substitutions["sub_5"] = $sub_vals;

    $header = $email->getHeaders();

    $this->assertEquals(5, count($header['sub']));
    $this->assertEquals($substitutions, $header['sub']);
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

    $header = $email->getHeaders();

    $this->assertEquals($sections, $header['section']);

    $this->assertEquals("{\"section\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $email->getHeadersJson());

    // ensure that addSubstitution appends to the list of substitutions
    
    $section_vals = array("val_5.1", "val_5.2", "val_5.3", "val_5.4");
    $email->addSection("sub_5", $section_vals);

    $sections["sub_5"] = $section_vals;

    $header = $email->getHeaders();

    $this->assertEquals(5, count($header['section']));
    $this->assertEquals($sections, $header['section']);
  }

  public function testUniqueArgumentsAccessors()
  {
    $email = new SendGrid\Email();

    $unique_arguments = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $email->setUniqueArguments($unique_arguments);

    $header = $email->getHeaders();

    $this->assertEquals($unique_arguments, $header['unique_args']);

    $this->assertEquals("{\"unique_args\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $email->getHeadersJson());

    // ensure that addSubstitution appends to the list of substitutions
    
    $unique_vals = array("val_5.1", "val_5.2", "val_5.3", "val_5.4");
    $email->addUniqueArgument("sub_5", $unique_vals);

    $unique_arguments["sub_5"] = $unique_vals;

    $header = $email->getHeaders();

    $this->assertEquals(5, count($header['unique_args']));
    $this->assertEquals($unique_arguments, $header['unique_args']);
  }

  public function testFilterSettingsAccessors()
  {
    $email = new SendGrid\Email();

    $filters =  
      array(
        "filter_1" => 
          array(
            "settings" => 
            array(
              "enable" => 1, 
              "setting_1" => "setting_val_1"
            )
          ),
        "filter_2" => 
          array(
            "settings" => 
            array(
              "enable" => 0,
              "setting_2" => "setting_val_2",
              "setting_3" => "setting_val_3"
            )
          ),
        "filter_3" => 
          array(
            "settings" => 
            array(
              "enable" => 0,
              "setting_4" => "setting_val_4",
              "setting_5" => "setting_val_5"
            )
          ),
      );

    $email->setFilterSettings($filters);

    $header = $email->getHeaders();

    $this->assertEquals(count($filters), count($header['filters']));

    $this->assertEquals($filters, $header['filters']);


    //the addFilter appends to the filter list
    $email->addFilterSetting("filter_4", "enable", 0);
    $email->addFilterSetting("filter_4", "setting_6", "setting_val_6");
    $email->addFilterSetting("filter_4", "setting_7", "setting_val_7");

    $filters["filter_4"] = 
      array(
        "settings" => 
          array(
            "enable" => 0, 
            "setting_6" => "setting_val_6", 
            "setting_7" => "setting_val_7"
          )
      );

    $header = $email->getHeaders();

    $this->assertEquals($filters, $header['filters']);
  }

  public function testHeaderAccessors()
  {
    $email = new SendGrid\Email();

    $this->assertEquals("{}", $email->getHeadersJson());


    $headers = 
      array(
        "header_1" => 
          array(
            "item_1" => "value_1", 
            "item_2" => "value_2", 
            "item_3" => "value_3"
          ),
        "header_2" => "value_4",
        "header_3" => "value_4",
        "header_4" => 
          array(
            "item_4" =>
            array(
              "sub_item_1" => "sub_value_1",
              "sub_item_2" => "sub_value_2"
            )
          )
      );


      $email->setHeaders($headers);


      $this->assertEquals($headers, $email->getHeaders());

      $email->addHeader("simple_header", "simple_value");

      $headers["simple_header"] = "simple_value";

      $this->assertEquals($headers, $email->getHeaders());
      $this->assertEquals("{\"header_1\":{\"item_1\":\"value_1\",\"item_2\":\"value_2\",\"item_3\":\"value_3\"},\"header_2\":\"value_4\",\"header_3\":\"value_4\",\"header_4\":{\"item_4\":{\"sub_item_1\":\"sub_value_1\",\"sub_item_2\":\"sub_value_2\"}},\"simple_header\":\"simple_value\"}", $email->getHeadersJson());

      //remove a header
      $email->removeHeader("simple_header");

      unset($headers["simple_header"]);

      $this->assertEquals($headers, $email->getHeaders());
  }

  public function testUseHeaders()
  {
    $email = new SendGrid\Email();

    $email->addTo('foo@bar.com')->
       addBcc('baa@bar.com')->
       setFrom('boo@foo.com')->
       setSubject('Subject')->
       setHtml('Hello You');
    
    $this->assertFalse($email->useHeaders());

    $email->removeBcc('baa@bar.com');
    $this->assertTrue($email->useHeaders());

    $email->addCc('bot@bar.com');
    $this->assertFalse($email->useHeaders());

    $email->removeCc('bot@bar.com')->
      setRecipientsinHeader(true);
    $this->assertTrue($email->useHeaders());

    $email->setRecipientsinHeader(false);
    $this->assertFalse($email->useHeaders());

    $email->
      addBcc('baa@bar.com')->
      addAttachment('attachment.ext');

    $this->assertTrue($email->useHeaders());
  }

  public function testToWebFormatWithTo() {
    $email    = new SendGrid\Email();
    $email->addTo('foo@bar.com');
    $json     = $email->toWebFormat();
    $xsmtpapi = json_decode($json["x-smtpapi"]); 

    $this->assertEquals($xsmtpapi->to, array('foo@bar.com'));
  }

  public function testToWebFormatWithToAndBcc() {
    $email    = new SendGrid\Email();
    $email->addTo('p1@mailinator.com');
    $email->addBcc('p2@mailinator.com');
    $json     = $email->toWebFormat();

    $this->assertEquals($json['to'], array('p1@mailinator.com'));
    $this->assertEquals($json['bcc'], array('p2@mailinator.com'));
    $this->assertEquals($json["x-smtpapi"], '{}');
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
}
