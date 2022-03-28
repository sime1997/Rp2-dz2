<?php

require_once __DIR__ . '/../app/db.class.php';
require_once __DIR__ . '/product.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/sales.class.php';


class EbuyService
{
	
function getAllUsers( )///ovdje san dohvatija sve usere
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email,registration_sequence,has_registered FROM dz2_users ORDER BY id');
			$st->execute();
		} 
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'],
                               $row['registration_sequence'],$row['has_registered']);
		}

		return $arr;///arr ti je niz klasa!!!
	} 

function getAllProducts()///sve proizvode
    {try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, name, description, price FROM dz2_products ORDER BY id');
			$st->execute();
		} 
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Product( $row['id'], $row['id_user'], $row['name'],$row['description'], $row['price']);
		}

		return $arr;///arr ti je niz klasa!!!
    }




function checkUser($property_1,$property_2)
    { $arr=$this->getAllUsers(); ///sad ga tribas naci;
		foreach ($arr as $row)
            {   
			if($row->username===$property_1 && $row->password_hash===$property_2) {return true;}
			}    
    }
function getId($property_1)
    {$arr=$this->getAllUsers(); ///sad ga tribas naci;
		foreach ($arr as $row)
            {   
			if($row->username===$property_1) {return $row->id;}
			} 
	}
function getUsername($id)
     {$arr=$this->getAllUsers();
      foreach($arr as $row)
	        {
				if($row->id===$id) {return $row->username;}
			}
	 }
	
	
function getProducts($id)/// za trazeni id vraca niz svih proizvoda
     { $arr=$this->getAllProducts();
       $ret_arr=array();
      foreach($arr as $row)
	      if($row->id_user===$id) 
		           array_push($ret_arr,$row);
	return $ret_arr;			
	}
	

function getAllSales( )///ovdje san dohvatija sve kupovine
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_product,id_user,rating,comment FROM dz2_sales ORDER BY id');
			$st->execute();
		} 
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Sale( $row['id'], $row['id_product'], $row['id_user'], $row['rating'],
                               $row['comment']);
		}

		return $arr;///arr ti je niz klasa!!!
	}

function getSale($property_1) ///dohvacamo komentare
{ $arr=$this->getAllSales();
	$ret_arr=array();
   foreach($arr as $row)
	   if($row->id_product===$property_1) 
				array_push($ret_arr,$row);
 return $ret_arr;			
 }
function addNewProduct($id_user,$name,$description,$price)
   {
	$db = DB::getConnection();

	// Ubaci neke proizvode unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera)
	try
	{
		$st = $db->prepare( 'INSERT INTO dz2_products(id_user, name, description, price) VALUES (:id_user, :name, :description, :price)' );

		$st->execute( array( 'id_user' =>$id_user , 'name' =>$name , 'description' =>$description , 'price' => $price) ); // slavko
	}
	catch( PDOException $e ) { exit( "PDO error [dz2_products]: " . $e->getMessage() ); }
  }
function searchProduct($string)
  {$arr=$this->getAllProducts();
   $ret_arr=[];
    foreach($arr as $row)
	   {
		$parts = explode( ' ', $row->name);
        foreach($parts as $value )
		     
				 if($value===$string)
                                         array_push($ret_arr,$row);
				                     
	   }
	return $ret_arr;
  }
function getUsersSales($id_user)
  {$arr=$this->getAllSales();
   $ret_arr=[];
	foreach($arr as $row)
           if($row->id_user===$id_user)
                   array_push($ret_arr,$row);
		   
   return $ret_arr;
  }

  function addNewSale($id_product,$id_user)
  {
   $db = DB::getConnection();

  
   try
   {
	   $st = $db->prepare( 'INSERT INTO dz2_sales(id_product, id_user) VALUES (:id_product, :id_user)' );

	   $st->execute( array( 'id_product' =>$id_product , 'id_user' =>$id_user)); 
   }
   catch( PDOException $e ) { exit( "PDO error [dz2_products]: " . $e->getMessage() ); }
 }



function getProductById($id)
   { $arr=$this->getAllProducts();
	  
	   foreach($arr as $row)
	       if($row->id===$id)
                    return $row;
     
   }




function addGradeAndComment($id_product,$id_user,$grade,$comment)
  { $arr=$this->getAllsales();
    
	 foreach($arr as $row)
	      { 
			if($row->id_product===$id_product && $row->id_user===$id_user)
			       {        
					 if($row->rating===null)
						  { 
							  $db = DB::getConnection();

						  // Ubaci neke proizvode unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera)
						  try
						  {
							  $st = $db->prepare( 'INSERT INTO dz2_sales(id,id_product,id_user, rating,commeny) VALUES (:rating,:comment)' );
					  
							  $st->execute( array( 'rating' =>$grade , 'comment' => $comment) ); // slavko
						  }
						catch( PDOException $e ) { exit( "PDO error [dz2_products]: " . $e->getMessage() ); }
						 }
				   }
					
		  }
	  
  }

}

?>