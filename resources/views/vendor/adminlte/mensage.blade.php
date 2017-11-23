<!-- Mensagem de Ação -->
@if(Session::has('mensagem_sucesso'))
    <div class="callout callout-success">
        {{ Session::get('mensagem_sucesso') }}
    </div>
@elseif(Session::has('mensagem_update'))
    <div class="callout callout-warning">
        {{ Session::get('mensagem_update') }}
    </div>
@elseif(Session::has('mensagem_destroy'))
    <div class="callout callout-danger">
        {{ Session::get('mensagem_destroy') }}
    </div>
@endif