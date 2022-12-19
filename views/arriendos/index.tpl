<div class="card">
    <div class="card-header">
    <h1 class="card-title">
        {{$subject}}
        <br></br>
        <a href="{$_layoutParams.root}arriendos/add" class="btn btn-outline-secondary">Nuevo Arriendo</a>
    </h1>
    </div>
    <div class="card-body">

        {include file="../partials/_messages.tpl"}

        {if isset($arriendos) && count($arriendos)}
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Fecha de Arriendo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$arriendos item=arriendo}
                        <tr>
                            <td>{$arriendo.id}</td>
                            <td>{$arriendo.nombre}</td>
                            <td>{$arriendo.created_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                            <td>
                                <a href="{$_layoutParams.root}arriendos/show/{$arriendo.id}" class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}arriendos/edit/{$arriendo.id}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="text-info">No hay arriendos registrados</p>
        {/if}
    </div>
</div>