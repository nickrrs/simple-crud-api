## Documentação de Projeto
O projeto consiste em uma simples API RESTFul em Laravel, e utiliza o banco de dados relacional para armazenamento de informações. 

> Documentação/Collection das Endpoints: **/documentation/** dentro do projeto. 

### Para configurar e executar o projeto é só seguir os simples passos:

Antes de iniciar, é importante que você crie um arquivo **.env** caso não o tenha. No arquivo **.env.example** há um modelo do arquivo que possa ser criado, com variáveis e valores ideais para o seu ambiente.

1 - Uma vez dentro do projeto, no terminal, exexcute o seguinte comando para instalar as dependências do projeto: 

> ```composer install```

2 - Uma vez que as depedências do projeto estiverem instaladas, e .env configurado, execute o seguinte comando no terminal para rodar as migrations e popular o banco de dados: 

>```php artisan migrate```

Execute também o seguinte comando:

> ```php artisan key:generate```

### Como funciona a API ?

A API consiste em um ambiente simples com uma simulação de funcionalidades CRUD para a entidade Tasks, envolvida por uma camada de autenticação JWT.

Para fins de testes da aplicação, se for do seu interesse, pode rodar o seguinte comando para executar todos os testes já montados para o sistema: 

> ```php artisan test```

Caso queira testar as rotas da API, pode-se utilizar as endpoints já montadas para cadastrar/listar/atualizar ou deletar os dados dentro do banco.
