<?php
require_once __DIR__.'/baseTest.php';

class SendGridTest_GlobalStats extends baseTest
{ 
  public function testGET()
  { 
    $code = 200;
    $headers = array('Content-Type' => 'application/json');
    $body = '[
                {
                  "date": "2015-01-01",
                  "stats": [
                    {
                      "metrics": {
                        "blocks": 1,
                        "bounce_drops": 0,
                        "bounces": 0,
                        "clicks": 0,
                        "deferred": 1,
                        "delivered": 1,
                        "invalid_emails": 1,
                        "opens": 1,
                        "processed": 2,
                        "requests": 3,
                        "spam_report_drops": 0,
                        "spam_reports": 0,
                        "unique_clicks": 0,
                        "unique_opens": 1,
                        "unsubscribe_drops": 0,
                        "unsubscribes": 0
                      }
                    }
                  ]
                },
                {
                  "date": "2015-01-02",
                  "stats": [
                    {
                      "metrics": {
                        "blocks": 0,
                        "bounce_drops": 0,
                        "bounces": 0,
                        "clicks": 0,
                        "deferred": 0,
                        "delivered": 0,
                        "invalid_emails": 0,
                        "opens": 0,
                        "processed": 0,
                        "requests": 0,
                        "spam_report_drops": 0,
                        "spam_reports": 0,
                        "unique_clicks": 0,
                        "unique_opens": 0,
                        "unsubscribe_drops": 0,
                        "unsubscribes": 0
                      }
                    }
                  ]
                }
              ]';
              
    $sendgrid = $this->buildClient($code, $headers, $body);
    $start_date = "2015-01-01";    
    $response = $sendgrid->global_stats->get($start_date);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
    
    $sendgrid = $this->buildClient($code, $headers, $body);
    $end_date = "2015-01-02";
    $response = $sendgrid->global_stats->get($start_date, $end_date);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
    
    $sendgrid = $this->buildClient($code, $headers, $body);
    $aggregated_by = "day";
    $response = $sendgrid->global_stats->get($start_date, $end_date, $aggregated_by);
    $this->assertEquals($code, $response->getStatusCode());
    $this->assertEquals($body, $response->getBody());
  }
  
}