// Animações dos ícones do cabeçalho
/* let formBuscar = document.querySelector('.form-buscar'); */
let carrinho = document.querySelector('.carrinho');
let formLogin = document.querySelector('.form-login');
let menuNav = document.querySelector('.menu-nav');

/* document.querySelector('#btn-buscar').onclick = () => {
     formBuscar.classList.toggle('active');
    carrinho.classList.remove('active');
    formLogin.classList.remove('active');
    menuNav.classList.remove('active');
}; */

document.querySelector('#btn-carrinho').onclick = () => {
    window.location.href = "carrinho.php";
};

document.querySelector('#btn-login').onclick = () => {
    formLogin.classList.toggle('active');
   /* formBuscar.classList.remove('active'); */
    carrinho.classList.remove('active');
    menuNav.classList.remove('active');
};

document.querySelector('#btn-menu').onclick = () => {
    menuNav.classList.toggle('active');
   /* formBuscar.classList.remove('active'); */
    carrinho.classList.remove('active');
    formLogin.classList.remove('active');
};

window.onscroll = () => {
   /* formBuscar.classList.remove('active'); */
    carrinho.classList.remove('active');
    formLogin.classList.remove('active');
    menuNav.classList.remove('active');
};

// Validação do Login
const formLoginElement = document.getElementById('form-login');

if (formLoginElement) {
    const emailLogin = formLoginElement.querySelector('#email');
    const senhaLogin = formLoginElement.querySelector('#senha');
    const erroLogin = formLoginElement.querySelector('#erro-login');

    formLoginElement.addEventListener('submit', (e) => {
        let mensagens = [];

        // Validação do email
        if (emailLogin.value.trim() === '') {
            mensagens.push('O campo de e-mail não pode estar vazio.');
        } else if (!emailLogin.value.includes('@') || !emailLogin.value.includes('.')) {
            mensagens.push('Insira um e-mail válido, certifque-se que tenha @ e .');
        }

        // Validação da senha
        if (senhaLogin.value.length <= 6) {
            mensagens.push('A senha deve ter mais de 6 caracteres.');
        }

        if (senhaLogin.value.length >= 20) {
            mensagens.push('A senha deve ter menos de 20 caracteres.');
        }

        if (mensagens.length > 0) {
            e.preventDefault();
            erroLogin.innerText = mensagens.join('\n');
            erroLogin.style.color = "red";
        } else {
            e.preventDefault();
            erroLogin.innerText = "✅ Login realizado com sucesso!";
            erroLogin.style.color = "green";
        }
    });
}

// Validação do Cadastro
const formCadastro = document.getElementById('form-cadastro');

if (formCadastro) {
    const nome = formCadastro.querySelector('#nome');
    const emailCadastro = formCadastro.querySelector('#email');
    const senhaCadastro = formCadastro.querySelector('#senha');
    const telefone = formCadastro.querySelector('#telefone');
    const erroCadastro = formCadastro.querySelector('#erro-cadastro');

    formCadastro.addEventListener('submit', (e) => {
        let mensagens = [];

        // Nome
        if (nome.value.trim().length < 3) {
            mensagens.push("O nome deve ter pelo menos 3 caracteres.");
        }

        // Email
        if (!emailCadastro.value.includes('@') || !emailCadastro.value.includes('.')) {
            mensagens.push("Insira um e-mail válido.");
        }

        // Senha
        if (senhaCadastro.value.length <= 6) {
            mensagens.push("A senha deve ter mais de 6 caracteres.");
        }

        // Telefone (apenas números)
        const numerosTel = telefone.value.replace(/\D/g, ''); 
        if (numerosTel.length < 10) {
            mensagens.push("Insira um telefone válido com DDD.");
        }

        if (mensagens.length > 0) {
            e.preventDefault();
            erroCadastro.innerText = mensagens.join("\n");
            erroCadastro.style.color = "red";
        } else {
            erroCadastro.innerText = "✅ Cadastro realizado com sucesso!";
            erroCadastro.style.color = "green";
        }
    });
}
