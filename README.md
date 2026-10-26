<p align="center">
  <img src="assets/logo md - sem fundo.png" width="360" alt="Logo do Make Delivery">
</p>

<p align="center">
  <b>Entregas rápidas entre pessoas, com preço calculado pela rota real e motoboys escolhendo as corridas que querem fazer.</b><br>
  TCC do curso Técnico em Informática · por <a href="https://github.com/mateusrosa0901">Mateus Rosa</a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
  <img src="https://img.shields.io/badge/Google%20Maps-API-4285F4?style=for-the-badge&logo=googlemaps&logoColor=white">
</p>

---

## 📦 O que é

O **Make Delivery** liga quem precisa enviar alguma coisa a motoboys disponíveis. A pessoa cadastra o pedido, o sistema traça a rota até o destinatário e calcula o preço sozinho. O primeiro motoboy que aceitar leva a encomenda.

São dois tipos de conta, cada um com login e painel próprios:

| 👤 Usuário (cliente) | 🛵 Motoboy |
|:--|:--|
| Cria conta com foto de perfil; o endereço é preenchido sozinho a partir do CEP | Cria conta com os dados da moto (placa) |
| Faz um pedido para outro usuário, buscando o destinatário pelo e-mail | Vê no painel os pedidos que ainda estão procurando entregador |
| Vê o preço, a distância e o tempo estimado antes de enviar | Aceita uma corrida e recebe a rota de coleta e entrega no mapa |
| Acompanha os pedidos **enviados** e **recebidos**, com o mapa e os dados do motoboy | Marca a entrega como concluída |

## 🔄 Como um pedido anda

```
 Usuário cria o pedido ──► "Procurando entregador" ──► Motoboy aceita ──► "Em rota" ──► Motoboy conclui ──► "Entrega concluída"
```

## 💰 Como o preço é calculado

A distância e o tempo vêm da **Distance Matrix API** do Google, usando o endereço de quem envia e de quem recebe:

```
preço = (peso × R$ 0,15) + (km × R$ 1,50) + (minutos × R$ 0,15)
```

O motoboy fica com **60%** desse valor e a plataforma com 40%.

## 🛠️ Tecnologias

- **Laravel 10** (PHP 8.1+): rotas, controllers, Eloquent e migrations
- **Autenticação com dois guards** (`web` para usuários e `motoboys` para entregadores), com middleware próprio para cada painel
- **MySQL** como banco de dados
- **Google Maps JavaScript API** para os mapas e **Distance Matrix API** para distância e tempo
- **ViaCEP** para completar o endereço a partir do CEP
- **Blade + CSS** nas telas

## 🗂️ Onde está cada coisa

```
app/Http/Controllers/
├── UserController.php              # cadastro, login, edição, busca de destinatário por e-mail
├── MotoboyController.php           # cadastro e login do motoboy
├── PedidoController.php            # criar pedido, cálculo do preço, aceitar e concluir entrega
├── UserDashboardController.php     # painel do usuário: enviados e recebidos
└── MotoboyDashboardController.php  # painel do motoboy: pedidos disponíveis
app/Models/                         # User, Motoboy, Pedido
database/migrations/                # tabelas users, motoboys e pedidos
resources/views/                    # telas em Blade (users, motoboys, pedidos, dashboard)
routes/web.php                      # todas as rotas
```

## ▶️ Como rodar

Você vai precisar de **PHP 8.1+**, **Composer**, **MySQL** e uma **chave do Google Maps** com as APIs *Maps JavaScript* e *Distance Matrix* ativas.

```bash
git clone https://github.com/mateusrosa0901/tcc-MakeDelivery.git
cd tcc-MakeDelivery

composer install
cp .env.example .env
php artisan key:generate
```

No `.env`, preencha o banco (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) e a chave do Maps:

```env
MAPS_API_KEY=sua-chave-aqui
```

Depois crie as tabelas e suba o servidor:

```bash
php artisan migrate
php artisan serve
```

Acesse:

- `http://localhost:8000/user/cadastro` para criar uma conta de usuário
- `http://localhost:8000/motoboy/cadastro` para criar uma conta de motoboy

> **Dica:** cadastre um motoboy antes de criar o primeiro pedido. Todo pedido novo fica ligado ao motoboy de id 1 até alguém aceitar a corrida.

## 🎓 Sobre o projeto

Desenvolvi o Make Delivery como Trabalho de Conclusão de Curso do **Técnico em Informática**. O projeto junta, num sistema só, autenticação com dois tipos de conta, banco de dados relacional, integração com APIs externas e regra de negócio de ponta a ponta.
