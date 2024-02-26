# Marcasite Cursos

Bem-vindo ao projeto Marcasite Cursos! Este é um breve guia para configurar e executar o projeto em seu ambiente local.

## Requisitos

Certifique-se de que seu ambiente atenda aos seguintes requisitos:

- PHP 8.1
- Composer
- Laravel 10
- MySQL ou outro banco de dados suportado pelo Laravel

## Configuração

Siga estas etapas para configurar o projeto:

1. Clone o repositório do GitHub:

```bash
git clone https://github.com/viniciumelo/marcasite-cursos.git
```

2. Acesse o diretório do projeto:

```bash
cd marcasite-cursos
```

3. Instale as dependências do Composer:

```bash
composer install
```

4. Copie o arquivo .env.example e renomeie para .env:

```bash
cp .env.example .env
```

5. Gere uma nova chave de aplicativo Laravel:

```bash
php artisan key:generate
```

6. Configure o arquivo .env com as informações do seu banco de dados.

7. Execute as migrações do banco de dados junto com os seeds:

```bash
php artisan migrate --seed
```
##  Executando o projeto
Após a configuração, você pode iniciar o servidor de desenvolvimento do Laravel com o seguinte comando:

```bash
php artisan serve
```
Acesse o projeto em seu navegador em http://localhost:8000.

Agora você está pronto para começar a desenvolver e explorar o projeto Marcasite Cursos! Se precisar de ajuda adicional, consulte a documentação oficial do Laravel em laravel.com/docs.

Obrigado por escolher Marcasite Cursos! 😊🚀

