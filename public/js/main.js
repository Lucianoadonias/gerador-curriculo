document.addEventListener("DOMContentLoaded", function () {
    // ============================
    // 1️⃣ CÁLCULO AUTOMÁTICO DA IDADE
    // ============================
    const dataNascimentoInput = document.getElementById("data_nascimento");
    const idadeInput = document.getElementById("idade");

    dataNascimentoInput.addEventListener("change", function () {
        const dataNascimento = new Date(this.value);
        const hoje = new Date();

        let idade = hoje.getFullYear() - dataNascimento.getFullYear();
        const mes = hoje.getMonth() - dataNascimento.getMonth();

        if (
            mes < 0 ||
            (mes === 0 && hoje.getDate() < dataNascimento.getDate())
        ) {
            idade--;
        }

        idadeInput.value = idade;
    });
});
