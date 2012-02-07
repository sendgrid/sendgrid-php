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

  /*public function __call($method, $args)
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
  }*/

  /* getTos
   * Return the list of recipients
   * @return list of recipients
   */
  public function getTos()
  {
    return $this->to_list;
  }

  /* setTos
   * Initialize an array for the recipient 'to' field
   * Destroy previous recipient 'to' data.
   * @param Array $email - an array of email addresses
   * @return the SendGridMail object.
   */
  public function setTos(array $email)
  { 
    $this->to_list = $email;
    return $this;
  }

  /* setTo
   * Initialize a single email for the recipient 'to' field
   * Destroy previous recipient 'to' data.
   * @param String $email - a single email address
   * @return the SendGridMail object.
   */
  public function setTo($email)
  {
    $this->to_list = array($email);
    return $this;
  }

  /* addTo
   * append an email address to the existing list of addresses
   * Preserve previous recipient 'to' data.
   * @param String $email - a single email address
   * @return the SendGridMail object.
   */
  public function addTo($email)
  {
    $this->to_list[] = $email;
    return $this;
  }

  /* removeTo
   * remove an email address from the list of addresses
   * @param String $email - an email address to be removed
   * @return the SendGridMail object.
   */
  public function removeTo($email)
  {
    foreach($this->to_list as $key => $val)
    {
      if($val == $email)
      {
        unset($this->to_list[$key]);
      }
    }
    return $this;
  }

  /* getFrom
   * get the from email address
   * @return the from email address
   */
  public function getFrom()
  {
    return $this->from;
  }

  /* setFrom
   * set the from email
   * @param String $email - an email address
   * @return the SendGridMail object.
   */
  public function setFrom($email)
  {
    $this->from = $email;
    return $this;
  }

  public function setCc($email)
  {
    $this->cc_list = $email;
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
    $this->bcc_list = $email;
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

  /* getSubject
   * get the email subject
   * @return the email subject
   */
  public function getSubject()
  {
    return $this->subject;
  }

  /* setSubject
   * set the email subject
   * @param String $subject - the email subject
   * @return the SendGridMail object
   */
  public function setSubject($subject)
  {
    $this->subject = $subject;
    return $this;
  }

  /* getText
   * get the plain text part of the email
   * @return the plain text part of the email
   */
  public function getText()
  {
    return $this->text;
  }

  /* setText
   * Set the plain text part of the email
   * @param String $text - the plain text of the email
   * @return the SendGridMail object.
   */
  public function setText($text)
  {
    $this->text = $text;
    return $this;
  }
  
  /* getHtml
   * Get the HTML part of the email
   * @param String $html - the HTML part of the email
   * @return the HTML part of the email.
   */
  public function getHtml()
  {
    return $this->html;
  }

  /* setHTML
   * Set the HTML part of the email
   * @param String $html - the HTML part of the email
   * @return the SendGridMail object.
   */
  public function setHtml($html)
  {
    $this->html = $html;
    return $this;
  }

  public function addAttachment($file)
  {
    
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

  /* SetSubstitutions
   *
   * Substitute a value for list of values, where each value corresponds
   * to the list emails in a one to one relationship. (IE, value[0] = email[0], 
   * value[1] = email[1])
   *
   * @param array $key_value_pairs key/value pairs where the value is an array of values
   * @return the SendGridMail object
   */
  public function setSubstitutions($key_value_pairs)
  {

    return $this;
  }

  /* addSubstitution
   *
   * Substitute a value for list of values, where each value corresponds
   * to the list emails in a one to one relationship. (IE, value[0] = email[0], 
   * value[1] = email[1])
   *
   * @param string $from_key - the value to be replaced
   * @param array $to_values - an array of values to replace the $from_value
   * @return the SendGridMail object
   */
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