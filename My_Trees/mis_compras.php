<?php
require('utils/functions.php');
$conn = getConnection();
$sql = "SELECT * FROM mis_compras";
$result = mysqli_query($conn, $sql);

?>
<?php require('inc/header.php') ?>
<div class="container-fluid">
  <div class="jumbotron">
    <h1 class="display-4">Trees</h1>
    <p class="lead">List of trees</p>
    <hr class="my-4">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre comprador</th>
        <th>Especie</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
          <td><?php echo htmlspecialchars($row['id']); ?></td>
          <td><?php echo htmlspecialchars($row['nombre_comprador']); ?></td>
          <td><?php echo htmlspecialchars($row['especie']); ?></td>
          <td>
            <a href="actions/detalles.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-warning">Detalles</a>
            <a href="actions/delete.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger">Eliminar</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>