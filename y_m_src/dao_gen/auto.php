<?php

function artistAdd ($num=1) 
{
	$request = "http://localhost/dev/yahoo_music/dev/artist.php";
//	$request = "http://p1.osp.hki.yahoo.com/admin/artist.php";
	
	for ($index = 0; $index <= $num; $index++) 
	{
		$artistcode = "artistcode".mt_rand(99999,10000000);
		$artistname = "artistname".mt_rand(99999,10000000);
		$artistname_eng = "artistname_eng".mt_rand(99999,10000000);
		$initial = chr( mt_rand(ord('a'),ord('z')) );
		$postargs = "act=AddSubmit&artistcode={$artistcode}&artistname={$artistname}&artistname_eng={$artistname_eng}&initial={$initial}";
		
		doPost($request,$postargs);
	}
	
	echo "success submit {$num} request ";
}

function doPost ($request="",$postargs="") 
{
	$session = curl_init($request);
	curl_setopt ($session, CURLOPT_POST, true);
	curl_setopt ($session, CURLOPT_POSTFIELDS, $postargs);
	curl_setopt($session, CURLOPT_HEADER, false);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($session);
	curl_close($session);
}

artistAdd (50);


?>
