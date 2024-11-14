<?php
require_once('framework/view.fw.php');
require_once('model/greeting.class.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES
//////////////////////////////////////////////////////////////////////////////

// Récupération des informations de la query string
$name = $_GET['name'] ?? '';
$language = $_GET['language'] ?? '';

// Sécurité : ces données ne doivent pas être vides
if ($name == '') {$view = new View(); $view->assign('error','name is empty');$view->display('error');}
if ($language == '') {$view = new View(); $view->assign('error','language is empty');$view->display('error');}

//////////////////////////////////////////////////////////////////////////////
// PARTIE ACTIVATION DU MODELE
//////////////////////////////////////////////////////////////////////////////

$greeting = new Greeting($name);
$salutation = $greeting->sayHelloIn($language);

//////////////////////////////////////////////////////////////////////////////
// PARTIE ACTIVATION DE LA VUE
//////////////////////////////////////////////////////////////////////////////

// Création de la vue
$view = new View();
$view->assign('name', $name);
$view->assign('language',$language);
$view->assign('languages',Greeting::getAllLanguages());
$view->assign('salutation',$salutation);
$view->display('sayHello');

