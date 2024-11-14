<?php
require_once(__DIR__ . '/dao.class.php');
require_once(__DIR__ . '/categorie.class.php');

// Un article en vente 
class Article
{
  private int     $ref;         // Référence unique
  private string  $libelle;     // Nom de l'article
  private Categorie  $categorie; // La catégorie de cet attribut
  private float   $prix;        // Le prix
  private string  $image;       // Nom du fichier image
  // URL absolue pour les images
  private const URL = 'https://www-info.iut2.univ-grenoble-alpes.fr/intranet/enseignements/ProgWeb/data/bricomachin/img/';

  // Constructeur
  public function __construct(
    int $ref = -1,
    string $libelle = '',
    Categorie $categorie = NULL,
    float $prix = 0.0,
    string  $image = ''
  ) {
    $this->ref = $ref;
    $this->libelle = $libelle;
    // On ne peux pas affecter NULL à un attribut de type Categorie
    if ($categorie === NULL) {
      $this->categorie = new Categorie();
    } else {
      $this->categorie = $categorie;
    }
    $this->prix = $prix;
    $this->image = $image;
  }

  // Getters
  public function getRef(): int
  {
    return $this->ref;
  }

  public function getLibelle(): string
  {
    return $this->libelle; 
  }

  public function getCategorie(): Categorie
  {
    return $this->categorie;
  }

  public function getPrix(): float
  {
    return $this->prix;
  }

  public function getImage(): string
  {
    return $this->image; 
  }

  // Retourne l'URL complete de l'image pour une utilisation dans la vue.
  public function getImageURL(): string
{
    return self::URL . $this->getImage(); // Utilisez les parenthèses pour appeler la méthode
}

  ////////////// Gestion de la persistance (méthodes CRUD) ////////////////

  // Retourne le nombre total d'articles dans la base
  // Est utilisé pour calculer le nombre de pages
  // Retourne le nombre total d'articles dans la base pour une référence donnée
// Est utilisé pour calculer le nombre de pages
  public static function count(): int{
      // Accès au DAO
      $dao = DAO::get();
      // Prépare la requête SQL
      $query = $dao->prepare('SELECT COUNT(*) as total FROM article');
      // Exécute la requête SQL en lui passant les paramètres
      $query->execute([]);
      // Récupère le résultat
      $result = $query->fetch(PDO::FETCH_ASSOC);
      
      // Vérifie si un résultat a été trouvé
      if ($result === false) {
          throw new Exception("Erreur: aucun article");
      }
      
      // Retourne le nombre total d'articles correspondants
      return (int)$result['total'];
  }

  ////////////// READ /////////////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article {
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article WHERE ref = :ref');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':ref' => $ref]);
    // Récupère le résultat
    $table = $query->fetchAll();
    // Il ne doit y avoir qu'un seul résultat dans la table
    if (count($table) == 0) {
      throw new Exception("Erreur:  Article $ref non trouvée");
    }
    // Il ne peux pas y avoir plus d'une instance avec cet ref
    if (count($table) > 1) {
      throw new Exception("Incohérence:  Article $ref existe en ".count($table)." exemplaires");
    }
    // Les données de cette catégorie
    $row = $table[0];
    // Création de la catégorie
    $categorie = Categorie::read((int)$row['categorie']); // Assurez-vous que 'categorie' est bien un ID valide
    // Crée l'instance
    $article = new Article($row['ref'],$row['libelle'],$categorie, $row['prix'], $row['image']);
    return $article;
  }

  // Récupère des articles étant donné un No de page
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  public static function readPage(int $page, int $pageSize): array
  {
      // Accès au DAO
      $dao = DAO::get();
      
      // Calculer l'offset pour la requête SQL
      $offset = ($page - 1) * $pageSize;
      
      // Prépare la requête SQL pour récupérer les articles avec pagination
      $query = $dao->prepare('SELECT * FROM article ORDER BY ref LIMIT :limit OFFSET :offset');
      
      // Lier les paramètres avec des valeurs appropriées
      $query->bindValue(':limit', $pageSize, PDO::PARAM_INT);
      $query->bindValue(':offset', $offset, PDO::PARAM_INT);
      
      // Exécute la requête SQL
      $query->execute();
      
      // Récupère tous les résultats
      $articlesData = $query->fetchAll(PDO::FETCH_ASSOC);
      
      // Créer un tableau d'objets Article à partir des résultats
      $articles = [];
      foreach ($articlesData as $row) {
          // Créez une instance de Categorie si nécessaire (vous pouvez adapter selon votre logique)
          $categorie = Categorie::read((int)$row['categorie']);
          
          // Créez l'objet Article et ajoutez-le au tableau
          $articles[] = new Article($row['ref'], $row['libelle'], $categorie, $row['prix'], $row['image']);
      }
      
      return $articles; // Retourne le tableau d'articles
  }
  // Récupère des articles étant donné un No de page et une catégorie
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  // $categorie : la categorie qui sert de filtre
  public static function readPageCategorie(int $page, int $pageSize, Categorie $categorie): array
  {
      // Accès au DAO
      $dao = DAO::get();
      
      // Calculer l'offset pour la requête SQL
      $offset = ($page - 1) * $pageSize;
      
      // Prépare la requête SQL pour récupérer les articles d'une catégorie spécifique avec pagination
      // On utilise une jointure pour obtenir les informations de la catégorie en une seule requête
      $sql = "SELECT a.*, c.nom as categorie_nom 
              FROM article a
              JOIN categorie c ON a.categorie = c.id
              WHERE a.categorie = :categorie 
              ORDER BY a.ref 
              LIMIT :limit OFFSET :offset";
      
      $query = $dao->prepare($sql);
      
      // Lier les paramètres avec des valeurs appropriées
      $query->bindValue(':categorie', $categorie->getId(), PDO::PARAM_INT);
      $query->bindValue(':limit', $pageSize, PDO::PARAM_INT);
      $query->bindValue(':offset', $offset, PDO::PARAM_INT);
      
      // Exécute la requête SQL
      $query->execute();
      
      // Récupère tous les résultats
      $articlesData = $query->fetchAll(PDO::FETCH_ASSOC);
      
      // Créer un tableau d'objets Article à partir des résultats
      $articles = [];
      foreach ($articlesData as $row) {
          // Nous utilisons la catégorie passée en paramètre, mais on pourrait aussi créer une nouvelle instance
          // si on voulait récupérer des informations spécifiques de la catégorie pour chaque article
          $articles[] = new Article(
              $row['ref'],
              $row['libelle'],
              $categorie, // On utilise la catégorie passée en paramètre
              $row['prix'],
              $row['image']
          );
      }
      
      return $articles; // Retourne le tableau d'articles
  }

  public function executeQuery(string $sql, array $params): array {
    // Accès au DAO
    $dao = DAO::get();
    
    // Prépare la requête SQL en utilisant l'objet PDO
    $query = $dao->pdo->prepare($sql);
    
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute($params);
    
    // Récupère tous les résultats
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

  
  

}
