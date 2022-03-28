<?php require_once __DIR__ . '/_header.php';
 
?>
<ul>

<li><a href="index.php?rt=users/listOfProducts">My products</a></li>
<li><a href="index.php?rt=products/">Add a new product</a></li>
<li><a href="index.php?rt=users/purchase">Shopping history</a></li>
<li><a href="index.php?rt=products/search">Search</a></li>
<li><a href="index.php?rt=users/logout">Logout</a></li>

</ul>
   <?php 
		foreach( $arr as $row )
		{
		 ?>
		
		Name:<?php	echo nl2br("$row->name\n");?>
		Price:<?php	echo nl2br("$row->price\n");?>
        Description:<?php echo nl2br("$row->description\n");?>
		
		<form method="POST" action="index.php?rt=products/comments">
           <input type="hidden" name="id" value=<?php echo "$row->id" ?> />
           <input type="submit" value="Comments" />
        </form>

  <?php }
        ?>

<?php
require_once __DIR__ . '/_footer.php'; ?>