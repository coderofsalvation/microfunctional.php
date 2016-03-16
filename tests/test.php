<?php 

require_once __DIR__ . '/../src/all.php'; // Autoload files using Composer autoload

/*
 * simple datastore example
 */
$createDefaultItem = function($key){
  return (object)array("title" => $key);
};
$set = function($store,$key,$value){
  $store->$key = $value;
};
$get = function($store,$key){
  return isset($store->$key) ? $store->$key : false;
};
/*
 * highorder functions using curry 
 */
$store        = (object)array();
$getFromStore = curry( $get,$store);
$saveToStore  = curry( $set,$store);
$saveToStore("foo","bar");
print_r( $getFromStore("foo") );
/*
 * highorder functions using compose (piping)
 */
$getDefaultItemAndSave = compose( $createDefaultItem, curry( $saveToStore, time() ) );
$getOrCreateItem       = either( $getFromStore, $getDefaultItemAndSave );   
print_r( $getOrCreateItem("newitem") );
print_r( $store );  
