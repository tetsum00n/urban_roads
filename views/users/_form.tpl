<div class="col-md-6">

    <form action="{$_layoutParams.root}{$process}" method="post">
        <div class="form-group mb-2">
            <label for="nombre" class="control-label">Nombre<span
                    class="text-danger">*</span></label>
            <input type="text" name="nombre" value="{$user.nombre|default:""}" class="form-control" id="" aria-describedby=""
                placeholder="Nombre del usuario">
        </div>
        <div class="form-group mb-2">
            <label for="rut" class="control-label">RUT<span
                    class="text-danger">*</span></label>
            <input type="text" name="rut" value="{$user.rut|default:""}" class="form-control" id="" aria-describedby=""
                placeholder="RUT del usuario">
        </div>
        <div class="form-group mb-2">
            <label for="email" class="control-label">Email<span class="text-danger">*</span></label>
            <input type="email" name="email" value="{$user.email|default:""}" class="form-control" id="" aria-describedby=""
                placeholder="Email del usuario">
        </div>
        
        {if $button == 'Editar'}
            <div class="form-group mb-2">
                <label for="status" class="control-label">Status<span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    {if $user.status == 1}
                        <option value="{$user.status}">Activo</option>
                        <option value="2">Desactivar</option>
                    {else}
                        <option value="{$user.status}">Inactivo</option>
                        <option value="1">Activar</option>
                    {/if}
                </select>
            </div>
        {/if}

        <div class="form-group mb-2">
            <label for="direccion" class="control-label">Dirección<span
                    class="text-danger">*</span></label>
            <textarea name="direccion" class="form-control" id="direccion" placeholder="Dirección del usuario" rows="4" style="resize:none;">{$user.direccion|default:""}</textarea>
        </div>
        <div class="form-group mb-2">
            <label for="comuna" class="control-label">Comuna<span
                    class="text-danger">*</span></label>
            <select name="comuna" class="form-control" id="comuna">
                {if $button=="Editar"}
                    <option value="{$user.comuna_id}">{{$user.comuna.nombre}} </option>
                {/if}
                <option value="">Seleccione... </option>
                {foreach from=$comunas item=comuna}
                    <option value="{$comuna.id}">{{$comuna.nombre}} </option>
                {/foreach}
            </select>
        </div>
        <div class="form-group mb-2">
            <label for="role" class="control-label">Rol<span
                    class="text-danger">*</span></label>
            <select name="role" class="form-control" id="role">
                {if $button=="Editar"}
                    <option value="{$user.role_id}">{{$user.role.nombre}} </option>
                {/if}
                <option value="">Seleccione... </option>
                {foreach from=$roles item=role}
                    <option value="{$role.id}">{{$role.nombre}} </option>
                {/foreach}
            </select>
        </div>
        {if $button == 'Guardar' || $button == 'Modificar'}
            <div class="form-group">
                <label for="password" class="control-label">Password<span
                        class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" id="" aria-describedby=""
                    placeholder="Password del usuario" onpaste="return false">
            </div>
            <div class="form-group mb-2">
                <label for="password_confirm" class="control-label">Confirmar Password<span class="text-danger">*</span></label>
                <input type="password" name="password_confirm" class="form-control" id="" aria-describedby="" placeholder="Confirmar password del usuario" onpaste="return false">
            </div>
        {/if}

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-outline-success">{$button}</button>
        <a href="{$_layoutParams.root}{$back}" class="btn btn-outline-primary">Cancelar</a>
    </form>
</div>