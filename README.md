# GT Storage - Sistema de gerenciamento de arquivos 

O GT Storage é um sistema web feito em php (estruturado),js,html,css de gerenciamento de arquivos, onde o usuário pode criar e/ou fazer uploads de seus arquivos e pastas, podendo compartilhar com outras pessoas, o sistema possui 4 planos de armazenamento (20 gb, 50 gb, 100 gb, 1tb) todos com preços fictícios. 

## Usuário

![](https://lh3.google.com/u/0/d/1eyRrI2SL2IM9C-f2t4s0akOF91u8gha6=w1920-h969-iv1)

### Funcionalidades
- Gerenciamento de arquivos (Upload/Exclusão/Edição/Compartilhamento (através de e-mail e/ou um link compartilhável))

- Compartilhados comigo (Arquivos compartilhados comigo (tendo as opções de somente visualizar, editar, editar e excluir definidas por quem compartilha o arquivo, ou seja, o “dono” do arquivo))

- Anotações (Cadastro/exclusão)

![](https://lh3.google.com/u/0/d/1eqT1_kyyKRtifo3wSWBev67o5-sosO99=w1920-h969-iv1)

- Arquivos excluídos (Recuperação de arquivo, download, exclusão (após 7 dias da data de exclusão))

- Outros

![](https://lh3.google.com/u/0/d/103x5Gl-9_CuafVtqI_0rfKBeF-UEdEyv=w1515-h969-iv1)

- Meu perfil (Edição de cadastro)

- Planos de armazenamentos (“Compra de planos”, aprovados pelo usuário admin)


![](https://lh3.google.com/u/0/d/15pGiK5oqjle66wGR9chBp4SHELNctqjV=w1515-h969-iv1)

- Configurações (Mudança de cor do site, redefinição de senha)

![](https://lh3.google.com/u/0/d/1xzPnA40QN9jMieJpOX1K5DFfkhUBpggS=w1515-h969-iv1)

### Versionamento

Quando o arquivo já existe, o sistema da algumas opções do que fazer com o arquivo, podendo ser substituído, criado uma cópia e/ou o sistema cria uma pasta com as versões do arquivo separando o mesmo por data (colocado no nome do arquivo).

![](https://lh3.google.com/u/0/d/15E2uPn1kg7repMiiXO2i_cNhFiOJzc4t=w1515-h969-iv1)

### Versionamento para arquivos de texto (txt, arquivos de códigos)

Quando o sistema encontra arquivos iguais nos formatos de texto e/ou códigos, ele os compara e mostra as diferenças.

![](https://lh3.google.com/u/0/d/1VCOvn1vqhSuH__6q-kUTvV0LFBXYcukZ=w1515-h969-iv1)

## Administrador

![](https://lh3.google.com/u/0/d/1uLEFB0SnHBbtAHoGd7BchlsS68lkLNLd=w1920-h969-iv1)

### Funcionalidades 
- Todas as funcionalidades descritas no perfil usuário
- Gerenciamento de usuários (gráficos de utilização do armazenamento e acesso aos arquivos)

![](https://lh3.google.com/u/0/d/1s2uQR94UG5uhDg97y2VFG3WKejBhvXn8=w1920-h969-iv1)

- Planos em liberação (aprovação de planos de armazenamentos)

- Planos aprovados (planos de armazenamentos aprovados com gráfico para acompanhamento)

![](https://lh3.google.com/u/0/d/1KP00ZG-2L5NmrtZ5cJC5BiFgWzMXMBiw=w1920-h969-iv1)

## Como testar o sistema
- Ter um sevidor web, exemplo Apache
- Importar a base de dados (mysql)
- Login do adm (Email: admin@admin.com, Senha: 123123123)
- Usuário (Sem usuários para testes, para criar um basta ir em "Crie sua conta")