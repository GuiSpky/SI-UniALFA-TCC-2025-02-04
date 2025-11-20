| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C02-CT01 | Acessar pagina de listagem de usuários. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Estar logado no sistema como Gerente. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na Dashboard do sistema                      |
| **QUANDO** acessamos a pagina de usuário                          |
| **ENTÃO** devemos ver a lista de todos os usuários cadastrados.   |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O redirecionamento para pagina de usuários e a listagem completa de usuários.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e dados salvos| 
| * **URL:** https://drive.google.com/file/d/1VlLWiuJURkMIA91QNd_jrzyB-nHxhhWu/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C02-CT02 | Criar novo usuário. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Estar logado no sistema como Gerente. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página Usuários do sistema                |
| **E** selecionamos a opção "Novo Usuário"                         |
| **E** preenchemos todos os campos corretamente                    |
| **QUANDO** selecionamos "salvar"                                  |
| **ENTÃO** devemos ser informados que o cadastro foi concluido.    |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| Novo usuário cadastrado e exibido na lista.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e dados salvos| 
| * **URL:** https://drive.google.com/file/d/1Rfvdy3VVwAG3Jhnd8L1TibfWjQn4P1oB/view?usp=share_link| 

---
| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C02-CT03 | Criar novo usuário com informações incompletas. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Estar logado no sistema como Gerente. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página Usuários do sistema                |
| **E** selecionamos a opção "Novo Usuário"                         |
| **E** preenchemos todos os campos corretamente exeto o nome       |
| **QUANDO** selecionamos "salvar"                                  |
| **ENTÃO** devemos ser informados que o cadastro não foi concluido por que esta faltando informações.|
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| Mensagem de erro e usuário não salvo.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e dados salvos| 
| * **URL:** https://drive.google.com/file/d/1IrKQ2RlO6OSjaZpgGgLRb54mgywvtEUY/view?usp=share_link | 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C02-CT04 | Editar usuário. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Estar logado no sistema como Gerente e. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página Usuários do sistema                |
| **E** selecionamos a opção "Editar" no Usuário Teste              |
| **E** editamos o nome para "Teste Editado"                        |
| **QUANDO** selecionamos "salvar"                                  |
| **ENTÃO** devemos ser informados que o cadastro foi concluido.    |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| Novo usuário cadastrado e exibido na lista.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e dados salvos| 
| * **URL:** https://drive.google.com/file/d/1J_TamExJOXviStHFiql1oBpRw43ke-38/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C02-CT05 | Excluir usuário. |

| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Estar logado no sistema como Gerente e. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página Usuários do sistema                |
| **E** selecionamos a opção "Excluir" no Usuário Teste             |
| **QUANDO** selecionamos "confirmar"                               |
| **ENTÃO** devemos ser informados que o cadastro foi excluido.     |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| Usuário excluido com sucesso e não exibido na lista final.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e dados salvos| 
| * **URL:** https://drive.google.com/file/d/1wUzVplpwwUetaEZRKIvG87hAuVOQrrSN/view?usp=share_link | 

---
