{# View gerada automaticamente Via Scooby_CLI em dateNow #}
{% if msg %}
    {{ msg|raw }} 
{% endif %}
<div class='container z-depth-5' style="margin:3% auto !important; padding:5%; background-color: #ddd !important">
    <h2 class="center">ScoobyPHP DashBoard.</h2>
    <h4 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou
        corretamente!</h4>
    <br>
    <a href='{{ base_url }}exit' class='btn black waves-light'>{{ btn_sign_out }}</a>
    <form action="{{ base_url }}delete-user" method="post">
        {{ method_delete|raw }}
        <input type="submit" class="btn red" value="{{ btn_delete }}">
    </form>
    <a href="{{ base_url }}alter-user" class="btn green">{{ btn_update }}</a>
</div>
