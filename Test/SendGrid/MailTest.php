<?php 


class MailTest extends PHPUnit_Framework_TestCase
{

  public function testToAccessors()
  {
    $message = new SendGrid\Mail();

    // setTo instanciates and overrides existing data
    $message->setTo('bar');
    $message->setTo('foo');

    $this->assertEquals(1, count($message->getTos()));

    $to_list = $message->getTos();

    $this->assertEquals('foo', $to_list[0]);


    // setTos instanciates and overrides existing data
    $message->setTos(array('raz', 'ber'));

    $this->assertEquals(2, count($message->getTos()));

    $to_list = $message->getTos();

    $this->assertEquals('raz', $to_list[0]);
    $this->assertEquals('ber', $to_list[1]);

    // addTo appends to existing data
    $message->addTo('foo');
    $message->addTo('raz');

    $this->assertEquals(4, count($message->getTos()));

    $to_list = $message->getTos();

    $this->assertEquals('raz', $to_list[0]);
    $this->assertEquals('ber', $to_list[1]);
    $this->assertEquals('foo', $to_list[2]);
    $this->assertEquals('raz', $to_list[3]);

    // removeTo removes all occurences of data
    $message->removeTo('raz');

    $this->assertEquals(2, count($message->getTos()));

    $to_list = $message->getTos();

    $this->assertEquals('ber', $to_list[0]);
    $this->assertEquals('foo', $to_list[1]);
  }

  public function testFromAccessors()
  {
    $message = new SendGrid\Mail();

    $message->setFrom("foo@bar.com");
    $message->setFromName("John Doe");

    $this->assertEquals("foo@bar.com", $message->getFrom());
    $this->assertEquals(array("foo@bar.com" => "John Doe"), $message->getFrom(true));
  }

  public function testFromNameAccessors()
  {
    $message = new SendGrid\Mail();

    // Defaults to false
    $this->assertFalse($message->getFromName());

    $message->setFromName("Swift");

    $this->assertEquals("Swift", $message->getFromName());
  }

  public function testReplyToAccessors()
  {
    $message = new SendGrid\Mail();

    // Defaults to false
    $this->assertFalse($message->getReplyTo());

    $message->setReplyTo("swift@sendgrid.com");

    $this->assertEquals("swift@sendgrid.com", $message->getReplyTo());
  }

  public function testCcAccessors()
  {
    $message = new SendGrid\Mail();

    // setTo instanciates and overrides existing data
    $message->setCc('bar');
    $message->setCc('foo');

    $this->assertEquals(1, count($message->getCcs()));

    $cc_list = $message->getCcs();

    $this->assertEquals('foo', $cc_list[0]);


    // setTos instanciates and overrides existing data
    $message->setCcs(array('raz', 'ber'));

    $this->assertEquals(2, count($message->getCcs()));

    $cc_list = $message->getCcs();

    $this->assertEquals('raz', $cc_list[0]);
    $this->assertEquals('ber', $cc_list[1]);

    // addTo appends to existing data
    $message->addCc('foo');
    $message->addCc('raz');

    $this->assertEquals(4, count($message->getCcs()));

    $cc_list = $message->getCcs();

    $this->assertEquals('raz', $cc_list[0]);
    $this->assertEquals('ber', $cc_list[1]);
    $this->assertEquals('foo', $cc_list[2]);
    $this->assertEquals('raz', $cc_list[3]);

    // removeTo removes all occurences of data
    $message->removeCc('raz');

    $this->assertEquals(2, count($message->getCcs()));

    $cc_list = $message->getCcs();

    $this->assertEquals('ber', $cc_list[0]);
    $this->assertEquals('foo', $cc_list[1]);
  }

  public function testBccAccessors()
  {
    $message = new SendGrid\Mail();

    // setTo instanciates and overrides existing data
    $message->setBcc('bar');
    $message->setBcc('foo');

    $this->assertEquals(1, count($message->getBccs()));

    $bcc_list = $message->getBccs();

    $this->assertEquals('foo', $bcc_list[0]);


    // setTos instanciates and overrides existing data
    $message->setBccs(array('raz', 'ber'));

    $this->assertEquals(2, count($message->getBccs()));

    $bcc_list = $message->getBccs();

    $this->assertEquals('raz', $bcc_list[0]);
    $this->assertEquals('ber', $bcc_list[1]);

    // addTo appends to existing data
    $message->addBcc('foo');
    $message->addBcc('raz');

    $this->assertEquals(4, count($message->getBccs()));

    $bcc_list = $message->getBccs();

    $this->assertEquals('raz', $bcc_list[0]);
    $this->assertEquals('ber', $bcc_list[1]);
    $this->assertEquals('foo', $bcc_list[2]);
    $this->assertEquals('raz', $bcc_list[3]);

    // removeTo removes all occurences of data
    $message->removeBcc('raz');

    $this->assertEquals(2, count($message->getBccs()));

    $bcc_list = $message->getBccs();

    $this->assertEquals('ber', $bcc_list[0]);
    $this->assertEquals('foo', $bcc_list[1]);
  }

  public function testSubjectAccessors()
  {
    $message = new SendGrid\Mail();

    $message->setSubject("Test Subject");

    $this->assertEquals("Test Subject", $message->getSubject());
  }

  public function testTextAccessors()
  {
    $message = new SendGrid\Mail();

    $text = "sample plain text";

    $message->setText($text);

    $this->assertEquals($text, $message->getText());
  }

  public function testHTMLAccessors()
  {
    $message = new SendGrid\Mail();

    $html = "<p style = 'color:red;'>Sample HTML text</p>";

    $message->setHtml($html);

    $this->assertEquals($html, $message->getHtml());
  }

  public function testAttachmentAccessors()
  {
    $message = new SendGrid\Mail();

    $attachments = 
      array(
        "path/to/file/file_1.txt", 
        "../file_2.txt", 
        "../file_3.txt"
      );

    $message->setAttachments($attachments);

    $msg_attachments = $message->getAttachments();

    $this->assertEquals(count($attachments), count($msg_attachments));

    for($i = 0; $i < count($attachments); $i++)
    {
      $this->assertEquals($attachments[$i], $msg_attachments[$i]['file']);
    }

    //ensure that addAttachment appends to the list of attachments
    $message->addAttachment("../file_4.png");

    $attachments[] = "../file_4.png";

    $msg_attachments = $message->getAttachments();
    $this->assertEquals($attachments[count($attachments) - 1], $msg_attachments[count($msg_attachments) - 1]['file']);


    //Setting an attachment removes all other files
    $message->setAttachment("only_attachment.sad");

    $this->assertEquals(1, count($message->getAttachments()));

    //Remove an attachment
    $message->removeAttachment("only_attachment.sad");
    $this->assertEquals(0, count($message->getAttachments()));
  }

  public function testCategoryAccessors()
  {
    $message = new SendGrid\Mail();

    $message->setCategory('category_0');
    $this->assertEquals("{\"category\":[\"category_0\"]}", $message->getHeadersJson());

    $categories = array(
                    "category_1", 
                    "category_2", 
                    "category_3", 
                    "category_4"
                  );

    $message->setCategories($categories);

    $header = $message->getHeaders();

    // ensure that the array is the same
    $this->assertEquals($categories, $header['category']);

    // uses valid json
    $this->assertEquals("{\"category\":[\"category_1\",\"category_2\",\"category_3\",\"category_4\"]}", $message->getHeadersJson());

    // ensure that addCategory appends to the list of categories
    $category = "category_5";
    $message->addCategory($category);

    $header = $message->getHeaders();

    $this->assertEquals(5, count($header['category']));

    $categories[] = $category;

    $this->assertEquals($categories, $header['category']);


    // removeCategory removes all occurrences of a category
    $message->removeCategory("category_3");

    $header = $message->getHeaders();

    unset($categories[2]);
    $categories = array_values($categories);

    $this->assertEquals(4, count($header['category']));

    $this->assertEquals($categories, $header['category']);
  }

  public function testSubstitutionAccessors()
  {
    $message = new SendGrid\Mail();

    $substitutions = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $message->setSubstitutions($substitutions);

    $header = $message->getHeaders();

    $this->assertEquals($substitutions, $header['sub']);

    $this->assertEquals("{\"sub\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $message->getHeadersJson());

    // ensure that addSubstitution appends to the list of substitutions
    
    $sub_vals = array("val_5.1", "val_5.2", "val_5.3", "val_5.4");
    $message->addSubstitution("sub_5", $sub_vals);

    $substitutions["sub_5"] = $sub_vals;

    $header = $message->getHeaders();

    $this->assertEquals(5, count($header['sub']));
    $this->assertEquals($substitutions, $header['sub']);
  }

  public function testSectionAccessors()
  {
    $message = new SendGrid\Mail();

    $sections = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $message->setSections($sections);

    $header = $message->getHeaders();

    $this->assertEquals($sections, $header['section']);

    $this->assertEquals("{\"section\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $message->getHeadersJson());

    // ensure that addSubstitution appends to the list of substitutions
    
    $section_vals = array("val_5.1", "val_5.2", "val_5.3", "val_5.4");
    $message->addSection("sub_5", $section_vals);

    $sections["sub_5"] = $section_vals;

    $header = $message->getHeaders();

    $this->assertEquals(5, count($header['section']));
    $this->assertEquals($sections, $header['section']);
  }

  public function testUniqueArgumentsAccessors()
  {
    $message = new SendGrid\Mail();

    $unique_arguments = array(
                      "sub_1" => array("val_1.1", "val_1.2", "val_1.3"),
                      "sub_2" => array("val_2.1", "val_2.2"),
                      "sub_3" => array("val_3.1", "val_3.2", "val_3.3", "val_3.4"),
                      "sub_4" => array("val_4.1", "val_4.2", "val_4.3")
                    );

    $message->setUniqueArguments($unique_arguments);

    $header = $message->getHeaders();

    $this->assertEquals($unique_arguments, $header['unique_args']);

    $this->assertEquals("{\"unique_args\":{\"sub_1\":[\"val_1.1\",\"val_1.2\",\"val_1.3\"],\"sub_2\":[\"val_2.1\",\"val_2.2\"],\"sub_3\":[\"val_3.1\",\"val_3.2\",\"val_3.3\",\"val_3.4\"],\"sub_4\":[\"val_4.1\",\"val_4.2\",\"val_4.3\"]}}", $message->getHeadersJson());

    // ensure that addSubstitution appends to the list of substitutions
    
    $unique_vals = array("val_5.1", "val_5.2", "val_5.3", "val_5.4");
    $message->addUniqueArgument("sub_5", $unique_vals);

    $unique_arguments["sub_5"] = $unique_vals;

    $header = $message->getHeaders();

    $this->assertEquals(5, count($header['unique_args']));
    $this->assertEquals($unique_arguments, $header['unique_args']);
  }

  public function testFilterSettingsAccessors()
  {
    $message = new SendGrid\Mail();

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

    $message->setFilterSettings($filters);

    $header = $message->getHeaders();

    $this->assertEquals(count($filters), count($header['filters']));

    $this->assertEquals($filters, $header['filters']);


    //the addFilter appends to the filter list
    $message->addFilterSetting("filter_4", "enable", 0);
    $message->addFilterSetting("filter_4", "setting_6", "setting_val_6");
    $message->addFilterSetting("filter_4", "setting_7", "setting_val_7");

    $filters["filter_4"] = 
      array(
        "settings" => 
          array(
            "enable" => 0, 
            "setting_6" => "setting_val_6", 
            "setting_7" => "setting_val_7"
          )
      );

    $header = $message->getHeaders();

    $this->assertEquals($filters, $header['filters']);
  }

  public function testHeaderAccessors()
  {
    $message = new SendGrid\Mail();

    $this->assertEquals("{}", $message->getHeadersJson());


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


      $message->setHeaders($headers);


      $this->assertEquals($headers, $message->getHeaders());

      $message->addHeader("simple_header", "simple_value");

      $headers["simple_header"] = "simple_value";

      $this->assertEquals($headers, $message->getHeaders());
      $this->assertEquals("{\"header_1\":{\"item_1\":\"value_1\",\"item_2\":\"value_2\",\"item_3\":\"value_3\"},\"header_2\":\"value_4\",\"header_3\":\"value_4\",\"header_4\":{\"item_4\":{\"sub_item_1\":\"sub_value_1\",\"sub_item_2\":\"sub_value_2\"}},\"simple_header\":\"simple_value\"}", $message->getHeadersJson());

      //remove a header
      $message->removeHeader("simple_header");

      unset($headers["simple_header"]);

      $this->assertEquals($headers, $message->getHeaders());
  }

  public function testUseHeaders()
  {
    $mail = new SendGrid\Mail();

    $mail->addTo('foo@bar.com')->
       addBcc('baa@bar.com')->
       setFrom('boo@foo.com')->
       setSubject('Subject')->
       setHtml('Hello You');
    
    $this->assertFalse($mail->useHeaders());

    $mail->removeBcc('baa@bar.com');
    $this->assertTrue($mail->useHeaders());

    $mail->addCc('bot@bar.com');
    $this->assertFalse($mail->useHeaders());

    $mail->removeCc('bot@bar.com')->
      setRecipientsinHeader(true);
    $this->assertTrue($mail->useHeaders());

    $mail->setRecipientsinHeader(false);
    $this->assertFalse($mail->useHeaders());

    $mail->
      addBcc('baa@bar.com')->
      addAttachment('attachment.ext');

    $this->assertTrue($mail->useHeaders());
  }
}
