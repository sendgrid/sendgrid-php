<?php

namespace SendGrid;

class Report {

  static $actions = array('get','delete','count','add');
  static $modules = array('spamreports','blocks','bounces','invalidemails','unsubscribes');
  static $parameters = array('date','days','limit','offset','type','email');
  static $parameters_underscored = array('start_date'=>'startDate','end_date'=>'endDate'); // to comply with PSR, methods shouldn't have underscores
  public $module,
         $format,
         $action,
         $date,
         $days,
         $start_date,
         $end_date,
         $limit,
         $offset,
         $type,
         $email;

  public function __construct() {
    $this->format = 'json';
  }

  public function __call($method, $args=null) {
    // set action (defaults to get)
    $this->action = 'get';
    if(in_array($method,self::$actions))$this->action = $method;
    // set module
    if(in_array($method,self::$modules))$this->module = $method;
    // set parameter
    if(in_array($method,array_merge(self::$parameters,array_values(self::$parameters_underscored)))){
      $method = $this->addUnderscore($method);
      $args = array_shift($args);
      if(empty($args)) $args = 1;
      $this->{$method} = $args;
    }
    return $this;
   }

  public function getUrl($url=null)
  {
    if(!isset($url)) $url = 'https://api.sendgrid.com/api/'.$this->module.'.'.$this->action.'.'.$this->format;
    return $url;
  }

  public function addUnderscore($method)
  {
      if(in_array($method,array_values(self::$parameters_underscored))){
        $method = str_replace(array_values(self::$parameters_underscored),array_keys(self::$parameters_underscored),$method);
      }
      return $method;
  }

  public function toWebFormat() {
    $web = array();
    foreach(self::$parameters as $parameter){
      if($this->{$parameter})$web[$parameter]=$this->{$parameter};
    }
    return $web;
  }
}
