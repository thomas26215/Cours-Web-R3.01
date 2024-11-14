<?php

// Classe chargée de réaliser un change entre deux monnaies
Class Change {
  // Liste des taux indexés par deux IDF de taux séparé par un espace
  private array $rates = array();
  // Liste des IDF des devises
  // Est utile pour afficher les devises que l'on peut choisir
  private array $devises = array();

  // Constructeur
  function __construct(string $filename) {
    // Lecture des taux
    $this->load($filename);
  }

  // Charge la liste des Taux et des idf de devises
  private function load(string $filename) {
    $file = fopen($filename, 'r');
    fgetcsv($file);
    while (($row = fgetcsv($file)) !== false) {
        $from = $row[0];
        $to = $row[1];
        $rate = $row[2];
        $this->rates["$from $to"] = $rate;
        if (!in_array($from, $this->devises)) $this->devises[] = $from;
        if (!in_array($to, $this->devises)) $this->devises[] = $to;
    }
    fclose($file);
}

function getRate(string $from, string $to) : float {
    if ($from === $to) return 1.0;
    $key = "$from $to";
    if (isset($this->rates[$key])) return (float)$this->rates[$key];
    $inverseKey = "$to $from";
    if (isset($this->rates[$inverseKey])) return 1 / (float)$this->rates[$inverseKey];
    throw new Exception("ERREUR : taux de $from vers $to inconnu");
}

function getDevises() : array {
    return $this->devises;
}

function change(string $from, string $to, float $amount) : float {
    $rate = $this->getRate($from, $to);
    return round($amount * $rate, 2);
}
}

?>
