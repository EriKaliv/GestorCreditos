<?php namespace App\Controllers;

class Home extends BaseController
{
  protected $session;
  public function __construct()
  {
    $this->session = session();
  }

  public function index()
  {
    if (isset($this->session->idRol)) {
      $session = session();
      $session->destroy();
      return view('login');
    } else {
      return view('login');
    }
  }

  public function signup()
  {
    if (isset($this->session->idRol)) {
      $session = session();
      $session->destroy();
      return view('signup');
    } else {
      return view('signup');
    }
  }
}
