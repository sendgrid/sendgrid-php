<?php 

require_once __dir__ . "/../../SendGrid/Mail.php";


class MailTest extends PHPUnit_Framework_TestCase
{

    public function testToAccessors()
    {
      $message = new SendGrid\Mail();

      //setTo instanciates and overrides existing data
      $message->setTo('bar');
      $message->setTo('foo');

      $this->assertEquals(1, count($message->getTos()));

      $to_list = $message->getTos();

      $this->assertEquals('foo', $to_list[0]);


      //setTos instanciates and overrides existing data
      $message->setTos(array('raz', 'ber'));

      $this->assertEquals(2, count($message->getTos()));

      $to_list = $message->getTos();

      $this->assertEquals('raz', $to_list[0]);
      $this->assertEquals('ber', $to_list[1]);

      //addTo appends to existing data
      $message->addTo('foo');
      $message->addTo('raz');

      $this->assertEquals(4, count($message->getTos()));

      $to_list = $message->getTos();

      $this->assertEquals('raz', $to_list[0]);
      $this->assertEquals('ber', $to_list[1]);
      $this->assertEquals('foo', $to_list[2]);
      $this->assertEquals('raz', $to_list[3]);

      //removeTo removes all occurences of data
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

      $this->assertEquals("foo@bar.com", $message->getFrom());
    }

    public function testCcAccessors()
    {
      $message = new SendGrid\Mail();

      //setTo instanciates and overrides existing data
      $message->setCc('bar');
      $message->setCc('foo');

      $this->assertEquals(1, count($message->getCcs()));

      $cc_list = $message->getCcs();

      $this->assertEquals('foo', $cc_list[0]);


      //setTos instanciates and overrides existing data
      $message->setCcs(array('raz', 'ber'));

      $this->assertEquals(2, count($message->getCcs()));

      $cc_list = $message->getCcs();

      $this->assertEquals('raz', $cc_list[0]);
      $this->assertEquals('ber', $cc_list[1]);

      //addTo appends to existing data
      $message->addCc('foo');
      $message->addCc('raz');

      $this->assertEquals(4, count($message->getCcs()));

      $cc_list = $message->getCcs();

      $this->assertEquals('raz', $cc_list[0]);
      $this->assertEquals('ber', $cc_list[1]);
      $this->assertEquals('foo', $cc_list[2]);
      $this->assertEquals('raz', $cc_list[3]);

      //removeTo removes all occurences of data
      $message->removeCc('raz');

      $this->assertEquals(2, count($message->getCcs()));

      $cc_list = $message->getCcs();

      $this->assertEquals('ber', $cc_list[0]);
      $this->assertEquals('foo', $cc_list[1]);
    }

    public function testBccAccessors()
    {
      $message = new SendGrid\Mail();

      //setTo instanciates and overrides existing data
      $message->setBcc('bar');
      $message->setBcc('foo');

      $this->assertEquals(1, count($message->getBccs()));

      $bcc_list = $message->getBccs();

      $this->assertEquals('foo', $bcc_list[0]);


      //setTos instanciates and overrides existing data
      $message->setBccs(array('raz', 'ber'));

      $this->assertEquals(2, count($message->getBccs()));

      $bcc_list = $message->getBccs();

      $this->assertEquals('raz', $bcc_list[0]);
      $this->assertEquals('ber', $bcc_list[1]);

      //addTo appends to existing data
      $message->addBcc('foo');
      $message->addBcc('raz');

      $this->assertEquals(4, count($message->getBccs()));

      $bcc_list = $message->getBccs();

      $this->assertEquals('raz', $bcc_list[0]);
      $this->assertEquals('ber', $bcc_list[1]);
      $this->assertEquals('foo', $bcc_list[2]);
      $this->assertEquals('raz', $bcc_list[3]);

      //removeTo removes all occurences of data
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

    public function testCategoryAccessors()
    {
      $message = new SendGrid\Mail();

      $categories = array(
                      "category_1", 
                      "category_2", 
                      "category_3", 
                      "category_4"
                    );

      $message->setCategories($categories);

      $header = $message->getHeaders();

      //ensure that the array is the same
      $this->assertEquals($categories, $header['category']);

      //uses valid json
      $this->assertEquals("{\"category\":[\"category_1\",\"category_2\",\"category_3\",\"category_4\"]}", $message->getHeadersJson());

      //ensure that addCategory appends to the list of categories
      $category = "category_5";
      $message->addCategory($category);

      $header = $message->getHeaders();

      $this->assertEquals(5, count($header['category']));

      $categories[] = $category;

      $this->assertEquals($categories, $header['category']);


      //removeCategory removes all occurrences of a category
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

      //ensure that addSubstitution appends to the list of substitutions
      
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

      //ensure that addSubstitution appends to the list of substitutions
      
      $section_vals = array("val_5.1", "val_5.2", "val_5.3", "val_5.4");
      $message->addSection("sub_5", $section_vals);

      $sections["sub_5"] = $section_vals;

      $header = $message->getHeaders();

      $this->assertEquals(5, count($header['section']));
      $this->assertEquals($sections, $header['section']);
    }
}