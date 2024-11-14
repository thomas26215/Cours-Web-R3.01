<?php

// Pour dire une salutation dans quelques langues
class Greeting {
  private string $name;

  // Liste de languages
  const LANGUAGES = array (
    'Anglais' => 'Hello',
    'Allemand' => 'Hallo',
    'Arabe' => 'Salam',
    'Basque' => 'Kaixo',
    'Bulgare' => 'Zdravei',
    'Danois' => 'Hej',
    'Espagnol' => 'Hola',
    'Finnois' => 'Hei',
    'Français' => 'Salut',
    'Grec' => 'Yasou',
    'Hindi' => 'Namaste',
    'Indonésien' => 'Selamat',
    'Italien' => 'Ciao',
    'Japonais' => 'Ossu',
    'Mandarin' => 'Ní hǎo',
    'Russe' =>  'Privyèt',
    'Serbe' => 'Zdravo',
    'Ukrainien' => 'Pryvit',
    'Zoulou' => 'Sawubona'
  );

  function __construct(string $name) {
    $this->name = $name;
  }

  // Dit bonjour dans une langue
  public function sayHelloIn(string $language) : string {
    if (array_key_exists($language,self::LANGUAGES)) {
      return self::LANGUAGES[$language].' '.$this->name;
    } else {
      return '(?) '.$this->name;
    }
  }

  // Retourne la liste des langues possibles
  public static function getAllLanguages() : array {
    return array_keys(self::LANGUAGES);
  }
}
  
?>
