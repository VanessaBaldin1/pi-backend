# ConectaConsulta

Sistema de gerenciamento de consultas médicas desenvolvido em PHP.

## Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Composer

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/conecta-consulta.git
cd conecta-consulta
```

2. Instale as dependências:
```bash
composer install
```

3. Configure o banco de dados:
- Crie um banco de dados MySQL chamado `conecta_consulta`
- Importe o arquivo `database.sql` para criar as tabelas necessárias

4. Configure as credenciais do banco de dados:
- Edite o arquivo `src/Services/Conecta.php` e atualize as credenciais do banco de dados

## Estrutura do Projeto

```
conecta-consulta/
├── admin/              # Páginas de administração
│   ├── consultas/     # CRUD de consultas
│   ├── exames/        # CRUD de exames
│   ├── medicos/       # CRUD de médicos
│   └── pacientes/     # CRUD de pacientes
├── src/               # Código fonte
│   ├── Models/        # Classes de modelo
│   └── Services/      # Classes de serviço
├── vendor/            # Dependências
├── composer.json      # Configuração do Composer
└── README.md         # Este arquivo
```

## Uso

1. Acesse o sistema através do navegador:
```
http://localhost/conecta-consulta
```

2. Use o menu de navegação para acessar as diferentes seções:
- Pacientes
- Médicos
- Exames
- Consultas

## Funcionalidades

- Cadastro e gerenciamento de pacientes
- Cadastro e gerenciamento de médicos
- Agendamento de consultas
- Registro de exames
- Controle de status de consultas
- Relatórios e estatísticas

## Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request

## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.


