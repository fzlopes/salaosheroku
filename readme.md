## Desenvolvedor

Fábio Lopes fzlopes1@gmail.com

## Criando um novo admin

1. Clone este repositório na sua máquina local para sua nova aplicação

2. Configure o arquivo `.env` com as configurações do ambiente local

3. Instalando as dependências via composer (na raiz do projeto)
```composer install```

4. Dentro do diretório da nova aplicação gere a nova key (na raiz do projeto)
```php artisan key:generate```

5. Crie a base de dados que foi configurada no `.env`

6. Rode as migrations
```php artisan migrate```

7. Gere os seeds para a aplicação (se necessário adicione mais seeds)
```php artisan db:seed```

8. Rode a aplicação
```php artisan serve```

9. Criar a pasta photos na pasta public
