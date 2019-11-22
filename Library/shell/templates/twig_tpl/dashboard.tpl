{# View gerada automaticamente Via Scooby_CLI em dateNow #}
{% if msg %}
    {{ msg|raw }} 
{% endif %}
<div class='container-fluid z-depth-5' style="margin:3% 10% !important; padding:5%; background-color: #ddd !important">
    <h2 class="center">ScoobyPHP DashBoard.</h2>
    <h4 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou
        corretamente!</h4>
    <br>
    <a href='{{ base_url }}exit' class='btn black waves-light'>Sair</a>
    <a href="{{ base_url }}delete-user" class="btn red"> Apagar usuario</a>
    <a href="{{ base_url }}alter-user" class="btn green"> Atualizar usuario</a>
</div>
