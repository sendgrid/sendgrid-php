<?php 

class SendGridTest_Report extends PHPUnit_Framework_TestCase {

  public function testConstructionReport() {
    $report = new SendGrid\Report();
    $this->assertEquals(get_class($report), "SendGrid\Report");
  }
  public function testBounces() {
    $report = new SendGrid\Report();
    $report->bounces();
    $this->assertEquals("https://api.sendgrid.com/api/bounces.get.json",$report->getUrl());
  }
  public function testBlocks() {
    $report = new SendGrid\Report();
    $report->blocks();
    $this->assertEquals("https://api.sendgrid.com/api/blocks.get.json",$report->getUrl());
  }
  public function testInvalidEmails() {
    $report = new SendGrid\Report();
    $report->invalidemails();
    $this->assertEquals("https://api.sendgrid.com/api/invalidemails.get.json",$report->getUrl());
  }
  public function testSpamReports() {
    $report = new SendGrid\Report();
    $report->spamreports();
    $this->assertEquals("https://api.sendgrid.com/api/spamreports.get.json",$report->getUrl());
  }
  public function testUnsubscribes() {
    $report = new SendGrid\Report();
    $report->unsubscribes();
    $this->assertEquals("https://api.sendgrid.com/api/unsubscribes.get.json",$report->getUrl());
  }
  public function testParameterDate()
  {
    $report = new SendGrid\Report();
    $report->bounces()->date();
    $this->assertEquals(array('date'=>1),$report->toWebFormat());
  }
  public function testParameterDays()
  {
    $report = new SendGrid\Report();
    $report->bounces()->days(5);
    $this->assertEquals(array('days'=>5),$report->toWebFormat());
  }
  public function testParameterStartDate()
  {
    $report = new SendGrid\Report();
    $report->bounces()->startDate('2014-01-01');
    $this->assertEquals(array('start_date'=>'2014-01-01'),$report->toWebFormat());
  }
  public function testParameterEndDate()
  {
    $report = new SendGrid\Report();
    $report->bounces()->endDate('2014-12-31');
    $this->assertEquals(array('end_date'=>'2014-12-31'),$report->toWebFormat());
  }
  public function testParameterLimit()
  {
    $report = new SendGrid\Report();
    $report->bounces()->limit('11');
    $this->assertEquals(array('limit'=>'11'),$report->toWebFormat());
  }
  public function testParameterOffset()
  {
    $report = new SendGrid\Report();
    $report->bounces()->offset('500');
    $this->assertEquals(array('offset'=>'500'),$report->toWebFormat());
  }
  public function testParameterType()
  {
    $report = new SendGrid\Report();
    $report->bounces()->type('hard');
    $this->assertEquals(array('type'=>'hard'),$report->toWebFormat());
  }
  public function testParameterEmail()
  {
    $report = new SendGrid\Report();
    $report->bounces()->email('foo@bar.com');
    $this->assertEquals(array('email'=>'foo@bar.com'),$report->toWebFormat());
  }
  public function testParametersCombined() {
    $report = new SendGrid\Report();
    $report->bounces()->startDate('2014-01-01')->endDate('2014-12-31')->email('foo@bar.com')->limit();
    $this->assertEquals(array('email'=>'foo@bar.com','start_date' => '2014-01-01','end_date' => '2014-12-31','limit'=>1),$report->toWebFormat());
  }
}
