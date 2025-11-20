

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C06-CT01 | Cadastro de Cardapio. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cardapios. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cardapio                        |
| **E** selecionamos a opção de "Novo Cardapio"                     |
| **E** preechemos os dados do novo cardapio corretamente           |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que o cadastro foi feito.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro foi salvo.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1nI_1YWNP8xDL9PGmLmnPdjAOAEl3z88O/view?usp=share_link | 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT02 | Cadastro de Produto com informação incompleta. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cardapio. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cardapio                         |
| **E** selecionamos a opção de "Novo Cardapio"                      |
| **E** preechemos os dados do novo cardapio corretamente menos o campo Receita|
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar erro de campo vazio.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar erro de campo vazio.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1eKoGLUmcER3GtWLR7Yi7aZRQCdJTCWBJ/view?usp=share_link | 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT03 | Cadastro de Cardapio com data anterior a atual. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cardapio. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cardapio                         |
| **E** selecionamos a opção de "Novo Cardapio"                      |
| **E** preechemos os dados do novo cardapio com uma data menor a atual|
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar erro de dada.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar erro de campo em duplicidade.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/14pFJO4jTwDVOoRdhHqwdh7KOBUUYF7ku/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT04 | Edição de Cardapio. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cardapio. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cardapio                         |
| **E** selecionamos a opção de "Editar" no Receita Teste           |
| **E** mudamos o nome do cardapio para Receita Teste Editado        |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que a atualização foi feita.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que a atualização foi feita.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1RXt2o3D9L8Kw8YUmVzrri7yqQAsDECXh/view?usp=share_link | 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C05-CT05 | Exclusão de Cardapio. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cardapio. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cardapio                         |
| **E** selecionamos a opção de "Excluir" no Cardapio Teste           |
| **QUANDO** selecionamos a opção de "Confirmar"                       |
| **ENTÃO** o sistema deve deletar e informar que o item foi apagado.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve deletar e informar que o item foi apagado.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Cardapio não pode ser excluido por que o cardapio se refere ao itemCardapio| 
| * **URL:**  | 

---
