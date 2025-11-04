<?php


$experiencias_final = [];
$formacoes_final = [];
$referencias_final = [];
$habilidades_array = [];

$nome = htmlspecialchars($_POST['nome'] ?? 'Nome do Candidato');
$email = htmlspecialchars($_POST['email'] ?? '');
$telefone = htmlspecialchars($_POST['telefone'] ?? '');
$resumo = htmlspecialchars($_POST['resumo'] ?? '');

$data_nasc = $_POST['data_nascimento'] ?? '';
$idade_final_valida = '';
$data_nasc_formatada = '';

if (!empty($data_nasc)) {
    try {
        $dataNascObj = new DateTime($data_nasc);
        $hoje = new DateTime();
        $idadeIntervalo = $hoje->diff($dataNascObj);
        $idade_final_valida = $idadeIntervalo->y;
        $data_nasc_formatada = $dataNascObj->format('d/m/Y');
    } catch (\Exception $e) {
        $idade_final_valida = 'Erro';
        $data_nasc_formatada = 'Data Inválida';
    }
}

foreach (['experiencia', 'formacao', 'referencias'] as $tipo) {
    if (isset($_POST[$tipo]) && is_array($_POST[$tipo])) {
        foreach ($_POST[$tipo] as $bloco) {
            $dadosLimpos = [];
            foreach ($bloco as $key => $value) {
                // Limpeza e tratamento de dados
                $dadosLimpos[$key] = htmlspecialchars($value);
            }
            if ($tipo === 'experiencia') {
                $experiencias_final[] = $dadosLimpos;
            } elseif ($tipo === 'formacao') {
                $formacoes_final[] = $dadosLimpos;
            } elseif ($tipo === 'referencias') {
                $referencias_final[] = $dadosLimpos;
            }
        }
    }
}

$habilidades_input = $_POST['habilidades'] ?? '';
if (!empty($habilidades_input)) {
    $habilidades_array = array_filter(array_map('trim', explode(',', $habilidades_input)));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pré-Visualização do Currículo</title>

    <!-- Link para o Bootstrap (Estilo base) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #f0f2f5;
        /* Fundo cinza suave */
    }

    .cv-container-web {
        background-color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        min-height: 100vh;
        /* Altura mínima para simular uma página */
        padding: 30px 40px;
        margin: 20px auto;
        border-radius: 8px;
    }

    .text-primary,
    .cv-header h1 {
        color: #1a73e8 !important;
        /* Azul da Identidade */
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .text-secondary {
        color: #5f6368 !important;
    }

    .section-title {
        color: #3c4043;
        border-bottom: 1px solid #c8c8c8;
        padding-bottom: 5px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .list-inline-item {
        display: inline-block;
        margin-right: 15px;
        padding: 5px 0;
    }
    </style>
</head>

<body>

    <div class="container cv-container-web">

        <div class="container">

            <header class="text-center pb-4 mb-4 cv-header">
                <h1 class="display-4 fw-bold text-primary"><?= $nome; ?></h1>
                <p class="lead fs-5 mb-1 text-secondary">
                    <?php if (!empty($data_nasc_formatada)): ?>
                    Data de Nascimento: <?= $data_nasc_formatada; ?> (<?= $idade_final_valida; ?> anos)
                    <?php endif; ?>
                </p>
                <p class="lead fs-5 text-secondary">
                    <?php if (!empty($email)): ?>
                    Email: <?= $email; ?>
                    <?php endif; ?>
                    <?php if (!empty($telefone)): ?>
                    <?php if (!empty($email)): ?> <span class="mx-2">|</span> <?php endif; ?>
                    Telefone: <?= $telefone; ?>
                    <?php endif; ?>
                </p>
            </header>

            <main class="cv-main-content">


                <?php if (!empty($resumo)): ?>
                <section class="mb-5">
                    <h2 class="h4 section-title">Resumo Profissional</h2>
                    <p class="text-secondary"><?= $resumo; ?></p>
                </section>
                <?php endif; ?>

                <?php if (!empty($experiencias_final)): ?>
                <section class="mb-5">
                    <h2 class="h4 section-title">Experiência Profissional</h2>
                    <?php foreach ($experiencias_final as $exp): ?>
                    <div class="mb-4">
                        <h5 class="mb-0 fw-bold"><?= $exp['cargo']; ?></h5>

                        <h6 class="text-primary fw-normal mb-1">
                            <?= $exp['empresa']; ?>
                            <?php if(!empty($exp['local'])): ?>
                            | <?= $exp['local']; ?>
                            <?php endif; ?>
                        </h6>
                        <p class="text-muted small mb-2">
                            Período: <?= $exp['inicio']; ?> - <?= $exp['fim']; ?>
                        </p>
                        <p class="text-secondary"><?= $exp['descricao']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </section>
                <?php endif; ?>


                <?php if (!empty($formacoes_final)): ?>
                <section class="mb-5">
                    <h2 class="h4 section-title">Formação Acadêmica</h2>
                    <?php foreach ($formacoes_final as $form): ?>
                    <div class="mb-3">
                        <h5 class="mb-0 fw-bold"><?= $form['curso']; ?></h5>
                        <p class="mb-0 text-primary"><?= $form['instituicao']; ?></p>
                        <p class="text-muted small">
                            Duração: <?= $form['inicio']; ?> -
                            <?php if (!empty($form['fim'])): ?>
                            <?= $form['fim']; ?>
                            <?php else: ?>
                            Cursando
                            <?php endif; ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </section>
                <?php endif; ?>


                <?php if (!empty($habilidades_array)): ?>
                <section class="mb-5">
                    <h2 class="h4 section-title">Habilidades</h2>
                    <ul class="list-inline">
                        <?php foreach ($habilidades_array as $habilidade): ?>
                        <li class="list-inline-item badge bg-light text-dark border p-2">
                            <?= $habilidade; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                <?php endif; ?>


                <?php if (!empty($referencias_final)): ?>
                <section class="mb-5">
                    <h2 class="h4 section-title">Referências</h2>
                    <div class="row">
                        <?php foreach ($referencias_final as $ref): ?>
                        <div class="col-md-6 mb-3">
                            <h5 class="mb-0 fw-bold"><?= $ref['nome']; ?></h5>
                            <p class="mb-0 text-primary">Relação: <?= $ref['relacao']; ?></p>
                            <?php if (!empty($ref['telefone'])): ?>
                            <p class="mb-0 text-muted small">Telefone: <?= $ref['telefone']; ?></p>
                            <?php endif; ?>
                            <?php if (!empty($ref['email'])): ?>
                            <p class="mb-0 text-muted small">Email: <?= $ref['email']; ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

            </main>
        </div>


        <div class="text-center mt-5 p-4 border-top">
            <form method="POST" action="gerar_pdf.php">
                <?php 
           
            foreach ($_POST as $key => $value):
                if (is_array($value)):
                    // Lida com arrays (Experiências, Formações, etc.)
                    foreach ($value as $block_index => $block):
                        foreach ($block as $field_name => $field_value):
                            // Cria um input oculto para cada campo dinâmico
                            echo "<input type='hidden' name='{$key}[{$block_index}][{$field_name}]' value='" . htmlspecialchars($field_value, ENT_QUOTES) . "'>";
                        endforeach;
                    endforeach;
                else:
                    // Lida com campos simples
                    echo "<input type='hidden' name='{$key}' value='" . htmlspecialchars($value, ENT_QUOTES) . "'>";
                endif;
            endforeach;
            ?>

                <p class="text-muted small mb-3">
                    Pré-visualização do currículo concluída. Se os dados estiverem corretos, clique abaixo para
                    finalizar e gerar o arquivo PDF.
                </p>
                <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                    Gerar PDF Profissional
                </button>
            </form>
        </div>

    </div>
    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>