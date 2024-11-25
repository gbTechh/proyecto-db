<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
<?php endif; ?>

<div class="transportes">
    <div class="form-group">
        <form action="transportes.php?action=update&id=<?php echo $transporte->getID(); ?>" method="POST" class="transporte-form">
            <div>
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" id="tipo" value="<?php  htmlspecialchars($data['transporte']->getTipo() ?? ''); ?>">
            </div>
            <div>
                <label for="costo">Costo</label>
                <input type="number" name="costo" id="costo" value="<?php  htmlspecialchars($data['transporte']->getCosto()); ?>">
            </div>
            <div>
                <label for="empresa">Empresa</label>
                <input type="text" name="empresa" id="empresa" value="<?php  htmlspecialchars($data['transporte']->getEmpresa() ?? '');?>">
            </div>
            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</div>