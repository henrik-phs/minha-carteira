# Minha Carteira


![Badge em Desenvolvimento](https://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=GREEN&style=for-the-badge)
[![GitHub issues](https://img.shields.io/github/issues/henrik-phs/minha-carteira)](https://github.com/henrik-phs/minha-carteira/issues)
[![GitHub forks](https://img.shields.io/github/forks/henrik-phs/minha-carteira)](https://github.com/henrik-phs/minha-carteira/network)
[![GitHub stars](https://img.shields.io/github/stars/henrik-phs/minha-carteira)](https://github.com/henrik-phs/minha-carteira/stargazers)

Minha Carteira é um simples sistema para inserção e acompanhamento de entradas e saídas de dinheiro. Pode ser usado para controle de gastos pessoais ou comerciais.

<img src="public/imgs/screenshots/screenshots.gif"/>

<a href="public/imgs/screenshots/">Mais imagens</a>

## Funcionalidades

- **Inserir**
  - Inserção de entradas ou saídas 

- **Histórico**
  - Acompanha o histórico das entradas e saídas
  - Possibilidade de filtrar resultados
  - Edite ou exclua um registro de entrada ou saída

- **Relatórios**
  - Acompanhamento do histórico por meio de gráficos

- **Minha Conta**
  - Edite e veja informações da sua conta de usuário

## Tarefas a serem executadas

- [ ] Meta de gastos mensais
- [ ] Guias de ajuda

## Como executar o projeto

Para executar o projeto será necessário ter instalado:

Servidor PHP (XAMPP, WAMP, LAMP)

Composer

<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
<img src="https://img.shields.io/badge/Node.js-43853D?style=for-the-badge&logo=node.js&logoColor=white">


**Clone o projeto**
```
git clone https://github.com/henrik-phs/minha-carteira.git
```

**Acesse o projeto**
```
cd seuprojeto
```

**Instale as dependências e o framework**
```
composer install --no-scripts
```

**Copie o arquivo .env.example**
Crie uma cópia do arquivo **.env.evample** e renomeie para **.env** e altere as informações do banco de dados
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306*
DB_DATABASE=minha-carteira*
DB_USERNAME=root*
DB_PASSWORD=*
```
*preencha com as suas informações de banco de dados

**Crie uma nova chave para a aplicação**
```
php artisan key:generate
```

**Rode as migrations com:**
```
php artisan migrate --seed
```

**Por fim rode os comando do npm:**
```
npm install
npm run dev
```

## Tecnologias usadas

<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"> 8.1.6

<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"> 9.22.1

<img src="https://img.shields.io/badge/Node.js-43853D?style=for-the-badge&logo=node.js&logoColor=white"> 16.16.0

## Autor

<img src="https://avatars.githubusercontent.com/u/24757230" width="120px">

Pedro H. da Silva