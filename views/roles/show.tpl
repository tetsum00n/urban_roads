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
                    <td>{$role.nombre}</td>
                </tr>
                <tr>
                    <th>Creado:</th>
                    <td>{$role.created_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
                <tr>
                    <th>Modificado:</th>
                    <td>{$role.updated_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
                </tr>
            </table>
        </div>
        <p>
            <a href="{$_layoutParams.root}roles" class="btn btn-outline-primary btn-sm">Volver</a>
        </p>
    </div>
</div>