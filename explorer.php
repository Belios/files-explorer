<?php
// // Récupère le chemin du dossier présent
// $url = getcwd();
// echo $url;
//  // Liste les éléments (Dossiers/Fichiers) du répertoire
// $contents = scandir($url);
// $
//
// foreach ($contents as $items) {
//   if (is_dir($items)) {
//     echo "<br><a href='".$SERVER."'>" . $items . "</a><br>";
//
//   }
// }

function simplePath($dir) {
        if($dir == '') return './';
        $dir = str_replace('//', '/', str_replace('\\', '/', $dir));
        if($dir[strlen($dir)-1] != '/') $dir .= '/';
        return $dir;
}

if(!empty($_GET['dir'])) $dir = simplePath($_GET['dir']);
else $dir = './';

$opendir = false;
if(is_dir($dir)) $opendir = @opendir($dir);
if(!$opendir) {
        $dir = './';
        $opendir = opendir('./') or die();
}

echo '<div style="float:right;"><a href="?dir=./">Root</a></div>';

echo '<h1>'.$dir.'</h1>';

if(substr($dir, 0, 2) == './') $dir = substr($dir, 2);

while(($file = readdir($opendir)) !== false) {
        if(is_file($dir.$file)) {
                echo '<a href="'.$dir.$file.'" title="'.$dir.$file.'">'.$file.'</a><br/>', "\n";
        }
        elseif(is_dir($dir.$file) && $file != '.') {
                echo '<a href="?dir='.urlencode($dir.$file).'" title="'.$dir.$file.'">'.$file.'</a><br/>', "\n";
        }
}

closedir($opendir);

// Change directory
// chdir("images");
 ?>
