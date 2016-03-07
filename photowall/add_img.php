<?php
error_reporting(E_ALL);
$path = "/www/photos/html/content";

if ($_SERVER['argc'] < 3)
	die("usage: add_img.php [filename] [title]\n");

$filename = $_SERVER['argv'][1];
$summary = $_SERVER['argv'][2];

$thumbfilepath = $path."/images/TN_".$filename;

$slug = preg_replace("/\.jpg$/i", "", $filename);

// copy the image into content directory
if (!copy($filename, $path."/images/".$filename))
	print "Error: couldn't copy $filename to $path/images\n";

// make the numbnail
$str = "/usr/bin/convert -define jpeg:size=300x300 $filename -thumbnail 300x300^ -gravity center -extent 300x300 $thumbfilepath";

//print "[EXEC] $str\n";

exec($str, $ret);
//var_dump($ret);

// generate the .md file
/*
Title: Banff, Canada
Date: 2015-01-24 18:13
Category: Photo
Thumbnail: TN_banff.jpg

[![Foo]({attach}images/banff.jpg)]({filename})
[![Foo]({attach}images/TN_banff.jpg)]({filename})
*/

$jpgdate = getJpgDate($filename);

$mdtext = "Title: $summary
Date: $jpgdate
Category: Photo
Thumbnail: TN_$filename

[![Foo]({attach}images/$filename)]({filename})
[![Foo]({attach}images/TN_$filename)]({filename})";

$fp = fopen($path."/".$slug.".md", "w");
fputs($fp, $mdtext, 1024);
fclose($fp);


function getJpgDate($filepath)
{
	$exif = exif_read_data($filepath);

	$datestr = $exif['DateTimeOriginal'];
	$bits = explode(" ", $datestr);
	$date = str_replace(":", "-", $bits[0]);
	$time = $bits[1];
	$newdatestr = $date." ".$time;

	return $newdatestr;
}
