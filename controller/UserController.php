<?php
require_once __DIR__."/../model/User.php";
require_once __DIR__."/../config.php";

class UserController {

  private $mysqli;

  function __construct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  } 

  function get($nik){
    $Q = "SELECT * FROM user WHERE `nik` = '$nik'";
    $row = $this->mysqli->query($Q);
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

  function auth($nik, $pass){
    $auth = NOT_REGISTERED;
    $ldapconfig['host'] = 'merahputih.telkom.co.id';
    $ldapconfig['authrealm'] = 'User Telkom POINT';
    if($nik != "" && $pass != ""){
      $ds = @ldap_connect($ldapconfig['host']);
      $r = @ldap_search( $ds, " ", 'uid=' . $nik);
      if($r){
        $result = @ldap_get_entries( $ds, $r);
        if(isset($result[0])){
          $auth = WRONG_PASSWORD;
          if(@ldap_bind( $ds, $result[0]['dn'], $pass)){
            $auth = $result[0]['cn'][0]."#un&mail#".$result[0]['mail'][0];
          }
        }
      } else {
        $auth = NOT_CONNECTED;
      }
    }
    return $auth;
  }

  function fetch($rows){
    $users = array();
    $i = 0;
    while($r = $rows->fetch_array()){
      $user = new User();
      $user->id = $r['id'];
      $user->nik = $r['nik'];
      $user->name = $r['name'];
      $user->level = $r['level'];
      $user->subunit = $r['subunit'];
      $users[$i] = $user;
      $i++;
    }
    return $users;
  }

  function fetchID($rows){
    $ids = array();
    $i = 0;
    while($r = $rows->fetch_array()){
      $ids[$i] = $r['pic'];
      $i++;
    }
    return $ids;
  }

  function getAll(){
    $Q = "SELECT * FROM user";
    return $this->fetch($this->mysqli->query($Q));
  }

  function getByUnit($subunit){
    $Q = "SELECT * FROM user WHERE `subunit` = '$subunit'";
    return $this->fetch($this->mysqli->query($Q));
  }

  function getById($id){
    $Q = "SELECT * FROM user WHERE `id` = $id";
    return $this->fetch($this->mysqli->query($Q));
  }

  function getByAct($act_id){
    $Q = "SELECT * FROM pic WHERE `act` = $act_id";
    return $this->fetchID($this->mysqli->query($Q));
  }
}
?>