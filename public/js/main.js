document.addEventListener("DOMContentLoaded", function () {
    const inputDataNascimento = document.getElementById("dataNascimento");
    const inputIdade = document.getElementById("idade");

    if (inputDataNascimento) {
        inputDataNascimento.addEventListener("change", calcularIdade);
    }

    function calcularIdade() {
        const dataNascString = inputDataNascimento.value;

        if (!dataNascString) {
            inputIdade.value = "";
            return;
        }

        const dataNasc = new Date(dataNascString);
        const dataHoje = new Date();
        let idade = dataHoje.getFullYear() - dataNasc.getFullYear();
        const mesDiff = dataHoje.getMonth() - dataNasc.getMonth();

        if (
            mesDiff < 0 ||
            (mesDiff === 0 && dataHoje.getDate() < dataNasc.getDate())
        ) {
            idade--;
        }

        inputIdade.value = idade;
    }

    const btnAddFormacao = document.getElementById("btn-add-formacao");
    const areaFormacao = document.getElementById("area-formacao");
    let contadorFormacao = 0;

    btnAddFormacao.addEventListener("click", function () {
        contadorFormacao++;

        const novoBlocoFormacao = `
            <div class="formacao-bloco card shadow-sm p-3 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="curso-${contadorFormacao}" class="form-label">Curso/Nível</label>
                        <input type="text" class="form-control" id="curso-${contadorFormacao}" name="formacao[${contadorFormacao}][curso]" placeholder="Ex: Bacharelado em Ciência da Computação">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="instituicao-${contadorFormacao}" class="form-label">Instituição</label>
                        <input type="text" class="form-control" id="instituicao-${contadorFormacao}" name="formacao[${contadorFormacao}][instituicao]" placeholder="Ex: Universidade Federal...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inicio-formacao-${contadorFormacao}" class="form-label">Ano de Início</label>
                        <input type="number" class="form-control" id="inicio-formacao-${contadorFormacao}" name="formacao[${contadorFormacao}][inicio]" min="1950" max="2050">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fim-formacao-${contadorFormacao}" class="form-label">Ano de Conclusão</label>
                        <input type="number" class="form-control" id="fim-formacao-${contadorFormacao}" name="formacao[${contadorFormacao}][fim]" min="1950" max="2050" placeholder="Deixe em branco se cursando">

                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger ">Remover Formação Acadêmica</button>
                </div>
            </div>
        `;
        areaFormacao.insertAdjacentHTML("beforeend", novoBlocoFormacao);
    });

    areaFormacao.addEventListener("click", function (event) {
        const btnRemover = event.target.closest(".btn");
        if (btnRemover) {
            const blocoParaRemover = btnRemover.closest(".formacao-bloco");
            if (blocoParaRemover) {
                blocoParaRemover.remove();
            }
        }
    });

    const btnAddExperiencia = document.getElementById("btn-add-experiencia");
    const areaExperiencia = document.getElementById("area-experiencia");
    let contadorExperiencia = 0;

    btnAddExperiencia.addEventListener("click", function () {
        contadorExperiencia++;

        const novoBlocoExperiencia = `
            <div class="experiencia-bloco card shadow-sm p-3 mb-3">
                <div class="mb-3">
                    <label for="cargo-${contadorExperiencia}" class="form-label">Cargo/Título</label>
                    <input type="text" class="form-control" id="cargo-${contadorExperiencia}" name="experiencia[${contadorExperiencia}][cargo]" placeholder="Ex: Desenvolvedor Front-end Sênior">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="empresa-${contadorExperiencia}" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="empresa-${contadorExperiencia}" name="experiencia[${contadorExperiencia}][empresa]" placeholder="Ex: Tech Solutions S.A.">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cidade-exp-${contadorExperiencia}" class="form-label">Localização (Cidade/Estado)</label>
                        <input type="text" class="form-control" id="cidade-exp-${contadorExperiencia}" name="experiencia[${contadorExperiencia}][local]" placeholder="Ex: São Paulo - SP">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inicio-exp-${contadorExperiencia}" class="form-label">Data de Início</label>
                        <input type="date" class="form-control" id="inicio-exp-${contadorExperiencia}" name="experiencia[${contadorExperiencia}][inicio]">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fim-exp-${contadorExperiencia}" class="form-label">Data de Fim</label>
                        <input type="date" class="form-control" id="fim-exp-${contadorExperiencia}" name="experiencia[${contadorExperiencia}][fim]" placeholder="Deixe em branco se atual">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="desc-exp-${contadorExperiencia}" class="form-label">Descrição das Responsabilidades/Conquistas</label>
                    <textarea class="form-control" id="desc-exp-${contadorExperiencia}" name="experiencia[${contadorExperiencia}][descricao]" rows="3" placeholder="Ex: Responsável pela migração de sistemas legados para uma nova arquitetura."></textarea>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger ">Remover Experiências</button>
            </div>
        `;
        areaExperiencia.insertAdjacentHTML("beforeend", novoBlocoExperiencia);
    });

    areaExperiencia.addEventListener("click", function (event) {
        const btnRemover = event.target.closest(".btn");
        if (btnRemover) {
            const blocoParaRemover = btnRemover.closest(".experiencia-bloco");
            if (blocoParaRemover) {
                blocoParaRemover.remove();
            }
        }
    });

    const btnAddReferencia = document.getElementById("btn-add-referencia");
    const areaReferencias = document.getElementById("area-referencias");
    let contadorReferencia = 0;

    btnAddReferencia.addEventListener("click", function () {
        contadorReferencia++;

        const novoBlocoReferencia = `
            <div class="referencia-bloco card shadow-sm p-3 mb-3">
                <div class="mb-3">
                    <label for="ref-nome-${contadorReferencia}" class="form-label">Nome Completo da Referência</label>
                    <input type="text" class="form-control" id="ref-nome-${contadorReferencia}" name="referencia[${contadorReferencia}][nome]" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ref-relacao-${contadorReferencia}" class="form-label">Relação/Cargo</label>
                        <input type="text" class="form-control" id="ref-relacao-${contadorReferencia}" name="referencia[${contadorReferencia}][relacao]" placeholder="Ex: Supervisor, Professor, Colega de Trabalho" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ref-telefone-${contadorReferencia}" class="form-label">Telefone / Celular</label>
                        <input type="tel" class="form-control" id="ref-telefone-${contadorReferencia}" name="referencia[${contadorReferencia}][telefone]" placeholder="(XX) XXXXX-XXXX">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ref-email-${contadorReferencia}" class="form-label">E-mail da Referência</label>
                    <input type="email" class="form-control" id="ref-email-${contadorReferencia}" name="referencia[${contadorReferencia}][email]" placeholder="email@exemplo.com">    
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger ">Remover Referências</button>
            </div>
        `;
        areaReferencias.insertAdjacentHTML("beforeend", novoBlocoReferencia);
    });

    areaReferencias.addEventListener("click", function (event) {
        const btnRemover = event.target.closest(".btn");
        if (btnRemover) {
            const blocoParaRemover = btnRemover.closest(".referencia-bloco");
            if (blocoParaRemover) {
                blocoParaRemover.remove();
            }
        }
    });
});
