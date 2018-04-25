<?php

namespace SendGrid\Tests\Campaigns;

use SendGrid\Tests\BaseTestClass;

class CampaignsTest extends BaseTestClass
{
    public function testCampaignsPostMethod()
    {
        $request_body = json_decode('{
  "categories": [
    "spring line"
  ],
  "custom_unsubscribe_url": "",
  "html_content": "<html><head><title></title></head><body><p>Check out our spring line!</p></body></html>",
  "ip_pool": "marketing",
  "list_ids": [
    110,
    124
  ],
  "plain_content": "Check out our spring line!",
  "segment_ids": [
    110
  ],
  "sender_id": 124451,
  "subject": "New Products for Spring!",
  "suppression_group_id": 42,
  "title": "March Newsletter"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->campaigns()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testCampaignsGetMethod()
    {
        $query_params = json_decode('{"limit": 1, "offset": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->campaigns()->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testCampaignsIdPatchMethod()
    {
        $request_body = json_decode('{
  "categories": [
    "summer line"
  ],
  "html_content": "<html><head><title></title></head><body><p>Check out our summer line!</p></body></html>",
  "plain_content": "Check out our summer line!",
  "subject": "New Products for Summer!",
  "title": "May Newsletter"
}');
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testCampaignsIdGetMethod()
    {
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testCampaignsIdDeleteMethod()
    {
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testCampaignsIdSchedulesPatchMethod()
    {
        $request_body = json_decode('{
  "send_at": 1489451436
}');
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->schedules()->patch($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testCampaignsIdSchedulesPostMethod()
    {
        $request_body = json_decode('{
  "send_at": 1489771528
}');
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->schedules()->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testCampaignsIdSchedulesGetMethod()
    {
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->schedules()->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testCampaignsIdSchedulesDeleteMethod()
    {
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->schedules()->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testCampaignsIdSchedulesNowPostMethod()
    {
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->schedules()->now()->post(null, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testCampaignsIdSchedulesTestPostMethod()
    {
        $request_body = json_decode('{
  "to": "your.email@example.com"
}');
        $campaign_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->campaigns()->_($campaign_id)->schedules()->test()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }
}
