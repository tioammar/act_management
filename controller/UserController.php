<?php
require_once __DIR__."/../model/User.php";
require_once __DIR__."/../config.php";

class UserController {

  private $nik;
  private $pass;

  function __construct($nik, $pass){
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
    $this->nik = $nik;
    $this->pass = $pass;
  } 

  function getUser($nik){
    $Q = "SELECT * FROM user WHERE `nik` = '$nik'";
    $row = $mysqli->query($Q);
    $user = new User();
    if($r = $row->fetch_array()){
      $user->id = $r['id'];
      $user->nik = $r['nik'];
      $user->name = $r['full_name'];
      $user->level = $r['level'];
      $user->subunit = $r['subunit'];
    }
    return $user;
  }

  function auth(){
    $auth = NOT_REGISTERED;
    $ldapconfig['host'] = 'merahputih.telkom.co.id';
    $ldapconfig['authrealm'] = 'User Telkom POINT';
    if($this->nik != "" && $this->pass != ""){
      $ds = @ldap_connect($ldapconfig['host']);
      $r = @ldap_search( $ds, " ", 'uid=' . $this->nik);
      if($r){
        $result = @ldap_get_entries( $ds, $r);
        if(isset($result[0])){
          $auth = WRONG_PASSWORD;
          if(@ldap_bind( $ds, $result[0]['dn'], $this->pass)){
            $auth = $result[0]['cn'][0]."#un&mail#".$result[0]['mail'][0];
          }
        }
      } else {
        $auth = NOT_CONNECTED;
      }
    }
    return $auth;
  }

  function getAllUser(){
    $Q = "SELECT * FROM user";
  }

  function getUserByUnit($unit){
    $Q = "SELECT * FROM user WHERE `subunit` = '$subunit'";
  }

  function getUserById($id){
    $Q = "SELECT * FROM user WHERE `id` = $id";
  }
}
?>