<?php
class Customer
{
  //DB stuff
  private $conn;
  private $table = 'asiakas';

  //Customer Properties
  public $etunimi;
  public $sukunimi;
  public $puhnro;
  public $sposti;
  public $osoite;
  public $postinro;
  public $postitmp;
  public $tallennettu;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Create customer
  public function create()
  {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' (etunimi, sukunimi, puhnro, sposti, osoite, postinro, postitmp)
          VALUES(
            :etunimi,
            :sukunimi,
            :puhnro,
            :sposti,
            :osoite,
            :postinro,
            :postitmp)';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    //Clean data
    $this->etunimi = htmlspecialchars(strip_tags($this->etunimi));
    $this->sukunimi = htmlspecialchars(strip_tags($this->sukunimi));
    $this->puhnro = htmlspecialchars(strip_tags($this->puhnro));
    $this->sposti = htmlspecialchars(strip_tags($this->sposti));
    $this->osoite = htmlspecialchars(strip_tags($this->osoite));
    $this->postinro = htmlspecialchars(strip_tags($this->postinro));
    $this->postitmp = htmlspecialchars(strip_tags($this->postitmp));

    //Bind data
    $stmt->bindParam(':etunimi', $this->etunimi);
    $stmt->bindParam(':sukunimi', $this->sukunimi);
    $stmt->bindParam(':puhnro', $this->puhnro);
    $stmt->bindParam(':sposti', $this->sposti);
    $stmt->bindParam(':osoite', $this->osoite);
    $stmt->bindParam(':postinro', $this->postinro);
    $stmt->bindParam(':postitmp', $this->postitmp);

    //Execute query
    if ($stmt->execute()) {
      return true;
    }
    //Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
}
