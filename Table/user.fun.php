<?php

/**
*function get user in table 'users'
*
*@param string $loggin
*@param string $password
*/

function getUser(array $data) : boolean
{
  $req_sql=
  'SELECT id
  FROM `users`
  WHERE loggin = :loggin
  AND password = :password  '
  ;

  $req_sql->bindParam(':loggin' , $data['loggin']);
  $req_sql->bindParam(':password' , md5($data['password']));

  return bdd_getData($req_sql)['id'];

}

/**
*function insert user in table 'users'
*
*@param string $loggin
*@param string $password
*/
function insertUser(array $data){
  if(getUser($data)){
    $msg = " ce nom d'utilisateur existe déjà ";
  }

  $req =
  'INSERT INTO `users` (`id`, `username`, `password`)
  VALUES (NULL, :loggin, :password);';

  $req->bindParam(':loggin' , $data['loggin']);
  $req->bindParam(':password' , md5($data['password']));

  bdd_execute($req);
  $msg = " inscription réussi";
  return $msg;
}
                  
function loggin(array $data){

  if(getUser($data)){
    $_SESSION['user_id'] = getUser($data);

  }else {
    return "loggin or password are incorrect";
  }

}                                                                                                                                                                                                                                                                                                                                                                     
