# EcoVolt - App de Gamificação para Economia de Energia

## Integrantes
22401822 - Arthur Moreira | 22300350 - Vinicius Isaac | 22401229 - Luis Gustavo | 22301305 - João Pedro B. | 22301933 - Paulo Sérgio | 22300368 - Carlos Henrique

## Descrição
EcoVolt é um aplicativo web que utiliza gamificação para incentivar a economia de energia. Os usuários ganham pontos ao completar tarefas de economia, desbloqueiam badges e competem em rankings.

## Funcionalidades
- Sistema de login/registro com SQLite
- Gamificação com pontos, níveis e badges
- Dashboard com gráficos de consumo simulado
- Lista de tarefas de economia de energia
- Sistema de ranking entre usuários
- Design responsivo mobile-first
- Arquitetura com Repositories e Services

## Estrutura do Projeto
```
EcoVolt/
├── index.php (Roteador principal)
├── app/
│   ├── controllers/ (Controladores MVC)
│   ├── services/ (Lógica de negócio)
│   ├── repositories/ (Acesso aos dados)
│   ├── models/ (Database)
│   └── views/ (Templates HTML)
├── public/
│   ├── css/ (Estilos)
│   └── js/ (JavaScript)
└── database/ (Banco SQLite)
```

## Arquitetura
- **Controllers**: Recebem requisições e coordenam fluxo
- **Services**: Contêm lógica de negócio (AuthService, GameService, DashboardService)
- **Repositories**: Fazem acesso aos dados (UserRepository, TaskRepository, BadgeRepository)
- **Models**: Gerenciam conexão com banco SQLite
- **Views**: Templates HTML responsivos

## Instalação
1. Clone o projeto
2. Configure servidor web com PHP 7.4+
3. Acesse index.php no navegador
4. Banco SQLite criado automaticamente com dados de exemplo

## Tecnologias
- PHP 7.4+ (backend)
- SQLite (banco de dados)
- HTML5/CSS3/JavaScript (frontend)
- Arquitetura MVC com Repository/Service Pattern

## Como Usar
1. Registre-se ou faça login
2. Complete tarefas de economia para ganhar pontos
3. Desbloqueie badges e suba de nível
4. Compete no ranking com outros usuários
5. Visualize gráficos de consumo no dashboard
