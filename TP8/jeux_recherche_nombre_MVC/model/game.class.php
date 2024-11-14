<?php

// Modèle pour jouer au jeu de la recherche du nombre
// La recherche se fait par dichotomie
class Game {
  // Interval de recherche du jeu
  private static $min = 1;
  private static $max = 1000;
  // Borne inférieur de l'interval de recherche
  private int $inf;
  // Borne supérieur de l'interval de recherche
  private int $sup;
  // La valeur proposée actuelle à l'utilisateur
  private int $guess;
  // Nombre de coups joués
  private int $nbGuess;
  // Nombre de partie jouée
  private int $nbGame;

  function __construct() {
    // Les bornes sont initialisées au maximum
    $this->inf = self::$min;
    $this->sup = self::$max;
    $this->nbGuess = 0;
    // C'est le première partie
    $this->nbGame = 1;
    // Initialisation pour eviter une erreur d'exécution
    $this->guess = -1;
  }

  // Redémarre une partie
  function restart() {
    $this->inf = self::$min;
    $this->sup = self::$max;
    $this->nbGuess = 0;
    $this->guess = -1;
    // Redémarrage d'une nouvelle partie
    $this->nbGame += 1;
  }

  ////////////////////////////////////////////////////////////
  // Getters
  ////////////////////////////////////////////////////////////

  // Retourne la valeur proposée à l'utilisateur
  function getGuess(): int {
    return $this->guess;
  }

  // Retourne le nombre de coup joués
  function getNbGuess(): int {
    return $this->nbGuess;
  }

  // Retourne le nombre de jeux réalisés
  function getNbGame() : int {
    return $this->nbGame;
  }

  ////////////////////////////////////////////////////////////
  // Autres méthodes
  ////////////////////////////////////////////////////////////


  // Propose une nouvelle valeur en fonction de l'état courant
  function guess(): int {
    // L'estimation est au milieu de l'interval
    // Le forcage au type int permet d'arrondir le calcul à l'entier
    $this->guess = (int)(($this->sup - $this->inf) / 2 + $this->inf);
    // Incremente le nombre de tests
    $this->nbGuess++;
    return $this->guess;
  }

  // On est informé que la valeur proposée est trop petite
  function guessTooLow(): void {
    // Reduction de l'interval de recherche
    $this->inf = $this->guess;
  }

  // On est informé que la valeur proposée est trop grand
  function guessTooHigh(): void   {
    // Reduction de l'interval de recherche
    $this->sup = $this->guess;
  }

  // Retourne vrai s'il n'y a plus de choix
  function noChoice(): bool {
    return ($this->sup - $this->inf) < 2;
  }
}
?>
