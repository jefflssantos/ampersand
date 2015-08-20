<?php

namespace Ampersand;
use Ampersand\Http\Response;

class Callback extends Response {

  public $request;
  public $parameters;
  private $args;

  public function __construct($req, $args, $parameters) {
    $this->request = $req;
    $this->args = $args;
    $this->parameters = $parameters;
    parent::__construct();
  }

  public function params($key){
    return $this->request->params($key);
  }

  public function bindAndCall($cb){
    ob_start();
    $ncb = $cb->bindTo($this, $this);
    call_user_func_array($ncb, $this->args);
    $this->write(ob_get_clean());
  }

}