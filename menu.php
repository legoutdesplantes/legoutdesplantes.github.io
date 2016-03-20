<?php 
$menupages = array('accueil', 'cuisine-sauvage', 'legumes', 'recettes', 'cuisine-vegetarienne', 'bio', 'terrain', 'biblio', 'qui');
$requesturi = $_SERVER["REQUEST_URI"];
$requesturi = preg_replace('/#.*/', '', $requesturi);
$requesturi = preg_replace('/\?.*/', '', $requesturi);

?>

<ul>
<?php 
foreach ($menupages as $onepage) {
  if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$onepage))
    continue;
  if ($requesturi=='/'.$onepage.'/') {
    echo '<li><div class="current">';
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$onepage.'/'.$titleName.'.html'))
      include($onepage.'/'.$titleName.'.html');
    else
      require($onepage.'/titre.html');
    echo '</div></li>';
  } else if (substr($requesturi, 0, strlen($onepage)+2) == '/'.$onepage.'/') {
    echo '<li><a href="/'.$onepage.'/"><div class="current">';
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$onepage.'/'.$titleName.'.html'))
      include($onepage.'/'.$titleName.'.html');
    else
      require($onepage.'/titre.html');
    echo '</div></a></li>';
  } else {
    echo '<li><a href="/'.$onepage.'/"><div>';
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$onepage.'/'.$titleName.'.html'))
      include($onepage.'/'.$titleName.'.html');
    else
      require($onepage.'/titre.html');
    echo '</div></a></li>';
  }
} ?>
</ul>
