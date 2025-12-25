
---

```markdown
# 📝 Blog CMS - Portfolio Project (Laravel 12)

Um sistema de gerenciamento de conteúdo (CMS) desenvolvido com **Laravel 12**, focado em demonstrar competências essenciais de desenvolvimento Backend: CRUD, Autenticação, Relacionamentos de Banco de Dados e Segurança.

O projeto separa claramente a **Área Administrativa** (protegida) da **Área Pública** (leitura e interação).

---

## 🚀 Funcionalidades

### 🔐 Área Administrativa (Back-office)
- **Autenticação Segura:** Login gerenciado pelo Laravel Breeze.
- **Gestão de Posts (CRUD):**
  - Criação de posts com título, conteúdo e opção de rascunho/publicado.
  - Geração automática de **Slugs** (URLs amigáveis) baseadas no título.
  - Edição e Exclusão de conteúdos.
- **Moderação de Comentários:**
  - Visualização de comentários pendentes.
  - Sistema de Aprovação/Exclusão (comentários só aparecem no site após aprovação).

### 🌐 Área Pública (Front-end)
- **Blog:** Listagem de posts publicados com paginação.
- **Leitura:** Página individual do post (Show).
- **Interação:** Formulário para visitantes deixarem comentários (sujeitos a moderação).
- **Feedback:** Mensagens de sucesso ao enviar comentários.

---

## 🛠️ Tecnologias e Ferramentas

- **Framework:** Laravel 12 (PHP 8.2+)
- **Banco de Dados:** MySQL / MariaDB
- **Front-end:** Blade Templates + Tailwind CSS
- **Build Tool:** Vite + Node.js
- **Autenticação:** Laravel Breeze
- **Controle de Versão:** Git & GitHub

---

## ⚙️ Instalação e Configuração

Siga os passos abaixo para rodar o projeto localmente:

1. **Clone o repositório**
   ```bash
   git clone [https://github.com/gmmaraccini/portifolio_blog.git](https://github.com/gmmaraccini/portifolio_blog.git)
   cd portifolio_blog

```

2. **Instale as dependências do PHP**
```bash
composer install

```


3. **Configure o ambiente**
* Copie o arquivo de exemplo: `cp .env.example .env`
* Gere a chave da aplicação: `php artisan key:generate`
* Configure as credenciais do seu banco de dados no arquivo `.env`.


4. **Instale as dependências do Front-end (Assets)**
   *Necessário para carregar o CSS do Tailwind via Vite.*
```bash
npm install
npm run build

```


5. **Banco de Dados e Seeds**
   Rode as migrations e popule o banco com o usuário admin padrão:
```bash
php artisan migrate:fresh --seed

```


6. **Acesse o Projeto**
```bash
php artisan serve

```


Acesse: `http://localhost:8000`

### 🔑 Acesso Administrativo

Após rodar o seed, use estas credenciais:

* **Email:** `admin@admin.com`
* **Senha:** `12345678`

---

## 🧠 Análise Técnica e Desafios (Dev Log)

Durante o desenvolvimento deste projeto, enfrentei e solucionei diversos desafios técnicos que reforçaram meu aprendizado no ecossistema Laravel.

### 1. Integração Git e Conflitos de Histórico

**O Problema:** Ao vincular o projeto local (Laravel) com o repositório remoto (criado previamente no GitHub com um README), ocorreu o erro `refusing to merge unrelated histories`.
**A Solução:** Utilizei a flag `--allow-unrelated-histories` no `git pull` para forçar a fusão e resolvi o conflito do arquivo README manualmente escolhendo a versão local (`git checkout --ours README.md`).

### 2. Assets e Compilação (Vite vs Node)

**O Problema:** A aplicação retornava `ViteManifestNotFoundException`. Isso ocorreu porque o Laravel moderno depende do Vite para servir assets, e os arquivos de build não existiam.
**A Solução:** Inicialmente, cogitei usar CDN para contornar, mas optei pela solução definitiva e profissional: instalei o ambiente **Node.js**, rodei `npm install` e `npm run build` para gerar o `manifest.json` corretamente.

### 3. Rotas e Controllers (Logic Separation)

**A Estrutura:** Optei por separar a lógica para manter o código limpo (Clean Code):

* `PostController`: Restrito ao Admin (CRUD completo).
* `BlogController`: Apenas leitura (Métodos `index` e `show`) para a área pública.
* `CommentController`: Híbrido (Store para público, Approve/Destroy para admin).

### 4. Segurança (XSS)

**Implementação:** Para evitar ataques de XSS nos comentários, implementei sanitização no `CommentController` utilizando `strip_tags()` antes de salvar o conteúdo no banco. Além disso, a lógica de aprovação (`is_approved`) garante que nenhum conteúdo apareça sem revisão.

---

## 📂 Estrutura de Pastas Principal

```
app/
├── Http/Controllers/
│   ├── BlogController.php    (Front-end lógica)
│   ├── PostController.php    (Back-end CRUD)
│   └── CommentController.php (Lógica de comentários)
├── Models/
│   ├── Post.php              (Relacionamentos e Fillable)
│   └── Comment.php           (Scopes e Regras)
database/
├── migrations/               (Estrutura das tabelas posts e comments)
├── seeders/
│   └── AdminUserSeeder.php   (Criação do usuário admin padrão)
resources/
├── views/
│   ├── blog/                 (Telas públicas)
│   └── posts/                (Telas administrativas)

```

---

## 📄 Licença

Este projeto é open-source e está licenciado sob a [MIT license](https://opensource.org/licenses/MIT).



## Video funcionamento
https://youtu.be/FCcDVA2QLZE
