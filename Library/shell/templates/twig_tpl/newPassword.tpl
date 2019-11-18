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
                <form class="login-form  z-depth-5" method="post" action="{{ base_url }}password-reset">
                    <div class="card">
                        <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                        <input type="hidden" name="passwordToken" value='{{ token }}'>
                        <div class="card-content">
                            <div class="input-field col s12">
                                <input placeholder="Digite a nova senha" id='new-pass' name="new-password" type="password" class="validate">
                                <label for="new-pass">Nova Senha</label>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="input-field col s12">
                                        <input placeholder="Confirme a nova senha" id='confirm-pass' name="confirm-password" type="password"
                                            class="validate">
                                        <label for="confirm-pass">Confirme Nova Senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Entrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col s4">
                        <a href="{{ base_url }}register" class="btn purple">Registrar</a>
                    </div>
                    <div class="col s8 right-align">
                        <a href="{{ base_url }}passwordRescue" class="btn red">Esqueci a senha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>