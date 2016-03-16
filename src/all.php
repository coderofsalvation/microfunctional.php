<?php 
/*
 *
 * Copyright 2015 Leon van Kammen / Coder of Salvation. All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 * 
 *    1. Redistributions of source code must retain the above copyright notice, this list of
 *       conditions and the following disclaimer.
 * 
 *    2. Redistributions in binary form must reproduce the above copyright notice, this list
 *       of conditions and the following disclaimer in the documentation and/or other materials
 *       provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY Leon van Kammen / Coder of Salvation AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL Leon van Kammen / Coder of Salvation OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * The views and conclusions contained in the software and documentation are those of the
 * authors and should not be interpreted as representing official policies, either expressed
 * or implied, of Leon van Kammen / Coder of Salvation 
 */ 

/* high order functions utils for php */

// curry!
// example: $arrayToLines = curry( implode, "\n" ); 
//          $arrayToLines( ["one","two"] );
function curry($fn, $arg, $obj = null) {
    return function() use ($fn, $arg, $obj) {
        $args = func_get_args();
        array_unshift($args, $arg);
        if($obj) {
            $fn = array($obj, $fn);
        }
        return call_user_func_array($fn, $args);
    };
}

// This function allows creating a new function from two functions passed into it
function compose(&$f, &$g) {
  // Return the composed function
  return function() use($f,$g) {
    // Get the arguments passed into the new function
    $x = func_get_args();
    // Call the function to be composed with the arguments
    // and pass the result into the first function.
    return $f(call_user_func_array($g, $x));
  };
}
// Convenience wrapper for mapping
function map(&$data, &$f) {
  return array_map($f, $data);
}
// Convenience wrapper for filtering arrays
function filter(&$data, &$f) {
  return array_filter($data, $f);
}
// Convenience wrapper for reducing arrays
function fold(&$data, &$f) {
  return array_reduce($data, $f);
}
function either($a,$b){
  return function($c) use($a,$b) { $a($c) || $b($c); };
}


?>
