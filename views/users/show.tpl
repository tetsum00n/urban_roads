<div class="card">
    <div class="card-header">
    <h1 class="card-title">
        {{$subject}}
    </h1>
    </div>
    <div class="card-body">
        {include file="../partials/_messages.tpl"}
        <div class="col-md-6">
            <table class="table table-hover">
                <tr>
                    <th>Nombre:</th>
                    <td>{$user.nombre}</td>
                </tr>
                <tr>
                    <th>RUT:</th>
                    <td>{$user.rut}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{$user.email}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        {if $user.status == 1}
                            Activo
                        {else}
                            Inactivo
                        {/if}
                    </td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{$user.direccion}</td>
                </tr>
                <tr>
                    <th>Comuna:</th>
                    <td>{$user.comuna.nombre}</td>
                </tr>
                <tr>
                    <th>Rol:</th>
                    <td>{$user.role.nombre}</td>
                </tr>
                <tr>
                    <th>Teléfonos:</th>
                    <td>
                        {if isset($telefonos) && count($telefonos)}
                            <div class="list-group">
                                {foreach from=$telefonos item=telefono}

                                    <a href="{$_layoutParams.root}telefonos/show/{$telefono.id}" class="list-group-item list-group-item-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16"
                                            fill="currentColor" class="bi bi-telephone-forward-fill"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zm10.761.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z" />
                                        </svg>&nbsp;
                                        {{$telefono.numero}}
                                    </a>
                                {/foreach}
                            </div>
                        {else}
                            <p class="text-info">No tiene teléfonos registrados</p>
                        {/if}
                    </td>
                </tr>
                <tr>
                    <th>Creado:</th>
                    <td>{$user.created_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
                <tr>
                    <th>Modificado:</th>
                    <td>{$user.updated_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
            </table>
            <p>
                <a href="{$_layoutParams.root}users" class="btn btn-outline-primary btn-sm">Volver</a>
                <a href="{$_layoutParams.root}telefonos/add/{$user.id}/user" class="btn btn-outline-primary btn-sm">Agregar Teléfono</a>
            </p>
            <p>
                <a href="{$_layoutParams.root}passwords/edit" class="btn btn-outline-success btn-sm">Cambiar Password</a>
            </p>
        </div>
    </div>
</div>