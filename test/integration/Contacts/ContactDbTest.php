<?php

namespace SendGrid\Tests\Integration\Contacts;

use SendGrid\Tests\BaseTestClass;

class ContactDbTest extends BaseTestClass
{
    public function testContactDbCustomFieldsPostMethod()
    {
        $request_body = json_decode('{
  "name": "pet",
  "type": "text"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->contactdb()
                                     ->custom_fields()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testContactDbCustomFieldsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->custom_fields()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbCustomFieldsIdGetMethod()
    {
        $custom_field_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->custom_fields()
                                     ->_($custom_field_id)
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbCustomFieldsIdDeleteMethod()
    {
        $custom_field_id = "test_url_param";
        $request_headers = ["X-Mock: 202"];
        $response = self::$sg->client->contactdb()
                                     ->custom_fields()
                                     ->_($custom_field_id)
                                     ->delete(null, null, $request_headers);
        $this->assertEquals(202, $response->statusCode());
    }

    public function testContactDbListsPostMethod()
    {
        $request_body = json_decode('{
  "name": "your list name"
}');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testContactDbListsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbListsDeleteMethod()
    {
        $request_body = json_decode('[
  1,
  2,
  3,
  4
]');
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->delete($request_body, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testContactDbListsIdPatchMethod()
    {
        $request_body = json_decode('{
  "name": "newlistname"
}');
        $query_params = json_decode('{"list_id": 1}');
        $list_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->_($list_id)
                                     ->patch($request_body, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbListsIdGetMethod()
    {
        $query_params = json_decode('{"list_id": 1}');
        $list_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->_($list_id)
                                     ->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbListsIdDeleteMethod()
    {
        $query_params = json_decode('{"delete_contacts": "true"}');
        $list_id = "test_url_param";
        $request_headers = ["X-Mock: 202"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->_($list_id)
                                     ->delete(null, $query_params, $request_headers);
        $this->assertEquals(202, $response->statusCode());
    }

    public function testContactDbListsIdRecipientsPostMethod()
    {
        $request_body = json_decode('[
  "recipient_id1",
  "recipient_id2"
]');
        $list_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->_($list_id)
                                     ->recipients()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testContactDbListsIdRecipientsGetMethod()
    {
        $query_params = json_decode('{"page": 1, "page_size": 1, "list_id": 1}');
        $list_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->_($list_id)
                                     ->recipients()
                                     ->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbListsIdRecipientsIdPostMethod()
    {
        $list_id = "test_url_param";
        $recipient_id = "test_url_param";
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->_($list_id)
                                     ->recipients()
                                     ->_($recipient_id)
                                     ->post(null, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testContactDbListsIdRecipientsIdDeleteMethod()
    {
        $query_params = json_decode('{"recipient_id": 1, "list_id": 1}');
        $list_id = "test_url_param";
        $recipient_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->contactdb()
                                     ->lists()
                                     ->_($list_id)
                                     ->recipients()
                                     ->_($recipient_id)
                                     ->delete(null, $query_params, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testContactDbRecipientsPatchMethod()
    {
        $request_body = json_decode('[
  {
    "email": "jones@example.com",
    "first_name": "Guy",
    "last_name": "Jones"
  }
]');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->patch($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testContactDbRecipientsPostMethod()
    {
        $request_body = json_decode('[
  {
    "age": 25,
    "email": "example@example.com",
    "first_name": "",
    "last_name": "User"
  },
  {
    "age": 25,
    "email": "example2@example.com",
    "first_name": "Example",
    "last_name": "User"
  }
]');
        $request_headers = ["X-Mock: 201"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(201, $response->statusCode());
    }

    public function testContactDbRecipientsGetMethod()
    {
        $query_params = json_decode('{"page": 1, "page_size": 1}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbRecipientsDeleteMethod()
    {
        $request_body = json_decode('[
  "recipient_id1",
  "recipient_id2"
]');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->delete($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbRecipientsBillableCountGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->billable_count()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbRecipientsCountMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->count()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbRecipientsSearchGetMethod()
    {
        $query_params = json_decode('{"{field_name}": "test_string"}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->search()
                                     ->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbRecipientsIdGetMethod()
    {
        $recipient_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->_($recipient_id)
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbRecipientsIdDeleteMethod()
    {
        $recipient_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->_($recipient_id)
                                     ->delete(null, null, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testContactDbRecipientsIdListsGetMethod()
    {
        $recipient_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->recipients()
                                     ->_($recipient_id)
                                     ->lists()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbReservedFieldsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->reserved_fields()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbSegmentsPostMethod()
    {
        $request_body = json_decode('{
  "conditions": [
    {
      "and_or": "",
      "field": "last_name",
      "operator": "eq",
      "value": "Miller"
    },
    {
      "and_or": "and",
      "field": "last_clicked",
      "operator": "gt",
      "value": "01/02/2015"
    },
    {
      "and_or": "or",
      "field": "clicks.campaign_identifier",
      "operator": "eq",
      "value": "513"
    }
  ],
  "list_id": 4,
  "name": "Last Name Miller"
}');
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->segments()
                                     ->post($request_body, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbSegmentsGetMethod()
    {
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->segments()
                                     ->get(null, null, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbSegmentsIdPatchMethod()
    {
        $request_body = json_decode('{
  "conditions": [
    {
      "and_or": "",
      "field": "last_name",
      "operator": "eq",
      "value": "Miller"
    }
  ],
  "list_id": 5,
  "name": "The Millers"
}');
        $query_params = json_decode('{"segment_id": "test_string"}');
        $segment_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->segments()
                                     ->_($segment_id)
                                     ->patch($request_body, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbSegmentsIdGetMethod()
    {
        $query_params = json_decode('{"segment_id": 1}');
        $segment_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->segments()
                                     ->_($segment_id)
                                     ->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }

    public function testContactDbSegmentsIdDeleteMethod()
    {
        $query_params = json_decode('{"delete_contacts": "true"}');
        $segment_id = "test_url_param";
        $request_headers = ["X-Mock: 204"];
        $response = self::$sg->client->contactdb()
                                     ->segments()
                                     ->_($segment_id)
                                     ->delete(null, $query_params, $request_headers);
        $this->assertEquals(204, $response->statusCode());
    }

    public function testContactDbSegmentsIdRecipientsGetMethod()
    {
        $query_params = json_decode('{"page": 1, "page_size": 1}');
        $segment_id = "test_url_param";
        $request_headers = ["X-Mock: 200"];
        $response = self::$sg->client->contactdb()
                                     ->segments()
                                     ->_($segment_id)
                                     ->recipients()
                                     ->get(null, $query_params, $request_headers);
        $this->assertEquals(200, $response->statusCode());
    }
}
