<h1>API Movie catalog</h1>

<h2>Descrição da API:</h2>
<p>
  A aplicação foi feita utilizando o <b>framewrok Laravel na versão 5.6</b> com <b>banco de dados relacional MySQL</b>.
  Decidi usar o MySQL para persistir os dados por que devido à especificação do projeto ficou claro que exigia um modelo de banco dados relacional.
  o MySQL é uma boa opção por causa da simplicidade de se trabalhar, sendo agil para o desenvolvimento de aplicações de pequeno porte mas com uma boa margem para escalar.
  Além de ser uma tecnologia de banco de dados bastante utilizada pela comunidade possuindo ampla compatibilidade com as tecnologias de desenvolvimento do mercado.
</p>

<h3>Na API é possível realizar o cadastro de um catálogo de filmes, descrevendo detalhes como a classificação indicativa, diretor, e elenco.</h3>
<ul>
  <li>É possível listar todos os filmes cadastrados, todos os diretores cadastrados bem como todos os atores cadastrados.
  </li>
  <li>De forma semelhante é possivel listar um registro único de cada entidade passando o id como parâmetro na rota.
  </li>
  <li>
    Nessas requisições de filtragem de um registro único, na resposta estão inclusos os dados dos relacionamentos de forma detalhada. De forma que é possível ver qual é o diretor de um filme, ver quais são os atores que estralaram naquele filme.
  </li>
  <li>
    Semelhantemente, é possível listar todos os filmes que um diretor específico dirigiu, e todos os filmes em que um ator espefícido participou do elenco.
  </li>
  <li>
    Nas requisição de listagem de todos os registro de uma tabela, por exemplo listagem de todos os filmes, não são retornados os dados das tabelas relacionados melhorando assim o desempenho das resposta. Não há necessidade de mostrar tantos detalhes numa listagem tão genérica.
  </li>
  <li>
    É possível alterar dados como nome dos filmes, classificação, nome dos diretores, nomes dos atores.
  </li>
  <li>
    É possível deletar qualquer registro criado via os endpoints abertos.
  </li>
</ul>

<h3>Descrição dos relacionamentos:</h3>
<ul>
  <li>
    A tabela de diretores tem relacionamento de 1 para muitos com a tabela de filmes.
  </li>
  <li>
    A tabela de filmes tem relacionamento de muitos para 1 com a tabela de diretores.
  </li>
  <li>
    A tabela de filmes tem relacionamento de muitos para muitos com a tabela de atores.
  </li>
  <li>
    As tabelas de filmes e atores geram uma tabela pivot chamada casts (elencos) por causa do seu relacionameto muitos para muitos.
  </li>
</ul>

<p>
  Durante o desenvolvimento pensei num modelo mais enxuto e simples possível respeitando as especificações passadas.
</p>
<p>
  Existem 3 tabelas principais e 1 tabela <b>pivot</b> que relaciona os filmes com os atores participantes do mesmo.
</p>
<p>
  A parte da classificação do filme, decidi não incluí-la em uma tabela própria, por questões de simplicidade, até porque um simples campo de úmero na tabela movies já dá conta desta informação.
</p>
<p>
  Mas à título de informação esta poderia ser uma tabela à parte contendo uma campo id (pk) e um campo idade do tipo inteiro, e uma referência da classificação na tabela movies via uma <b>foreign key</b> chamada <b>classification_id</b>.
</p>


<h3>Tabelas do banco:</h3>
<h4>movies:</h4>
  <h5>campos:</h5>
  <ul>
    <li>id (pk) - id do filme.</li>
    <li>name - nome do filme.</li>
    <li>classification - classificação recomendada do filme.</li>
    <li>director_id (fk) - id do diretor do filme.</li>
  </ul>  
<h4>directors:</h4>
  <h5>campos:</h5>
  <ul>
    <li>id (pk) - id do diretor.</li>
    <li>name - nome do diretor de filmes.</li>
  </ul>
  <h4>actors:</h4>
    <h5>campos:</h5>
    <ul>
      <li>id (pk) - id do ator.</li>
      <li>name - nome do ator de cinema.</li>
    </ul>

<h4>casts: tabela pivot entre movies e actors que representa a abstração do elenco dos filmes.</h4>
  <h5>campos:</h5>
  <ul>
    <li>id (pk) - id do registro filme x ator.</li>
    <li>movie_id (fk) - representa o id do filme.</li>
    <li>actor_id (fk) - representa o id do ator.</li>
  </ul>

<h3>Endpoints:</h3>

<h4>Diretores:</h4>
  <h5>MÉTODO GET:</h5>
  <ul>
    <li>Listagem de todos: localhost/api/directors</li>
    <li>Filtro pelo ID: localhost/api/directors/{id do diretor}</li>
  </ul>
  <h5>MÉTODO POST:</h5>
  <ul>
    <li>Criação: localhost/api/directors/
      <ul>
        <li>Enviar campos: name (string obrigatorio).</li>
      </ul>
    </li>
  </ul>
  
  <h5>MÉTODO PUT:</h5>
  <ul>
    <li>Atualização: localhost/api/directors/{id do diretor}
      <ul>
        <li>Enviar campos: name (string obrigatorio).</li>
      </ul>
    </li>

  </ul>
  <h5>MÉTODO DELETE:</h5>
  <ul>
    <li>Exclusão: localhost/api/directors/{id do diretor}</li>
  </ul>
  

<h4>Atores:</h4>
  <h5>MÉTODO GET:</h5>
  <ul>
    <li>Listagem de todos: localhost/api/actors</li>
    <li>Filtro pelo ID: localhost/api/actors/{id do ator}</li>
  </ul>
  
  <h5>MÉTODO POST:</h5>
  <ul>
    <li>Criação: localhost/api/actors/
      <ul>
        <li>Enviar campos: name (string obrigatorio).</li>
      </ul>
    </li>
  </ul>
  
    
  
  <h5>MÉTODO PUT:</h5>
  <ul>
    <li>Atualização: localhost/api/actors/{id do ator}
      <ul>
        <li>Enviar campos: name (string obrigatorio).</li>
      </ul>
    </li>
  </ul>
  <h5>MÉTODO DELETE:</h5>
  <ul>
    <li>Exclusão: localhost/api/actors/{id do ator}</li>
  </ul>

<h4>Filmes:</h4> 
  <h5>MÉTODO GET:</h5>
  <ul>
    <li>Listagem de todos: localhost/api/movies</li>
    <li>Filtro pelo ID: localhost/api/movies/{id do filme}</li>
  </ul>
  
  
  
  <h5>MÉTODO POST:</h5>
  <ul>
    <li>Criação: localhost/api/movies/
      <ul>
        <li>Enviar campos: name (string obrigatorio); classification (obrigatorio), director_id (obrigatorio), actors_id (array de inteiros obrigatorio) exemplo: "actors_id": [1, 2, 3, 4]</li>
      </ul>
    </li>
  </ul>
  <h5>MÉTODO PUT:</h5>
  <ul>
    <li>Atualização: localhost/api/movies/{id do filme}
      <ul>
        <li>Enviar campos: name (string obrigatorio)</li>
      </ul>
    </li>
  </ul>
  <h5>MÉTODO DELETE:</h5>
  <ul>
    <li>Exclusão: localhost/api/movies/{id do filme}</li>
  </ul>
  
  <h2>Arquivo de documentação e informações de como configurar o projeto em /documentacao-ultilizacao-api.txt</h2>
<h2>Arquivo da coleção do Postman em /Movie Catalog API.postman_collection.json</h2>
