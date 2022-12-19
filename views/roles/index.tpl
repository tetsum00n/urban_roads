<div class="card">
    <div class="card-header">
    <h1 class="card-title">
        {{$subject}}
        <br></br>
        <a href="{$_layoutParams.root}roles/add" class="btn btn-outline-secondary">Nuevo Rol</a>
    </h1>
    </div>
    <div class="card-body">
        {include file="../partials/_messages.tpl"}
        {if isset($roles) && count($roles)}
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$roles item=role}
                        <tr>
                            <td>{$role.id}</td>
                            <td>{$role.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}roles/show/{$role.id}" class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}roles/edit/{$role.id}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="text-info">No hay roles registrados</p>
        {/if}
    </div>
</div>