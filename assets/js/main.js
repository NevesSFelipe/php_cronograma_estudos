const url_base = "http://localhost/github/cronograma_estudos/";

init();

function init() {
    mapearChangeSelectFormacoes();
    mapearBtnBuscarCursoPorNome();
}

function mapearChangeSelectFormacoes() {

    document.getElementById("select_formacoes").addEventListener("change", function() {
        consultarCursos();
    });

}

async function consultarCursos() {

    let viewDesejada = document.getElementById('select_formacoes').value;

    fetch(url_base + `index/consultarCursos/${viewDesejada}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Erro na requisição: " + response.statusText);
            }
            return response.json();
        })
        .then((cursos) => {
            montarTabela(cursos.data);
        })
        .catch((error) => {
            console.error("Erro:", error);
        });
}

function montarTabela(dadosTabela) {

    const table = document.createElement('table');
    table.classList.add('table', 'table-light', 'table-bordered', 'text-center', 'table-hover');

    const thead = document.createElement('thead');
    thead.classList.add('table-dark');

    const trHead = document.createElement('tr');
    
    const thHead1 = document.createElement('th');
    thHead1.setAttribute("scope", "col");
    thHead1.textContent = "Titulo do Curso";

    const thHead2 = document.createElement('th');
    thHead2.setAttribute("scope", "col");

    const tbody = document.createElement('tbody');

    const divTable = document.getElementById('tabelaCursos');
    divTable.innerHTML = ''; // Limpar quaisquer linhas existentes

    let totalCursosConcluidos = 0;
    const totalCursos = dadosTabela.length;
    
    if(totalCursos == 0) {
        divTable.innerHTML = "<h4 class='text-info text-center'>Nenhum registrro encontrado.</h4>";
        return;
    }

    dadosTabela.forEach(curso => {

        if(curso.status == 1) { totalCursosConcluidos++; }

        const trCursos = document.createElement('tr');

        const tdTituloCurso = document.createElement('td');
            tdTituloCurso.textContent = curso.titulo_curso;
        trCursos.appendChild(tdTituloCurso);

        const tdTituloFormacao = document.createElement('td');
            const input = document.createElement('input');
                input.type  = 'checkbox';
                input.name  = 'checkbox_' + curso.id;
                input.value = curso.status;
                input.checked = curso.status;
                input.addEventListener('click', () => {editarStatusCurso(curso.id_curso, curso.status)});
            tdTituloFormacao.appendChild(input);
        trCursos.appendChild(tdTituloFormacao);

        tbody.appendChild(trCursos);

    });

    thHead2.textContent = `${totalCursosConcluidos} / ${totalCursos}`;
    
    trHead.appendChild(thHead1);
    trHead.appendChild(thHead2);
    thead.appendChild(trHead);
    table.appendChild(thead);
    table.appendChild(tbody);
    
     divTable.append(table);   

}

async function editarStatusCurso(idCurso, statusAtual) {

    const dados = {
        idCurso: idCurso,
        novoStatusCurso: statusAtual
    };

    try {
        const url = url_base + `index/editarStatusCurso`;
        const resposta = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dados) 
        });

        if (!resposta.ok) {
            throw new Error(`Erro na requisição: ${resposta.statusText}`);
        }

        const resultado = await resposta.json();
        alert(resultado['data']);
        consultarCursos();

    } catch (erro) {
        console.error('Erro:', erro);
        return null;
    }
        
}

function mapearBtnBuscarCursoPorNome() {

    document.getElementById("btnBuscarCursoPorNome").addEventListener("click", function() {
        buscarCursoPorNome();
    });

    document.getElementById("inputNomeCursoProcurado").addEventListener("keypress", function(event) {
        if (event.key === "Enter" || event.keyCode === 13) {
            buscarCursoPorNome();   // Chama a função
        }
    });

}

async function buscarCursoPorNome() {
    
    let nomeCursoProcurado = document.getElementById('inputNomeCursoProcurado').value;

    fetch(url_base + `index/buscarCursoPorNome/${nomeCursoProcurado}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Erro na requisição: " + response.statusText);
            }
            return response.json();
        })
        .then((cursos) => {
            montarTabela(cursos.data);
        })
        .catch((error) => {
            console.error("Erro:", error);
        });

}