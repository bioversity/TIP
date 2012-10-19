<?php

if ('POST' == $request->getMethod()) {
  $cat  = $_POST['trait_cat'];
  
  if($cat){
    return json_encode($app['db']->fetchAssoc('SELECT DISTINCT t.name FROM crop_cat_trait cct LEFT JOIN trait t ON cct.trait = t.id WHERE cct.cat ='.$cat));
  }

}