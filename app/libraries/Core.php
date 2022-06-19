<?php
/*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class Core
{
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];
  protected $arr = [];

  public function debug_to_console($data)
  {
    $output = $data;
    if (is_array($output))
      $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  }

  public function __construct()
  {
    //print_r($this->getUrl());

    $url = $this->getUrl();
    //$this->debug_to_console(ucwords($url[0]));

    //remove irrelevant root path:
    while (count($url) > 1 && !file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      \array_splice($url, 0, 1);
    }

    // Look in BLL for first value
    if (!is_null($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // If exists, set as controller
      $this->currentController = ucwords($url[0]);

      // Unset 0 Index
      unset($url[0]);
    }

    // Require the controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // Instantiate controller class
    $this->currentController = new $this->currentController;

    // Check for second part of url
    if (isset($url[1])) {
      //$this->debug_to_console($url[1]);
      // Check to see if method exists in controller
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        // Unset 1 index
        unset($url[1]);
      }
    }

    // Get params
    if (isset($_SERVER["REQUEST_URI"])) {
      parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $this->params);
    } else {
      $this->params = [];
    }
    //$this->debug_to_console($this->params);
    /*
    echo "<script>console.log('Debug in core: " . count($this->params) . "' );</script>";
    foreach ($this->params as $param) {

      echo "<script>console.log('Debug par: " . $param . "' );</script>";
      array_push($this->arr, $param);
    }

    foreach($this->arr as $el){
      
      echo "<script>console.log('Debug el: " . $el . "' );</script>";
    }
*/

    // Call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], array($this->params));
  }

  public function getUrl()
  {
    if (isset($_SERVER["REQUEST_URI"])) {
      //$this->debug_to_console(parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH));
      $url = rtrim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
