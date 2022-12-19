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
                    <th>Número:</th>
                    <td>{$telefono.numero}</td>
                </tr>
                <tr>
                    <th>Tipo Teléfono   :</th>
                    <td>
                        {if $telefono.movil == 1}
                            Móvil
                        {else}
                            Fijo
                        {/if}
                    </td>
                </tr>
                <tr>
                    <th>Propietario(a):</th>
                    <td>
                        {{$propietario->name}}
                    </td>
                </tr>
                <tr>
                    <th>Tipo Usuario:</th>
                    <td>{{$telefono->telefonoable_type}} </td>
                </tr>
                <tr>
                    <th>Creado:</th>
                    <td>{$telefono.created_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
                <tr>
                    <th>Modificado:</th>
                    <td>{$telefono.updated_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
            </table>
        </div>
        <p>
            <a href="{$_layoutParams.root}{$back}" class="btn btn-outline-primary btn-sm">Volver</a>
            <a href="{$_layoutParams.root}telefonos/edit/{$telefono.id}" class="btn btn-outline-success btn-sm">Editar</a>

            <form action="{$_layoutParams.root}telefonos/destroy/{$telefono.id}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="send" value="{$send}">
                <button type="submit" class="btn btn-outline-warning">Eliminar</button>
            </form>
        </p>
    </div>
</div>