<h2><?= isset($horario) ? 'Editar Horario' : 'Nuevo Horario' ?></h2>

<form method="POST" action="<?= isset($horario) ? "index.php?c=horarios&a=actualizar&id={$horario['id']}" : 'index.php?c=horarios&a=guardar' ?>">
    <label>Trabajador:</label>
    <select name="user_id" required>
        <option value="">Seleccione</option>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>" <?= (isset($horario) && $horario['user_id'] == $u['id']) ? 'selected' : '' ?>>
                <?= $u['nombre'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Fecha:</label>
    <input type="date" name="fecha" value="<?= $horario['fecha'] ?? '' ?>" required><br>

    <label>Hora Entrada:</label>
    <input type="time" name="hora_entrada" value="<?= $horario['hora_entrada'] ?? '' ?>"><br>

    <label>Hora Salida:</label>
    <input type="time" name="hora_salida" value="<?= $horario['hora_salida'] ?? '' ?>"><br>

    <label>Estado:</label>
    <select name="estado">
        <?php
        $estados = ['Activo', 'Vacaciones', 'Incapacidad', 'Permiso', 'Ausente'];
        foreach ($estados as $estado):
            $selected = (isset($horario) && $horario['estado'] === $estado) ? 'selected' : '';
            echo "<option value='$estado' $selected>$estado</option>";
        endforeach;
        ?>
    </select><br>

    <label>Observaciones:</label><br>
    <textarea name="observaciones"><?= $horario['observaciones'] ?? '' ?></textarea><br>

    <button type="submit">Guardar</button>
</form>
