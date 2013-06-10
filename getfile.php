<?php
error_reporting(E_ALL);

if(isset($_POST['id'])) {
	$type=$_POST['type'];
    $acc=$_POST['id'];
    $len=$_POST['len'];
    $lenm=$_POST['lenm'];
    $multi2=preg_replace('/\s/',',',$acc);
    $multi=preg_replace('/\s/','',$multi2); 
    //'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=nucleotide&id=3KZ2_B,3U7I_C,AER70130.1&rettype=fasta';
    $accurl='http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=nucleotide&id='.$multi.'&rettype=gb';
    //NC_018750
    $filen=$acc.'-'.$type.'.fasta';
    $accdata=file_get_contents($accurl);
    writefile ($accdata,$filen);
    doanalysis ($filen,$type,$accurl,$len,$lenm);
    //echo "done!";
} 

if(isset($_POST['up'])) {
	$type=$_POST['type'];
	$len=$_POST['len'];
	$lenm=$_POST['lenm'];

    //NC_018750
    $accurl="No need !";
    $filen=$_POST['up'];   
    doanalysis ($filen,$type,$accurl,$len,$lenm);
    //echo "done!";
} 

function writefile ($data,$name){
	$fileread=fopen('files/'.$name,'w+');
	fwrite($fileread,$data);
	fclose($fileread);
	// echo $name;
}

function doanalysis ($name,$type,$url,$len,$lenm) {
	$command='python runme2.py files/'.$name.' '.$len.' '.$type.' '.$lenm;
	exec('python runme2.py files/'.$name.' '.$len.' '.$type.' '.$lenm);
	echo $name.' --- '.$url.' --- '.$command;
	//echo $url;
}

if(isset($_POST['get'])) {
	$name=$_POST['name'];
	$type=$_POST['type'];
	$filen=$name.'-'.$type.'.fasta';
$data=file_get_contents('files/'.$filen);
echo $data;
}

?>