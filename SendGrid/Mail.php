<?php

namespace SendGrid;

class Mail
{
  
  private $to_list, 
          $from,
          $cc_list,
          $bcc_list,
          $subject,
          $text,
          $html,
          $attachment_list,
          $category_list,
          $substitution_list,
          $section_list,
          $unique_argument_list,
          $filter_setting_list,
          $header_list;

  public function __construct()
  {
    
  }

  public function __call($method, $args)
  {
    if (substr($method, 0, 3) == 'get')
    {
      $property = strtolower(substr($method, 3));
      if (isset($this->$property))
      {
        return $this->$property;
      }
    }

    return null;
  }

  public function setTo($email)
  {
    $this->to_list = array($email);
    return $this;
  }

  public function addTo($email)
  {
    $this->to_list[] = $email;
    return $this;
  }

  public function removeTo($email)
  {
    array_filter($this->to_list, function($x) use($email){ return $x == $email; });
    return $this;
  }

  public function setFrom($email)
  {
    $this->from = $email;
    return $this;
  }

  public function setCc($email)
  {
    $this->cc_list = array($email);
    return $this;
  }

  public function addCc($email)
  {
    $this->cc_list[] = $email;
    return $this;
  }

  public function removeCc($email)
  {
    return $this;
  }

  public function setBcc($email)
  {
    $this->bcc_list = array($email);
    return $this;
  }

  public function addBcc($email)
  {
    $this->bcc_list[] = $email;
    return $this;
  }

  public function removeBcc($email)
  {
    return $this;
  }

  public function setSubject($subject)
  {
    $this->subject = $subject;
    return $this;
  }

  public function setText($text)
  {
    $this->text = $text;
    return $this;
  }

  public function setHtml($html)
  {
    $this->html = $html;
    return $this;
  }

  public function addAttachment($file)
  {
    $this->attachment_list[] = $file;
    return $this;
  }

  public function removeAttachment($file)
  {
    return $this;
  }


  public function setCategories($category_list)
  {
    $this->category_list = $category_list;
    return $this;
  }

  public function addCategory($category)
  {
    $this->category_list[] = $category;
    return $this;
  }

  public function removeCategory($category)
  {
    return $this;
  }

  public function setSubstitutions($key_value_pairs)
  {

    return $this;
  }

  public function addSubstitution($from_value, array $to_values)
  {
    $this->substitution_list[$from_value] = $to_values;
    return $this;
  }

  public function setSections(array $key_value_pairs)
  {
    return $this;
  }
  
  public function addSection($from_value, $to_value)
  {
    $this->section_list[$from_value] = $to_value;
    return $this;
  }

  public function setUniqueArguments(array $key_value_pairs)
  {
    $this->unique_argument_list = $key_value_pairs;
    return $this;
  }
  
  public function addUniqueArgument($key, $value)
  {
    $this->unique_argument_list[$key] = $value;
    return $this;
  }

  public function setFilterSettings($filter_settings)
  {
    $this->filter_setting_list = $filter_settings;
    return $this;
  }
  
  public function addFilterSetting($filter_name, $parameter_name, $parameter_value)
  {
    $this->filter_setting_list[] = array($filter_name, $parameter_name, $parameter_value);
    return $this;
  }

  public function setHeaders($key_value_pairs)
  {
    $this->headers_list = $key_value_pairs;
    return $this;
  }
  
  public function addHeader($key, $value)
  {
    $this->headers_list[$key] = $value;
    return $this;
  }

  public function removeHeader($key)
  {
    unset($this->headers_list[$key]);
    return $this;
  }

}

