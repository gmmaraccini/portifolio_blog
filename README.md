
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



---

# 🔌 Projeto 6: REST API (Complemento do Blog CMS)

Esta etapa consistiu na evolução do projeto "Blog CMS" para uma arquitetura híbrida. Além das views tradicionais (Blade), o sistema agora expõe endpoints **RESTful** que retornam dados em formato **JSON**, permitindo que o conteúdo do blog seja consumido por aplicativos móveis ou front-ends modernos (React/Vue).

**Repositório:** [github.com/gmmaraccini/portifolio_blog](https://github.com/gmmaraccini/portifolio_blog)

## 🚀 Funcionalidades da API

* **Listagem de Posts (`GET /api/posts`):** Retorna todos os posts marcados como "Publicado", com paginação automática.
* **Detalhes do Post (`GET /api/posts/{id}`):** Retorna o conteúdo completo de um post específico.
* **Transformação de Dados (API Resources):** Uso do `PostResource` para formatar o JSON, filtrando dados sensíveis e garantindo que o front-end receba apenas o necessário (ex: convertendo datas, limpando campos internos).
* **Autenticação (Sanctum):** Configuração inicial do Laravel Sanctum para proteção de rotas futuras.

## 🛠️ Tecnologias e Conceitos Aplicados

* **Laravel 12 API:** Instalação e configuração do ambiente de API (`php artisan install:api`).
* **API Resources:** Camada de transformação de dados para manter a resposta JSON consistente e desacoplada do Banco de Dados.
* **Controller Separation:** Separação física entre `BlogController` (Web/HTML) e `Api/PostController` (JSON) para manter o princípio de responsabilidade única (SRP).
* **Depuração de Migrations:** Resolução de conflitos de versionamento de banco de dados.

## ⚙️ Como Testar a API

Como o projeto já está configurado, siga os passos:

1. **Garanta que o servidor está rodando:**
```bash
php artisan serve

```


2. **Teste a Listagem (Navegador ou Postman):**
   Acesse: `http://localhost:8000/api/posts`
   *Resultado esperado:* Um JSON contendo a lista de posts e metadados de paginação.
3. **Teste Unitário (Post Específico):**
   Acesse: `http://localhost:8000/api/posts/1`
   *(Certifique-se de ter criado pelo menos um post no painel admin antes).*

## 🛑 Desafios e Soluções (Dev Log)

Durante o desenvolvimento desta API, enfrentei um desafio crítico relacionado ao versionamento do banco de dados no Laravel 12.

**1. Conflito de Migrations Duplicadas**

* **O Problema:** Ao executar o comando de instalação da API, o framework gerou automaticamente novas migrations para tabelas que já existiam (`posts` e `comments`), causando o erro `SQLSTATE[42S01]: Base table or view already exists`.
* **A Análise:** Foi necessário inspecionar a pasta `database/migrations` e identificar que haviam arquivos duplicados: um com a estrutura completa (que eu havia codado) e outro vazio (gerado automaticamente).
* **A Solução:**
1. Identificação e exclusão dos arquivos de migration duplicados/vazios.
2. Execução do comando `php artisan migrate:fresh --seed` para recriar o banco de dados do zero, garantindo a integridade do schema.



**2. Routing e Classes Inexistentes**

* **O Problema:** Erro `Target class [Api\PostController] does not exist` ao acessar as rotas.
* **A Solução:** A estrutura de pastas da API foi definida nas rotas, mas os arquivos físicos não haviam sido gerados. Criei os Controllers e Resources manualmente via Artisan e implementei a lógica de busca.

## ⏱️ Tempo de Execução

* **Tempo estimado:** 2 a 3 horas.
* **Foco:** O tempo maior foi dedicado à resolução de conflitos de *migrations* e reestruturação do banco de dados, garantindo que a base do projeto estivesse sólida para suportar tanto a Web quanto a API.

---
Video parte 2 -
https://youtu.be/BpPVjcnTK80




