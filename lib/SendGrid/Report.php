<?php

namespace SendGrid;

class Report {

  public $module,
         $modules,
         $format,
         $action,
         $parameters,
         $date,
         $days,
         $start_date,
         $end_date,
         $limit,
         $offset,
         $type,
         $email;

  public function __construct() {
    $this->modules = array('spamreports','blocks','bounces','invalidemails','unsubscribes');
    $this->parameters = array('date','days','limit','offset','type','email');
    $this->parameters_underscored = array('start_date'=>'startDate','end_date'=>'endDate'); // to comply with PSR, methods shouldn't have underscores
    $this->format = 'json';
    $this->action = 'get';
  }

  public function __call($method, $args=null) {
    // set module with calls
    if(in_array($method,$this->modules)){
      $this->module = $method;
      return $this;
    }
    // set parameter
    if(in_array($method,array_merge($this->parameters,array_values($this->parameters_underscored)))){
      $method = $this->addUnderscore($method);
      $args = array_shift($args);
      if(empty($args)) $args = 1;
      $this->{$method} = $args;
      return $this;
    }
   }

  public function getUrl($url=null)
  {
    if(!isset($url)) $url = 'https://api.sendgrid.com/api/'.$this->module.'.'.$this->action.'.'.$this->format;
    return $url;
  }

  public function delete()
  {
    $this->action = 'delete';
    return $this;
  }

  public function addUnderscore($method)
  {
      if(in_array($method,array_values($this->parameters_underscored))){
        $method = str_replace(array_values($this->parameters_underscored),array_keys($this->parameters_underscored),$method);
      }
      return $method;
  }

  public function toWebFormat() {
    $web = array();
    foreach($this->parameters as $parameter){
      if($this->{$parameter})$web[$parameter]=$this->{$parameter};
    }
    return $web;
  }
}
