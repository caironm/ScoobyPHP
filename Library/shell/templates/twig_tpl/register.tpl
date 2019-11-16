{# View gerada automaticamente Via Scooby_CLI em dateNow #}
<div class="container-fluid bg-login z-depth-5" style="margin:3% 10% !important; padding:0; background-color: #ddd !important">
<a href="{{ base_url }}back" class="btn black">voltar</a>
    <h3 class="center">ScoobYTasks - Novo Usuário</h3>
    {% if msg %}
    <span class="alert center">{{ msg|raw }}</span>
    {% endif %}
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <form class="login-form  z-depth-5" method="post" action="{{ base_url }}user/saveUser">
                <div class="card">
                    <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                    <div class="card-content">
                        <div class="input-field">
                            <input class="validate" id="name" type="text" name="name">
                            <label for="name">Nome</label>
                        </div>
                        <div class="input-field">
                            <input class="validate" id="email" type="email" name="email">
                            <label for="email">Email</label>
                        </div>

                        <div class="row">
                            <div class="col s12 m8 l12">
                                <div class="input-field">
                                    <input id="password" type="password" name="pass">
                                    <label for="password">Senha</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="center-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Criar Conta
                                <i class="material-icons right">send</i>
                            </button> </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col s4">
                    <a href="{{ base_url }}login" class="btn purple">Login</a>
                </div>
                <div class="col s8 right-align">
                    <a href="{{ base_url }}passwordRescue" class="btn red">Esqueci a senha</a>
                </div>
            </div>
        </div>
    </div>
</div>