<?php
require_once __DIR__ .'/../model/ebuyservise.class.php';


class ProductsController{

function index()///dodaj artikl od pojedinog korisnika
         {
          
          require_once __DIR__.'/../view/add_product.php'; 
          }
function comments()///ovdje cemo izvuci komentare;
         { $es=new EbuyService();
            $arr=array();
        $arr=$es->getSale($_POST['id']);
        require_once __DIR__.'/../view/comments_list.php'; 
         }

function add()///
      { $es=new EbuyService();
          $es->addNewProduct($_SESSION['id'],$_POST['product'],$_POST['description'],$_POST['price']);
         
          require_once __DIR__.'/../view/_menu.php';
      }
        
function search()
      {
        $title="Search product:";
        require_once __DIR__.'/../view/_search.php';
        
      }
function searchResults()
      {$es=new EbuyService();
       
        $arr=$es->searchProduct($_POST['search']);
       require_once __DIR__.'/../view/search_results.php';
      }
    
function buy()
    {
     $es=new EbuyService();
     $arr=$es->getProducts($_SESSION['id']);///provjeri prodaje li ga ili ga je vec kupio
     $control=1;
     foreach($arr as $row)
        {
          if($row->id===$_POST['id'])
                $control=0;

        }
     
     $arr=$es->getUsersSales($_SESSION['id']);
     
     foreach($arr as $row)
     {
       if($row->id_product===$_POST['id'])
                $control=0;
     }
    
     if($control)///e sad ga moze kupiti :(
            {
                $es->addNewSale($_POST['id'],$_SESSION['id']);
               
                require_once __DIR__.'/../view/bought_successfully.php';
            }
      else
          { 
            require_once __DIR__.'/../view/already_exists.php';  
          }
    }
function rate()
   {$es=new EbuyService();
    $es->addGradeAndComment($_POST['id'],$_SESSION['id'],$_POST['rate_grade'],$_POST['rate_comment']);
    require_once __DIR__.'/../view/_menu.php';
   }
}
?>