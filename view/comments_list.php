<?php require_once __DIR__ . '/_header.php';


		foreach( $arr as $row )
		if($row->comment!=null)
		{$user=$es->getUsername($row->id_user);
		echo nl2br("$user"); 
		echo nl2br(":\n");
		echo nl2br("$row->comment\n");
		}
 require_once __DIR__ . '/_footer.php'; ?>
