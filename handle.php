<?php

// ech
// file_put_contents("db.txt", "");
$currentModif = filemtime("db.txt");
$time=time();
// echo $currentModif;
// jezeli plik zapisany przed chwilą
while(time() - $currentModif <= 10){
	// sprawdzam ewentualą zmianę w bazie/memcache/itp
    $data=file_get_contents("db.txt");
    // echo $data;
	if(!empty($data)){
		echo $data;
        $fh = fopen("db.txt",'w');
        // echo "jest data";
        // file_put_contents("db.txt", "");
		break;
	}
	usleep(1000);
}
?>