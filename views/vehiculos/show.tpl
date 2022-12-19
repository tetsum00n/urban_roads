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
                    <td>{$nacionalidad.nombre}</td>
                </tr>
                <tr>
                    <th>Creado:</th>
                    <td>{$nacionalidad.created_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
                <tr>
                    <th>Modificado:</th>
                    <td>{$nacionalidad.updated_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
            </table>
        </div>
        <p>
            <a href="{$_layoutParams.root}nacionalidades" class="btn btn-outline-primary btn-sm">Volver</a>
        </p>
    </div>
</div>