<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;


ob_start(); 


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
    <title>Currículo de <?= $nome; ?></title>

    <style>
    body {
        font-family: 'Helvetica', 'Arial', sans-serif;
        font-size: 11pt;
        line-height: 1.4;
        color: #333;
        background-color: #ffffff;
    }

    .cv-container {
        width: 100%;
        margin: 0 auto;
        padding: 30px;
    }

    .cv-header {
        text-align: center;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .cv-header h1 {
        font-size: 24pt;
        color: #333;
        margin: 0;
        font-weight: bold;
    }

    .cv-header p {
        font-size: 11pt;
        color: #555;
        margin: 3px 0;
    }

    .section-title {
        font-size: 16pt;
        color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 5px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .cv-badge {
        display: inline-block;
        font-size: 11pt;
        /* Aumentado */
        color: #333;
        margin: 3px 10px 3px 0;
        /* Ajuste para espaçamento */
        white-space: nowrap;
        background-color: transparent !important;
        /* Limpeza Total */
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        font-weight: bold;
        /* Destaque */
        padding: 0 !important;
    }

    .list-inline-item {
        display: inline-block;
        margin-right: 15px;
        background-color: transparent !important;
    }

    /* Limpeza Total */
    h5 {
        font-size: 12pt;
        font-weight: bold;
        color: #000;
        margin-bottom: 0;
    }

    h6 {
        font-size: 11pt;
        color: #333;
        font-weight: normal;
        margin-top: 2px;
        margin-bottom: 2px;
    }

    .text-muted,
    .small {
        color: #777;
        font-size: 10pt;
    }

    .cv-text {
        text-align: justify;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .mb-1 {
        margin-bottom: 3px !important;
    }

    .mb-2 {
        margin-bottom: 5px !important;
    }

    .mb-3 {
        margin-bottom: 10px !important;
    }
    </style>
</head>

<body>
    <div class="container cv-container">
        <!-- CABEÇALHO -->
        <header class="text-center pb-4 mb-4 cv-header">
            <h1 class="display-4 fw-bold"><?= $nome; ?></h1>
            <p class="lead fs-5 mb-1">
                <?php if (!empty($data_nasc_formatada)): ?>
                Data de Nascimento: <?= $data_nasc_formatada; ?> (<?= $idade_final_valida; ?> anos)
                <?php endif; ?>
            </p>
            <p class="lead fs-5">
                <?php if (!empty($email)): ?>
                Email: <?= $email; ?>
                <?php endif; ?>
                <?php if (!empty($telefone)): ?>
                <span style="margin: 0 10px;">|</span>
                Telefone: <?= $telefone; ?>
                <?php endif; ?>
            </p>
        </header>
        <main class="cv-main-content">
            <?php if (!empty($resumo)): ?>
            <section class="mb-4">
                <h2 class="section-title">Resumo Profissional</h2>
                <p class="cv-text"><?= $resumo; ?></p>
            </section>
            <?php endif; ?>

            <?php if (!empty($experiencias_final)): ?>
            <section class="mb-4">
                <h2 class="section-title">Experiência Profissional</h2>
                <?php foreach ($experiencias_final as $exp): ?>
                <div class="mb-4 experience-block">
                    <h5 class="mb-0 fw-bold">Cargo: <?= $exp['cargo']; ?></h5>
                    <h6 class="mb-1">
                        Empresa: <?= $exp['empresa']; ?>
                        <?php if(!empty($exp['local'])): ?>
                        | Local: <?= $exp['local']; ?>
                        <?php endif; ?>
                    </h6>
                    <p class="text-muted small mb-2">
                        Período: <?= $exp['inicio']; ?> - <?= $exp['fim']; ?>
                    </p>
                    <p class="cv-text"><?= $exp['descricao']; ?></p>
                </div>
                <?php endforeach; ?>
            </section>
            <?php endif; ?>

            <?php if (!empty($formacoes_final)): ?>
            <section class="mb-4">
                <h2 class="section-title">Formação Acadêmica</h2>
                <?php foreach ($formacoes_final as $form): ?>
                <div class="mb-3">
                    <h5 class="mb-0 fw-bold">Curso: <?= $form['curso']; ?></h5>
                    <p class="mb-0">Instituição: <?= $form['instituicao']; ?></p>
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
            <section class="mb-4">
                <h2 class="section-title">Habilidades</h2>
                <ul class="list-inline" style="list-style: none; padding: 0; margin: 0;">
                    <?php foreach ($habilidades_array as $habilidade): ?>
                    <li class="list-inline-item">
                        <span class="cv-badge">
                            <?= $habilidade; ?>
                        </span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <?php endif; ?>

            <?php if (!empty($referencias_final)): ?>
            <section class="mb-4">
                <h2 class="section-title">Referências</h2>
                <div style="clear: both;">
                    <?php foreach ($referencias_final as $ref): ?>
                    <div style="float: left; width: 48%; margin-right: 2%;">
                        <h5 class="mb-0 fw-bold">Nome: <?= $ref['nome']; ?></h5>
                        <p class="mb-0">Relação: <?= $ref['relacao']; ?></p>
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
</body>

</html>
<?php

$html_do_curriculo = ob_get_clean(); 
$options = new Options();
$options->set('isRemoteEnabled', true); 
$options->set('defaultFont', 'Helvetica');

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html_do_curriculo);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

ob_end_clean(); 

$dompdf->stream(
    "Curriculo-{$nome}.pdf", 
    ["Attachment" => true]
);

exit;
?>