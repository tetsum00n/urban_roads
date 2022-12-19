<div class="col-md-6">
    <form action="{$_layoutParams.root}{$process}" method="post">
        <div class="form-group mb-2">
            <label for="nombre" class="control-label">Nombre<span class="text-danger">*</span></label>
            <input type="text" name="nombre" value="{$suscriptor.nombre|default:""}" class="form-control" id="nombre"
                aria-describedby="" placeholder="Nombre del suscriptor">
        </div>
        <div class="form-group mb-2">
            <label for="rut" class="control-label">RUT<span class="text-danger">*</span></label>
            <input type="text" name="rut" value="{$suscriptor.rut|default:""}" class="form-control" id="rut"
                aria-describedby="" placeholder="RUT del suscriptor">
        </div>

        <div class="form-group mb-2">
            <label for="email" class="control-label">Email<span class="text-danger">*</span></label>
            <input type="email" name="email" value="{$suscriptor.email|default:""}" class="form-control" id="email"
                aria-describedby="" placeholder="Email del suscriptor">
        </div>
        <div class="form-group mb-2">
            <label for="direccion" class="control-label">Dirección<span class="text-danger">*</span></label>
            <textarea name="direccion" id="direccion" class="form-control" rows="4"
                placeholder="Dirección del suscriptor" style="resize: none;">
                {{$suscriptor.direccion|default:""}}
            </textarea>
        </div>
        <div class="form-group mb-2">
            <label for="comuna" class="control-label">Comuna<span class="text-danger">*</span></label>
            <select name="comuna" id="comuna" class="form-control">
                {if $button == 'Editar'}
                    <option value="{$suscriptor.comuna_id}">{$suscriptor.comuna.nombre}</option>
                {/if}
                <option value="">Seleccione...</option>
                {foreach from=$comunas item=comuna}
                    <option value="{$comuna.id}">{$comuna.nombre}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group mb-2">
            <label for="nacionalidad" class="control-label">Nacionalidad<span class="text-danger">*</span></label>
            <select name="nacionalidad" id="nacionalidad" class="form-control">
                {if $button == 'Editar'}
                    <option value="{$suscriptor.nacionalidad_id}">{$suscriptor.nacionalidad.nombre}</option>
                {/if}
                <option value="">Seleccione...</option>
                {foreach from=$nacionalidades item=nacionalidad}
                    <option value="{$nacionalidad.id}">{$nacionalidad.nombre}</option>
                {/foreach}
            </select>
        </div>

        {if $button == 'Editar'}
            <div class="form-group mb-2">
                <label for="activo" class="control-label">Estado<span class="text-danger">*</span></label>
                <select name="activo" id="activo" class="form-control">
                    {if $suscriptor.activo == 1}
                        <option value="1">Activo</option>
                        <option value="2">Bloquear</option>
                    {else}
                        <option value="2">Bloqueado</option>
                        <option value="1">Activar</option>
                    {/if}
                </select>
            </div>
        {/if}

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-outline-success">{$button}</button>
        <a href="{$_layoutParams.root}{$back}" class="btn btn-outline-primary">Cancelar</a>
    </form>
</div>