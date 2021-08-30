<?php

if(!empty($_FILES)){
	require("imgClass.php");
	$img = $_FILES['img'];
	$ext = strtolower(substr($img['name'],-3));
	$allow_ext = array("jpg",'png','gif');
	if(in_array($ext,$allow_ext)){
		move_uploaded_file($img['tmp_name'],"images/".$img['name']);
		Img::creerMin("images/".$img['name'],"images/min",$img['name'],215,112);
		Img::convertirJPG("images/".$img['name']);
	}
	else{
		$erreur = "Votre fichier n'est pas une image";
	}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <script type="text/javascript" src="zoombox/jquery.js"></script>
    <script type="text/javascript" src="zoombox/zoombox.js"></script>
    <link rel="stylesheet" type="text/css" href="theme/style.css" />
    <link href="zoombox/zoombox.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
    <?php
if(isset($erreur)){
	echo $erreur;
}

?>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="file" name="img" />
        <input type="submit" name="Envoyer" />
    </form>

    <?php
$dos = "images/min";
$dir = opendir($dos);
while($file = readdir($dir)){
	$allow_ext = array("jpg",'png','gif');
	$ext = strtolower(substr($file,-3));
	if(in_array($ext,$allow_ext)){
		?>
    <div class="min">
        <a href="images/<?php echo $file; ?>" rel="zoombox[galerie]">
            <img src="images/min/<?php echo $file; ?>" />
            <h3><?php echo $file; ?></h3>
        </a>
    </div>
    <?php
	}
}
?>
</body>

</html>