<div class="card">
    <div class="card-header">
        <h1 class="card-title">
            {{$subject}}
            <a href="{$_layoutParams.root}suscriptores/add" class="btn btn-outline-secondary">Nuevo Suscriptor</a>
        </h1>
    </div>
    <div class="card-body">
        {include file="../partials/_messages.tpl"}
        {if isset($suscriptores) && count($suscriptores)}
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>RUT</th>
                        <th>Estado</th>
                        <th>Comuna</th>
                        <th>Nacionalidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$suscriptores item=suscriptor}
                        <tr>
                            <td>{$suscriptor.id}</td>
                            <td>{$suscriptor.nombre}</td>
                            <td>{$suscriptor.rut}</td>
                            <td>
                                {if $suscriptor.activo == 1}
                                    <span class="badge badge-success">Activo</span>
                                {else}
                                    <span class="badge badge-warning">Bloqueado</span>
                                {/if}
                            </td>
                            <td>{$suscriptor.comuna.nombre}</td>
                            <td>{$suscriptor.nacionalidad.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}suscriptores/show/{$suscriptor.id}"
                                    class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}suscriptores/edit/{$suscriptor.id}"
                                    class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="text-info">No hay suscriptores registrados</p>
        {/if}
    </div>
</div>