<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit();
}

// Constantes
const IVA = 0.12;                // 12%
const LIMITE_DESCUENTO = 150;    // $150
const PORC_DESCUENTO = 0.15;     // 15%

// Captura y validación
$descripcion = htmlspecialchars(trim($_POST['descripcion'] ?? ''));
$cantidad    = intval($_POST['cantidad'] ?? 0);
$precio      = floatval($_POST['precio'] ?? 0);

if ($descripcion === '' || $cantidad <= 0 || $precio <= 0) {
    echo '<div class="alert alert-danger m-5">Datos inválidos. <a href="index.html">Volver</a></div>';
    exit();
}

// Cálculos
$subtotal        = $cantidad * $precio;       // Precio bruto
$montoIva        = $subtotal * IVA;           // IVA
$totalConIva     = $subtotal + $montoIva;     // Precio total de venta

// Descuento condicional
$aplicaDescuento = $totalConIva > LIMITE_DESCUENTO;
$montoDescuento  = $aplicaDescuento ? $totalConIva * PORC_DESCUENTO : 0;
$totalNeto       = $totalConIva - $montoDescuento;

// Formato
function fmt($n) {
    return '$ ' . number_format($n, 2, '.', ',');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Generada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Factura de Compra</h4>
                    </div>
                    <div class="card-body">

                        <h5 class="mb-3">Detalle del Artículo</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 40%;">Descripción</th>
                                    <td><?= $descripcion ?></td>
                                </tr>
                                <tr>
                                    <th>Cantidad</th>
                                    <td><?= $cantidad ?> unidades</td>
                                </tr>
                                <tr>
                                    <th>Precio Unitario</th>
                                    <td><?= fmt($precio) ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mb-3">Desglose</h5>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal (<?= $cantidad ?> × <?= fmt($precio) ?>):</span>
                                <strong><?= fmt($subtotal) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>IVA (12%):</span>
                                <span><?= fmt($montoIva) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total con IVA:</span>
                                <strong><?= fmt($totalConIva) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Descuento (15%):</span>
                                <?php if ($aplicaDescuento): ?>
                                    <span class="text-success">- <?= fmt($montoDescuento) ?> (aplicado)</span>
                                <?php else: ?>
                                    <span class="text-muted">No aplica (el total no supera $150)</span>
                                <?php endif; ?>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-success text-white">
                                <span><strong>Total Neto a Pagar:</strong></span>
                                <strong><?= fmt($totalNeto) ?></strong>
                            </li>
                        </ul>

                        <a href="index.html" class="btn btn-secondary w-100">Nueva Factura</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>