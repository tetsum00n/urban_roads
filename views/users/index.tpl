<div class="card">
    <div class="card-header">
    <h1 class="card-title">
        {{$subject}}
        <br></br>
        <a href="{$_layoutParams.root}users/add" class="btn btn-outline-secondary">Nuevo Usuario</a>
    </h1>
    </div>
    <div class="card-body">

        {include file="../partials/_messages.tpl"}

        {if isset($users) && count($users)}
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>RUT</th>
                        <th>Comuna</th>
                        <th>Rol</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$users item=user}
                        <tr>
                            <td>{$user.id}</td>
                            <td>{$user.nombre}</td>
                            <td>{$user.rut}</td>
                            <td>{$user.comuna.nombre}</td>
                            <td>{$user.role.nombre}</td>
                            <td>
                                {if $user.status == 1}
                                    <span class="badge badge-success">Activo</span>
                                {else}
                                    <span class="badge badge-danger">Inactivo</span>
                                {/if}
                            </td>
                            <td>
                                <a href="{$_layoutParams.root}users/show/{$user.id}" class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}users/edit/{$user.id}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="text-info">No hay usuarios registrados</p>
        {/if}
    </div>
</div>