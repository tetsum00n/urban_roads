<div class="card">
    <div class="card-header">
        <h1 class="card-title">{{$subject}}</h1>
    </div>
    <div class="card-body">
        {include file="../partials/_messages.tpl"}
        <p class="text-danger">Campos obligatorios</p>
        {include file="../telefonos/_form.tpl"}
    </div>
</div>