
| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT01 | Cadastro de Produto. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Produto. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Produto                         |
| **E** selecionamos a opção de "Novo Produto"                      |
| **E** preechemos os dados do novo produto corretamente            |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que o cadastro foi feito.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro foi salvo.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1Y4i9Te2LgY2qvniHTM-UpF1cXl1qktWv/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT02 | Cadastro de Produto com informação incompleta. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Produto. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Produto                         |
| **E** selecionamos a opção de "Novo Produto"                      |
| **E** preechemos os dados do novo produto corretamente menos o campo nome|
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar erro de campo vazio.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar erro de campo vazio.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1ILeCGE4PZNvToY7qa74ImNivGENqWVPE/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT03 | Cadastro de Produto com nome em duplicidade. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Produto. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Produto                         |
| **E** selecionamos a opção de "Novo Produto"                      |
| **E** preechemos os dados do novo produto com nome de um produto ja criado|
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar erro de campo em duplicidade.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar erro de campo em duplicidade.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1XPNnsEx4JrJ_BP7QOelNwc7nA3k5f17O/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT04 | Edição de Produto. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Produto. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Produto                         |
| **E** selecionamos a opção de "Editar" no Produto Teste           |
| **E** mudamos o nome do produto para Produto Teste Editado        |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que a atualização foi feita.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que a atualização foi feita.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1OOeLm9-dOj3UzdOBkRbZ2cOO01oaJd8F/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT05 | Exclusão de Produto. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Produto. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Produto                         |
| **E** selecionamos a opção de "Excluir" no Produto Teste           |
| **QUANDO** selecionamos a opção de "Confirmar"                       |
| **ENTÃO** o sistema deve deletar e informar que o item foi apagado.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve deletar e informar que o item foi apagado.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1bSNXo7AN5gcbm-AmN9MO-1v8R9NQRy8c/view?usp=share_link | 

---
