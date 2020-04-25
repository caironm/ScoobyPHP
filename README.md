# <img src="App/Public/assets/img/scooby_logo.svg" width="40"/> ScoobyPHP

> Um framework MVC feito com PHP e muito amor para tornar o desnvolvimento web muito mais simples e divertido.

O desenvolvimento de aplicações web tem se tornado cada vez mais necessário no cenário atual, seguindo esta tendência, a padronização de escrita de código, estruturação de projeto e etc tem evoluído cada dia mais, não é difícil nos depararmos com novos padrões adotados pela comunidade. Levando em consideração toda essa evolução e necessidade, proporcionamos aos desenvolvedores, principalmente aqueles que estão tendo um primeiro contato com um framework
php
, uma maior facilidade e conforto na estruturação dos diretórios, agilidade e desempenho nas entregas, segurança e organização do projeto.

## Instalação

### OS X & Linux

O modo mais fácil de instalar o ScoobyPHP é clonar o repositório do instalador no github, ou baixar o instalador no site oficial.
Lembrando que será necessário ter o composer e o npm instalado no computador em questão.

Clonando o instalador:

```sh
git clone https://github.com/terriani/ScoobyNewProject.git
```

Baixando o instalador pelo site oficial:

vá ate o site oficial que se encontra em ScoobyPHP.tech/install, baixe o instalador, descompacte no diretório onde será criado o projeto, htdocs/ ou www/ por exemplo e pronto isso será o bastante para iniciarmos com o ScoobyPHP.

Após clonar o repositório ScoobyNewProject acesse ele e copie o arquivo que encontra-se em seu interior, caso tenha efetuado o download no site o arquivo estará pronto para o uso, não sendo necessário entrar na pasta e copiar o mesmo.

para rodarmos o instalador do ScoobyPHP basta e entrar na pasta onde o arquivo scooby-create-app se encontra e executar o comando:

```sh
php scooby-create
```

Ao executar este comando, será solicitado no terminal que o programador de um nome para o novo projeto, informe este nome e aguarde o termino da instalação. Pode ser que o instalador necessite da senha do usuário logado para a manipulação do cache e para dar as devidas permissões no projeto, caso isso aconteça, informe a senha requerida e aguarde o fim da instalação.

Quando a instalação chegar ao final uma mensagem de informando o sucesso desta operação sera apresentada, note que também será criado um repositório com o nome que foi informado no começo da instalação. Este diretório contem tudo que será necessário para o desenvolvimento da sua nova aplicação web.

### Windows

Primeiramente será necessário fazer o download do git bash no site: git-scm.com

Após o download e instalação do git bash siga o guia de instalação para LINUX e OS X

### Clonando o ScoobyPHP direto do github

Também é possível clonar o repositório do ScoobyPHP direto do github, para isso basta entrar no terminal, ou caso esteja usando windows, será necessário utilizar o git bash e navegar ate a pasta onde ficam os projetos, por exemplo, htdocs/ ou www/, execute o comando:

```sh
git clone https://github.com/terriani/ScoobyPHP.git
```

Após clonar o projeto será necessário instalar as suas dependências, para isto basta rodar dois comandos no terminal na pasta raiz do projeto. Primeiro instale as dependências do composer, para isto execute:

```sh
composer install
```

Após o termino da instalação das dependências do composer, vamos instalar as dependências do javascript:

```sh
npm install
```

Pronto agora com as dependências instaladas, já é possível renomear a pasta do ScoobyPHP para o nome do seu projeto, Lembrando que será necessário entrar na pasta que do projeto, lá dentro entre em: App/Config/appConfig.php e altere o nome do seu projeto na constante APP_NAME, trocando o scoobyPHP para o nome que do projeto. Caso a instalação tenha sido feito com o instalador não será necessário fazer nenhuma alteração nas configurações do framework.

## Executando o projeto no navegador

Levando em consideração que todos os passos anteriores foram executados corretamente e seu servidor local, por exemplo o xampp, esteja rodando sem erro, abra seu navegador e digite na barra de endereço:

```sh
http://localhost/NomeDoProjeto/
```

Ou caso esteja utilizando um virtual host, digite no navegador o link setado nos arquivos de configuração da sua VHost.

Caso a instalação tenha dado tudo cero, uma tela de boas vindas será apresentada.

![strat00](Docs/Images/wellcome.png)

## Estrutura de pastas

A pasta *** App *** será onde toda a regra de negócio ficará, esta pasta contém os controllers, models, rotas, arquivos de configuração, seeds, migrations, a pasta public onde ficaram os arquivos css, javascript, imagens utilizadas na aplicação, imagens vindas de uploads, views e uma pasta nomeada de Utils, que será explicada sua função no decorrer deste guia.

**Atenção:** Por convenção o ScoobyPHP nomeia suas pastas com a primeira letra maiúscula, sendo assim, quando criar uma pasta ou uma sub-pasta,  por favor siga esta recomendação.

Estrutura de pasta App/:

![strat00](Docs/Images/skeleton.png)

### Breve descrição de cada pasta dentro do diretório App/

#### App/

Pasta onde será criada toda a regra de negócios da aplicação, em todo o ciclo de vida do web app só será necessário ter conhecimento desta pasta em questão.

#### App/Config

Esta pasta conterá todos os arquivos de configurações da aplicação, como por exemplo, configurações de banco de dados, envio de e-mail e etc...

#### App/Config/lang

Nesta pasta ficam os arquivos de tradução do systema, caso deseje fazer um sistema multilinguagem será abordado mais a diante deste guia como implementar esta funcionalidade.

#### App/Controllers

Aqui ficam todos os controlers da aplicação, esta pasta não aceita outras pastas dentro dela, ou seja, o ScoobyPHP até a versão atual não aceita pastas especificas para a criação de controllers específicos, por exemplo: App/Controllers/Auth/UserController, essa arquitetura de organização dos controllers separados em pastas irá gerar um erro na aplicação.

#### App/Db

Nesta pasta ficam os arquivos de migrations e seeds

#### App/Db/Migration

Dentro desta pasta ficaram todas as migrations geradas pelo sistema.

#### App/Db/Seeds

Dentro desta pasta ficaram todas as seeds geradas pelo sistema, ao decorrer deste guia sera abordado como gerar migrations, seeds e muito mais utilizando o scooby-do, uma ferramenta de linha de comando.

#### App/Utils

Nesta pasta pode ser usada para um propósito geral, para a criação de metodos auxiliares, extensão dos helpers, validações, etc...

#### App/Models

Aqui ficaram todo os models da aplicação, ao decorrer deste guia sera abordado como gerar models via terminal utilizando o scooby-do.

#### App/Public

Nesta pasta ficaram os arquivos públicos da aplicação.

#### App/Public/assats/css

Neste local ficará todos os arquivos css da aplicação, não deverá ser criadas pastas aqui dentro, pois o ScoobyPHP mapeia esta pasta para minificar os arquivos e inclui-los no template.

#### App/Public/assets/img

Aqui ficaram as imagem utilizadas pela aplicação

#### App/Public/assats/js

Neste local ficará todos os arquivos javascript da aplicação, não deverá ser criadas pastas aqui dentro, pois o ScoobyPHP mapeia esta pasta para minificar os arquivos e incluí-los no template.

#### App/Public/uploaded

Nesta pasta ficará todos os arquivos upados da aplicação

#### App/Routes

Nesta pasta ficaram todos os arquivos de rotas, caso necessário poderá ser criado mais de um arquivo contendo diferentes rotas do sistema.

#### App/tests

Aqui ficará todos os testes da aplicação [Ainda não está em funcionamento]

#### App/Views

Aqui ficam as paginas da aplicação, templates e paginas de erro

#### App/Views/Error

Nesta pasta ficam as páginas de erro do sistema, como por exemplo a página de erro 404.

#### App/Views/pages

Aqui ficam todas as páginas da aplicação, sendo assim o diretório responsável pelo frontend do app.

## Os componentes do MVC

Tradicionalmente usado para interfaces gráficas de usuário (GUIs), esta arquitetura tornou-se popular para projetar aplicações web e até mesmo para aplicações móveis, para desktop e para outros clientes. Linguagens de programação populares como Java, C#, Ruby, PHP e outras possuem frameworks MVC populares que são atualmente usados no desenvolvimentos de aplicações web.

### Camada de modelo ou da lógica da aplicação (Model)

Modelo é a ponte entre as camadas Visão (View) e Controle (Controller), consiste na parte lógica da aplicação, que gerencia o comportamento dos dados através de regras de negócios, lógica e funções. Esta fica apenas esperando a chamada das funções, que permite o acesso para os dados serem coletados, gravados e, exibidos.

É o coração da execução, responsável por tudo que a aplicação vai fazer a partir dos comandos da camada de controle em um ou mais elementos de dados, respondendo a perguntas sobre o sua condição e a instruções para mudá-las. O modelo sabe o que o aplicativo quer fazer e é a principal estrutura computacional da arquitetura, pois é ele quem modela o problema que está se tentando resolver. Modela os dados e o comportamento por trás do processo de negócios. Se preocupa apenas com o armazenamento, manipulação e geração de dados. É um encapsulamento de dados e de comportamento independente da apresentação.

### Camada de apresentação ou visualização (View)

Visão pode ser qualquer saída de representação dos dados, como uma tabela ou um diagrama. É onde os dados solicitados do Modelo (Model) são exibidos. É possível ter várias visões do mesmo dado, como um gráfico de barras para gerenciamento e uma visão tabular para contadores. A Visão também provoca interações com o usuário, que interage com o Controle (Controller). O exemplo básico disso é um botão gerado por uma Visão, no qual um usuário clica e aciona uma ação no Controle.

Não se dedica em saber como o conhecimento foi retirado ou de onde ela foi obtida, apenas mostra a referência. Segundo Gamma et al (2006), ”A abordagem MVC separa a View e Model por meio de um protocolo inserção/notificação (subscribe/notify). Uma View deve garantir que sua expressão reflita o estado do Model. Sempre que os dados do Model mudam, o Model altera as Views que dependem dele. Em resposta, cada View tem a oportunidade de modificar-se”. Adiciona os elementos de exibição ao usuário : HTML, ASP, XML, Applets. É a camada de interface com o usuário. É utilizada para receber a entrada de dados e apresentar visualmente o resultado.

### Camada de controle ou controlador (Controller)

Controle é o componente final da tríade, faz a mediação da entrada e saída, comandando a visão e o modelo para serem alterados de forma apropriada conforme o usuário solicitou através do mouse e teclado. O foco do Controle é a ação do usuário, onde são manipulados os dados que o usuário insere ou atualiza, chamando em seguida o Modelo.

O Controle (Controller) envia essas ações para o Modelo (Model) e para a janela de visualização (View) onde serão realizadas as operações necessárias.

# Configurações

## Desvendando as configurações do ScoobyPHP

Raramente o programador precisará alterar os arquivos de configuração do Scooby, porém, é de suma importância termos conhecimentos sobre seus arquivos.

### Conhecendo a pasta App/Config

Possuímos alguns arquivos de configuração dentro da pasta App/Config, são estes:

#### App/Config/Lang/

Nesta pasta ficam os arquivos de idioma do ScoobyPHP, para criar novos arquivos de tradução dentro do Scooby é bem simples, basta criar um novo arquivo dentro desta pasta, o nome deste arquivo deve seguir a tabela contida nesta página <a href='https://www.w3schools.com/tags/ref_language_codes.asp' target='_blank'>www.w3schools.com/tags/ref_language_codes.asp</a>, Após nomear o arquivo com referência ao idioma que sera incluso basta copiar o conteúdo de um dos arquivos já existentes, o conteúdo dos arquivos de tradução é um array $GLOBAL['key' => 'value'], onde a tradução devera ser feita substituindo o valor do value dentro do array.

```php
<?php

//Simulação de criação de novo arquivo de tradução

//Arquivo existente en.php
$GLOBALS = [
'WELLCOME_MSG' => 'Welcome to the Scooby framework. If you are viewing this page,
     it means that scooby was installed correctly! '
];

//Primeiro Criamos o arquivo pt-br.php e adicionamos o conteúdo do en.php, após isso traduzimos as mensagens e caso precise criamos novas mensagens
//Tradução, note que a chave do array permanece a mesma só alteramos o valor
<?php

$GLOBALS = [
'WELLCOME_MSG' => 'Bem vindo ao Scooby framework. Se Você esta visualizando esta página,
     quer dizer que o scooby foi instalado corretamente!'
]

```

Para acessarmos essas mensagens traduzidas em qualquer parte do sistema é muito fácil, basta chamarmos $GLOBALS[''], passando a chave que desejamos recuperar o valor.

```php
// Recuperando o valor de um arquivo de tradução
//chame-se a global passando a chave desejada
echo $GLOBALS['WELLCOME_MSG'];
```

Esse código ira imprimir na tela a mensagem de boas-vindas.

Para configurar um novo idioma basta abrir o arquivo situado em App/Config/appConfig.php e alterar a constante SITE_LANG para o idioma desejado.

```php
// Alteração de idioma de inglês para português

//Site lang definido em inglês
 define('SITE_LANG', 'en');

// Alterar para o idioma desejado, lembrando que o arquivo de tradução devera ter sido criado previamente
 define('SITE_LANG', 'pt_br'); 
```

#### App/Config/apiConfig.php

Este arquivo é muito importante, pois contém as configurações básicas para o desenvolvimento de APIs utilizando o scooby

Neste arquivo encontramos:

```php
<?php

// Definir se a aplicação será uma API ou um projeto WEB monolítico
define('IS_API', false);

// Hash para encriptação do jwt único, gerado ao criar o projeto
define('SECRET_KEY', '76783e11c38704ce746fa4f01cf4c85cb5db840077d4d4e4a4bf250824f155bb');

// Constante para definição de origens permitidas 
define('ORIGIN_ALLOW', '*');

// Constante para definição de metodos permitodos 
define('METHODS_ALLOW', 'GET, POST, PUT, DELETE');

// 
define('CREDENTIALS_ALLOW', true);

```

#### App/Config/appConfig.php

No arquivo appConfig encontramos as configurações básicas da aplicação como APP_NAME, BASE_URL e etc...

```php
//define o nome do site em desenvolvimento
    define('APP_NAME', 'ScoobyPHP');

    //Url base para caso o controller não seja indicado na url
    define("HOME", "home");

    //define o idioma das menssagens exibidas automaticamente pelo o framework em desenvolvimento
    define('SITE_LANG', 'pt-br');

    //define a url base do sistema
    define("BASE_URL", "/");

    // Nome dado a rota de erro http
    define('ROUTE_ERROR', 'ooops');
```

#### App/Config/assetsConfig

Neste arquivo encontramos todas as configurações de assets da aplicação.
Em **ASSETS_VERSION** temos um valor definido como 1, este valor é a versão atual dos seus assets, ao um projeto em produção, alteramos o conteúdo do arquivo  ***env.php*** para "***production***" e subimos o projeto para o servidor, com o projeto em ambiengte de produção ao alterarmos o conteúdo de algum de nossos arquivos de assets como os ***CSS*** ou o ***JS*** da nossa aplicação devemos mudar a verssão da constante **ASSETS_VESRION** para 2 e assim por diante, agora caso queira voltar uma versão especifica dos assets do projeto basta alterar o assets versio para o número desejado.

#### App/Config/assetsInclude.php

A utilização deste arquivo é bem simples e intuitivo, dentro do array ***html*** temos 3 arrays, o ***header***, ***bodyTop*** e ***bodyBottom***, a função destes arrays são receber as tags ***Link*** e ***Script***, por exemplo, vamos supor que precisamos adicionar uma tag link no ***header*** do template da nossa aplicação, arquivo assetsInclude.php ficaria assim

```php
<?php

$html = [
    'header' => [
        // Este arquivo sera carregado no header da aplicação
        "<link rel='stylesheet' href='" . ASSET . "css/404.css'>"
    ],
    'bodyTop' => [
        // Aqui ficara os arquivos carregados na parte superior da body
    ],
    'bodyBottom' => [
        // Aqui ficara os arquivos carregados na parte superior da body
    ]
];

```

#### App/Config/authConfig.php

Por padrão o ScoonyPHP não autentica somente suas rotas e controllers, ele também autentica suas views, oferecendo assim mais uma camada de segurança para suas aplicações.
Ao criarmos uma view, precisamos registar ela no arquivo ***authConfig.php***, este arquivo possui dois arrays, um chamado ***notAutentication*** e o outro nomeado como ***autentication***, para as views públicas, que serão vistas por todos e não somente por usuário logados no sistema, devera ser adicionado o nome ao array notAutentication, e as views que só poderão ser visualizadas por usuários logados deverão ser registradas no array autentication. Para registrar uma view e muito simples, basta adicionar o nome da mesma, sem a extensão ***.twig***.

```php
<?php

/**
 * Array contendo as views que não passarão pela autenticação
 */
$notAutentication = [
    // Aqui ficam as view não autenticadas 
    '404',
    'home',
];

/**
 * Array contendo as views que passarão pela autenticação
 */
$autentication = [
    // Aqui ficam as views autenticadas
];

```

#### App/Config/databaseConfig.php

Neste arquivo podemos efetuar todas as configurações de banco de dados, tanto em modo de desenvolvimento como em produção

#### App/Config/emailConfig.php

Neste arquivo podemos efetuar todas as configurações de um servidor ***SMTP***, tanto em modo de desenvolvimento como em produção

#### App/Config/env.php

Neste arquivo definimos se nossa aplicação está em modo desenvolvimento ou em produção

#### App/Config/SEOConfig.php

Neste arquivo podemos efetuar todas as configurações de ***SEO*** da aplicação, tanto em modo de desenvolvimento como em produção

#### App/Config/twigGlobalVariables.php

Neste arquivo podemos definir variáveis globais para usarmos em nosso frontend com ***.twig***, segue um exemplo de definição de variável global em twig e sua recuperação no frontend da aplicação.

```php
$twig->addGlobal('nome_dado_a_variavel', 'Conteudo_da_variavel'),
```

e para usarmos essa variável em nossos arquivos ***.twig*** usamos:

```twig
{{ nome_dado_a_variavel }}
```
# Controllers

## Desvendadndo os Controllers

Ao se trabalhar com o padrão MVC grande parte do projeto será desenvolvido nos controllers, neste tópico iremos criar nosso primeiro controller, descobrir como chamar uma view, como instanciar um model, como utilizar alguns dos helpers do ScoobyPHP e muito mais...

### Criando um controller

para criarmos um controller, basta irmos ate a pasta Controllers, que se encontra em App/Controllers/, lá criaremos um novo arquivo com o nome desejado, com a primeira letra maiúscula e acompanhado da palavra Controller e finalizando com .php, ficando deste jeito por exemplo: HomeController.php.

Ao abrir o Controller recém criado basta adicionar o código abaixo:

```php
<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * @return void
    */
    public function index(): void
    {
        //
    }
}
```

Pronto, com algumas linhas de código já temos um controller criado e pronto para o uso. Uma rotina muito comum de se fazer nos controllers é o ato de chamar uma view, seja ela um formulário, uma tela de login ou qualquer outra tela existente na aplicação e para exibirmos uma view no navegador do usuário é muito simples, por estarmos estendendo o controller base do Scooby, temos acesso aos seus métodos e um deles é o metodo view, que é responsável por exibir uma view para o usuário final do app.

Para chamar uma view no navegador do usuário, levando em consideração que a view já foi previamente criada na pasta App/Views/Pages/, basta escrever o seguinte código dentro do método desejado. Exemplo de um controller chamando uma view na action index.

```php
<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Metodo index está chamando uma view na pasta Pages com o nome Home.twig
    *
    * @return void
    */
    public function index(): void
    {
        $this->view('Pages', 'Home', []);
    }
}
```

Note que o método view mapeia a chamada para dentro da pasta App/Views, sendo necessário somente informar a pasta em que você deseja chamar o arquivo de visualização. Note também que o método view recebe como terceiro parâmetro um array, que no caso do exemplo está vazio, porém neste array mandamos informações para a view, podendo ser strings, retornos de métodos, ou qualquer coisa que desejarmos.

Exemplo de envio de um texto de boa vindas do metodo index para a view home.

```php
<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Envio de msg de boas vindas para a view home.twig que se encontra em: App/Views/pages/
    *
    * @return void
    */
    public function index(): void
    {
        $this->view('Pages', 'Home', [
            'wellcomeMessage' => 'Sejam Bem Vindos ao SccobyPHP!!!'
        ]);
    }
}
```

Para passarmos o valor para a view usamos um array associativo, onde a chave do array, que no nosso exemplo é ' wellcomeMessage ', será a variável que acessaremos na view, neste momento não precisa se preocupar e caso não tenha entendido como será feita esta tarefa, quando entrarmos no estudo de views todas as dúvidas serão sanadas.

Podemos também setar um titulo para a view a ser apresentada, para isto basta usarmos o metodo

```php
$this->setTitle('Titulo da página');
```

Neste caso o controller ficaria assim:

```php
<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;

class HomeController extends Controller
{
    /**
    * Adiciona o titulo Hello World para a view wellcome
    *
    * @return void
    */
    public function index(): void
    {
        $this->setTitle('Hello world');
        $this->view('Pages', 'Home', [
            'wellcomeMessage' => 'Sejam Bem Vindos ao SccobyPHP!!!'
        ]);
    }
}
```

Caso nenhum titulo seja informado no controller, o APP_NAME será o titulo de todas as páginas do projeto, neste caso como o APP_NAME esta definodo para ScoobyPHP, todas as páginas herdarão este titulo.

Veja como é simples trabalhar com controllers no ScoobyPHP. Mais para a frente aprenderemos a usar o ***scooby-do***, o CLI integrado no Scooby.

### [***ATENÇÃO*** - ESCRITA DA DOCUMETAÇÃO EM ANDAMENTO...]

## Histórico de lançamentos

* 1.0
LANÇAMENTO: Lançamento da versão 1.0

## Autor

* **Vinicius Terriani** – [@vinicius_terriani](https://twitter.com/VTerriani) – viniciusterriani.esy.es

Distribuído sob a licença MIT. Veja [LICENSE](LICENSE) para mais informações.

[https://github.com/terriani/ScoobyPHP](https://github.com/terriani/)

## Contributing

1. Faça o _fork_ do projeto (<https://github.com/terriani/ScoobyPHP/fork>)
2. Crie uma _branch_ para sua modificação (`git checkout -b feature/fooBar`)
3. Faça o _commit_ (`git commit -am 'Add some fooBar'`)
4. _Push_ (`git push origin feature/fooBar`)
5. Crie um novo _Pull Request_