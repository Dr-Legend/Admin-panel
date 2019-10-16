  <?php
  class FuncsLib extends dbc
  { 
	  /* check form submit by post mathed*/
	  public function is_post_back() {
		  if(count($_POST)>0) {
			  return true;
		  } else {
			  return false;
		  }
	  
	  }
  
	  /* form start function */
	   public function  sform($vals='')
	   {
		  return '<form id="formID" class="formular" method="post" enctype="multipart/form-data" name="aforms" action=""  '.$vals.'>';
	   }
	  
	  /* form end function */
	   public function  eform()
	   {
		  return '</form>';
	   }
	   
	   
	   public function redir($url,$inpage=0)
	   {
		  if($inpage==0)
		  {
			  header('location: '.$url) or die("Cannot Send to next page");
			  exit;
		  }else {
			  echo '
			  <script type="text/javascript">
			  <!--
			  window.location.href="'.$url.'";
			  -->
			  </SCRIPT>'
			  ;
			  exit;
		  }
	  }
	  
	  public function qry_str($arr, $skip = '') {
		  $s = "?";
		  $i = 0;
		  foreach($arr as	$key =>	$value) {
			  if ($key !=	$skip) {
				  if (is_array($value)) {
					  foreach($value as $value2) {
						  if ($i == 0) {
							  $s .= $key . '[]=' . $value2;
							  $i = 1;
						  } else {
							  $s .= '&' .	$key . '[]=' . $value2;
						  }
					  }
				  } else {
					  if ($i == 0) {
						  $s .= "$key=$value";
						  $i = 1;
					  } else {
						  $s .= "&$key=$value";
					  }
				  }
			  }
		  }
		  return $s;
	  }
	  
	  public function getFilename($filename) {
		  $uniq = uniqid("");
		  $arr=explode('.',$filename);
		  $ext = $arr[count($arr)-1];
	  
		  $allowed = "/[^a-z0-9\\_]/i";
		  $arr[0] = preg_replace($allowed,"",$arr[0]);
	  
		  $filename=$uniq.$arr[0]."_.".$ext;
	  
		  return $filename;
	  }
	  public function getextention($fname){
		  $fext=explode(".",$fname);
		  $ext=$fext[count($fext)-1];
		  return $ext;
	  }
	  
	  public  function checkpath($PATH){
		  if(!is_dir($PATH)){
			  mkdir($PATH,0777);
			  chmod($PATH, 0777);
		  }
	  }
  public function getCityformZip($zipcode) {
	  
  $homepage = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$zipcode.'&sensor=false&key=AIzaSyBTBERHI2rPUjrfKUWJ66zlblRz9D5QUSg');
  $abc=json_decode($homepage);
  $cityName=$abc->results[0]->address_components[2]->long_name;
  return $cityName;
  }	
  public 	function paymentGatewayRazorpay($post,$orderid) {
		 
		  $checkSum = "";
		  $paramList = array();
		  $surl = SITE_PATH.'success';
		  $form =' <form id="razorpayPay"  action="'.$surl.'" method="POST">
		<script
		  src="https://checkout.razorpay.com/v1/checkout.js"
		  data-key="rzp_live_P5zeo0N1erUOHB"
		  data-amount="'.(int) $post['amount'].'00"
		  data-name="LAUNCHNOTE INDIA PRIVATE LIMITED"
		  data-description="'.$post['productinfo'].'"
		  data-image="https://www.trademarkbazaar.com/images/logo.png"
		  data-netbanking="true"
		  data-description="'.$post['productinfo'].'"
		  data-prefill.name="'.$post['firstname'].'"
		  data-prefill.email="'.$post['email'].'"
		  data-prefill.contact="'.$post['phone'].'"
		  data-notes.shopping_order_id="'.$post['txnid'].'"
		  data-theme.color="#B5181E">
		  
		</script>
		<!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
		<input type="hidden" name="shopping_order_id" value="'.$orderid.'">
	  </form>
	  <style>.razorpay-payment-button{display:none;}</style>
	  <script type="text/javascript">
	 document.getElementsByClassName("razorpay-payment-button")[0].click();
	</script>
	  ';
  ?>
  <?php	
	  return $form;	
	  exit;		
	  }
  public   function paymentGatewayPayU($post) { 
	  
	  $MERCHANT_KEY = "4zdPif"; 
	 $hash_string = '';
  $SALT = "nxIl0w5s";
  $PAYU_BASE_URL = "https://secure.payu.in";
  $action = '';
  $formError = 0;
  if(empty($post['txnid'])) {
	 // Generate random transaction id
	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
  } else {
	$txnid = $post['txnid'];
  }
  $hash = '';
  // Hash Sequence
  $posted['key']=$MERCHANT_KEY;
  $posted['txnid']=$txnid;
  $posted['amount']=$post['amount'];
  $posted['firstname']=$post['name'];
  $posted['email']=$post['email'];
  $posted['phone']=$post['phone'];
  $posted['productinfo']=$post['productinfo'];
  $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
  if(empty($posted['hash']) && sizeof($posted) > 0) {
	if(
			   empty($posted['key'])
			|| empty($posted['txnid'])
			|| empty($posted['amount'])
			|| empty($posted['firstname'])
			|| empty($posted['email'])
			|| empty($posted['phone'])
			|| empty($posted['productinfo'])
		   
	) {
	  $formError = 1;
	} else {
	  
	  $hashVarsSeq = explode('|', $hashSequence);
   
	  foreach($hashVarsSeq as $hash_var) {
		$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
		$hash_string .= '|';
	  }
	  $hash_string .= $SALT; 
  
	  $hash = strtolower(hash('sha512', $hash_string));
	  $action = $PAYU_BASE_URL . '/_payment';
	}
  } elseif(!empty($posted['hash'])) {
	$hash = $posted['hash'];
	$action = $PAYU_BASE_URL . '/_payment';
  }
  ?>
   <html>
	<head>
	<script>
	  var hash = '<?php echo $hash ?>';
	  //alert(hash);
	  function submitPayuForm() {
		if(hash == '') {
		  return;
		}
		var payuForm = document.forms.payuForm;
		payuForm.submit();
	  }
	</script>
	</head>
	<body onLoad="submitPayuForm()">
	  <form action="<?php echo $action; ?>" id="payu" method="post" name="payuForm" >
		<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
		<input type="hidden" name="hash" value="<?php echo $hash ?>"/>
		<input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
	   
		  <input type="hidden" name="surl" value="<?=SITE_PATH?>bookstore-thank-you" /> 
	  
			<input type="hidden" name="amount" value="<?=$post['amount']?>" />
		   
		   <input type="hidden" name="firstname" id="firstname" value="<?=$post['name']?>" />
		
			<input type="hidden" name="email" id="email" value="<?=$post['email']?>" />
			<input type="hidden" name="phone" value="<?=$post['phone']?>" />
		 <input type="hidden" name="productinfo" value="<?=$post['productinfo']?>">
		 
			<input type="hidden" name="curl" value="<?=SITE_PATH?>payment-failed"/>
	  </form>
	   </body>
  </html> <?php } 
  
	  public function uploadFile3($PATH,$FILENAME,$FILEBOX,$SONGNAME)
	  {
		  $SONGNAME=trim(strtolower($SONGNAME));
		  $SONGNAME=str_replace(' ', '_', $SONGNAME);
		  //$RW = new DAL();	
		  $this->checkpath($PATH);
  
		 $PATH = $PATH.'/';
  
		 $ext=$this->getextention($FILENAME);
  
		 $FILENAME=$SONGNAME."_".mt_rand(1,1000).".".$ext;
  
  
		  //$FILENAME = renamefile($PATH,$fname);
  
		 $file=$PATH.$FILENAME;
	  
	  
		$uploaded="TRUE";
	  global $_FILES;
	  if (! @file_exists($file))
	  {
  
		  if ( isset( $_FILES[$FILEBOX] ) )
		  {
			  if (is_uploaded_file($_FILES[$FILEBOX]['tmp_name']))
			  {
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
			  }else{
				  $uploaded="FALSE";
			  }
		  }
	  } //end of if @fileexists
	  return $FILENAME;
	  
	  }
	  
	  
	  public function uploadFile2($PATH,$FILENAME,$FILEBOX)
	  {
		  
		  //$RW = new DAL();	
		  $this->checkpath($PATH);
  
		 $PATH = $PATH.'/';
  
		 $ext=$this->getextention($FILENAME);
  
		 $FILENAME=time()."_".mt_rand(1,1000).".".$ext;
  
  
		  //$FILENAME = renamefile($PATH,$fname);
  
		 $file=$PATH.$FILENAME;
	  
	  
		$uploaded="TRUE";
	  global $_FILES;
	  if (! @file_exists($file))
	  {
  
		  if ( isset( $_FILES[$FILEBOX] ) )
		  {
			  if (is_uploaded_file($_FILES[$FILEBOX]['tmp_name']))
			  {
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
			  }else{
				  $uploaded="FALSE";
			  }
		  }
	  } //end of if @fileexists
	  return $FILENAME;
	  
	  }
	  
	  
	  
	  
	public function uploadFile($PATH,$FILENAME,$FILEBOX){
	  global $temp_file; 
	  $this->checkpath($PATH);
	  $PATH = $PATH.'/';
	  $ext = strtolower($this->getextention($FILENAME));
	  $FILENAME_= time()."_".mt_rand(1,1000);
	  $temp_file = THUMB_CACHE_DIR.$FILENAME_;
	  if (isset($_FILES[$FILEBOX])){
		  switch($_FILES[$FILEBOX]['type']){
			  case "image/png":
				   $file = $temp_file.".".$ext;
				   $FILENAME = $FILENAME_.".png";
				   move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
			  /*     $imageObject = imagecreatefrompng($file);
				   imagejpeg($imageObject,$PATH.$FILENAME);
				   unlink($file);
				   imagedestroy($imageObject);*/
				   $input_file = $file;
				   $output_file = $FILENAME;
				   $input = imagecreatefrompng($file);
				   list($width, $height) = getimagesize($file);
				   $output = imagecreatetruecolor($width, $height);
				   $white = imagecolorallocate($output,  255, 255, 255);
				   imagefilledrectangle($output, 0, 0, $width, $height, $white);
				   imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
				   imagepng($output, $PATH.$FILENAME);
				   unlink($file);
				   break;
			  case "image/gif":
				  $file = $temp_file.".".$ext;
				  $FILENAME = $FILENAME_.".gif";
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
				  $imageObject = imagecreatefromgif($file);
				  imagejpeg($imageObject,$PATH.$FILENAME);
				  unlink($file);
				  imagedestroy($imageObject);
				  break; 
			  case "image/bmp":
				  $file = $temp_file.".".$ext;
				  $FILENAME = $FILENAME_.".bmp";
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
				  $imageObject = imagecreatefromwbmp($file);
				  imagejpeg($imageObject,$PATH.$FILENAME);
				  unlink($file);
				  imagedestroy($imageObject);
				  break; 
			  default:
				  $file = $PATH.$FILENAME_.".".$ext;
				  $FILENAME = $FILENAME_.".".$ext;
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);	
		  }
	  }	
	  return $FILENAME;
	}
	public function uploadFilebyName($PATH,$FILENAME,$FILEBOX,$name){
	  global $temp_file; 
	  $this->checkpath($PATH);
	  $PATH = $PATH.'/';
	  $ext = strtolower($this->getextention($FILENAME));
	  $FILENAME_= $name;
	  $temp_file = THUMB_CACHE_DIR.$FILENAME_;
	  if (isset($_FILES[$FILEBOX])){
		  switch($_FILES[$FILEBOX]['type']){
			  case "image/png":
				   $file = $temp_file.".".$ext;
				   $FILENAME = $FILENAME_.".png";
				   move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
			  /*     $imageObject = imagecreatefrompng($file);
				   imagejpeg($imageObject,$PATH.$FILENAME);
				   unlink($file);
				   imagedestroy($imageObject);*/
				   $input_file = $file;
				   $output_file = $FILENAME;
				   $input = imagecreatefrompng($file);
				   list($width, $height) = getimagesize($file);
				   $output = imagecreatetruecolor($width, $height);
				   $white = imagecolorallocate($output,  255, 255, 255);
				   imagefilledrectangle($output, 0, 0, $width, $height, $white);
				   imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
				   imagejpeg($output, $PATH.$FILENAME);
				   unlink($file);
				   break;
			  case "image/gif":
				  $file = $temp_file.".".$ext;
				  $FILENAME = $FILENAME_.".gif";
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
				  $imageObject = imagecreatefromgif($file);
				  imagejpeg($imageObject,$PATH.$FILENAME);
				  unlink($file);
				  imagedestroy($imageObject);
				  break; 
			  case "image/bmp":
				  $file = $temp_file.".".$ext;
				  $FILENAME = $FILENAME_.".bmp";
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
				  $imageObject = imagecreatefromwbmp($file);
				  imagejpeg($imageObject,$PATH.$FILENAME);
				  unlink($file);
				  imagedestroy($imageObject);
				  break; 
			  default:
				  $file = $PATH.$FILENAME_.".".$ext;
				  $FILENAME = $FILENAME_.".".$ext;
				  move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);	
		  }
	  }	
	  return $FILENAME;
	}
	
	public function make_thumb_gd($imgPath, $destPath, $newWidth, $newHeight, $ratio_type = 'width', $quality = 80, $verbose = false) {
	  
	  $size = getimagesize($imgPath);
	  if (!$size) {
		  if ($verbose) {
			  echo "Unable to read image info.";
		  }
		  return false;
	  }
	  $this->checkpath(dirname($destPath));
	  $curWidth	= $size[0];
	  $curHeight	= $size[1];
	  $fileType	= $size[2];
	
	  // width/height ratio
	  $ratio =  $curWidth / $curHeight;
	  $thumbRatio = $newWidth / $newHeight;
	
	  $srcX = 0;
	  $srcY = 0;
	  $srcWidth = $curWidth;
	  $srcHeight = $curHeight;
	
	  if($ratio_type=='width_height') {
		  $tmpWidth	= $newHeight * $ratio;
		  if($tmpWidth > $newWidth) {
			  $ratio_type='width';
		  } else {
			  $ratio_type='height';
		  }
	  }
	
	 if($ratio_type=='width') {
		  // If the dimensions for thumbnails are greater than original image do not enlarge
		  if($newWidth > $curWidth) {
			  $newWidth = $curWidth;
		  }
		  $newHeight	= $newWidth / $ratio;
	  } else if($ratio_type=='height') {
		  // If the dimensions for thumbnails are greater than original image do not enlarge
		  if($newHeight > $curHeight) {
			  $newHeight = $curHeight;
		  }
		  $newWidth	= $newHeight * $ratio;
	  } else if($ratio_type=='crop') {
		  if($ratio < $thumbRatio) {
			  $srcHeight = round($curHeight*$ratio/$thumbRatio);
			  $srcY = round(($curHeight-$srcHeight)/2);
		  } else {
			  $srcWidth = round($curWidth*$thumbRatio/$ratio);
			  $srcX = round(($curWidth-$srcWidth)/2);
		  }
	  } else if($ratio_type=='distort') {
	  }
	
	  // create image
	  switch ($fileType) {
		  case 1:
			  if (function_exists("imagecreatefromgif")) {
				  $originalImage = imagecreatefromgif($imgPath);
			  } else {
				  if ($verbose) {
					  echo "GIF images are not support in this php installation.";
					  return false;
				  }
			  }
			  $fileExt = 'gif';
			  break;
		  case 2:
			  $originalImage = imagecreatefromjpeg($imgPath);
			  $fileExt = 'jpg';
			  break;
		  case 3:
			  $originalImage = imagecreatefrompng($imgPath);
			  $fileExt = 'png';
			  break;
		  default:
			  if ($verbose) {
				  echo "Not a valid image type.";
			  }
			  return false;
	  }
	  // create new image
	
	  $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
	  //echo "$srcX, $srcY, $newWidth, $newHeight, $curWidth, $curHeight";
	  //echo "<br>$srcX, $srcY, $newWidth, $newHeight, $srcWidth, $srcHeight<br>";
	  imagealphablending($resizedImage, false);
	  imagesavealpha($resizedImage,true);
	  $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
	  imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
	  imagecopyresampled($resizedImage, $originalImage, 0, 0, $srcX, $srcY, $newWidth, $newHeight, $srcWidth, $srcHeight);
	  imageinterlace($resizedImage, 1);
	  switch ($fileExt) {
		  case 'gif':
			  imagegif($resizedImage, $destPath, $quality);
			  break;
		  case 'jpg':
			  imagejpeg($resizedImage, $destPath, $quality);
			  break;
		  case 'png':
			  imagepng($resizedImage, $destPath, $quality/10);
			  break;
	  }
	  // return true if successfull
	  return true;
	}
	
	public function url($url, $dir='') {
	  return SITE_PATH.(($dir)?$dir."/":'').$url.".html";
	}
	
	public function product_price($price){
	  $price = CUR.number_format(($price),2);
	  
	  return $price;
	}
	
	public function shipping_price($price){
	  $price = CUR.number_format(($price),2);
	  
	  return $price;
	}
	
	public function display_price($price){
	  $price = CUR.number_format(($price),2);
	  
	  return $price;
	}
	public function displayprice($price){
	  $price = CUR.number_format(($price));
	  
	  return $price;
	}
	public function mak_skucode($designers_sku_code, $brand_name, $series_number){
	
	  $data  =$designers_sku_code;
	  $data .=ucfirst(substr(strtolower($brand_name), 0, 1));
	  $data .=ucfirst(substr(strtolower($series_number), 0, 3));
	
	  return $data;
	  
	}
	
	  
	public function sendmail($to, $subject, $message, $fname='', $femail='',$data=''){
	  $headers  = 'MIME-Version: 1.0' . "\r\n";
	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  $headers .= 'From: '.(($fname)?$fname:$this->getSingleresult("select company from #_setting where `pid`='1'")).' <'.(($femail)?$femail:$this->getSingleresult("select email from #_setting where `pid`='1'")).'>' . "\r\n";
	  if($data){foreach ($data as $key => $value){
	  $messageiner='<table width="100%" cellpadding="5" cellspacing="0" style="max-width:900px; margin:auto;" >';
	  $messageiner .= "<tr><td> <b>".ucfirst(htmlspecialchars($key))."</b></td><td> ".htmlspecialchars($value)."</td></tr>";
	  $messageiner .='</table>';
	  }}
	  $message=$message.$messageiner;
	  @mail($to, $subject, $message, $headers);
	}
	
	
	public function convert_number_to_words($number) 
	{
	
	$hyphen      = '-';
	$conjunction = ' and ';
	$separator   = ', ';
	$negative    = 'negative ';
	$decimal     = ' point ';
	$dictionary  = array(
	  0                   => 'zero',
	  1                   => 'one',
	  2                   => 'two',
	  3                   => 'three',
	  4                   => 'four',
	  5                   => 'five',
	  6                   => 'six',
	  7                   => 'seven',
	  8                   => 'eight',
	  9                   => 'nine',
	  10                  => 'ten',
	  11                  => 'eleven',
	  12                  => 'twelve',
	  13                  => 'thirteen',
	  14                  => 'fourteen',
	  15                  => 'fifteen',
	  16                  => 'sixteen',
	  17                  => 'seventeen',
	  18                  => 'eighteen',
	  19                  => 'nineteen',
	  20                  => 'twenty',
	  30                  => 'thirty',
	  40                  => 'fourty',
	  50                  => 'fifty',
	  60                  => 'sixty',
	  70                  => 'seventy',
	  80                  => 'eighty',
	  90                  => 'ninety',
	  100                 => 'hundred',
	  1000                => 'thousand',
	  1000000             => 'million',
	  1000000000          => 'billion',
	  1000000000000       => 'trillion',
	  1000000000000000    => 'quadrillion',
	  1000000000000000000 => 'quintillion'
	);
	
	if (!is_numeric($number)) {
	  return false;
	}
	
	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
	  // overflow
	  trigger_error(
		  'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
		  E_USER_WARNING
	  );
	  return false;
	}
	
	if ($number < 0) {
	  return $negative . $this->convert_number_to_words(abs($number));
	}
	
	$string = $fraction = null;
	
	if (strpos($number, '.') !== false) {
	  list($number, $fraction) = explode('.', $number);
	}
	
	switch (true) {
	  case $number < 21:
		  $string = $dictionary[$number];
		  break;
	  case $number < 100:
		  $tens   = ((int) ($number / 10)) * 10;
		  $units  = $number % 10;
		  $string = $dictionary[$tens];
		  if ($units) {
			  $string .= $hyphen . $dictionary[$units];
		  }
		  break;
	  case $number < 1000:
		  $hundreds  = $number / 100;
		  $remainder = $number % 100;
		  $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		  if ($remainder) {
			  $string .= $conjunction . $this->convert_number_to_words($remainder);
		  }
		  break;
	  default:
		  $baseUnit = pow(1000, floor(log($number, 1000)));
		  $numBaseUnits = (int) ($number / $baseUnit);
		  $remainder = $number % $baseUnit;
		  $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		  if ($remainder) {
			  $string .= $remainder < 100 ? $conjunction : $separator;
			  $string .= $this->convert_number_to_words($remainder);
		  }
		  break;
	}
	
	if (null !== $fraction && is_numeric($fraction)) {
	  $string .= $decimal;
	  $words = array();
	  foreach (str_split((string) $fraction) as $number) {
		  $words[] = $dictionary[$number];
	  }
	  $string .= implode(' ', $words);
	}
	
	return $string;
	}
	
	public function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);
	
	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;
	
	$string = array(
	  'y' => 'year',
	  'm' => 'month',
	  'w' => 'week',
	  'd' => 'day',
	  'h' => 'hour',
	  'i' => 'minute',
	  's' => 'second',
	);
	foreach ($string as $k => &$v) {
	  if ($diff->$k) {
		  $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	  } else {
		  unset($string[$k]);
	  }
	}
	
	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	public function gen_slug($str){
	# special accents
	$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');
	$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
	return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
	}
	public function encrypt_decrypt($action, $string) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = '786';
	$secret_iv = '07';
	// hash
	$key = hash('sha256', $secret_key);
	
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
	  $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	  $output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
	  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
	}
	public function replaceword( $content, $word, $replace ) {
	$content = str_ireplace( $word, $replace, $content ); // replace content
	
	return $content; // return highlighted data
	}
	
	public function displaytabs($pid){
	$qry=$this->db_query("SELECT * FROM #_services where status ='1' and subpage_id='".$pid."' order by shortorder desc");
	$res=$this->db_fetch_all($qry);
	$html='<div class="protect-tab">
	  <ul id="tabsJustified" class="nav nav-tabs nav-fill w-100 align-items-start">';
	  $i=1;
	  foreach($res as $tbs){
		  if($i==1){$alnk='active';}else{$alnk='';}
		$html.='<li class="nav-item"><a href="" data-target="#'.$tbs['url'].'" data-toggle="tab" class="nav-link '.$alnk.'">'.$tbs['heading'].'</a></li>';
	  $i++;}
		$html.='</ul>
				<div id="tabsJustifiedContent" class="tab-content border">';
				$j=1;
		foreach($res as $tbsdt){
			if($j==1){$alnk='active show';}else{$alnk='';}
		$html.='<div id="'.$tbsdt['url'].'" class="tab-pane p-4 fade bg-white  '.$alnk.'">
		  <div class="table-responsive">
			'.$tbsdt['body'].'
		  </div>
		</div>';
		$j++;}
		$html.='</div>
		</div>
	';
		
	return $html;}
	
	public function displayhtml($data, $main){
	//if($city!=''){}
	switch ($data['section']) {
					case 0:
							 $val ='Invalid';
							 break;
					case 1:
					if($data['image']){$pageimge='style="background-image:url('.SITE_PATH.'uploaded_files/services/thumb/'.$data['image'].')"';}
					if($data['formstatus']){$col='7';}else{$col='12';}
							 $val ='<div class="page-header" '.$pageimge.'>
									<div class="overlay">
										<div class="container">
											<div class="row">
												<div class="col-md-'.$col.' col-sm-12 col-12">';
													if($data['heading'])$val.='<h1 class="pb-2 text-bold text-uppercase">'.$data['heading'].'</h1>';
													if($data['subheading'])$val.='<h4 class="text-semibold text-shadow">'.$data['subheading'].'</h4>';
												$val.='</div>';
												if($data['formstatus']){$val.='<div class="col-md-4 col-sm-12 col-12 offset-md-1">
								<form class="header-form has-validation-callback" method="post" action="" novalidate onSubmit="return submitform(this)">
								 <h2 class="text-center form-header">Trademark Registration</h2> 
								  <div class="form-inner">          
									<div class="form-group">
									  <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
									</div>
									<div class="form-group">
									  <input type="email" class="form-control" name="email" placeholder="Enter email" required>
									</div>
									<div class="form-group">
									  <input type="text" class="form-control" name="phone" placeholder="Enter Phone" required>
									</div>
									<div class="form-group">
									  <textarea class="form-control" placeholder="How We Can Help?" name="comments" rows="2"></textarea>
									</div>
									<div class="form-group text-center mb-0">
									<input type="hidden" name="flag" value="Header Form">
									<input type="hidden" name="service" value="themonetic header">
									<input type="hidden" name="source" value="'.$data['heading'].'">
									<button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Start Now&nbsp;&nbsp;&nbsp;</button>
									</div>
								  </div>
								</form>
							  </div>
							  ';
												}
											$val.='</div>
										</div>
									</div>
								</div>';
								if($main['hid'])$hd=$main['hid'];
								$val.='<div class="container-fluid mon-bg '.$hd.'">
							  <div class="container">
							  <ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="'.SITE_PATH.'">Home</a></li>
								<li class="breadcrumb-item active">'.$main['heading'].'</li>
							  </ol>
							</div>
							</div>';
							 break;
					case 3:
							$val ='<section class="alt-bg pt-4 pb-4">
									  <div class="container">
										<div class="row">
										  <div class="col-12 col-md-12">
											<h2 class="text-center text-uppercase">'.$data['heading'].'</h2>';
											if($data['subheading'])$val .='<h5 class="text-center">'.$data['subheading'].'</h5>';
											$val .='<hr class=" inline">';
											$val .=$this->displaytabs($data['pid']);
											$val .='</div>
											</div>
										  </div>
										</section>'; 
							 
							 break;
					case 2:
							 $val ='<section class="pt-4 pb-4">
								  <div class="container">
									<div class="row">
									  <div class="col-12 col-md-12">
										<h2 class="text-center mt-4 text-uppercase">'.$data['heading'].'</h2>';
										if($data['subheading'])$val .='<h5 class="text-center mt-4 text-uppercase">'.$data['subheading'].'</h5>';
										$val .='<hr class=" inline">
										'.$data['body'].'
									  </div>
									</div>
								  </div>
								</section>';  
					default:
						//code to be executed if n is different from all labels;
				  }	
				  
	return $val;
	}
	
	public function highlight_word( $content, $word, $class ) {
	$word=explode(',',$word);
	foreach($word as $w){
	$replace[] = '<span class="' . $class . '">' . $w . '</span>';	
		}
	 // create replacement
	$content = str_ireplace( $word, $replace, $content ); // replace content
	
	return $content; // return highlighted data
	}
	
	public function tabledata($table,$pid ) {
	$dataQuery=$this->db_query("select * from #_".$table." where pid='".$pid."' ");
	$data=$this->db_fetch_array($dataQuery);
	return $data; // return highlighted data
	}
	
	public function reCaptcha($secret,$captchacode ) {
	$curl = curl_init();
	  curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => 1,
		  CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
		  CURLOPT_POST => 1,
		  CURLOPT_POSTFIELDS => array(
			  'secret' => $secret,
			  'response' => $captchacode
		  )
	));
	$response = curl_exec($curl);
	curl_close($curl);
	if(strpos($response, '"success": true') !== FALSE){
	  return true;
	}else{
	return false;
	}
	}
	
	public function showsocial() {
	$dataQuery=$this->db_query("select * from #_setting where 1");
	$socialarray=array("facebook"=>"facebook","twitter"=>"twitter","linkedin"=>"linkedin","youtube"=>"youtube","gplus"=>"google-plus","pinterest"=>"pinterest","tumblr"=>"tumblr","instagram"=>"instagram");
	$data=$this->db_fetch_array($dataQuery);
	foreach($socialarray as $key=>$value){
	if(array_key_exists($key , $data) && $data[$key]!=''){
	  $slink.='<li class="list-inline-item '.$value.'"><a href="'.$data[$key].'" target="_blank"><i class="fa fa-'.$value.'"></i></a></li>';
	   }
	 }
	return $slink;
	}
	
	public function showsocialtop() {
	$dataQuery=$this->db_query("select * from #_setting where 1");
	$socialarray=array("facebook"=>"facebook","twitter"=>"twitter","linkedin"=>"linkedin","youtube"=>"youtube","gplus"=>"google-plus","pinterest"=>"pinterest","tumblr"=>"tumblr","instagram"=>"instagram");
	$data=$this->db_fetch_array($dataQuery);
	foreach($socialarray as $key=>$value){
	if(array_key_exists($key , $data) && $data[$key]!=''){
	  $slink.='<a href="'.$data[$key].'" target="_blank" class="ti-'.$value.' monetic_tooltip" title="Follow us on '.$value.'" data-gravity="n" ><i class="ci_icon-'.$value.'"></i></a>';
	   }
	 
	 }
	return $slink;
	}
	}
	?>
