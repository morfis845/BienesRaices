<fieldset>
    <legend>Informacion General</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre del Vendedor" value="<?php echo s($vendedor->nombre); ?>">
    <label for="apellido">Apellido:</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido del Vendedor" value="<?php echo s($vendedor->apellido); ?>">
    <label for="telefono">Telefono:</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" value = "<?php echo s($vendedor->telefono); ?>">
</fieldset>