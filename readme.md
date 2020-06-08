<h1>API Movie catalog</h1>

Descrição da API:
A aplicação foi feita utilizando o framewrok Laravel na versão 5.6 com banco de dados relacional MySQL.
Decidi usar o MySQL para persistir os dados por que devido à especificação do projeto ficou claro que exigia um modelo de banco dados relacional.
o MySQL é uma boa opção por causa da simplicidade de se trabalhar, sendo agil para o desenvolvimento de aplicações de pequeno porte mas com uma boa margem para escalar.
Além de ser uma tecnologia de banco de dados bastante utilizada pela comunidade possuindo ampla compatibilidade com as tecnologias de desenvolvimento do mercado.

Na API é possível realizar o cadastro de um catálogo de filmes, descrevendo detalhes como a classificação indicativa, diretor, e elenco.
- É possível listar todos os filmes cadastrados, todos os diretores cadastrados bem como todos os atores cadastrados.
- De forma semelhante é possivel listar um registro único de cada entidade passando o id como parâmetro na rota.
- Nessas requisições de filtragem de um registro único, na resposta estão inclusos os dados dos relacionamentos de forma detalhada. De forma que é possível ver qual é o diretor de um filme, ver quais são os atores que estralaram naquele filme.
- Semelhantemente, é possível listar todos os filmes que um diretor específico dirigiu, e todos os filmes em que um ator espefícido participou do elenco.
- Nas requisição de listagem de todos os registro de uma tabela, por exemplo listagem de todos os filmes, não são retornados os dados das tabelas relacionados melhorando assim o desempenho das resposta. Não há necessidade de mostrar tantos detalhes numa listagem tão genérica. 
- É possível alterar dados como nome dos filmes, classificação, nome dos diretores, nomes dos atores.
- É possível deletar qualquer registro criado via os endpoints abertos.

- Descrição dos relacionamentos:
  - A tabela de diretores tem relacionamento de 1 para muitos com a tabela de filmes.
  - A tabela de filmes tem relacionamento de muitos para 1 com a tabela de diretores.
  - A tabela de filmes tem relacionamento de muitos para muitos com a tabela de atores.
  - As tabelas de filmes e atores geram uma tabela pivot chamada casts (elencos) por causa do seu relacionameto muitos para muitos.

Durante o desenvolvimento pensei num modelo mais enxuto e simples possível respeitando as especificações passadas.
Existem 3 tabelas principais e 1 tabela pivot que relaciona os filmes com os atores participantes do mesmo.
A parte da classificação do filme, decidi não incluí-la em uma tabela própria, por questões de simplicidade, até porque um simples campo de úmero na tabela movies já dá conta desta informação.
Mas à título de informação esta poderia ser uma tabela à parte contendo uma campo id (pk) e um campo idade do tipo inteiro, e uma referência da classificação na tabela movies via uma foreign key chamada classification_id.


Tabelas do banco:
movies:
  campos: 
  - id (pk) - id do filme.
  - name - nome do filme.
  - classification - classificação recomendada do filme.
  - director_id (fk) - id do diretor do filme.
  
directors
  campos:
  - id (pk) - id do diretor.
  - name - nome do diretor de filmes.

actors
  campos:
  - id (pk) - id do ator.
  - name - nome do ator de cinema.

casts: tabela pivot entre movies e actors que representa a abstração do elenco dos filmes.
  campos:
  - id (pk) - id do registro filme x ator.
  - movie_id (fk) - representa o id do filme . 
  - actor_id (fk) - representa o id do ator.

Endpoints:

Diretores: 
  MÉTODO GET:
  Listagem de todos: http://api-movie-catalog.test/api/directors
  Filtro pelo ID: http://api-movie-catalog.test/api/directors/{id do diretor}
  
  MÉTODO POST:
  Criação: http://api-movie-catalog.test/api/directors/
    Enviar campos: name (string obrigatorio);
  
  MÉTODO PUT:
  Atualização: http://api-movie-catalog.test/api/directors/{id do diretor}
    Enviar campos: name (string obrigatorio);

  MÉTODO DELETE:
  Exclusão: http://api-movie-catalog.test/api/directors/{id do diretor}

Atores: 
  MÉTODO GET:
  Listagem de todos: http://api-movie-catalog.test/api/actors
  Filtro pelo ID: http://api-movie-catalog.test/api/actors/{id do ator}
  
  MÉTODO POST:
  Criação: http://api-movie-catalog.test/api/actors/
    Enviar campos: name (string obrigatorio);
  
  MÉTODO PUT:
  Atualização: http://api-movie-catalog.test/api/actors/{id do ator}
    Enviar campos: name (string obrigatorio);

  MÉTODO DELETE:
  Exclusão: http://api-movie-catalog.test/api/actors/{id do ator}

Filmes: 
  MÉTODO GET:
  Listagem de todos: http://api-movie-catalog.test/api/movies
  Filtro pelo ID: http://api-movie-catalog.test/api/movies/{id do filme}
  
  MÉTODO POST:
  Criação: http://api-movie-catalog.test/api/movies/
    Enviar campos: name (string obrigatorio); classification (obrigatorio), director_id (obrigatorio), actors_id (array de inteiros obrigatorio) exemplo: "actors_id": [1, 2, 3, 4]
  
  MÉTODO PUT:
  Atualização: http://api-movie-catalog.test/api/movies/{id do filme}
    Enviar campos: name (string obrigatorio);

  MÉTODO DELETE:
  Exclusão: http://api-movie-catalog.test/api/movies/{id do filme}
