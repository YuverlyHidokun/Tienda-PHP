<?php
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        img { width: 80px; height: auto; }
        a.op, form.eliminar-form { margin: 0 5px; display: inline-block; }
    </style>
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tu archivo de estilos personalizados -->
    <link rel="stylesheet" href="assets/css/estilos.css">

</head>
<body>
    <h1>Productos Registrados</h1>
    <a href="index.php?action=registrar">Registrar Nuevo Producto</a><br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $prod): ?>
                <tr>
                    <td><?= $prod['id'] ?></td>
                    <td>
                        <?php if ($prod['foto']): ?>
                            <img src="../imagenes/<?= htmlspecialchars($prod['foto']) ?>" alt="foto">
                        <?php else: ?>
                            <em>Sin imagen</em>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                    <td>$<?= number_format($prod['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($prod['categoria']) ?></td>
                    <td>
                        <a class="op" href="index.php?action=editar&id=<?= $prod['id'] ?>">✏️ Editar</a>

                        <form method="POST" action="index.php?action=eliminar&id=<?= $prod['id'] ?>" class="eliminar-form" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
