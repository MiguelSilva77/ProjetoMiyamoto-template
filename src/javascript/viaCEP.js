// Criador Miguel Silva
/*script que controla todas as funções da api via cep na seguinte ordem
verifica se a label já foi digitada -> verifica se o cep é valido -> preenche os campos caso o cep seja válido*/

let cepLabel = document.getElementById('cep');


cepLabel.addEventListener('input',function(){
        let cep = document.getElementById('cep').value;
        if(cep.length == 8){
                cepValido(cep);
        }
})

function cepValido(cep){
        cep = cep.replace(/\D/g, '');
        if(cep.length !== 8){
                alert("CEP invalido, a quantidade de caracteres deve ser 8");
                limpaForm();
                return;
        }
        
       fetch("https://viacep.com.br/ws/"+cep+"/json/")
       .then(response => response.json())
       .then(data => {
        if(data.erro){
                alert("CEP não encontrado");
                limpaForm();
                return;
        }else{
                buscaEndereco(cep);
        }

})


function buscaEndereco(cep){
     fetch("https://viacep.com.br/ws/"+cep+"/json/")
        .then(response => response.json())
        .then(data => {
                document.getElementById('cep').value = data.cep;
                document.getElementById('rua').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
        })
}
}
       
function limpaForm(){
        document.getElementById('cep').value = '';
        document.getElementById('rua').value = '';
        document.getElementById('bairro').value = '';
        document.getElementById('cidade').value =  '';
        document.getElementById('estado').value = '';
}

