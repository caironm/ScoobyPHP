    {# View gerada automaticamente Via Scooby_CLI em dateNow #}
    <div class="bg-login">
        <div class="container-fluid z-depth-5" style="margin:3% 10% !important; padding:0; background-color: #ddd !important">
                <a href="{{ base_url }}back" class="btn black">voltar</a>
            <h2 class="center">ScoobYTasks - Recuperação de senha</h2>
            {% if msg %}
            <span class="alert"> {{ msg|raw }} </span>
            {% endif %}
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <form class="login-form  z-depth-5" method="post" action="{{ base_url }}user/newPass">
                        <div class="card">
                            <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                            <div class="card-content">
                                <div class="input-field">
                                    <input class="validate" id="email" type="email" name="email">
                                    <label for="email">Digite seu email cadastrado em nosso sistema</label>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="center-align">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Recuperar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                            <div class="col s8 ">
                                    <a href="{{ base_url }}login" class="btn red">Login</a>
                                </div>
                        <div class="col s4 right-align">
                            <a href="{{ base_url }}register" class="btn purple">Registrar</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>