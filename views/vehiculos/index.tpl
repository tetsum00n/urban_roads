<div class="card">
    <div class="card-header">
        <h1 class="card-title">
            {{$subject}}
            <br></br>
            <a href="{$_layoutParams.root}vehiculos/add" class="btn btn-outline-secondary">Nuevo Vehiculo</a>
        </h1>
    </div>
    <div class="card-body">
        {include file="../partials/_messages.tpl"}
        {if isset($vehiculos) && count($vehiculos)}
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$vehiculos item=vehiculo}
                        <tr>
                            <td>{$vehiculo.id}</td>
                            <td>{$vehiculo.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}nacionalidades/show/{$vehiculo.id}" class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}nacionalidades/edit/{$vehiculo.id}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="text-info">No hay vehiculos registrados</p>
        {/if}
    </div>
</div>