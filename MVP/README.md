# 🏫 TCC - GEMA

## 🚀 Rodando o Projeto

Siga os passos abaixo para configurar e iniciar o ambiente de desenvolvimento:

```bash
### 1️⃣ Clonar o repositório
git clone https://github.com/GuiSpky/SI-UniALFA-TCC-2025-02-04.git

cd SI-UniALFA-TCC-2025-02-04/MVP/BackEnd

### 2️⃣ Configurar variáveis de ambiente
Crie o arquivo .env com base no exemplo fornecido:

cp .env.example .env

### 3️⃣ Instalar dependências do PHP
composer install

### 4️⃣ Instalar dependências do Node.js
npm install

### 5️⃣ Compilar os assets front-end
npm run build

### 6️⃣ Executar migrações do banco de dados
php artisan migrate

### 7️⃣ Popular o banco de dados com dados iniciais (seeders)
php artisan db:seed

### 8️⃣ Gerar a chave da aplicação
php artisan key:generate

### 9️⃣ Limpar e recarregar o cache de configuração
php artisan config:cache

### 🔟 Iniciar o servidor local
php artisan serve

```


O projeto estará disponível em:
👉 http://localhost:8000

💡 Tecnologias Utilizadas

Laravel
 - Framework PHP

Composer
 - Gerenciador de dependências PHP

Node.js & NPM
 - Gerenciamento de pacotes e build frontend

Vite
 - Build de assets frontend

🧑‍💻 Autors

Joao Felipe Bacarin && Guilherme Fernandes

📧 joaofbacarin@gmail.com

🌐 [LinkedIn](https://www.linkedin.com/in/joao-felipe-bacarin-da-silva-196351263/)