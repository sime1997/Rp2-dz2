<?php

require_once __DIR__ .'/../model/ebuyservise.class.php';



class UsersController{

public function listOfProducts()///dohvati id
    { $es=new EbuyService();
      $arr=array();
        $id=$es->getId($_SESSION['login']); ///pronadjemo sve proizvode td. id_user=id;
        $arr=$es->getProducts($id);
        $title='lista';
      require_once __DIR__.'/../view/products_list.php';
    }
public function check()///ovdje provjeravamo imamo li korisnika
   { $es=new EbuyService();
        
	    
       if($es->checkUser($_POST['username'],$_POST['pass'])) 
           {
            $_SESSION['login'] =$_POST['username'];
            $_SESSION['id']=$es->getId($_POST['username']);                                       ///treba zapamtiti i id;
            header('Location:index.php?rt=users/success');
            }
       else
           {
            header( 'Location: index.php');
           }
   
    }
public function success()///trebamo ga preusmjeriti na listu
	{
    
	$title="ebuy";
    
    require_once __DIR__.'/../view/_menu.php';
    }

public function logout()
   {
     session_unset();
     header( 'Location: index.php');
   }

public function purchase()
    {
      $es=new EbuyService();
      $arr=$es->getUsersSales($_SESSION['id']);
      $arr_products=[];

     foreach($arr as $row)
         {
          array_push($arr_products,$es->getProductById($row->id_product));
         }
      $title="History";
      require_once __DIR__.'/../view/_history.php';
    }
  }
?>