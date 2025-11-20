| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C01-CT01 | Realização de login. |


| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Sistema rodando com a tela de login. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página Login                              |
| **E** inserimos "gerente@gmail.com" no campo "Email"              |
| **E** "gerente123" no campo "Senha"                               |
| **QUANDO** selecionamos a opção de "Entrar"                       |
| **ENTÃO** seremos redirecionados para a tela do dashboard.        |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O redirecionados para a tela do dashboard e estar logado como gerente.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e login realizado| 
| * **URL:** https://drive.google.com/file/d/182XHMPL94iWIIEHRHhv--I9fXqhsU0EL/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C01-CT02 | Realização de login com email invalidas. |


| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Sistema rodando com a tela de login. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página Login                              |
| **E** inserimos "erro@gmail.com" no campo "Email"              |
| **E** "gerente123" no campo "Senha"                               |
| **QUANDO** selecionamos a opção de "Entrar"                       |
| **ENTÃO** o sistema deve informar que credenciais estão inválidads.        |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que credenciais estão inválidads e não realizar o login.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e login realizado| 
| * **URL:** https://drive.google.com/file/d/1deT06Tpt9-JckYJEUz8gN2Vs6jH5StTu/view?usp=share_link| 

---

| ID       | Descrição                                                |
| :------- | :------------------------------------------------------- |
| C01-CT02 | Realização de login com senha invalida. |


| **Pré-condições**                                             |
| :------------------------------------------------------------ |
| Sistema rodando com a tela de login. |

| **Passos**                                                        |
| :---------------------------------------------------------------- |
| **DADO** que estamos na página Login                              |
| **E** inserimos "gerente@gmail.com" no campo "Email"              |
| **E** "erro123" no campo "Senha"                               |
| **QUANDO** selecionamos a opção de "Entrar"                       |
| **ENTÃO** o sistema deve informar que credenciais estão inválidads.        |
    
 | **Critérios de aceitação**                                      |
| :-------------------------------------------------------------- |
| O sistema deve informar que credenciais estão inválidads e não realizar o login.  |

| Resultado |
| :---------------------------------------------------------------- |
| Teste realizado | 
| *  Teste concluido e login realizado| 
| * **URL:** https://drive.google.com/file/d/17EG_6NQifiUK5y_6o_gR-WVfYend6rpD/view?usp=share_link| 

---
