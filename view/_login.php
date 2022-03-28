<?php require_once __DIR__ . '/_header.php';
 
?>


<form action="index.php?rt=users/check" method="post">
        <label for="">Korisničko ime:</label>		
		<input type="text" name="username" id="username" value="" />
         
         
        <label for="">Lozinka:</label>		
		<input type="password" name="pass" id="pass" value="" />

		
	  <button type="submit">Ulogiraj se!</button>
</form>

<?php

require_once __DIR__ . '/_footer.php'; ?>