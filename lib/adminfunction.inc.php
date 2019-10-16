<?php
/*
# @package AKM CMS
# Copy right code 
# The base configurations of the AKM CMS.
# This file has the following configurations: MySQL settings, Table Prefix,
# by visiting {config.inc.php} Codex page. You can get the MySQL settings from your web host.
# MySQL settings - You can get this info from your web host
# The name of the database for AKM CMS
# Developer by Ajay Maurya
# eMail: ajaymaurya.it@gmail.com
*/

class FuncsAmd {  
	private $var;
	public function adminsbox(){
		return '';
	}
	public function adminebox(){
		return '';
	}
	public function breadcrumb($com){
		if($com=='pages'){
			return "CMS";	
		}
		else{
			$rr=ucwords(str_replace('_', ' ',$com));
			
			return $rr;		
		}
	}
	public function admincids($val){
		$arr = explode(",",$val);
		$newarr = array();
		foreach($arr as $k => $v) {
			if($v)
				$newarr[] = $v;
		}
		return $newarr;
	}
	public function calcinch($f, $i){
		$inch = ($f * (12)) + $i;
		return $inch;
	}
	public function sessset($val, $msg=""){
		 $_SESSION['sessmsg'] = $val;
		$_SESSION['alert'] = $msg;
		
	}

	public function adminpublish($val){
		if($val == 'Active'){
			return "Deactivate";
		} else {
			return "Activate";
		}
	}
	public function secure(){
		 if (!$_SESSION["AMD"][0] and !$_SESSION["AMD"][2])
		 {
			//header('Location: '.SITE_PATH_ADM.'login.php');
			echo '
			<script type="text/javascript">
			<!--
			window.location.href="'.SITE_PATH_ADM.'login/";
			-->
			</SCRIPT>'
			;
			exit;	 
		}
	}
	public function url($file){
		return SITE_PATH_ADM.$file.".php";
	}
	public function iurl($comp,$mode='', $id='', $action=''){
		return SITE_PATH_ADM."index.php?comp=".$comp.(($mode)?"&mode=".$mode:'').(($id)?"&uid=".$id:'').(($action)?"&action=".$action:'');
	}
	public function furl($file){
		return SITE_PATH_ADM.$file."/";
	}

	public function alert(){
		if($_SESSION['alert']=='e'){
			echo $this->error();
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='w'){
			echo $this->warning();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='s'){
			echo $this->success();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
	}

	public function info() {
		if($_SESSION['sessmsg']){
			return '<div class="alert alert-dismissable alertMessage info SE alert-info text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['sessmsg'].'</div>';		
		}
	}

	public function error() {
		if($_SESSION['sessmsg']){
			return '<div class="alert alert-dismissable alertMessage error SE alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['sessmsg'].'</div>';		
		}
	}

	public function warning() {
		if($_SESSION['sessmsg']){
			return '<div class="alert alert-dismissable alertMessage warning SE alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['sessmsg'].'</div>';		
		}	
	}

	public function success() {
		if($_SESSION['sessmsg']){
			return '<div class="alert alert-dismissable alertMessage success SE alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['sessmsg'].'</div>';	
		}	
	}

	public function rowerror($n) {
		return '<tr class="grey"><td align="center" colspan="'.$n.'"><b>Sorry! No record in databse.</b></td></tr>';	
	} 

	public function even_odd($vars){
			if($vars%2==1){
				return ' class="grey"';		
			}
	}
	

	public function check_all(){
		return '<input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)">';
	}

	public function check_input($vars){
		return '<input name="arr_ids[]" type="checkbox" id="arr_ids[]" value="'.$vars.'">';
	}
	public function action($comp, $pid,$cid=0){
		if($_SESSION["AMD"][3]=='1'){
		$ulr=$cid?'&catid='.$cid:'';
	return '<a class="btn btn-primary btn-sm" href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=add'.$ulr.'&uid='.$pid.'"><i class="fa fa-pencil"></i></a>
		<a  class="btn btn-danger btn-sm" href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&uid='.$pid.'&action=del" onclick="return confirm(\'Do you want delete this record?\');"><i class="fa fa-trash" title="Delete Record"></i></a>';
		
		
		}else{
		return '<a class="btn btn-primary btn-sm" href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=add&uid='.$pid.'"><i class="fa fa-pencil"></i></a><a class="btn btn-danger btn-sm" href="javascript:void(0);"><i class="fa fa-trash" title="Delete Record"></i></a>';
				}
	}
	public function actionMode($comp, $pid, $mode=""){
		if($mode){$mode='&mode='.$mode;}
		return '<a class="btn btn-primary btn-sm" href="'.SITE_PATH_ADM.'index.php?comp='.$comp.$mode.'&uid='.$pid.'"><i class="fa fa-pencil"></i></a><a class="btn btn-danger btn-sm" href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&uid='.$pid.'&action=del" onclick="return confirm(\'Do you want delete this record?\');"><i class="fa fa-trash" title="Delete Record"></i></a>';
		
	}
	public function HrefAction($comp, $pid){
		return $eurl = SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=add&uid='.$pid;
	}
	public function Eaction($comp, $pid){
		$eurl = SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=add&uid='.$pid;
		return ' onclick="location.href=\''.$eurl.'\';" ';
	}
	public function Caction($comp, $pid){
		$eurl = SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=customquotesupdate&uid='.$pid;
		return ' onclick="location.href=\''.$eurl.'\';" ';
	}
	public function cataction($vars, $ids, $tags=''){
		return '<table border="0" cellpadding="0" cellspacing="0"><tr><td><a href="'.$vars.'?id='.$ids.'"><i class="fa fa-pencil" title="Edit Record"></i></a></td><td style="padding-left:15px;"><a href="'.SITE_PATH_ADM.(($tags)?$tags:CPAGE).'?id='.$ids.'&action=del&view=true" onclick="return confirm(\'Do you want delete this record?\');"><i class="fa fa-trash" title="Delete Record"></i></a></td></tr></table>';
	}
	public function action2($comp, $pid){
		return '<a href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=add&uid='.$pid.'"><i class="fa fa-pencil" title="Edit Record"></i></a><a href="javascript:void(0);"><i class="fa fa-trash" title="Edit Delete"></i></a>';
	}
	public function actionEX($comp, $pid){
		return '<div align="center"><a class="btn btn-primary btn-sm" href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=add&uid='.$pid.'"><i class="fa fa-pencil"></i></a></div>';
	}
	public function viewmode($comp, $pid){
		return '<a href="'.SITE_PATH_ADM.'index.php?comp='.$comp.'&mode=view&uid='.$pid.'"><i class="fa fa-eye" title="View Record"></i></a>';
	}

	public function h1_tag($vars, $others='&nbsp;'){
		return '<h1><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="50%" align="left">'.$vars.'</td><td width="50%">'.$others.'</td></tr></table></h1>';
	}
	public function heading($vars){
		return '<h2>'.$vars.'</h2>';
	}
	public function get_editor($fld, $vals, $path='', $w='900', $h='350'){
		return '<textarea name="'.$fld.'" id="'.$fld.'"  rows=""  cols="" class="form-control">'.$vals.'</textarea><script type="text/javascript">
				window.onload = function(){
					var editor=CKEDITOR.replace(\''.$fld.'\',{
			        uiCoor : \'#9AB8F3\',
					width : \''.$w.'px\',
					height : \''.$h.'px\'
    			} );
				CKFinder.setupCKEditor( editor, \''.SITE_SUB_PATH.'lib/ckfinder/\' );};</script>';
	}
	public function get_editor_s($fld, $vals, $w='45', $h='7'){
		return '<textarea cols="'.$w.'" id="'.$fld.'" name="'.$fld.'" rows="'.$h.'">'.$vals.'</textarea>
		<script type="text/javascript">
		//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			var editors_'.$fld.'=CKEDITOR.replace( \''.$fld.'\',
				{
					extraPlugins : \'uicolor\',
					toolbar :
					[
						[ \'Source\',\'FontSize\' ],[\'JustifyLeft\', \'JustifyCenter\', \'JustifyRight\', \'JustifyBlock\' ],[ \'Bold\', \'Italic\', \'-\', \'NumberedList\', \'BulletedList\', \'-\', \'Link\', \'Unlink\' ],
						[ \'Image\' ]
					],
					//filebrowserUploadUrl : \''.SITE_SUB_PATH.'lib/ckfinder/config.php\'
				});

		//]]>
		CKFinder.setupCKEditor( editors_'.$fld.', \''.SITE_SUB_PATH.'lib/ckfinder/\' );
		</script>';
	}
	public function get_editor_s_front($fld, $vals, $w='45', $h='4', $cls='form-control', $ph='Your comments*...', $rq=true){
		$rqd=$rq?'required':'';
		return '<textarea class="'.$cls.'" placeholder="'.$ph.'" cols="'.$w.'" id="'.$fld.'" name="'.$fld.'" rows="'.$h.'" '.$rqd.' >'.$vals.'</textarea>
		<script type="text/javascript">
		//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( \''.$fld.'\',
				{
					extraPlugins : \'uicolor\',
					toolbar :
					[
						[ \'Bold\', \'Italic\',\'FontSize\', \'-\', \'NumberedList\', \'BulletedList\', \'-\', \'Link\', \'Unlink\' ],
						[ \'UIColor\' ]
					]
				});

		//]]>
		</script>';
	}
	public function imageurl($string){
		$string = str_replace("/", " ",$string);
		$string = str_replace('\\', " ",$string);
		$string = str_replace("(", "",$string);
		$string = str_replace(")", "",$string);
		$string = str_replace("&", "",$string);
		$string = str_replace("#", "",$string);
		$string = str_replace("---", "",$string);
		$string = str_replace("--", "",$string);
		$string = str_replace("-", "",$string);
		$string = str_replace("&shy;", "",$string);
		$string = str_replace("&minus;", "",$string);
		$string = str_replace("'", "",$string);
		$string = str_replace('"', "",$string);
		$string = str_replace(" –", "",$string);
		$string = str_replace("+", "",$string);
		$string = str_replace(",", "",$string);
		$string = str_replace("   ", " ",$string);
		$string = str_replace("  ", " ",$string);
		
		return $string;
	}
	public function baseurl($string){
		$string=strtolower($string);
		$string=preg_replace('/\s+/',' ',$string);
		$string=trim($string);
		$string = str_replace(' ', '-', $string);
		$string =preg_replace('/[^A-Za-z0-9\-]/', '', $string);
		$string = preg_replace('/-+/', '-', $string);
		
		/*$vals = str_replace(" ", "",trim(strtolower($vals)));
		$vals = str_replace("/", "",$vals);
		$vals = str_replace("(", "",$vals);
		$vals = str_replace(")", "",$vals);
		$vals = str_replace("&", "",$vals);
		$vals = str_replace("#", "",$vals);
		$vals = str_replace("---", "",$vals);
		$vals = str_replace("--", "",$vals);
		$vals = str_replace("-", "",$vals);
		$vals = str_replace("&shy;", "",$vals);
		$vals = str_replace("&minus;", "",$vals);
		$vals = str_replace("'", "",$vals);
		$vals = str_replace('"', "",$vals);
		$vals = str_replace(" –", "",$vals);
		$vals = str_replace("+", "",$vals);
		$vals = str_replace(",", "",$vals);
		*/
		return $string;
	}
	public function baseurlmenu($string){
		
		$string=strtolower($string);
		$string=preg_replace('/\s+/',' ',$string);
		$string=trim($string);
		$string = str_replace(' ', '-', $string);
		$string =preg_replace('/[^A-Za-z0-9\-\/\#\:\.\_]/', '', $string);
		$string = str_replace('-/-', '/', $string);
		$string = preg_replace('/-+/', '-', $string);
		
		/*$vals = str_replace(" ", "",trim(strtolower($vals)));
		$vals = str_replace("/", "",$vals);
		$vals = str_replace("(", "",$vals);
		$vals = str_replace(")", "",$vals);
		$vals = str_replace("&", "",$vals);
		$vals = str_replace("#", "",$vals);
		$vals = str_replace("---", "",$vals);
		$vals = str_replace("--", "",$vals);
		$vals = str_replace("-", "",$vals);
		$vals = str_replace("&shy;", "",$vals);
		$vals = str_replace("&minus;", "",$vals);
		$vals = str_replace("'", "",$vals);
		$vals = str_replace('"', "",$vals);
		$vals = str_replace(" –", "",$vals);
		$vals = str_replace("+", "",$vals);
		$vals = str_replace(",", "",$vals);
		*/
		return $string;
	}
	public function spl($vals){
		$vals = str_replace("'", "&#039;",trim($vals));
		$vals = str_replace('"', "&quot;",trim($vals));
		return $vals;
	}
	public function spl1($vals){
		$vals = str_replace("'", "&#039;",trim($vals));
		return $vals;
	}
	public function viewimage($path	, $img){
		if($img and file_exists(UP_FILES_FS_PATH."/".$path."/".$img)){
			return '<a href="'.SITE_PATH.'uploaded_files/'.$path.'/'.$img.'" target="_blank">View</a>';
		} else{
			return "N/A";
		}
	} 
	public function textcount($one,$two, $num){
		return 'onKeyDown="textCounter(document.aforms.'.$one.',document.aforms.'.$two.','.$num.')" onKeyUp="textCounter(document.aforms.'.$one.',document.aforms.'.$two.','.$num.')"';
	}
	public function maxnum($name, $num){
		return '<input readonly type="text" name="'.$name.'" size="3" maxlength="3" value="'.$num.'">';
	}
	public function compname($name){
		$name = str_replace('_',' ',$name);
		$name = ucfirst($name);
		return $name;
	}
	public function displaystatus($status){
	   switch ($status) {
						case 0:
								 $val ='Inactive';
								 break;
						case 1:
								 $val ='Active';
								 break;
						
						default:
							//code to be executed if n is different from all labels;
                      }	
					  
		return $val;
	}
	public function displaysection($status){
	   switch ($status) {
						case 0:
								 $val ='Invalid';
								 break;
						case 1:
								 $val ='detail';
								 break;
						case 2:
								 $val ='company-name';
								 break;
						case 3:
								 $val ='price';
								 break;
						case 4:
								 $val ='requirements';
								 break;
						case 5:
								 $val ='process';
								 break;
						case 6:
								 $val ='blog';
								 break;
						case 7:
								 $val ='faqs';
								 break;
						case 8:
								 $val ='class-search';
								 break;	
						case 9:
								 $val ='trademark-search';
								 break;
						case 10:
								 $val ='packages';
								 break;		 
								 	 	 
						
						default:
							//code to be executed if n is different from all labels;
                      }	
					  
		return $val;
	}
	public function user_type($user){
	   switch ($user) {
						
						case 1:
								 $val ='Super Admin';
								 break;
						
						default:
							//code to be executed if n is different from all labels;
                      }	
					  
		return $val;
	}
	public function html_cut($text, $max_length){
    $tags   = array();
    $result = "";

    $is_open   = false;
    $grab_open = false;
    $is_close  = false;
    $in_double_quotes = false;
    $in_single_quotes = false;
    $tag = "";

    $i = 0;
    $stripped = 0;

    $stripped_text = strip_tags($text);

    while ($i < strlen($text) && $stripped < strlen($stripped_text) && $stripped < $max_length)
    {
        $symbol  = $text{$i};
        $result .= $symbol;

        switch ($symbol)
        {
           case '<':
                $is_open   = true;
                $grab_open = true;
                break;

           case '"':
               if ($in_double_quotes)
                   $in_double_quotes = false;
               else
                   $in_double_quotes = true;

            break;

            case "'":
              if ($in_single_quotes)
                  $in_single_quotes = false;
              else
                  $in_single_quotes = true;

            break;

            case '/':
                if ($is_open && !$in_double_quotes && !$in_single_quotes)
                {
                    $is_close  = true;
                    $is_open   = false;
                    $grab_open = false;
                }

                break;

            case ' ':
                if ($is_open)
                    $grab_open = false;
                else
                    $stripped++;

                break;

            case '>':
                if ($is_open)
                {
                    $is_open   = false;
                    $grab_open = false;
                    array_push($tags, $tag);
                    $tag = "";
                }
                else if ($is_close)
                {
                    $is_close = false;
                    array_pop($tags);
                    $tag = "";
                }

                break;

            default:
                if ($grab_open || $is_close)
                    $tag .= $symbol;

                if (!$is_open && !$is_close)
                    $stripped++;
        }

        $i++;
    }

    $j=1;

    while ($tags){

		if($j==1)$result .= " ....</".array_pop($tags).">";

        else $result .= "</".array_pop($tags).">";

	$j++;}

    return $result;
 }	
	public function send_mail($mailer_arr){
	 $mailer_arr = array_merge( array( 'to'=>'', 'from_name'=>'', 'from'=>'', 'subject'=>'', 'message'=>'', 'cc'=>'', 'bcc'=>'', 'file_name'=>'', 'file_path'=>'' ), $mailer_arr );
	 $EmailTo = strip_tags($mailer_arr['to']);
	 $EmailFrom = strip_tags($mailer_arr['from']);
	 $EmailFromNmae = strip_tags($mailer_arr['from_name']);
	 $EmailSubject = $mailer_arr['subject'];
	 $EmailMessage = stripslashes($mailer_arr['message']);
	 $EmailCc = strip_tags($mailer_arr['cc']);
	 $EmailBcc = strip_tags($mailer_arr['bcc']);
	 $filepath = $mailer_arr['file_path'];
	 $filename = $mailer_arr['file_name'] ? $mailer_arr['file_name'] : end((explode("/",$filepath)));
	 $eol = PHP_EOL;
	 $headers = "";
	 if( !empty($EmailFromNmae) ){
	 if( !empty($EmailFrom) )
	 $headers  .= "From: ".$EmailFromNmae.'<'.$EmailFrom.'>'.$eol; 
	 }else{
	 if( !empty($EmailFrom) )
	 $headers  .= "From: ".$EmailFrom.$eol; 
	 }
	 if( !empty($EmailFrom) )
	 $headers .= "Reply-To: ". $EmailFrom .$eol;
	 if( !empty($EmailCc) )
	 $headers .= "CC: ".$EmailCc.$eol;
	 if( !empty($EmailBcc) )
	 $headers .= "BCC: ".$EmailBcc.$eol;
	 $headers .= "MIME-Version: 1.0".$eol; 
	 if( !isset( $mailer_arr['file_path'] ) || $mailer_arr['file_path'] == '' ){ 
	 $headers .= "Content-type: text/html".$eol;
	 if(mail($EmailTo, $EmailSubject, $EmailMessage, $headers)) 
	 return true;
					else 
					return false;
	 
	 }
	 $attachment = chunk_split( base64_encode(file_get_contents($filepath)) );
	 $separator = md5(time());  
	 $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";
	 $body = "";
	 $body .= "--".$separator.$eol;
	 $body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
	 $body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;//optional defaults to 7bit
	 $body .= $EmailMessage.$eol;
	 // attachment
	 $body .= "--".$separator.$eol;
	 $body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
	 $body .= "Content-Transfer-Encoding: base64".$eol;
	 $body .= "Content-Disposition: attachment".$eol.$eol;
	 $body .= $attachment.$eol;
	 $body .= "--".$separator."--";
	 // send message
	 if (mail($EmailTo, $EmailSubject, $body, $headers)) {
	 return true;
	 }
	 else {
	 return false;
	 }
	 }
	 
	 public function shotIcon($fld,$fldcmp,$otype){
		 return '<span class="combine-icon '.($fld==$fldcmp?'active':'').'"><i class="fa fa-fw fa-sort-asc '.($otype=='asc'?'active':'').'"></i><i class="fa fa-fw fa-sort-desc '.($otype=='desc'?'active':'').'"></i></span>';
		 }
}
?>