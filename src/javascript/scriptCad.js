//Criador Miguel Silva
/*script que controla algumas funções da página de cadastro
adiciona * vermelhos automaticamente em campos required -> adicona mascaras nos campos cpf, telefone e estado*/

document.addEventListener("DOMContentLoaded", function () {
    const campos = document.querySelectorAll("input[required]");

    campos.forEach(campo => {
        const label = document.querySelector(`label[for="${campo.id}"]`);
        
        if (label) {
            label.innerHTML += ' <span class="required">*</span>';
        }
    });
});


$(document).ready(function(){
    $('#cpf').mask('000.000.000-00');
    $('#telefone').mask('(00)00000-0000');
    $('#estado').mask('SS');
});