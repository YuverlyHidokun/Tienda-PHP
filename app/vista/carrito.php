<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">

</head>
<body class="container py-5">

    <h1 class="mb-4">Tu Carrito de Compras</h1>

    <?php if (empty($productosCarrito)): ?>
        <p>El carrito está vacío.</p>
        <a href="index.php?action=inicio" class="btn btn-primary">Volver a la tienda</a>
    <?php else: ?>
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($productosCarrito as $prod):
                    $subtotal = $prod['precio'] * $prod['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($prod['nombre']) ?></td>
                        <td>$<?= number_format($prod['precio'], 2) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <a href="index.php?action=disminuirCantidad&id=<?= $prod['id'] ?>" class="btn btn-sm btn-warning">-</a>
                            <span class="mx-2"><?= $prod['cantidad'] ?></span>
                            <a href="index.php?action=agregarCarrito&id=<?= $prod['id'] ?>" class="btn btn-sm btn-success">+</a>
                            <a href="index.php?action=eliminarDelCarrito&id=<?= $prod['id'] ?>" class="btn btn-danger btn-sm ms-3">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <a href="index.php?action=inicio" class="btn btn-secondary">Seguir comprando</a>
        <a href="index.php?action=vaciarCarrito" class="btn btn-warning ms-2">Vaciar carrito</a>
        <button class="btn btn-success ms-2" disabled>Pagar (no implementado)</button>
    <?php endif; ?>

</body>
</html>
