# Migrations

## Conhecendo as migrations

Uma tarefa muito comum no dia a dia de programadores é ter que lidar com banco de dados, criar tabela, e preenchê-las. Para isto o ScoobyPHP utiliza a biblioteca **Phinx** para facilitar o dia a dia do desenvolvedor.

Veja como é fácil criar uma migration usando o **scooby-do**, ferramenta para geração de código automaticamente via linha de comando, o scooby-do será abordado em breve.
Para criarmos uma migration basta abrirmos o terminal e navegarmos ate a raiz do nosso projeto, vamos supor que estamos desenvolvendo no linux usando um servidor Xampp, para acessarmos a raiz do projeto basta abrir o terminal e digitarmos.

```shell
cd /opt/lampp/htdocs/pasta_do_projeto/
```

Após isto, digitamos no terminal:

```shell
php scooby-do
```

Ao abrir a tela do scooby-do, digitamos:

```shell
make:migration
```

Após isto sera pedido o nome da migration, esse nome, por padrão, precisa ser escrito no formato **MinhaPrimeiraMigration**, note que a primeira letra de cada palavra esta escrita em maiúsculo.
Ao executar este comando um novo arquivo será criado em **App/Db/Migrations/** com um nome parecido com **20200425160028_minha_primeira_migration.php**, dentro deste arquivo podemos encontrar o seguinte conteúdo:

```php
<?php

use Phinx\Migration\AbstractMigration;

class MinhaPrimeiraMigration extends AbstractMigration
{
    /**
    * Change Method.
    *
    * Write your reversible migrations using this method.
    *
    * More information on writing migrations is available here:
    * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
    *
    * The following commands can be used in this method and Phinx will
    * automatically reverse them when rolling back:
    *
    * createTable
    * renameTable
    * addColumn
    * addCustomColumn
    * renameColumn
    * addIndex
    * addForeignKey
    *
    * Any other distructive changes will result in an error when trying to
    * rollback the migration.
    */
    public function change()
    {

    }
}
```

Para termos nossa migration totalmente funcional basta preenchermos com algumas informações, como, por exemplo, o nome da tabela que queremos criar, os campos desta tabela, seus tipos e etc...

Veja neste exemplo, onde iremos criar uma migration da tabela de usuários.

```php
<?php

use Phinx\Migration\AbstractMigration;

class CreateUserAuth extends AbstractMigration
{
    /**
    * Change Method.
    *
    * Write your reversible migrations using this method.
    *
    * More information on writing migrations is available here:
    * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
    *
    * The following commands can be used in this method and Phinx will
    * automatically reverse them when rolling back:
    *
    * createTable
    * renameTable
    * addColumn
    * addCustomColumn
    * renameColumn
    * addIndex
    * addForeignKey
    *
    * Any other distructive changes will result in an error when trying to
    * rollback the migration.
    */
    public function change(): void
    {
    $this->Table('users')
    ->addColumn('name', 'string', ['null' => false])
    ->addColumn('email', 'string', ['null' => false])
    ->addColumn('password', 'string', ['null' => false])
    ->create();
    }

}

```

Neste exemplo passamos primeiramente o nome da tabela a ser criada, apos isto passamos seus campos com os nomes, tipos e um array com as regras, neste caso, **['null' =&gt; false]** e por ultimo chamamos o método **create()**, note que não informamos o **id**, pois o phinx cria um campo com o nome id do tipo primary key automaticamente

Agora, basta voltarmos ao terminal, digitarmos novamente
```shell
php scooby-do
```

E ao scooby-do abrir, digitamos

```shell
migrate
```

Esse comando irá executar todas as migrationsque ainda não foram executadas na aplicação. Após executar as migrations você tera uma tabela com o nome de **users** criada no banco de dados