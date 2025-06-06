<h2>Editar Evaluación</h2>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $data['evaluacion']['nombre'] ?>" required><br>
    <label>Descripción:</label>
    <textarea name="descripcion" required><?= $data['evaluacion']['descripcion'] ?></textarea><br>
    <label>Fecha:</label>
    <input type="date" name="fecha" value="<?= $data['evaluacion']['fecha'] ?>" required><br>
    <button type="submit">Actualizar</button>
</form>
<a href="/peoplepro/public/evaluacion/index">Volver</a>
