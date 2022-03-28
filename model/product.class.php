<?php

class Product
{
protected $id,$id_user,$name,$description,$price;

function __construct($id,$id_user,$name,$description,$price)
   {
    $this->id=$id;
    $this->id_user=$id_user;
    $this->name=$name;
    $this->description=$description;
    $this->price=$price;
   }
   function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }  
}
?>