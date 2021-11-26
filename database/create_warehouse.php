<!DOCTYPE html>
<html>

<body>

  <h1>Create Warehouse</h1>

  <?php
  echo "Remember that use this only to start a new warehouse!";
  ?>

  <h3>Create warehouse and shelfs</h3>
  <div style="background-color: #999;padding: 1rem; margin-top: 1rem">
    <p>Office is: 'Päätoimipaikka' id=1</p>
    <p style="padding: 1rem; background-color: #fff;">240 rengassarjapaikkaa:<br> hylly 1 36 sarjaa,<br> hylly 2 36 sarjaa,<br> hylly 3 40 sarjaa,<br> hylly 4 40 sarjaa,<br> hylly 5 88 sarjaa</p>

    <form method="post">
      <p>Luodaan toimisto, sinne varasto, 5 hyllyä ja niihin tarvittavat paikat.</p>
      <input type="submit" name="addWarehouseShelfs" value="Create shelfs and slots">
    </form>
  </div>
  <h3>Warehouse 1</h3>
  <?php
  if (isset($_POST['addWarehouseShelfs'])) {

    require_once '../inc/functions.php';

    $db = null;

    try {
      //instantiate DB & connect
      $db = openDb();
      // Create query
      $sql = "insert into office (name, phone, email, address, zipcode, city, logo) values
      ('Päätoimipaikka', '0407654321', 'paatoim@rengashotelli.org', 'Rengashotellintie 6', '76543', 'Renkaala', 'logo.jpg')";

      $db->query($sql);
    } catch (PDOException $pdoex) {
      returnError($pdoex);
    }
    echo "<h4>Toimisto luotu.</h4>";

    try {
      //instantiate DB & connect
      $db = openDb();
      // Create query
      $sql = "insert into warehouse (name, office_id) values ('iso varasto', 1);";

      $db->query($sql);
    } catch (PDOException $pdoex) {
      returnError($pdoex);
    }
    echo "<h4>Varasto luotu.</h4>";
    $nro_shelf = 5;
    $create_shelf = 1;
    $shelf_1 = [36, 36, 40, 40, 88];

    $slot_id = 1;

    while ($create_shelf <= $nro_shelf) {
      try {
        //instantiate DB & connect
        $db = openDb();
        // Create query
        $sql = "insert into shelf (id, warehouse_id) values ($create_shelf, 1);";

        $db->query($sql);
      } catch (PDOException $pdoex) {
        returnError($pdoex);
      }
      $db = null;

      $slots_nro = 1;
      while ($slots_nro <= $shelf_1[$create_shelf - 1]) {
        try {
          //instantiate DB & connect
          $db = openDb();
          // Create query
          $sql = "insert into slot (id, shelf_id) values ($slot_id, $create_shelf)";

          $db->query($sql);
        } catch (PDOException $pdoex) {
          returnError($pdoex);
        }

        $db = null;
        $slots_nro++;
        $slot_id++;
      }
      echo "Hyllyjä luotu: " . $create_shelf .  " Paikkoja luotu: " . $slots_nro - 1 . "<br>";
      $create_shelf++;
    }
    echo "<h4>Hyllyjä yhteensä: " . $nro_shelf .  " Paikkoja yhteensä: " . $slot_id - 1 . "</h4>";
  }

  ?>
</body>

</html>