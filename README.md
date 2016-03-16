Microfunctional
===============

<p align="center">
  <img alt="" width="250" src="http://jr0cket.co.uk/slides/images/myth-fp-is-for-geniuses.png"/>
  </p>

Bare minimum functional programming helpers:

* curry
* compose
* filter
* fold
* either

see [this video](https://www.youtube.com/watch?v=hzf3hTUKk8U&list=PLQB2www8g0gSx80WjEugNEYv3aJOKaaT2)

## Usage 

    $ composer require coderofsalvation/microfunctional

and then 

		<?php
			
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
		?>

   
## License

BSD
