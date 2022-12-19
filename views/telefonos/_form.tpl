<div class="col-md-6">
    <form action="{$_layoutParams.root}{$process}" method="post">
        <div class="form-group mb-2">
            <label for="numero" class="control-label">Número<span class="text-danger">*</span></label>
            <input type="number" name="numero" value="{$telefono.numero|default:""}" class="form-control" id="numero"
                aria-describedby="" placeholder="Número de teléfono">
        </div>
        <div class="form-group mb-2">
            <label for="movil" class="control-label">Tipo<span class="text-danger">*</span></label>
            <select name="movil" id="movil" class="form-control">
                {if $button == 'Editar'}
                    {if $telefono.movil == 1}
                        <option value="1">Móvil</option>
                        <option value="2">Fijo</option>
                    {else}
                        <option value="2">Fijo</option>
                        <option value="1">Móvil</option>
                    {/if}
                {else}
                    <option value="">Seleccione...</option>
                    <option value="1">Móvil</option>
                    <option value="2">Fijo</option>
                {/if}
            </select>
        </div>

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-outline-success">{$button}</button>
        <a href="{$_layoutParams.root}{$back}" class="btn btn-outline-primary">Cancelar</a>
    </form>
</div>