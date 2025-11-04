<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-file-person-fill"></i> Gerador de Currículo
            </a>
        </div>
    </nav>

    <div class="container mt-5 mb-5">

        <h1 class="display-4 text-center">Preencha seus Dados</h1>
        <p class="lead text-center">Insira suas informações para gerar o currículo.</p>

        <form action="visualizar.php" method="POST" target="_blank">

            <div class="card shadow p-4 mb-4">
                <h2 class="h4 mb-3"><i class="bi bi-person-lines-fill"></i> Dados Pessoais</h2>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="idade" class="form-label">Idade (automático)</label>
                        <input type="number" class="form-control" id="idade" name="idade" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="seu.email@exemplo.com" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefone" class="form-label">Telefone / Celular</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone"
                            placeholder="(XX) 9XXXX-XXXX">
                    </div>
                </div>
            </div>
            <div class="card shadow p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 m-0"><i class="bi bi-mortarboard-fill"></i> Formação Acadêmica</h2>
                    <button type="button" class="btn btn-outline-success rounded-circle" id="btn-add-formacao">
                        <i class="bi bi-plus-lg"></i> </button>
                </div>

                <div id="area-formacao">
                </div>
            </div>
            <div class="card shadow p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 m-0"><i class="bi bi-briefcase-fill"></i> Experiência Profissional</h2>
                    <button type="button" class="btn btn-outline-success rounded-circle" id="btn-add-experiencia">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
                <div id="area-experiencia">
                </div>
            </div>
            <div class="card shadow p-4 mb-4">
                <h2 class="h4 mb-3"><i class="bi bi-tools"></i> Habilidades</h2>
                <div class="mb-3">
                    <label for="habilidades" class="form-label">Liste suas habilidades (separadas por vírgula)</label>
                    <input type="text" class="form-control" id="habilidades" name="habilidades"
                        placeholder="Ex: PHP, JavaScript, Trabalho em Equipe, ...">
                </div>
            </div>
            <div class="card shadow p-4 mb-4">
                <h2 class="h4 mb-3"><i class="bi bi-person-badge"></i> Resumo Profissional</h2>
                <div class="mb-3">
                    <label for="resumo" class="form-label">Fale um pouco sobre você</label>
                    <textarea class="form-control" id="resumo" name="resumo" rows="5"></textarea>
                </div>
            </div>
            <div class="card shadow p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 m-0"><i class="bi bi-people-fill"></i> Referências Pessoais</h2>
                    <button type="button" class="btn btn-outline-success rounded-circle" id="btn-add-referencia">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
                <div id="area-referencias">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-lg"></i>
                    Gerar Currículo
                </button>
            </div>

        </form>

    </div>
    <footer class=" bg-dark text-white text-center py-3">
        <small>APO-Gerador de Currículo -Engenharia de software</small>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>