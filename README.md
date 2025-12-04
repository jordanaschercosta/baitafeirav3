# Baita Feira : Conectando Organizadores,Microemprendedores e Clientes em Feiras de Porto Alegre

_Jordana Scher e Sofia Pedroso_

Este artigo tem como objetivo analisar e documentar a criação de uma aplicação web para divulgar feiras em Porto Alegre.Essa aplicação foi desenvolvida como projeto final na unidade curricular Projeto de Desenvolvimento II pelas alunas Jordana Scher e Sofia Cotta do curso de Análise e Desenvolvimento de Sistemas do Centro Universitário Senac-RS.

## Resumo do Projeto

A ausência de um canal centralizado e confiável com informações sobre as feiras de microempreendedores locais representa um desafio significativo para a divulgação desses eventos. Muitos consumidores não têm acesso claro a dados como quando e onde as feiras acontecem, o que resulta em baixa participação, reduz o engajamento e compromete a visibilidade dos expositores locais. Essa falha na comunicação limita o alcance das iniciativas, impacta negativamente o desempenho dos microempreendedores e dificulta o fortalecimento do comércio local.

Diante desse contexto, o projeto propõe o desenvolvimento de uma aplicação web responsiva que conecte organizadores, expositores e consumidores em um único ambiente digital. A plataforma reunirá informações atualizadas sobre eventos, bancas participantes, produtos e promoções, facilitando o acesso do público e ampliando a visibilidade dos empreendedores. Com essa solução, espera-se aumentar a participação do público das feiras, incentivando mais pessoas a visitarem os eventos e conhecerem os microempreendedores locais.


## Definição do Problema

Microempreendedores expositores das que participam de feiras em Porto Alegre enfrentam dificuldades para divulgar seus eventos e alcançar um público maior. Para compreender melhor essas dificuldades, foi realizada uma pesquisa, por meio de formulários, com expositores e frequentadores das feiras de Porto Alegre.

Os resultados indicaram que muitos frequentadores das feiras não sabem quando e onde as feiras acontecem e relataram dificuldade em conhecer melhor os expositores e seus negócios , devido à falta de um espaço centralizado que reúna essas informações. Já os expositores que tem são microemprendedores apontaram não ter acesso adequado a informações sobre os locais dos eventos, além de identificarem falta de divulgação de seus produtos, promoções e bancas participantes .

Atualmente, não existe um canal que concentre e organize essas informações, o que resulta em baixa visibilidade para os expositores e limita as oportunidades para consumidores interessados em conhecer novidades, apoiar pequenos empreendedores e fortalecer o comércio local.

A seguir, são apresentadas as imagens referentes aos resultados obtidos na pesquisa realizada com microempreendedores e frequentadores das feiras, as quais contribuíram para a identificação das principais dificuldades e necessidades do público envolvido.

Press enter or click to view image in full size

## Objetivo Geral
Foi desenvolvida uma aplicação web responsiva que centraliza a divulgação de feiras , permitindo que organizadores publiquem seus eventos, expositores promovam seus negócios e consumidores tenham acesso a informações claras sobre quando e onde as feiras ocorrerão.

## Objetivos Específicos
Com o intuito de atender às necessidades dos diferentes públicos envolvidos nas feiras, como expositores, organizadores de eventos e frequentadores, o sistema busca alcançar os seguintes objetivos específicos:

## Para os Organizadores de Eventos:
* Disponibilizar ferramentas para criação, edição, publicação e cancelamento de eventos.
* Centralizar informações essenciais do evento, como data, horário, descrição e endereço.
* Melhorar a comunicação entre organizadores e expositores por meio de informações atualizadas e acessíveis.E para os clientes também para saber tudo sobre o evento.

Permitir o cadastro de perfis completos das bancas participantes, contendo informações como nome da banca, descrição, instagram e formas de contato.
Possibilitar o cadastro e a divulgação de produtos, promoções de cada banca.
Permitir que o expositor selecione a categoria da sua banca, facilitando para que os frequentadores encontrem marcas de acordo com seus interesses.
Possibilitar o cadastro de mais de uma banca, caso o expositor possua múltiplos negócios.
Facilitar o acesso às informações sobre os eventos disponíveis, permitindo que o expositor visualize detalhes e decida se irá participar ou não do evento.
Disponibilizar um espaço centralizado onde os consumidores possam conhecer melhor os expositores e os produtos oferecidos nas feiras.
## Para os Expositores (Microempreendedores):
* Permitir o cadastro de perfis completos das bancas participantes, contendo informações como nome da banca, descrição, instagram e formas de contato.
* Possibilitar o cadastro e a divulgação de produtos, promoções de cada banca.
* Permitir que o expositor selecione a categoria da sua banca, facilitando para que os frequentadores encontrem marcas de acordo com seus interesses.
* Possibilitar o cadastro de mais de uma banca, caso o expositor possua múltiplos negócios.
* Facilitar o acesso às informações sobre os eventos disponíveis, permitindo que o expositor visualize detalhes e decida se irá participar ou não do evento.
* Disponibilizar um espaço centralizado onde os consumidores possam conhecer melhor os expositores e os produtos oferecidos nas feiras.

## Para os Frequentadores das Feiras (Consumidores):
* Permitir que os usuários encontrem informações atualizadas sobre as os eventos , incluindo data, horário, endereço e bancas participantes.
* O sistema permite que os consumidores favoritem produtos e bancas de seu interesse .
* Sempre que um produto favoritado entrar em promoção, o usuário receberá uma notificação no próprio site, além de uma mensagem automática via WhatsApp, enviada por meio da integração com a API da Twilio. Essa dupla forma de comunicação garante que o consumidor seja informado rapidamente sobre ofertas nos produtos de favoritados, aumentando o engajamento com a plataforma.
* Permitir que o usuário manifeste que vai participar ou não do evento no dia do evento, para facilitar o planejamento de participação.
* Disponibilizar filtros por categorias para facilitar a busca por bancas e produtos de interesse.


## Stack Tecnológico

A solução proposta foi desenvolvida com o objetivo de atender às necessidades do público do Baita Feira, oferecendo uma aplicação moderna, responsiva e de fácil usabilidade, proporcionando uma navegação eficiente tanto para consumidores quanto para microempreendedores. O projeto prioriza a adoção de tecnologias estáveis, garantindo desempenho, segurança e confiabilidade na utilização do sistema.

* HTML5 e CSS3: O HTML5 e o CSS3 constituem a base estrutural e visual da aplicação. Enquanto o HTML organiza os conteúdos da página, o CSS estiliza e garante um design moderno e responsivo. Essa escolha possibilita interfaces compatíveis com diferentes navegadores e dispositivos, fundamentais para alcançar um público variado.
* Bootstrap: O Bootstrap foi incorporado para acelerar o desenvolvimento da interface e assegurar a responsividade. Sua biblioteca de componentes facilita a construção de layouts consistentes, proporcionando uma experiência fluida aos usuários, seja acessando a plataforma de um celular em uma feira ou de um computador em casa.
* JavaScript: O JavaScript é essencial para trazer dinamismo à aplicação, tornando-a mais interativa e intuitiva. Ele é utilizado para validações, efeitos visuais e interações em tempo real, enriquecendo a experiência dos consumidores ao navegar pelas feiras e bancas cadastradas.
* Laravel: O Laravel é o framework PHP escolhido para o back-end, estruturado no padrão MVC. Ele oferece ferramentas robustas, como autenticação, ORM Eloquent, migrations e sistema de rotas, garantindo segurança, escalabilidade e facilidade na manutenção do projeto. Essa escolha contribui diretamente para a confiabilidade da aplicação como canal oficial de divulgação dos eventos.
* MySQL: O MySQL é o banco de dados relacional utilizado para o armazenamento das informações de usuários, eventos e produtos. Sua integração nativa com o Laravel, aliada à confiabilidade e desempenho, torna-o adequado para garantir consistência e eficiência no gerenciamento dos dados do sistema.
* GitHub para Versionamento: O GitHub foi utilizado para versionamento do código-fonte, possibilitando colaboração, rastreamento de alterações e adoção de boas práticas de desenvolvimento. Essa ferramenta é essencial para manter organização e transparência ao longo da evolução do sistema.
Para a disponibilização da plataforma online, foi utilizada a hospedagem da HostGator para o registro do domínio do site. O domínio originalmente desejado, baitafeira, já se encontrava em uso, sendo necessária a escolha de uma variação disponível para viabilizar a publicação do projeto na internet.
* Hostinger para Hospedagem: A aplicação será hospedada na Hostinger, que oferece suporte completo para PHP/Laravel e bancos de dados MySQL. Essa escolha garante um ambiente moderno, rápido e com excelente custo-benefício, atendendo às necessidades do Baita Feira com estabilidade e desempenho.
Além das tecnologias mencionadas, a plataforma integra APIs externas, como o ViaCEP, utilizada para a obtenção automática de dados de endereço a partir do CEP informado, e a API do WhatsApp (Twilio), empregada para a automação do envio de mensagens de divulgação de eventos organizados pelo organizador, promoções e notificações aos usuários clientes. Essas integrações facilitam o cadastro de eventos, ampliam a divulgação e aprimoram a comunicação entre organizadores, expositores e clientes.

Além das tecnologias principais utilizadas na plataforma, o Baita Feira integra diversas APIs externas para automatizar processos e aprimorar a experiência dos usuários. A API ViaCEP é utilizada para o preenchimento automático dos dados de endereço durante o cadastro dos eventos. Ao informar o CEP no formulário, o sistema realiza uma requisição à API, que retorna os dados em formato JSON, como rua, bairro, cidade e estado, preenchendo os campos automaticamente na interface sem a necessidade de recarregar a página, reduzindo erros de digitação e agilizando o cadastro.

Após a confirmação, os dados são armazenados pelo backend desenvolvido em Laravel (PHP) no banco de dados MySQL. Para viabilizar a exibição de mapas, o sistema utiliza a biblioteca Leaflet integrada ao OpenStreetMap, serviço cartográfico gratuito que não exige chave de API. O endereço cadastrado é convertido em coordenadas geográficas (latitude e longitude) por meio da API Nominatim, processo executado pelo serviço interno GeoLocalizacaoService, que envia a requisição, recebe os dados em formato JSON e grava as coordenadas no banco de dados associadas ao evento. Essas coordenadas permitem que os locais sejam exibidos corretamente no mapa com marcadores interativos. Além disso, o sistema utiliza a API de Geolocalização do navegador para obter a posição do usuário e aplica a fórmula de Haversine diretamente nas consultas SQL para calcular a distância entre o usuário e cada evento considerando a curvatura da Terra. Com esse cálculo, os eventos são ordenados automaticamente por proximidade, possibilitando que o usuário visualize primeiro as feiras mais próximas de sua localização.

A plataforma também integra a API do WhatsApp (Twilio) para automatizar o envio de notificações, promoções e divulgações de eventos aos usuários, fortalecendo a comunicação entre organizadores, expositores e clientes.

Tecnologia utilizadas no Baita Feira, abaixo:


![Texto alternativo](./resources/imagem)

## Descrição da Solução

Diagrama de Fluxo Arquitetural, abaixo:

![Texto alternativo](./resources/imagem/diagramadefluxobaitafeira.jpg)


Descrição da Solução
O Baita Feira consiste em uma plataforma web desenvolvida em Laravel (PHP), com interface responsiva construída em HTML, CSS, Bootstrap e JavaScript, utilizando MySQL como banco de dados e hospedagem na Hostinguer.
Para os recursos de localização, o sistema utiliza o Leaflet integrado ao OpenStreetMap (OSM), permitindo exibir mapas e marcar o local dos eventos de forma totalmente gratuita. A latitude e longitude são processadas pelo próprio Leaflet, enquanto o preenchimento automático do endereço do organizador é obtido por meio da API gratuita ViaCEP, que retorna informações completas a partir do CEP informado.
Além disso, o sistema conta com ferramentas internas para organização de eventos, gerenciamento de bancas, controle de participantes e divulgação das feiras, tornando o processo mais ágil e acessível para organizadores, expositores e consumidores. A plataforma tem como finalidade centralizar informações sobre feiras , conectando microempreendedores e o público interessado em novidades locais.

## Para Expositores
A plataforma disponibiliza recursos para que os expositores possam:

Cadastrar perfis completos de suas bancas, incluindo nome fantasia,descrição, categoria da banca , instagram e imagem do nome fantasia;
Registrar produtos e confirmar sua participação ou não no evento.
Vincular múltiplas bancas ao seu perfil, caso possuam mais de um empreendimento;
Divulgar produtos e promoções de forma centralizada e organizada.

## Para Consumidores (Frequentadores):

A plataforma permite aos consumidores:

* Consultar eventos de por data, mais perto e e futuros e seus respectivos detalhes;
* Favoritar bancas e produtos de interesse;
* Verificar em quais eventos suas bancas favoritas estarão presentes;
* O sistema permite que os usuários confirmem interesse em feiras e recebam notificações diretamente pelo WhatsApp. As notificações incluem informações sobre novos eventos, alterações nos eventos já agendados, cancelamentos e promoções de produtos que foram favoritados. Essa funcionalidade garante que os usuários estejam sempre atualizados sobre as feiras e produtos de seu interesse, aumentando o engajamento e a satisfação com o aplicativo.

## Para Microempreendedores (Expositores)

A plataforma disponibiliza recursos para que os expositores possam:

* Cadastrar perfis completos de suas bancas, incluindo descrição, categoria, redes sociais e informações de contato;

* Registrar produtos e confirmar sua participações em eventos .

* Vincular múltiplas bancas ao seu perfil, caso possuam mais de um empreendimento;

* Divulgar produtos, serviços, promoções e novidades de forma centralizada e organizada.

## Para Organizadores de Feiras

A solução oferece aos organizadores ferramentas para:

* Criar, editar e gerenciar eventos utilizando:

* Google API, para validação de endereços, mapas e funcionalidades de localização;

* Inteligência Artificial, para geração automática de descrições, estruturação de informações e sugestões de conteúdo;

* Gerenciar bancas participantes e analisar solicitações de expositores;

* Divulgar eventos e promoções de forma automatizada, utilizando API do WhatsApp e API de envio de e-mails para alcançar o público de maneira direta e eficiente.

## Para Consumidores (Frequentadores)

A plataforma permite aos consumidores:

* Consultar eventos de agora e futuros e seus respectivos detalhes;

* Favoritar bancas e produtos de interesse, acompanhando novidades e atualizações;

* Verificar em quais eventos suas bancas favoritas estarão presentes;

* Confirmar interesse em feiras e receber notificações por e-mail e WhatsApp, incluindo divulgação de novos eventos, promoções e atualizações importante;



## Arquitetura

O sistema Baita Feira foi elaborado para proporcionar uma experiência responsiva, escalável e de fácil manutenção, adotando o padrão MVC (Model-View-Controller) com o framework Laravel (PHP). A estrutura é organizada em camadas:

* Camada de Apresentação (View — Front-end): interfaces responsivas em HTML, CSS, Bootstrap e JavaScript, exibindo feiras, expositores e produtos, e permitindo interações do usuário, como favoritar marcas ou utilizar cupons.

* Camada de Controle (Controller — Back-end): gerencia a lógica da aplicação, autenticação de usuários e operações CRUD para eventos, produtos e cupons, atuando como intermediária entre o front-end e o modelo de dados.

* Camada de Serviços (Service — Back-end): encapsula regras de negócio complexas, promove a reutilização de código e integrações externas, como notificações via WhatsApp.
Camada de Modelo (Model— Banco de Dados): representa dados e regras de negócio no MySQL, armazenando informações de usuários, eventos, produtos e histórico de interações, utilizando o Eloquent ORM do Laravel.

* O projeto é versionado no GitHub, assegurando controle de alterações e colaboração, e hospedado na Umbler, que oferece suporte ao Laravel e MySQL, garantindo alta disponibilidade e acesso seguro aos usuários.

Essa arquitetura permite que o Baita Feira seja uma plataforma dinâmica e adaptável, facilitando o desenvolvimento contínuo e a integração de novas funcionalidades.

![Texto alternativo](./resources/imagens/arquitetura.jpg)


Devem ser realizados no mínimo 5 artefatos.

A seguir são apresentados exemplos de artefatos que podem ser apresentados:

## Comparativo com Sistemas Correlatos

Para identificar diferenciais competitivos e oportunidades de melhoria, foi realizado um comparativo entre o sistema Baita Feira e outras plataformas com funcionalidades relacionadas, como Sympla, Site da Prefeitura de Porto Alegre e Feira Incomum.

O objetivo da análise foi identificar quais recursos essas plataformas oferecem e entender como o Baita Feira pode se destacar ao atender de forma mais eficaz as demandas de microempreendedores, organizadores e consumidores das feiras locais.

A comparação, apresentada na tabela do estudo, evidencia que:

* Nenhuma das plataformas analisadas oferece cupons de desconto,funcionalidade presente no Baita Feira e que incentiva o consumo, atrai clientes e fortalece o engajamento.

* Todas as plataformas disponibilizam informações básicas como data, horário e local dos eventos, o que é essencial para a divulgação.

* Não apresentam outras datas futuras do mesmo evento ou da mesma feira, dificultando o planejamento dos consumidores que desejam se organizar com antecedência.

* Nenhuma mostra claramente os expositores confirmados para cada evento, limitando a visibilidade dos expositores e impedindo que o público saiba previamente quais marcas estarão presentes.

* Benchmarking (tabela comparativa):

![Texto alternativo](./resources/imagem/sistemacorrelatos.jpg)

* MVP CANVA com as Personas
![Texto alternativo](./resources/imagem/mvp%20do%20baita%20feira%20certo.jpg)

* Casos de uso :
  
![Texto alternativo](./resources/imagem/diagrama%20de%20caso%20de%20uso%20funcionalidades.jpg)

## Protótipos

Para a criação dos protótipos da aplicação, foi utilizado o Figma, ferramenta que permite desenvolver interfaces de alta fidelidade de forma interativa e visualmente clara.

Nos protótipos voltados para os clientes, foram destacadas funcionalidades que proporcionam maior praticidade e engajamento com os microempreendedores:

* Favoritar marcas: O cliente pode selecionar as marcas que mais gosta, permitindo que acompanhe eventos e promoções relacionadas a essas marcas.

* Visualização de eventos: É possível verificar quando e onde os eventos das marcas favoritas acontecem, facilitando o planejamento da participação.

* Filtragem por categoria: Os clientes podem buscar marcas por categoria, tornando a navegação mais rápida e direcionada.

* Uso de cupons de desconto: Durante os eventos, os clientes podem utilizar cupons das marcas que favoritaram, incentivando a interação e a fidelização com os microempreendedores.

* Aqui temos as imagens das telas dos consumidores das feiras:
![Texto alternativo](./resources/imagem/tela%20do%20clientefigma.jpg)

Entre as principais funcionalidades dos Microemprendedores:

* Criação e gerenciamento de eventos: Os microempreendedores podem criar novos eventos, bem como editar,salvar ou deletar,eventos já cadastrados, garantindo controle total sobre sua agenda e participação em feiras.

* Gestão de produtos: É possível editar informações e imagens dos produtos,permitindo manter o catálogo atualizado e atrativo para os clientes.

* Cupons de desconto: Os microempreendedores podem criar cupons de desconto para atrair clientes durante eventos, definir regras de uso e monitorar o aproveitamento dessas promoções.

* Edição de informações da marca: A interface permite atualizar dados do perfil da marca, incluindo descrição, logo e outras informações relevantes para os clientes.

* Aqui temos as imagens das telas dos microemprendedores:

![Texto alternativo](./resources/imagem/telamicroemprendedor.jpg)



* Plano de Negócios:
  
![Texto alternativo](./resources/imagem/planode%20negocio.jpg)

## Validação

A validação do sistema foi realizada de forma demonstrativa, com o objetivo de apresentar o funcionamento da plataforma para fins de avaliação no TCC. Primeiro, foram feitos testes funcionais internos para garantir que as principais funcionalidades estivessem operando corretamente, como cadastro de usuários, criação de eventos e navegação pelas telas.

Em seguida, o sistema foi apresentado pessoalmente, por meio de um computador, para expositores e consumidores convidados. Durante a apresentação, foram demonstradas as telas, os fluxos principais e as funcionalidades da plataforma, permitindo que os participantes compreendessem como o sistema funciona na prática.

Após a demonstração, foi aplicado um questionário de feedback,no qual os participantes puderam avaliar a clareza da interface, a utilidade das funcionalidades e sugerir melhorias.

Essa etapa permitiu coletar percepções importantes do público-alvo e validar a proposta apresentada no TCC, mesmo sem a realização de testes completos de uso devido ao tempo disponível.

## Estratégia

Para compreender as reais necessidades do público-alvo, foi realizada uma entrevista com dois grupos distintos: consumidores que frequentam feiras locais e microempreendedores que participam como expositores. O objetivo dessa etapa foi levantar informações sobre dificuldades, expectativas e funcionalidades desejadas em uma aplicação que centralize dados de eventos e marcas.

As entrevistas procuraram identificar os principais desafios enfrentados por cada grupo. Entre os microempreendedores, destacou-se a dificuldade em divulgar eventos e atrair novos clientes. Já os consumidores mencionaram a falta de um canal centralizado para acessar informações sobre feiras, horários e expositores. Esses dados foram essenciais para orientar a construção das funcionalidades do sistema.

Após essa etapa, foi realizada a apresentação do MVP diretamente pelo computador, durante o momento de exposição do TCC. A demonstração permitiu apresentar visualmente as funcionalidades desenvolvidas e coletar feedback por meio de um questionário aplicado aos participantes. Essa avaliação complementou as entrevistas iniciais e ajudou a validar se o protótipo atendia às necessidades identificadas.


## Consolidação dos Dados Coletados-Entrevistas
Após a apresentação e demonstração do Baita Feira App em funcionamento na versão on-line da plataforma, foram aplicadas pesquisas com os dois principais públicos envolvidos no sistema: frequentadores das feiras e expositores. Os resultados indicaram alta aceitação da proposta, demonstrando que a plataforma atende às necessidades de ambos os perfis. Entre os frequentadores, destacaram-se o interesse em utilizar o aplicativo para acompanhar informações completas sobre eventos, como data, horário e localização, além de conhecer bancas e produtos, favoritar expositores e receber notificações. Já entre os expositores, o aplicativo foi reconhecido como uma ferramenta eficiente para a divulgação de eventos e produtos, ampliando a visibilidade das bancas e facilitando a aproximação com o público consumidor.

A partir das respostas coletadas, foram identificadas sugestões de melhorias que refletem expectativas comuns aos dois públicos. Entre elas, destaca-se a implantação de um sistema de reserva de produtos, permitindo que os clientes garantam antecipadamente a aquisição dos itens para retirada no dia da feira. Também foi sugerido o desenvolvimento de um canal de comunicação direta (chat) entre expositores e consumidores, facilitando o atendimento e o esclarecimento de dúvidas em tempo real. Outras propostas incluem a ampliação dos meios de notificação, como e-mail e SMS, além do WhatsApp já utilizado, a implementação de um sistema de curtidas e avaliações públicas para bancas e produtos, o destaque visual para os produtos mais favoritado pelos usúarios,bem como a possibilidade de compartilhamento de imagens e experiências dos clientes com produtos adquiridos nas feiras. De modo geral, as pesquisas confirmam que o Baita Feira App cumpre seu objetivo de centralizar informações, conectar expositores e consumidores e contribuir para o fortalecimento do comércio local, além de fornecer diretrizes claras para a evolução contínua da plataforma de acordo com as demandas identificadas.

## Conclusões
Após a apresentação e demonstração do Baita Feira App em funcionamento na versão on-line da plataforma, foram aplicadas pesquisas com os dois principais públicos envolvidos no sistema: frequentadores das feiras e expositores. Os resultados indicaram alta aceitação da proposta, demonstrando que a plataforma atende às necessidades de ambos os perfis. Entre os frequentadores, destacaram-se o interesse em utilizar o aplicativo para acompanhar informações completas sobre eventos, como data, horário e localização, além de conhecer bancas e produtos, favoritar expositores e receber notificações. Já entre os expositores, o aplicativo foi reconhecido como uma ferramenta eficiente para a divulgação de eventos e produtos, ampliando a visibilidade das bancas e facilitando a aproximação com o público consumidor.

A partir das respostas coletadas, foram identificadas sugestões de melhorias que refletem expectativas comuns aos dois públicos. Entre elas, destaca-se a implantação de um sistema de reserva de produtos, permitindo que os clientes garantam antecipadamente a aquisição dos itens para retirada no dia da feira. Também foi sugerido o desenvolvimento de um canal de comunicação direta (chat) entre expositores e consumidores, facilitando o atendimento e o esclarecimento de dúvidas em tempo real. Outras propostas incluem a ampliação dos meios de notificação, como e-mail e SMS, além do WhatsApp já utilizado, a implementação de um sistema de curtidas e avaliações públicas para bancas e produtos, o destaque visual para os produtos mais favoritado pelos usúarios,bem como a possibilidade de compartilhamento de imagens e experiências dos clientes com produtos adquiridos nas feiras. De modo geral, as pesquisas confirmam que o Baita Feira App cumpre seu objetivo de centralizar informações, conectar expositores e consumidores e contribuir para o fortalecimento do comércio local, além de fornecer diretrizes claras para a evolução contínua da plataforma de acordo com as demandas identificadas.



## Referências Bibliográficas

* Livros:

STAUFFER, Matt.Desenvolvimento com Laravel: um framework para construção de aplicativos PHP modernos. São Paulo: Novatec, 2017.

ELMASRI, R.E.; NAVATHE, S. BS. sistemas de banco de dados. 7. ed. São Paul: Pearson, 2019.