
| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT01 | Cadastro de Bairro. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Bairros. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Novo Bairro"                       |
| **E** preechemos os dados do novo bairro                          |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que o cadastro foi feito.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro foi salvo.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1WX2HMCSoSmZzsaCFSKrH7RScmTsFf6VK/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT02 | Cadastro de Bairro com dados incompletos. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Bairros. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Novo Bairro"                       |
| **E** preechemos os dados do novo bairro exeto o nome             |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que o cadastro não foi feito.   |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro não foi salvo.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/16l3EgindzE6HZIkRsLHPPEgSBWuRrYTx/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT03 | Editar Bairro. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Bairros. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Editar" no Bairro Teste            |
| **E** editar o nome para Bairro Teste Editado                     |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que o cadastro foi feito.       |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro foi salvo.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/148VjCFPBFYeto7cg_NRWpX1zm3cq1LoQ/view?usp=share_link | 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT04 | Excluir Bairro. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Bairros. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Excluir" no Bairro Teste            |
| **QUANDO** selecionamos a opção de "Confirmar"                       |
| **ENTÃO** o sistema deve excluir e apresentar uma mensagem de confirmação.|
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve excluir e apresentar uma mensagem de confirmação.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:**  https://drive.google.com/file/d/1vJBEcTyCaMRMDnsa-qgHv97r1MUnzd5t/view?usp=share_link | 

---
