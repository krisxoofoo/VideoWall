<?php
/*
	VideoWall Web Gallery by kris - http://www.xoofoo.org
	Based on Pagemap Premium Portfolios (http://getpagemap.com/pagemap-imagewall/).
	All Rights reserved.
*/
/* add little cache - credits: Rafael Paulino - http://www.phpclasses.org/package/5595-PHP-Cache-the-output-of-pages-into-files.html */
class cache {
	public $cache_file_name;
	public $age;
	public function __construct(){
		$this->cache_start();
		register_shutdown_function(array($this, "cache_end"), "inside");
	}
	public function __descruct(){
		$this->cache_end();
	}
	public function cache_start(){
		global $cache_file_name, $age;
		$cache_file_name = 	$_SERVER["DOCUMENT_ROOT"].$_SERVER['REQUEST_URI'] . '_cache';
		if (empty($age)){
			$age = 600;
		}
		if(file_exists($cache_file_name)){
			if (filemtime($cache_file_name) + $age > time()) {
				readfile($cache_file_name);
				unset($cache_file_name);
				exit;
			}
		}
		ob_start();
	}
	public function cache_end()
	{
		global $cache_file_name;
		if (empty($cache_file_name)){
			return;
		}
		$str = ob_get_clean();
		echo $str;
		fwrite(fopen($cache_file_name . '_tmp', "w"), $str);
		rename($cache_file_name . '_tmp',$cache_file_name);
	}
}
//$cache = new cache();
// SCRIPT
error_reporting(0);
// SETTINGS
global $set; if(empty($set)) $set = array();
$set['script version'] = '1.0';
$set['script name'] = empty($set['script name']) ? $_SERVER['SCRIPT_NAME'] : $set['script name'];
$set['script dir'] = empty($set['script dir']) ? './' : $set['script dir'];
//$set['cache dir'] = 'cache/';
$set['config file'] = $set['script dir'] . 'config.ini';
//$set['fallback image size'] = 800;
$set['color names'] = array('aliceblue' => '#f0f8ff', 'antiquewhite' => '#faebd7', 'aqua' => '#00ffff', 'aquamarine' => '#7fffd4', 'azure' => '#f0ffff', 'beige' => '#f5f5dc', 'bisque' => '#ffe4c4', 'black' => '#000000', 'blanchedalmond' => '#ffebcd', 'blue' => '#0000ff', 'blueviolet' => '#8a2be2', 'brown' => '#a52a2a', 'burlywood' =>  '#deb887', 'cadetblue' => '#5f9ea0', 'chartreuse' => '#7fff00', 'chocolate' => '#d2691e', 'coral' => '#ff7f50', 'cornflowerblue' => '#6495ed', 'cornsilk' => '#fff8dc', 'crimson' => '#dc143c', 'cyan' => '#00ffff', 'darkblue' => '#00008b', 'darkcyan' => '#008b8b', 'darkgoldenrod' => '#b8860b', 'darkgray' => '#a9a9a9', 'darkgreen' => '#006400', 'darkkhaki' => '#bdb76b', 'darkmagenta' => '#8b008b', 'darkolivegreen' => '#556b2f', 'darkorange' => '#ff8c00', 'darkorchid' => '#9932cc', 'darkred' => '#8b0000', 'darksalmon' => '#e9967a', 'darkseagreen' => '#8fbc8f', 'darkslateblue' => '#483d8b', 'darkslategray' => '#2f4f4f', 'darkturquoise' => '#00ced1', 'darkviolet' => '#9400d3', 'deeppink' => '#ff1493', 'deepskyblue' => '#00bfff', 'dimgray' => '#696969', 'dodgerblue' => '#1e90ff', 'firebrick' => '#b22222', 'floralwhite' => '#fffaf0', 'forestgreen' => '#228b22', 'fuchsia' => '#ff00ff', 'gainsboro' => '#dcdcdc', 'ghostwhite' => '#f8f8ff', 'gold' => '#ffd700', 'goldenrod' => '#daa520', 'gray' => '#808080', 'green' => '#008000', 'greenyellow' => '#adff2f', 'honeydew' => '#f0fff0', 'hotpink' => '#ff69b4', 'indianred ' => '#cd5c5c', 'indigo ' => '#4b0082', 'ivory' => '#fffff0', 'khaki' => '#f0e68c', 'lavender' => '#e6e6fa', 'lavenderblush' => '#fff0f5', 'lawngreen' => '#7cfc00', 'lemonchiffon' => '#fffacd', 'lightblue' => '#add8e6', 'lightcoral' => '#f08080', 'lightcyan' => '#e0ffff', 'lightgoldenrodyellow' => '#fafad2', 'lightgrey' => '#d3d3d3', 'lightgreen' => '#90ee90', 'lightpink' => '#ffb6c1', 'lightsalmon' => '#ffa07a', 'lightseagreen' => '#20b2aa', 'lightskyblue' => '#87cefa', 'lightslategray' => '#778899', 'lightsteelblue' => '#b0c4de', 'lightyellow' => '#ffffe0', 'lime' => '#00ff00', 'limegreen' => '#32cd32', 'linen' => '#faf0e6', 'magenta' => '#ff00ff', 'maroon' => '#800000', 'mediumaquamarine' => '#66cdaa', 'mediumblue' => '#0000cd', 'mediumorchid' => '#ba55d3', 'mediumpurple' => '#9370d8', 'mediumseagreen' => '#3cb371', 'mediumslateblue' => '#7b68ee', 'mediumspringgreen' => '#00fa9a', 'mediumturquoise' => '#48d1cc', 'mediumvioletred' => '#c71585', 'midnightblue' => '#191970', 'mintcream' => '#f5fffa', 'mistyrose' => '#ffe4e1', 'moccasin' => '#ffe4b5', 'navajowhite' => '#ffdead', 'navy' => '#000080', 'oldlace' => '#fdf5e6', 'olive' => '#808000', 'olivedrab' => '#6b8e23', 'orange' => '#ffa500', 'orangered' => '#ff4500', 'orchid' => '#da70d6', 'palegoldenrod' => '#eee8aa', 'palegreen' => '#98fb98', 'paleturquoise' => '#afeeee', 'palevioletred' => '#d87093', 'papayawhip' => '#ffefd5', 'peachpuff' => '#ffdab9', 'peru' => '#cd853f', 'pink' => '#ffc0cb', 'plum' => '#dda0dd', 'powderblue' => '#b0e0e6', 'purple' => '#800080', 'red' => '#ff0000', 'rosybrown' => '#bc8f8f', 'royalblue' => '#4169e1', 'saddlebrown' => '#8b4513', 'salmon' => '#fa8072', 'sandybrown' => '#f4a460', 'seagreen' =>  '#2e8b57', 'seashell' => '#fff5ee', 'sienna' => '#a0522d', 'silver' => '#c0c0c0', 'skyblue' => '#87ceeb', 'slateblue' => '#6a5acd', 'slategray' => '#708090', 'snow' => '#fffafa', 'springgreen' => '#00ff7f', 'steelblue' => '#4682b4', 'tan' => '#d2b48c', 'teal' => '#008080', 'thistle' => '#d8bfd8', 'tomato' => '#ff6347', 'turquoise' => '#40e0d0', 'violet' => '#ee82ee', 'wheat' => '#f5deb3', 'white' => '#ffffff', 'whitesmoke' => '#f5f5f5', 'yellow' => '#ffff00', 'yellowgreen' => '#9acd32');
// GET CONFIG
$config = array();
$config['Author'] = '';
$config['Channel Title'] = 'My Video Wall';
$config['Channel Description'] = 'VideoWall by XooFoo';
$config['Meta Keywords'] = 'gallery, video, youtube, holidays';
//$config['Thumbnail Cropped'] = 'on';
//$config['Thumbnail Quality'] = 80;
//$config['Thumbnail Size'] = 'normal';
$config['Thumbnail Background'] = 'black';
$config['Embedded Script'] = 'off';
$config['Other JS'] = '';
$config['ChannelWall Width'] = '900px';
$config['Header Image'] = '';
$config['Background'] = 'white';
$config['Header Color'] = 'silver';
$config['Content Color'] = 'black';
$config['Footer Color'] = 'silver';
$config['Custom CSS'] = '';
$config['Custom FileCSS'] = '';
$config['Custom HTML'] = '';
$config['Home Page'] = 'localhost';
$config['Contact'] = '';
$config['Imprint'] = '';
//$config['Videos List'] = '';
$config['Disqus Shortname'] = '';
$config['GoogleAnalytics Account'] = '';
$config['Per Page'] = '24';
$set['image overlay'] = 'R0lGODlhIAAgAJEAAAAAADMzMyEhIQAAACH5BAQUAP8ALAAAAAAgACAAAAJvTACGmtfrGBMCUVvB1Xn7DIXPKEUmhnLptwql+JKnSrN1hyPwHPeODczdfLviKNhK0oxEmQh5U1Ka1Bn0KmTytk8htlXVdqXess6JDkfXWLX6y86muXOyfUh3/8xxpbiOBteWRzjWd7jxp3cnKFAAADs=';


// VIDEOS list
$videos = array();
$i = 0;
$videos[$i] = array('SaVvwHGRt68','Présentation de mods ep 1');
$i++;
$videos[$i] = array('6MEb3UDYn1c','Visite du serveur FerdiCraft - partie 1');
$i++;
$videos[$i] = array('be9hfvL4jUQ','too many items pour les nuls');
$i++;
$videos[$i] = array('be9hfvL4jUQ','too many items pour les nuls');
$i++;
$videos[$i] = array('be9hfvL4jUQ','too many items pour les nuls');

// SET CONFIG
if(is_file($set['config file']) && is_readable($set['config file'])) {
	// Get config from Config File
	$set['config file contents'] =  file_get_contents($set['config file']);
	preg_match_all("/\[(.*):(.*)\]/U", $set['config file contents'], $set['config file variables']);
	foreach($set['config file variables'][1] as $position => $variable) if(!empty($variable))
		$config[trim($variable)] = isset($set['config file variables'][2][$position]) ? trim($set['config file variables'][2][$position]) : '';
} elseif(is_writeable($set['script dir'])) {
	// Create Config File if not exists
	$set['open config file'] = fopen($set['config file'], 'w');
	foreach($config as $variable => $value) fwrite($set['open config file'], '[' . $variable . ': ' . $value . ']' . "\r\n");
}
// FUNCTIONS
function p_encodeEmail($string) {
	$emails = array();
	preg_match_all('/\w[-._\w]*\w@\w[-._\w]*\w\.\w{2,6}/i', $string, $emails);
	foreach((array) $emails[0] as $email) {
		$encoded_string = '';
		$arrCharacters = str_split($email);
		foreach ($arrCharacters as $strCharacter)
			$encoded_string .= sprintf('&#%s;', ord($strCharacter));
		$string = str_replace($email, $encoded_string, $string);
	}
	return str_replace('mailto:', '&#109;&#97;&#105;&#108;&#116;&#111;&#58;', $string);
}
function p_addHTTP($url) { return !empty($url) && substr($url, 0, 7) != 'http://' ? 'http://' . $url : $url;}

function p_html2rgb($color) {
	if($color[0] == '#') $color = substr($color, 1);
	if(strlen($color) == 6) list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
		elseif(strlen($color) == 3) list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
	else return false;
	$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
	return array($r, $g, $b);
}
/* add page navigation - credits: V Song - https://code.google.com/p/pagemap-imagewall-enhance/ */
function mulit($count, $page, $perpage) {
	global $dir;
	$last = $allpage = ceil($count / $perpage);
	if ($page > $allpage) {
		$page = $allpage;    
	}
	if ($allpage == 0) {
		return false;    
	}
	$i = 1;
	$pager = "<nav id='mulit'><a rel='tooltip' href='?dir=$dir&page=1' title='First page'><em>First</em></a>";
	while($allpage) {
		$class = '';
		if ($i == $page) {
			$class = 'class = "current"'; 
		}
		if ($dir) {
			$pager .= "<a href='?dir=$dir&page=$i' ><em $class>";
		} else {
			$pager .= "<a rel='tooltip' href='?page=$i' title='Go to page $i'><em $class>";    
		}
		$pager .= "$i";
		$pager .= "</em></a>";
		$i ++;
		$allpage --;
	}
	$next = $page + 1;
	$pager .= "<a rel='tooltip' href='?dir=$dir&page=$last' title='Last page'><em>Last</em></a>";
	$pager .= "<a rel='tooltip' href='?dir=$dir&page=$next' title='Next page'><em>NEXT</em></a></nav>";
	return $pager;
}
// Convert Contact
$config['Contact'] = strpos($config['Contact'], '@') === false
	? p_addHTTP($config['Contact'])
	: p_encodeEmail('mailto:' . $config['Contact']);
// Validate URL's
$config['Home Page'] = p_addHTTP($config['Home Page']);
$config['Imprint'] = p_addHTTP($config['Imprint']);
// Thumbnail Background Color
if(isset($set['color names'][strtolower($config['Thumbnail Background'])])) $config['Thumbnail Background'] = $set['color names'][strtolower($config['Thumbnail Background'])];
$config['Thumbnail Background'] = p_html2rgb($config['Thumbnail Background']) ? p_html2rgb($config['Thumbnail Background']) : array(0, 0, 0);
// Custom HTML
if(!empty($config['Custom HTML']) && is_file($config['Custom HTML'])) $config['Custom HTML'] = file_get_contents($config['Custom HTML']);
// Layout files
if(isset($_GET['symbol'])) {
	header('content-type: image/gif');
	$set['symbol name'] = 'image ' . $_GET['symbol'];
	if(isset($set[$set['symbol name']])) echo base64_decode($set[$set['symbol name']]);
	exit();
}
// Set Page
$page = max(1, intval($_GET['page']));
$allpage = ceil(count($videos) / $config['Per Page']);
if ($page > $allpage) {
	$page = $allpage;    
}
$start = ($page - 1) * $config['Per Page'];
$mulit = mulit(count($videos), $page, $config['Per Page']);
$videos = array_slice($videos, $start, $config['Per Page']);
// Send header
if($config['Embedded Script'] == 'off' || headers_sent() == false) header('content-type: text/html; charset=utf-8');
?>
<?php if($config['Embedded Script'] == 'off') { ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="author" content="<?php echo strip_tags($config['Author']); ?>" />
	<meta name="description" content="<?php echo strip_tags($config['Channel Description']); ?>" />
	<meta name="generator" content="VideoWall" />
	<meta name="keywords" content="<?php echo strip_tags($config['Meta Keywords']); ?>">
	<meta name="robots" content="all" />
	<title><?php echo strip_tags($config['Channel Title']); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
	<link rel="start" title="Home Page" href="<?php echo $config['Home Page']; ?>" />
	<link rel="help" title="VideoWall Channel" href="https://github.com/krisxoofoo/VideoWall/" />
	<style type="text/css">
		* { margin:0;padding:0;border:0;}
		html { height: 100%;}
		img {max-width: 100%;}
		body { margin: 15px 25px; background: <?php echo $config['Background']; ?>; text-align: center; font: 12px 'Trebuchet MS', Arial, Helvetica, sans-serif; color: <?php echo $config['Content Color']; ?>; }
		header h1 {margin: 20px 20px 30px 20px;text-align: center;}
		header h1 span {line-height:24px;font-size: 24px;display: block; padding-top:20px; font-weight: 400;text-shadow: 0 1px 1px #fff;text-decoration: none;color: <?php echo $config['Header Color']; ?>;}
		header h1 span a { text-decoration: none;color: <?php echo $config['Header Color']; ?>;}
		footer {clear:both; margin-top: 15px; margin-bottom: 25px;height:80px;font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size: 11px; font-style: italic; text-align:center; line-height:1.6em; }
		footer nav {font-size: 14px; padding: .5em 0; font-style: normal;}
		footer, footer a { text-decoration: none; color: <?php echo $config['Footer Color']; ?>; }
	</style>
<?php } ?>
	<style type="text/css">
		/* GALLERY */
		.mfp-bg { background: #0b0b0b url('<?php echo $set['script name']; ?>?symbol=overlay') repeat !important; }
		#imagewall { max-width: <?php echo $config['ChannelWall Width']; ?>; margin: 0 auto; text-align: center; line-height: 0; font-size: 0; }
		#imagewall a, #imagewall a:hover {color:#999;text-decoration:none;}
		
		.popup-gallery ul { list-style:none;}
		
		.figure {float:left; display: inline;font-size: 12px; line-height: 1.4;text-align: center; margin:1.5em;}
		.figure img {-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); display: block;margin: 0 auto 1em; width:260px; height:145px;}
		.figure img:hover { opacity:.5;cursor: pointer;cursor: -webkit-zoom-in;cursor: -moz-zoom-in;cursor: zoom-in; }

		#mulit {clear:both; font-size:12px;text-align:center;padding: 20px 0 10px 0;margin: 10px 0 10px 0;}
		#mulit li {list-style:none;}
		#mulit em {border: solid 1px #ccc;padding: 2px 7px;margin: 0 3px 0 0;}
		#mulit .current {border: solid 1px #7dc0d1;color:#7dc0d1;}
	</style>
	<link rel="stylesheet" href="css/magnific-popup.css" />
	<link rel="stylesheet" href="css/zepto-tooltip.css" />
	<?php if(!empty($config['Custom FileCSS'])) { ?>
		<link rel="stylesheet" href="<?php echo $config['Custom FileCSS']; ?>">
	<?php } ?>
	<style type="text/css">
		<?php echo $config['Custom CSS']; ?>
	</style>
<?php if($config['Embedded Script'] == 'off') { ?>
</head>
<body>
<?php } ?>
<div id="imagewall">
<?php if($config['Embedded Script'] == 'off') { ?>
	<?php if(!empty($config['Header Image'])) { ?>
		<header>
			<h1><?php if(!empty($config['Home Page'])) { ?><a rel="tooltip" href="<?php echo $config['Home Page']; ?>" ><?php } ?><img src="<?php echo $config['Header Image']; ?>" alt="Header Image" /><?php if(!empty($config['Home Page'])) { ?></a><?php } ?>
			<span>
			<?php if(!empty($config['Channel Title'])) { ?><?php if(!empty($config['Home Page'])) { ?><a rel="tooltip" href="<?php echo $config['Home Page']; ?>" title="<?php echo $config['Channel Description']; ?>"><?php } ?><?php echo $config['Channel Title']; ?><?php if(!empty($config['Home Page'])) { ?></a><?php } ?><?php } ?>
			</span></h1>
		</header>
	<?php } ?>
<?php } ?>
	<section id="imagewall-container">
	<div class="popup-gallery">
		<ul>
<?php 

foreach ($videos as $key=>$val) {
	echo('<li class="figure"><a rel="tooltip"  class="popup-youtube" href="http://www.youtube.com/watch?v='.$videos[$key][0].'" title="'.$videos[$key][1].'">' .
          		'<img src="http://i1.ytimg.com/vi/'.$videos[$key][0].'/default.jpg" alt="ScreenShot" />' .
          				'<span class="figcaption">'.$videos[$key][1].'</span></a></li>');
	}
unset($key);
unset($val);
?>
			</ul>
		</div>
		<?php if($mulit) echo $mulit;?>
		<?php if(!empty($config['Disqus Shortname'])) { ?>
		<!-- disqus -->
		<div id="disqus_thread"></div>
		<script>
			var disqus_shortname = '<?php echo $config['Disqus Shortname']; ?>';
			/* * * DON'T EDIT BELOW THIS LINE * * */
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<p><noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		<a href="http://disqus.com" class="dsq-brlink">Comments powered by <span class="logo-disqus">Disqus</span></a></p>
		<?php } ?>
	</section>
	<?php echo $config['Custom HTML']; ?>

<?php if($config['Embedded Script'] == 'off') { ?>
	<footer>
		<nav><?php if(!empty($config['Home Page'])) { ?><a rel="tooltip" href="<?php echo $config['Home Page']; ?>" title="Go to the home page">Home</a><?php } ?><?php if(!empty($config['Contact'])) { ?> • <a rel="tooltip" href="<?php echo $config['Contact']; ?>" title="Contact us">Contact</a><?php } ?><?php if(!empty($config['Imprint'])) { ?> • <a rel="tooltip" href="<?php echo $config['Imprint']; ?>" title="Imprint this page">Imprint</a> <?php } ?></nav><?php if(!empty($config['Author'])) { ?><p>Videos by <strong><?php echo $config['Author']; ?></strong> - Copyright © 2013 - All rights reserved.</p><?php } ?>
		<p>Powered by <a rel="tooltip" href="https://github.com/krisxoofoo/VideoWall" title="A free web channel script for videos websites"><strong>VideoWall</strong></a> by <a rel="tooltip" href="http://www.xoofoo.org/" title="XooFoo Websites"><strong>XooFoo</strong></a> based on <a rel="tooltip" href="http://getpagemap.com/pagemap-imagewall/" title="A free web gallery script for portfolio websites"><strong>Pagemap Imagewall</strong></a></p>
	</footer>
<?php } ?>

</div>
<script>
	document.write('<script src=js/' +
	('__proto__' in {} ? 'zepto' : 'jquery') +
	'.min.js><\/script>')
</script>
<script src="js/zepto-tooltip.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<?php if(!empty($config['Other JS'])) { ?><script src="<?php echo $config['Other JS']; ?>"></script><?php } ?>
<script type="text/javascript">
  $(document).ready(function() {
	$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
	  disableOn: 700,
	  type: 'iframe',
	  mainClass: 'mfp-fade',
	  removalDelay: 160,
	  preloader: false,
	  fixedContentPos: false
	});
  });
</script>
<?php if(!empty($config['GoogleAnalytics Account'])) { ?>
<script>
<!-- ga -->
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $config['GoogleAnalytics Account']; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php } ?>
<?php if($config['Embedded Script'] == 'off') { ?></body></html><?php } else $set = null; ?>