<?php
$types = array(1 => 'gif', 'jpeg', 'png', 'swf', 'psd', 'wbmp');
$url = WWW_ROOT . 'uploads' . DS . $this->params['pass'][0];
$fit = false;
/*
var_dump($this->response);
die();
*/
if (file_exists($url)) {
	$exists = true;
	$size = getimagesize($url);
} else {
	$exists = false;
	$size = array(
		200, 150, 3,
		'mime' => 'image/png'
	);
}

if (!empty($this->params['named']['width'])) {
	$bolWidth = true;
	$width = $this->params['named']['width'];
} else {
	$bolWidth = false;
	$width = $size[0];
}

if (!empty($this->params['named']['height'])) {
	$bolHeight = true;
	$height = $this->params['named']['height'];
} else {
	$bolHeight = false;
	$height = $size[1];
}

if ((!empty($this->params['named']['crop'])) && ($this->params['named']['crop'] == "true")) {
	$crop = "crop";
	$ratio = $size[0] / $size[1];
	if ($bolWidth && !$bolHeight) {
		$height = $width / $ratio;
	}
	if ($bolHeight && !$bolWidth) {
		$width = $height * $ratio;
	}
	$srcWidth = $width;
	$srcHeight = $height;
	if (isset($this->params['named']['top'])) {
		$top = $this->params['named']['top'];
	} else {
		$top = ($size[1] - $height) / 2;
	}
	if (isset($this->params['named']['left'])) {
		$left = $this->params['named']['left'];
	} else {
		$left = ($size[0] - $width) / 2;
	}
} else {
	$crop = "nocrop";
	$top = 0;
	$left = 0;
	$srcWidth = $size[0];
	$srcHeight = $size[1];
	$ratio = $srcWidth / $srcHeight;
	if (($srcHeight / $height) > ($srcWidth / $width)) { 
		$width = ceil($height * $ratio); 
	} else {
		$height = ceil($width / $ratio);
	}
}

$cacheFilename = CACHE . 'thumbnails' . DS . $width . "x" . $height . "_" . $top . "_" . $left . "_" . $crop . "_" ;

if(!empty($this->params['named']['color'])) {
	$cacheFilename.='color_'.str_replace(',','',$this->params['named']['color']).'_';
}

if(!empty($this->params['named']['greyscale'])) {
	$cacheFilename.='greyscale_';
}

if(!empty($this->params['named']['sepia'])) {
	$cacheFilename.='sepia_';
}

if(!empty($this->params['named']['blur'])) {
	$cacheFilename.='blur_'.$this->params['named']['blur'].'_';
}

if(!empty($this->params['named']['smooth'])) {
	$cacheFilename.='smooth_'.$this->params['named']['smooth'].'_';
}

if(!empty($this->params['named']['invert'])) {
	$cacheFilename.='invert_';
}

if(!empty($this->params['named']['brightness'])) {
	$cacheFilename.='bright_'.$this->params['named']['brightness'].'_';
}

$cacheFilename.=basename($url);

if (file_exists($cacheFilename)) {
	$csize = getimagesize($cacheFilename);
	$cached = ($csize[0] == $width && $csize[1] == $height); // image is cached 
	if (@filemtime($cacheFilename) < @filemtime($url)) {
		// check if up to date 
		$cached = false;
	}
} else {
	$cached = false;
}

if ((!empty($this->params['named']['nocache'])) && ($this->params['named']['nocache'] == "true")) {
	$cached = false;
}
/* $cached = false; */
if (!$cached) {
	ini_set('memory_limit', '100M');
	if ($exists) {
		$image = call_user_func('imagecreatefrom' . $types[$size[2]], $url);
		if (!empty($this->params['named']['zoom'])) {
			$rgb = array(255,255,255);
			switch($this->params['named']['zoom']) {
				case "auto":
					$cropratio = $width / $height;
					$imageratio = $size[0] / $size[1];
				
					if($cropratio < $imageratio) {
						$zoom = $height;
						$zoomratio = $zoom / $size[1];
						$zoom_height = $zoom;
						$zoom_width = $zoomratio * $size[0];
					} else {
						$zoom = $width;
						$zoomratio = $zoom / $size[0];
						$zoom_width = $zoom;
						$zoom_height = $zoomratio * $size[1];
					}
					break;
				case "fit":
					$fit = true;
					$cropratio = $width / $height;
					$imageratio = $size[0] / $size[1];

					if($cropratio > $imageratio) {
						$zoom = $height;
						$zoomratio = $zoom / $size[1];
						$zoom_height = $zoom;
						$zoom_width = $zoomratio * $size[0];
						$bgwidth = ceil(($width - $zoom_width)/2);
						$bgheight = $height;
						$vertical = true;
					} else {
						$zoom = $width;
						$zoomratio = $zoom / $size[0];
						$zoom_width = $zoom;
						$zoom_height = $zoomratio * $size[1];
						$bgwidth = $width;
						$bgheight = ceil(($height - $zoom_height)/2);
						$vertical = false;
					}
					if(!empty($this->params['named']['background'])) {
						$rgb = html2rgb($this->params['named']['background']);
					}
					break;
				default:
					$zoom = (int)$this->params['named']['zoom'];
					$zoomratio = $zoom / $size[0];
					$zoom_width = $zoom;
					$zoom_height = $zoomratio * $size[1];
					break;
			}

			$zoom_image = imagecreatetruecolor($zoom_width,$zoom_height);
			
			imagealphablending( $zoom_image, false );
			imagesavealpha( $zoom_image, true );
			//imagegammacorrect($image, 2.2, 1.0);
			imagecopyresampled($zoom_image,$image,0,0,0,0,$zoom_width,$zoom_height,$size[0],$size[1]);
			//imagegammacorrect($zoom_image, 1.0, 2.2);
			imagedestroy($image);
			$image = $zoom_image;
			if (!isset($this->params['named']['top'])) {
				$top = ($zoom_height - $height) / 2;
			}
			if (!isset($this->params['named']['left'])) {
				$left = ($zoom_width - $width) / 2;
			}
		}
	} else {
		$image = imagecreatetruecolor(300, 150);
		$white = imagecolorallocate($image, 255, 255, 255);
		$grey = imagecolorallocate($image, 128, 128, 128);
		$black = imagecolorallocate($image, 0, 0, 0);

		imagefilledrectangle($image, 0, 0, 300, 150, $grey);
		imagestring($image, 3, 37, 70, "File doesn't exist", $white);
	}

	$temp = imagecreatetruecolor($width, $height);
	
	imagealphablending( $temp, false );
	imagesavealpha( $temp, true );
	//imagegammacorrect($image, 2.2, 1.0);
	imagecopyresampled($temp, $image, 0, 0, $left, $top, $width, $height, $srcWidth, $srcHeight);
	//imagegammacorrect($temp, 1.0, 2.2);
	if($fit) {
		$color = imagecolorallocate($temp, $rgb[0], $rgb[1], $rgb[2]);
		if($vertical) {
			imagefilledrectangle($temp, 0, 0, $bgwidth, $bgheight, $color);
			imagefilledrectangle($temp, $width-$bgwidth, 0, $width, $bgheight, $color);
		} else {
			imagefilledrectangle($temp, 0, 0, $bgwidth, $bgheight, $color);
			imagefilledrectangle($temp, 0, $height-$bgheight, $bgwidth, $height, $color);
		}
		
	}
	
	if(!empty($this->params['named']['sepia'])) {
		imagefilter($temp, IMG_FILTER_GRAYSCALE);
		imagefilter($temp, IMG_FILTER_COLORIZE, 90,60,40);
	}
	
	if(!empty($this->params['named']['color'])) {
		$color = explode('-', $this->params['named']['color']);
		imagefilter($temp, IMG_FILTER_GRAYSCALE);
		imagefilter($temp, IMG_FILTER_COLORIZE, $color[0],$color[1],$color[2]);
	}
	
	if(!empty($this->params['named']['greyscale'])) {
		imagefilter($temp, IMG_FILTER_GRAYSCALE);
	}
	
	if(!empty($this->params['named']['invert'])) {
		imagefilter($temp, IMG_FILTER_NEGATE);
	}
	
	if(!empty($this->params['named']['blur'])) {
		imagefilter($temp, IMG_FILTER_GAUSSIAN_BLUR);
	}
	
	if(!empty($this->params['named']['smooth'])) {
		imagefilter($temp, IMG_FILTER_SMOOTH, $this->params['named']['smooth']);
	}

	if(!empty($this->params['named']['brightness'])) {
		imagefilter($temp, IMG_FILTER_BRIGHTNESS, $this->params['named']['brightness']);
	}
	
	if(!empty($this->params['named']['contrast'])) {
		imagefilter($temp, IMG_FILTER_CONTRAST, $this->params['named']['contrast']);
	}
	
	if (!empty($this->params['named']['overlay'])) {
		$watermark_file = WWW_ROOT . 'img' . DS . $this->params['named']['overlay'];
		if(file_exists($watermark_file)) {
			$watermark = imagecreatefrompng($watermark_file);
			$watermark_width = imagesx($watermark);  
			$watermark_height = imagesy($watermark);
			imagealphablending($temp,true);
			$watermark_top = !empty($this->params['named']['overlaytop'])?$this->params['named']['overlaytop']:0;
			$watermark_left = !empty($this->params['named']['overlayleft'])?$this->params['named']['overlayleft']:0;
			imagecopy($temp, $watermark, $watermark_left, $watermark_top, 0, 0, $watermark_width, $watermark_height);
			imagedestroy($watermark);
		}
	}
	
	if($types[$size[2]]=="jpeg") {
		call_user_func('image' . $types[$size[2]], $temp, $cacheFilename,90);
	} else {
		call_user_func('image' . $types[$size[2]], $temp, $cacheFilename);
	}
	imagedestroy($temp);
	imagedestroy($image);
}
$data = file_get_contents($cacheFilename);
$etag = md5($data);
$lastModified = gmdate('D, d M Y H:i:s', filemtime($url)) . ' GMT';
header("Last-Modified: $lastModified");
header("Cache-Control: must-revalidate, max-age=604800");
header("Vary: Accept-Encoding");
header("ETag: \"{$etag}\"");
checkCached($etag, $lastModified);
header('Content-Type: ' . $size['mime']);
$this->response->type($size['mime']);
header('Content-Length: ' . filesize($cacheFilename));
header('Content-disposition: inline; filename="'.$cacheFilename.'"');
/* $cache = fopen($cacheFilename, 'r'); */
/* fpassthru($cache); */
/* fclose($cache);  */
echo $data;
function checkCached($etag, $lastModified) {
	$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ?
		stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) :
		false;

	$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ?
		stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) :
		false;

	if (!$if_modified_since && !$if_none_match) {
		header('Tony: '.json_encode($_SERVER));
		return;
	}

	if ($if_none_match && $if_none_match != $etag && $if_none_match != '"' . $etag . '"') {
		header('Tony: two');
		return;
	}// etag is there but doesn't match

	if ($if_modified_since && $if_modified_since != $lastModified) {
		header('Tony: three');
		return;
	}// if-modified-since is there but doesn't match

	// Nothing has changed since their last request - serve a 304 and exit
	header('HTTP/1.1 304 Not Modified');
	exit();
}
function html2rgb($color)
{
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}
?>