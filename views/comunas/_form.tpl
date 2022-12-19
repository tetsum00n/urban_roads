<div class="col-md-6">
    <form action="{$_layoutParams.root}{$process}" method="post">
        <div class="form-group mb-2">
            <label for="nombre" class="control-label">Nombre<span class="text-danger">*</span></label>
            <input type="text" name="nombre" value="{$comuna.nombre|default:""}" class="form-control" id="nombre" aria-describedby="" placeholder="Nombre de la comuna">
        </div>

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-outline-success">{$button}</button>
        <a href="{$_layoutParams.root}{$back}" class="btn btn-outline-primary">Cancelar</a>
    </form>
</div>