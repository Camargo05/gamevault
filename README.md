# 🎮 GameVault

> Um catálogo de jogos dinâmico desenvolvido com PHP "Raiz", focado em performance e estrutura limpa.

![Status](https://img.shields.io/badge/Status-Concluído-success)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-DB-4479A1?logo=mysql&logoColor=white)

## 💻 Sobre o Projeto

O **GameVault** é uma aplicação Fullstack que permite aos usuários visualizar, pesquisar e avaliar jogos. O objetivo deste projeto foi demonstrar domínio na construção de sistemas sem o uso de frameworks pesados, focando na lógica de programação e interação com banco de dados relacional.

### ✨ Funcionalidades

* **Catálogo Visual:** Listagem de jogos com capas e categorias.
* **Busca Inteligente:** Filtro em tempo real por nome do jogo (SQL `LIKE`).
* **Página de Detalhes:** Visualização profunda de informações do jogo.
* **Sistema de Avaliação:** Usuários podem enviar notas e comentários que são salvos no banco.
* **Arquitetura MVC Simplificada:** Separação clara entre configurações, assets e lógica.

---

## 🛠 Tecnologias Utilizadas

* **Back-end:** PHP 8 (PDO para segurança contra SQL Injection).
* **Banco de Dados:** MySQL (Relacionamentos 1:N).
* **Front-end:** HTML5, CSS3 (Design Responsivo/Dark Mode).
* **Versionamento:** Git e GitHub.

---

## 🚀 Como Rodar este Projeto

### Pré-requisitos
* Ter o **XAMPP** (ou similar) instalado.

### Passo a Passo

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/Camargo05/gamevault.git](https://github.com/Camargo05/gamevault.git)
    ```

2.  **Configure o Banco de Dados:**
    * Abra o phpMyAdmin (http://localhost/phpmyadmin).
    * Crie um banco chamado `gamevault`.
    * Importe o arquivo `database.sql` que está na raiz deste projeto.

3.  **Configure a Conexão:**
    * Verifique se o arquivo `config/db.php` está com a senha correta do seu MySQL (padrão é vazia).

4.  **Acesse:**
    * Abra no navegador: `http://localhost/gamevault`

---

Desenvolvido por **Pablo Juliano** para portfólio de desenvolvimento Web.