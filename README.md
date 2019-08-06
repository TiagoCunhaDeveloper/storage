# GT Storage - Sistema de gerenciamento de arquivos 

O GT Storage é um sistema web feito em php (estruturado),js,html,css de gerenciamento de arquivos, onde o usuário pode criar e/ou fazer uploads de seus arquivos e pastas, podendo compartilhar com outras pessoas, o sistema possui 4 planos de armazenamento (20 gb, 50 gb, 100 gb, 1tb) todos com preços fictícios. 

## Usuário

![1](https://user-images.githubusercontent.com/46055504/62573466-7d51c380-b86c-11e9-8856-323837235178.PNG)

### Funcionalidades
- Gerenciamento de arquivos (Upload/Exclusão/Edição/Compartilhamento (através de e-mail e/ou um link compartilhável))

- Compartilhados comigo (Arquivos compartilhados comigo (tendo as opções de somente visualizar, editar, editar e excluir definidas por quem compartilha o arquivo, ou seja, o “dono” do arquivo))

- Anotações (Cadastro/exclusão)

![2](https://user-images.githubusercontent.com/46055504/62573539-a83c1780-b86c-11e9-9fa0-43d16692d5e4.PNG)

- Arquivos excluídos (Recuperação de arquivo, download, exclusão (após 7 dias da data de exclusão))

- Outros

![3](https://user-images.githubusercontent.com/46055504/62573570-b9852400-b86c-11e9-927a-b175bf4d030b.PNG)

- Meu perfil (Edição de cadastro)

- Planos de armazenamentos (“Compra de planos”, aprovados pelo usuário admin)


![4](https://user-images.githubusercontent.com/46055504/62573593-c3a72280-b86c-11e9-8542-e6209828f5d2.PNG)

- Configurações (Mudança de cor do site, redefinição de senha)

![5](https://user-images.githubusercontent.com/46055504/62573611-cd308a80-b86c-11e9-92cb-c848061b4d49.PNG)

### Versionamento

Quando o arquivo já existe, o sistema da algumas opções do que fazer com o arquivo, podendo ser substituído, criado uma cópia e/ou o sistema cria uma pasta com as versões do arquivo separando o mesmo por data (colocado no nome do arquivo).

![6](https://user-images.githubusercontent.com/46055504/62573631-d7528900-b86c-11e9-9dd8-ba94c0caeb53.PNG)

### Versionamento para arquivos de texto (txt, arquivos de códigos)

Quando o sistema encontra arquivos iguais nos formatos de texto e/ou códigos, ele os compara e mostra as diferenças.

![7](https://user-images.githubusercontent.com/46055504/62573654-e33e4b00-b86c-11e9-9511-8fc4b72cd1f0.PNG)

## Administrador

![8](https://user-images.githubusercontent.com/46055504/62573669-ec2f1c80-b86c-11e9-98e6-a445652d5bcd.PNG)

### Funcionalidades 
- Todas as funcionalidades descritas no perfil usuário
- Gerenciamento de usuários (gráficos de utilização do armazenamento e acesso aos arquivos)

![9](https://user-images.githubusercontent.com/46055504/62573685-f5b88480-b86c-11e9-8992-69882e25ac66.PNG)

- Planos em liberação (aprovação de planos de armazenamentos)

- Planos aprovados (planos de armazenamentos aprovados com gráfico para acompanhamento)

![10](https://user-images.githubusercontent.com/46055504/62573698-ff41ec80-b86c-11e9-9772-a4cf86b7b344.PNG)

## Como testar o sistema
- Ter um sevidor web, exemplo Apache
- Importar a base de dados (mysql)
- Login do adm (Email: admin@admin.com, Senha: 123123123)
- Usuário (Sem usuários para testes, para criar um basta ir em "Crie sua conta", para logar va no cadastro do usuário no banco de dados e mude a coluna "status_email" de 0 para 1, pois é a validação de e-mail do usuário)