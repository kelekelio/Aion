var player = new Player(
<?php
$d = array();
$files = glob('audio/*.mp3');
if( $files ) { 
    $filecount = count($files); 
} 


$random = array();
for ($i = 0; $i < 20; $i++) {
    $random[$i] = rand(0,$filecount);
}

$i = 0;
$y = 0;



foreach ($files as $filename) {
	
	$p = pathinfo($filename);
	
	
	if (in_array($i, $random)) {
		
		if ($y == 0) {
			array_push($d, array('title' => $p['filename'],'file' => $p['filename'], 'autoplay' => 'true', 'howl' => 'null'));
			$y++;
		}else {
			array_push($d, array('title' => $p['filename'],'file' => $p['filename'],'howl' => 'null'));
		}
	}
	
	$i++;
}

//$d = array(array('title' => 'idunderpass_b1_q-01','file' => 'idunderpass_b1_q-01','howl' => 'null'), array('title' => 'idunderpass_b1_q-01','file' => 'idunderpass_b1_q-01','howl' => 'null'));

array_walk_recursive($d, function(&$item, $key) {
    if ($item == 'null') $item = NULL;
	if ($item == 'true') $item = true;
});

echo json_encode($d); 
?>
);