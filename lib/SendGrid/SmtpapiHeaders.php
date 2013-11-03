<?php

namespace SendGrid;

class SmtpapiHeaders {
  private $to = array();

  //this.to = [];
  //this.sub = {};
  //this.unique_args = {};
  //this.category = [];
  //this.filters = {};
  //this.section = {};

  public function __construct() {

  }

  public function addTo($email, $name=null) {
    $this->to[] = ($name ? $name . " <" . $email . ">" : $email);
    return $this;
  }

  public function setTo($email) {
    $this->to = array($email);
    return $this;
  }

  public function setTos(array $emails) { 
    $this->to = $emails;
    return $this;
  }

  public function removeTo($search_term) {
    $this->to = array_values(array_filter($this->to, function($item) use($search_term) {
      return !preg_match("/" . $search_term . "/", $item);
    }));
    return $this;
  }

  public function getTos() {
    return $this->to;
  }

}

