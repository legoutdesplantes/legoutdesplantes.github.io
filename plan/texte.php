<?php
$menupages = array('accueil', 'cuisine-sauvage', 'legumes', 'recettes', 'cuisine-vegetarienne', 'bio', 'terrain', 'biblio', 'qui', 'recherche', 'contact');

global $titleName, $lang;
 
foreach($menupages as $page) {
  if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$page))
    continue;
  echo '<div class="dir">';
  echo '<a href="/'.$page.'/">';
  if (file_exists('../'.$page.'/'.$titleName.'.html')) {
    $title = file_get_contents('../'.$page.'/'.$titleName.'.html');
  } else {
    $title = file_get_contents('../'.$page.'/titre.html');
  }
  echo $title;   
  echo '</a>';

  echoDir('../'.$page);

  echo '</div>';
}


function echoDir($dir) {
  global $titleName, $lang;
  $files = scandir($dir);
  $array = array();
  foreach($files as $file) {
    if($file=='.' || $file=='..' || substr($file,-1)=='X' || $file=='accueil' || $file=='ModÃ¨le' || $file=='Modèle' || !is_dir($dir.'/'.$file))
      continue;
    //echoDir($dir.'/'.$file);
    if ((file_exists($dir.'/'.$file.'/index.php') || file_exists($dir.'/'.$file.'/index.html')) && (file_exists($dir.'/'.$file.'/'.$titleName.'.html') || file_exists($dir.'/'.$file.'/titre.html'))) {
      if (file_exists($dir.'/'.$file.'/'.$titleName.'.html')) {
        $array[$dir.'/'.$file] = file_get_contents($dir.'/'.$file.'/'.$titleName.'.html');
      } else {
        $array[$dir.'/'.$file] = '« '.file_get_contents($dir.'/'.$file.'/titre.html').' »';
      }
    }
  }
  asort($array);
  foreach($array as $dirname => $pagename) {
      echo '<div class="dir">';
      echo '<a href="'.$dirname.'/">';
      if (!$pagename || trim($pagename)=='')
        $pagename = $dirname;
      echo $pagename;
      echo '</a>';
      
      echoDir($dirname);

      echo '</div>';
  }    
}


?>
