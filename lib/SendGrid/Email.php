<?php

namespace SendGrid;

class Email {

  private $from,
          $from_name,
          $reply_to,
          $cc_list,
          $bcc_list,
          $subject,
          $text,
          $html,
          $headers,
          $smtpapi_headers,
          $attachments;

  protected $use_headers;

  public function __construct() {
    $this->from_name        = false;
    $this->reply_to         = false;
    $this->smtpapi_headers  = new SmtpapiHeaders();
  }

  /**
   * _removeFromList
   * Given a list of key/value pairs, removes the associated keys
   * where a value matches the given string ($item)
   * @param Array $list - the list of key/value pairs
   * @param String $item - the value to be removed
   */
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

  public function addTo($email, $name=null) {
    $this->smtpapi_headers->addTo($email, $name);
    return $this;
  }

  public function setTo($email) {
    $this->smtpapi_headers->setTo($email);
    return $this;
  }

  public function setTos(array $emails) { 
    $this->smtpapi_headers->setTos($emails);
    return $this;
  }
  
  public function removeTo($search_term) {
    $this->smtpapi_headers->removeTo($search_term);
    return $this;
  }

  public function getTos() {
    return $this->smtpapi_headers->getTos();
  }

  public function setFrom($email) {
    $this->from = $email;
    return $this;
  }

  public function getFrom($as_array = false) {
    if($as_array && ($name = $this->getFromName())) {
      return array("$this->from" => $name);
    } else {
      return $this->from;
    }
  }

  public function setFromName($name) {
    $this->from_name = $name;
    return $this;
  }
 
  public function getFromName() {
    return $this->from_name;
  }

  public function setReplyTo($email) {
    $this->reply_to = $email;
    return $this;
  }

  public function getReplyTo() {
    return $this->reply_to;
  }

  public function setCc($email) {
    $this->cc_list = array($email);
    return $this;
  }

  public function setCcs(array $email_list) {
    $this->cc_list = $email_list;
    return $this;
  }

  public function addCc($email) {
    $this->cc_list[] = $email;
    return $this;
  }

  public function removeCc($email) {
    $this->_removeFromList($this->cc_list, $email);

    return $this;
  }

  public function getCcs() {
    return $this->cc_list;
  }

  public function setBcc($email) {
    $this->bcc_list = array($email);
    return $this;
  }

  public function setBccs($email_list) {
    $this->bcc_list = $email_list;
    return $this;
  }
 
  public function addBcc($email) {
    $this->bcc_list[] = $email;
    return $this;
  }

  public function removeBcc($email) {
    $this->_removeFromList($this->bcc_list, $email);
    return $this;
  }

  public function getBccs() {
    return $this->bcc_list;
  }

  public function setSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  public function getSubject() {
    return $this->subject;
  }

  public function setText($text) {
    $this->text = $text;
    return $this;
  }

  public function getText() {
    return $this->text;
  }

  public function setHtml($html) {
    $this->html = $html;
    return $this;
  }

  public function getHtml() {
    return $this->html;
  }

  public function setAttachments(array $files) {
    $this->attachments = array();

    foreach($files as $filename => $file) {
      if (is_string($filename)) {
        $this->addAttachment($file, $filename);
      } else {
        $this->addAttachment($file);
      }
    }

    return $this;
  }

  public function setAttachment($file, $custom_filename=null) {
    $this->attachments = array($this->_getAttachmentInfo($file, $custom_filename));
    return $this;
  }

  public function addAttachment($file, $custom_filename=null) {
    $this->attachments[] = $this->_getAttachmentInfo($file, $custom_filename);
    return $this;
  }

  public function getAttachments() {
    return $this->attachments;
  }

  public function removeAttachment($file) {
    $this->_removeFromList($this->attachments, $file, "file");
    return $this;
  }

  private function _getAttachmentInfo($file, $custom_filename=null) {
    $info                       = pathinfo($file);
    $info['file']               = $file;
    if (!is_null($custom_filename)) {
      $info['custom_filename']  = $custom_filename;
    }

    return $info;
  }

  public function setCategories($categories) {
    $this->smtpapi_headers->setCategories($categories);
    return $this;
  }

  public function setCategory($category) {
    $this->smtpapi_headers->setCategory($category);
    return $this;
  }

  public function addCategory($category) {
    $this->smtpapi_headers->addCategory($category);
    return $this;
  }

  public function removeCategory($category) {
    $this->smtpapi_headers->removeCategory($category);
    return $this;
  }

  public function setSubstitutions($key_value_pairs) {
    $this->smtpapi_headers->setSubstitutions($key_value_pairs);
    return $this;
  }

  public function addSubstitution($from_value, array $to_values) {
    $this->smtpapi_headers->addSubstitution($from_value, $to_values);
    return $this;
  }

  public function setSections(array $key_value_pairs) {
    $this->smtpapi_headers->setSections($key_value_pairs);
    return $this;
  }
  
  public function addSection($from_value, $to_value) {
    $this->smtpapi_headers->addSection($from_value, $to_value);
    return $this;
  }

  public function setUniqueArguments(array $key_value_pairs) {
    $this->smtpapi_headers->setUniqueArguments($key_value_pairs);
    return $this;
  }
    
  public function addUniqueArgument($key, $value) {
    $this->smtpapi_headers->addUniqueArgument($key, $value);
    return $this;
  }

  public function setFilterSettings($filter_settings) {
    $this->smtpapi_headers->setFilterSettings($filter_settings);
    return $this;
  }
  
  public function addFilterSetting($filter_name, $parameter_name, $parameter_value) {
    $this->smtpapi_headers->addFilterSetting($filter_name, $parameter_name, $parameter_value);
    return $this;
  }
  
  public function getHeaders() {
    syslog(LOG_NOTICE, "DEPRECATION NOTICE: getHeaders is deprecated. Use getSmtpapiHeaders instead.\n");
    return $this->getSmtpapiHeaders();
  }

  public function getSmtpapiHeaders() {
    return $this->smtpapi_headers->getHeaders();
  }

  public function getHeadersJson() {
    syslog(LOG_NOTICE, "DEPRECATION NOTICE: getHeadersJson is deprecated. Use getSmtpapiHeadersJson instead.\n");
    return $this->getSmtpapiHeadersJson();
  }

  public function getSmtpapiHeadersJson() {
    if (count($this->getSmtpapiHeaders()) <= 0) {
      return "{}";
    }

    return json_encode($this->getSmtpapiHeaders(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
  }

  public function setHeaders($key_value_pairs) {
    syslog(LOG_NOTICE, "DEPRECATION NOTICE: setHeaders is deprecated. Use setSmtpapiHeaders instead.\n");
    $this->setSmtpapiHeaders($key_value_paris);
    return $this;
  }

  public function setSmtpapiHeaders($key_value_pairs) {
    $this->smtpapi_headers->setHeaders($key_value_pairs);
    return $this;
  }

  public function addHeader($key, $value) {
    syslog(LOG_NOTICE, "DEPRECATION NOTICE: addHeader is deprecated. Use addSmtpapiHeader instead.\n");
    $this->addSmtpapiHeader($key_value_paris);
    return $this;
  }

  public function addSmtpapiHeader($key, $value) {
    $this->smtpapi_headers->addHeader($key, $value);
    return $this;
  }
 
  public function removeHeader($key) {
    syslog(LOG_NOTICE, "DEPRECATION NOTICE: removeHeader is deprecated. Use removeSmtpapiHeader instead.\n");
    $this->removeSmtpapiHeader($key);
    return $this;
  }

  public function removeSmtpapiHeader($key) {
    $this->smtpapi_headers->removeHeader($key);
    return $this;
  }

  public function getMessageHeaders() {
    return $this->headers;
  }
 
  public function getMessageHeadersJson() {
    if (count($this->getMessageHeaders()) <= 0) {
      return "{}";
    }
    return json_encode($this->getMessageHeaders(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
  }
 
  public function setMessageHeaders($key_value_pairs) {
    $this->headers = $key_value_pairs;
    return $this;
  }
 
  public function addMessageHeader($key, $value) {
    $this->headers[$key] = $value;
    return $this;
  }
 
  public function removeMessageHeader($key) {
    unset($this->headers[$key]);
    return $this;
  }

  /**
   * useHeaders
   * Checks to see whether or not we can or should you headers. In most cases,
   * we prefer to send our recipients through the headers, but in some cases,
   * we actually don't want to. However, there are certain circumstances in 
   * which we have to.
   */
  public function useHeaders()
  {
    return !($this->_preferNotToUseHeaders() && !$this->_isHeadersRequired());
  }

  public function setRecipientsInHeader($preference)
  {
    $this->use_headers = $preference;

    return $this;
  }

  /**
   * isHeaderRequired
   * determines whether or not we need to force recipients through the smtpapi headers
   * @return boolean, if true headers are required
   */
  protected function _isHeadersRequired()
  {
    if(count($this->getAttachments()) > 0 || $this->use_headers )
    {
      return true;
    }
    return false;
  }

  /**
   * _preferNotToUseHeaders
   * There are certain cases in which headers are not a preferred choice
   * to send email, as it limits some basic email functionality. Here, we
   * check for any of those rules, and add them in to decide whether or 
   * not to use headers
   * @return boolean, if true we don't 
   */
  protected function _preferNotToUseHeaders()
  {
    if (count($this->getBccs()) > 0 || count($this->getCcs()) > 0)
    {
      return true;
    }
    if ($this->use_headers !== null && !$this->use_headers)
    {
      return true;
    }
    
    return false;
  }

 
  public function toWebFormat() {
    $web = array( 
      'to'          => $this->getFrom(), // intentional, set below. 
      'from'        => $this->getFrom(),
      'subject'     => $this->getSubject(),
      'text'        => $this->getText(),
      'html'        => $this->getHtml(),
      'headers'     => $this->getMessageHeadersJson(),
      'x-smtpapi'   => $this->getSmtpapiHeadersJson(),
    );

    if ($this->getCcs())          { $web['cc']          = $this->getCcs(); }
    if ($this->getBccs())         { $web['bcc']         = $this->getBccs(); }
    if ($this->getFromName())     { $web['fromname']    = $this->getFromName(); }
    if ($this->getReplyTo())      { $web['replyto']     = $this->getReplyTo(); }

    // determine if we should send our recipients through our headers,
    // and set the properties accordingly
    if ($this->useHeaders()) {
      $headers              = $this->getSmtpapiHeaders();
      $headers['to']        = $this->getTos();
      $this->setSmtpapiHeaders($headers);

      $web['x-smtpapi']     = $this->getSmtpapiHeadersJson();
    } else {
      $web['to']            = $this->getTos();
    }

    if ($this->getAttachments()) {
      foreach($this->getAttachments() as $f) {
        $file             = $f['file'];
        $extension        = null;
        if (array_key_exists('extension', $f)) {
          $extension      = $f['extension'];
        };
        $filename         = $f['filename'];
        $full_filename    = $filename; 

        if (isset($extension)) {
          $full_filename  =  $filename.'.'.$extension;
        }
        if (array_key_exists('custom_filename', $f)) {
          $full_filename  = $f['custom_filename'];
        }

        $contents   = '@' . $file; 
        if (class_exists('CurlFile')) { // php >= 5.5
          $contents = new \CurlFile($file, $extension, $filename);
        }

        $web['files['.$full_filename.']'] = $contents;
      };
    }

    return $web;
  }

}
