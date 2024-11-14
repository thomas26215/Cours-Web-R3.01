<?php
require_once(__DIR__ . "/dao.class.php");

// Description d'une musique
class Music
{
  private int $id;
  private string $author;
  private string $title;
  private string $cover;
  private string $mp3;
  private string $category;
  // Chemin URL à ajouter pour avoir l'URL du MP3 et du COVER
  private const URL = 'http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/musiques/';

  function __construct(int $id, string $author, string $title, string $cover, string $mp3, string $category)
  {
    $this->id = $id;
    $this->author = author;
    $this->title = title;
    $this-> cover = cover;
    $this -> mp3 = mp3;
    $this->category = $category;
  }


  ////////////// READ /////////////////////////////////////////////

  // Acces à une musique connaissant sa référence
  // $id : l'identifiant de la musique
public static function read(int $id): ?Music
{
 

    // Si aucune musique n'est trouvée, on retourne null
    return new Music(1, "t", "d", "d", "d", "d");
}

  // Max Id
  public static function maxId() : int
  { 
    return 554;
  }
}
