        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('cep').value = ("");
            document.getElementById('logradouro').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('logradouro').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('logradouro').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };

        function validaCpf(cpf) {

            cpf = cpf.replace(/[^\d]+/g, '');

            function TestaCPF(strCPF) {
                var Soma;
                var Resto;
                Soma = 0;
                if (strCPF == "00000000000") return false;
                if (strCPF == "11111111111") return false;
                if (strCPF == "22222222222") return false;
                if (strCPF == "33333333333") return false;
                if (strCPF == "44444444444") return false;
                if (strCPF == "55555555555") return false;
                if (strCPF == "66666666666") return false;
                if (strCPF == "77777777777") return false;
                if (strCPF == "88888888888") return false;
                if (strCPF == "99999999999") return false;

                for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11)) Resto = 0;
                if (Resto != parseInt(strCPF.substring(9, 10))) return false;

                Soma = 0;
                for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11)) Resto = 0;
                if (Resto != parseInt(strCPF.substring(10, 11))) return false;
                return true;
            }

            resultado = TestaCPF(cpf);

            if (cpf != "") {
                if (!resultado) {
                    alert("CPF inválido.")
                    document.getElementById('cpf').value = ("");
                }
            }
        }

        function validaCnpj(cnpj) {

            function TestaCNPJ(cnpj) {

                cnpj = cnpj.replace(/[^\d]+/g, '');

                if (cnpj == '') return false;

                if (cnpj.length != 14)
                    return false;

                // Elimina CNPJs invalidos conhecidos
                if (cnpj == "00000000000000" ||
                    cnpj == "11111111111111" ||
                    cnpj == "22222222222222" ||
                    cnpj == "33333333333333" ||
                    cnpj == "44444444444444" ||
                    cnpj == "55555555555555" ||
                    cnpj == "66666666666666" ||
                    cnpj == "77777777777777" ||
                    cnpj == "88888888888888" ||
                    cnpj == "99999999999999")
                    return false;

                // Valida DVs
                tamanho = cnpj.length - 2
                numeros = cnpj.substring(0, tamanho);
                digitos = cnpj.substring(tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--) {
                    soma += numeros.charAt(tamanho - i) * pos--;
                    if (pos < 2)
                        pos = 9;
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(0))
                    return false;

                tamanho = tamanho + 1;
                numeros = cnpj.substring(0, tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--) {
                    soma += numeros.charAt(tamanho - i) * pos--;
                    if (pos < 2)
                        pos = 9;
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(1))
                    return false;

                return true;

            }

            resultado = TestaCNPJ(cnpj);

            if (cnpj != "") {
                if (!resultado) {
                    alert("CNPJ inválido.")
                    document.getElementById('cnpj').value = ("");
                }
            }
        }

        function del(entidade, id) { 
            if (confirm('Deseja mesmo excluir este ' + entidade + '? Lembre-se que todos vínculos serão excluídos juntos.')) {   
                document.getElementById(id).submit();
            }
        }

        function delAgendamento(id) {
            if (confirm('Deseja mesmo excluir este agendamento? Lembre-se que todos vínculos serão excluídos juntos.')) {   
                window.location.href = "http://admin.beautyhair.website/agendamento/excluir/" + id;
            }
        }

        function delCampanha(id) {
            if (confirm('Deseja mesmo excluir esta campanha? Lembre-se que todos vínculos serão excluídos juntos.')) {   
                window.location.href = "http://admin.beautyhair.website/campanha/excluir/" + id;
            }
        }

        function delFolga(id, data) {
            if (confirm('Deseja mesmo excluir esta folga? Lembre-se que todos vínculos serão excluídos juntos.')) {   
                window.location.href = "http://admin.beautyhair.website/colaborador/excluirFolga/" + id + "/" + data;
            }
        }

        $(document).ready(function(){
        $("#cpf").mask("000.000.000-00")
        $("#cnpj").mask("00.000.000/0000-00")
        $("#cep").mask("00.000-000")
        $("#telefone").mask("(00) 0 0000-0000")
        $("#telefoneCelular").mask("(00) 0 0000-0000")
        $("#telefoneFixo").mask("(00) 0000-0000")
    })