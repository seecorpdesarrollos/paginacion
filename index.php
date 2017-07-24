<?php
require 'conexion/conexion.php';

if (!isset($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}

if ($pagina == 0) {
    header('location:index.php');
}
$por_pagina = 5;
$sql1 = $conexion->prepare("SELECT  COUNT(*) as 'total' FROM cliente");
$sql1->execute();
$total_pagina = $sql1->fetch()['total'];
$cant_pagina = ceil($total_pagina / $por_pagina);

if ($pagina >= $cant_pagina) {
    $pagina = $cant_pagina;
}
$pag_last = $pagina * $por_pagina - $por_pagina;
$sql = $conexion->prepare("SELECT   * FROM cliente LIMIT $pag_last ,$por_pagina");
$sql->execute();
$result = $sql->fetchAll();

require 'views/index.view.php';
