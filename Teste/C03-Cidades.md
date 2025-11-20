| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT01 | Criação de Cidade. |


| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cidade. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Novo"                              |
| **E** preenchemos os campos corretamente                          |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** seremos redirecionados para a tela listagem de cidades com a nova cidade inserida.|
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O redirecionados para a tela listagem de cidades com a nova cidade inserida.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1M1zVSOkMfsdWhbrRXkEEmHjnpVQJF7cl/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT02 | Criação de Cidade com dados incompletos. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cidade. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Novo"                              |
| **E** preencha o campo de UF e deixe o Nome em branco             |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que o cadastro esta incompleto e não deve salvar.|
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro esta incompleto e não deve salvar.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1KpbzxKDJoq2nhgzTeBUr5RCr_8Bp-1di/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT03 | Edição de Cidade. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cidade. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Editar"                            |
| **E** adicione no nome da Teste Cidade Editado                    |
| **QUANDO** selecionamos a opção de "Salvar"                       |
| **ENTÃO** o sistema deve informar que o cadastro foi feito e redirecionar para tela de lsitagem.|
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro foi feito e redirecionar para tela de lsitagem.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1VaLLl3yOzKhKII5HXoBSDz7OjnsVcSQU/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C03-CT04 | Exclusão de Cidade. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Acesso à tela de Cidade. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página de Cidades                         |
| **E** selecionamos a opção de "Excluir"                           |
| **QUANDO** selecionamos a opção de "Confirmar"                    |
| **ENTÃO** o sistema deve informar que o cadastro foi removido.    |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que o cadastro foi removido.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido| 
| * **URL:** https://drive.google.com/file/d/1NSVkoObs2YSlm7BWU-HPyp1wVI2Ce3Ai/view?usp=share_link| 

---
