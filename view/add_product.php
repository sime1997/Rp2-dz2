<?php require_once __DIR__ . '/_header.php';
 
?>
<ul>

<li><a href="index.php?rt=users/listOfProducts">My products</a></li>
<li><a href="index.php?rt=products/">Add a new product</a></li>
<li><a href="index.php?rt=users/purchase">Shopping history</a></li>
<li><a href="index.php?rt=products/search">Search</a></li>
<li><a href="index.php?rt=users/logout">Logout</a></li>

</ul>

<form action="index.php?rt=products/add" method="post">
        <label for="">Which product:</label>		
		<input type="text" name="product" id="product" value="" />
         
         
        <label for="">Description:</label>		
		<input type="text" name="description" id="description" value="" />

        <label for="">Price:</label>		
		<input type="text" name="price" id="price" value="" />

		
	  <button type="submit">Ulogiraj se!</button>
</form>


<?php require_once __DIR__ . '/_footer.php';
 
?>