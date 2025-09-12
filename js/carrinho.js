// Mensagem ao apertar o adicionar ao carrinho

const botaoCarrinho = document.querySelectorAll('.produtos .btn');

botaoCarrinho.forEach(botao => {

  botao.addEventListener('click', (e) => {
    e.preventDefault();
    alert('✅ Produto adicionado ao carrinho!');
  })

})