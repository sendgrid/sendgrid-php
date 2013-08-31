<?php

class SendGrid_LoaderTest extends PHPUnit_Framework_TestCase
{

  public function setUp()
  {
    require_once(__DIR__ . '/../SendGrid_loader.php');
  }

  public function testAutoloaderSuccesfullyLoadsSendgridClass()
  {
    $this->assertTrue(class_exists('SendGrid', true));
  }

  public function testAutoloaderOnlyLoadsSendgridClasses()
  {
    $this->assertFalse(class_exists('SendGridFake\Example', true));
  }
}
