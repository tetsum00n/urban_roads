<div class="card">
    <div class="card-header">
    <h1 class="card-title">
        {{$subject}}
        <br></br>
        <a href="{$_layoutParams.root}comunas/add" class="btn btn-outline-secondary">Nueva Comuna</a>
    </h1>
    </div>
    <div class="card-body">
        {include file="../partials/_messages.tpl"}
        {if isset($comunas) && count($comunas)}
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$comunas item=comuna}
                        <tr>
                            <td>{$comuna.id}</td>
                            <td>{$comuna.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}comunas/show/{$comuna.id}" class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}comunas/edit/{$comuna.id}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="text-info">No hay comunas registradas</p>
        {/if}
    </div>
</div>