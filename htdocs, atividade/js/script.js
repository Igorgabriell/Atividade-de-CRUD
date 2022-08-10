/**
 * scripts.js
 * JavaScript global do aplicativo.
 * 
 * Observe que cada página também pode ter seu prório JavaScript, para
 * isso, crie, na pasta '/js' um arquivo com o mesmo nome da página, porém, 
 * com a extensão 'js'. Por exemplo:
 *
 *      Link da página → '/?p=contatos' ou '/index.php?p=contatos'
 *      Caminho real da página → '/page/contatos.php'
 *      Folha de estilos da página → '/js/contatos.js'
 *
 * Note que, caso o arquivo '/js/contatos.js' exista, ele será 'linkado'
 * automaticamente pelo script, desde que tenha o mesmo nome da página.
 * Se ele não existir, ao carregar '/?p=contatos', NÃO teremos erro.
 *
 **/

// Exibe / oculta valor do campo 'password' (senha) dos formulários:
if (typeof toglePass !== 'undefined') {
    toglePass.onclick = () => {
        if (password.getAttribute('type') == 'password') {
            password.setAttribute('type', 'text');
            toglePass.innerHTML = '<i class="fa-solid fa-eye-slash fa-fw"></i>';
        } else {
            password.setAttribute('type', 'password');
            toglePass.innerHTML = '<i class="fa-solid fa-eye fa-fw"></i>';
        }
    }
}