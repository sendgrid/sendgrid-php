<?php

class SendGrid
{
  
  private $category_list,
          $substitution_list,
          $section_list,
          $unique_argument_list,
          $filter_setting_list,
          $header_list;

  public function __construct()
  {
    # code...
  }

  public function setCategories($category)
  {
    # code...
  }

  public function addCategory($category)
  {
    # code...
  }

  public function removeCategory($category)
  {
    # code...
  }

  public function setSubstitution($from_value, $to_values)
  {
    # code...
  }

  public function addSubstitution($from_value, $to_value)
  {
    # code...
  }

  public function setSections($key_value_pairs)
  {
    # code...
  }
  
  public function addSection($from_value, $to_value)
  {
    # code...
  }

  public function setUniqueArguments($key_value_pairs)
  {
    # code...
  }
  
  public function addUniqueArgument($key, $value)
  {
    # code...
  }

  public function setFilterSettings($filter_settings)
  {
    # code...
  }
  
  public function addFilterSetting($filter_name, $parameter_name, $parameter_value)
  {
    # code...
  }

  public function setHeaders($key_value_pairs)
  {
    # code...
  }
  
  public function addHeader($key, $value)
  {
    # code...
  }

  public function removeHeader($key)
  {
    # code...
  }
}
