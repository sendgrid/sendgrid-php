<?php

namespace SendGrid;

class SmtpapiHeaders {
  private $to           = array();
  private $category     = array();
  private $sub          = array();
  private $section      = array();
  private $unique_args  = array();
  private $filters      = array();
  private $headers      = array();

  public function __construct() {}

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

  public function addCategory($category) {
    $this->category[] = $category;
    return $this;
  }

  public function setCategory($category) {
    $this->category = array($category);
    return $this;
  }

  public function setCategories($categories) {
    $this->category = $categories;
    return $this;
  }

  public function removeCategory($category) {
    $this->_removeFromList($this->category, $category);
    return $this;
  }

  public function setSubstitutions($key_value_pairs) {
    $this->sub = $key_value_pairs;
    return $this;
  }

  public function addSubstitution($from_value, array $to_values) {
    $this->sub[$from_value] = $to_values;
    return $this;
  }

  public function setSections(array $key_value_pairs) {
    $this->section = $key_value_pairs;
    return $this;
  }
  
  public function addSection($from_value, $to_value) {
    $this->section[$from_value] = $to_value;
    return $this;
  }

  public function setUniqueArguments(array $key_value_pairs) {
    $this->unique_args = $key_value_pairs;
    return $this;
  }
    
  public function addUniqueArgument($key, $value) {
    $this->unique_args[$key] = $value;
    return $this;
  }

  public function setFilterSettings($filter_settings) {
    $this->filters = $filter_settings;
    return $this;
  }
  
  public function addFilterSetting($filter_name, $parameter_name, $parameter_value) {
    $this->filters[$filter_name]['settings'][$parameter_name] = $parameter_value;
    return $this;
  }  
  
  public function setHeaders($key_value_pairs) {
    $this->headers = $key_value_pairs;
    return $this;
  }  
  
  public function addHeader($key, $value) {
    $this->headers[$key] = $value;
    return $this;
  }

  public function removeHeader($key) {
    unset($this->headers[$key]);
    return $this;
  }

  public function getHeaders() {
    $this->headers;
    if ($this->category) {
      $this->headers["category"] = $this->category;
    }
    if ($this->sub) {
      $this->headers["sub"] = $this->sub;
    }
    if ($this->section) {
      $this->headers["section"] = $this->section;
    }
    if ($this->unique_args) {
      $this->headers["unique_args"] = $this->unique_args;
    }
    if ($this->filters) {
      $this->headers["filters"] = $this->filters;
    }
  
    return $this->headers;
  }

  private function _removeFromList(&$list, $item, $key_field = null) {
    foreach ($list as $key => $val) {
      if($key_field) {
        if($val[$key_field] == $item) {
          unset($list[$key]);
        }
      } else {
        if ($val == $item) {
          unset($list[$key]);
        } 
      }
    }
    //repack the indices
    $list = array_values($list);
  }

}

