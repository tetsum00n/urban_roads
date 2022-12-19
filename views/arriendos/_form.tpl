<div class="col-md-6">
    <form action="{$_layoutParams.root}{$process}" method="post">
        <div class="form-group mb-2">
            <label for="nombre" class="control-label">Nombre del producto<span class="text-danger">*</span></label>
            <input type="text" name="nombre" value="{$arriendo.nombre|default:""}" class="form-control" id="nombre" aria-describedby="" placeholder="Nombre del producto">
        </div>
        <div class="form-group mb-2">
            <label for="arriendo" class="control-label">Arriendo<span
                    class="text-danger">*</span></label>
            <select name="arriendo" class="form-control" id="arriendo">
                {if $button=="Editar"}
                    <option value="{$user.arriendo_id}">{{$arriendo.nombre}} </option>
                {/if}
                <option value="">Seleccione... </option>
                {foreach from=$arriendos item=arriendo}
                    <option value="{$arriendo.id}">{{$arriendo.nombre}} </option>
                {/foreach}
            </select>
        </div>

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-outline-success">{$button}</button>
        <a href="{$_layoutParams.root}{$back}" class="btn btn-outline-primary">Cancelar</a>

        
    </form>
</div>