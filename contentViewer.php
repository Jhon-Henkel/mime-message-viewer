<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Mime Message Viewer</title>
        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body class="body-content-viewer">
        <div class="container">
            <?php
                require_once __DIR__.'/vendor/autoload.php';
                if (isset($_POST['acao']) && $_POST['acao'] == 'parsing'):
                    $inputContent = json_decode($_POST['content'])->MIMEMessage ?? 'Sem conteúdo HTML no mime message!';
            ?>
                <div class="container mt-5 bg-body-tertiary mail-content">
                    <div class="col-12">
                        <div class="text-center">
                            <br>
                            <div class="mt-4 content-viewer-title">
                                <h4>Debug (conteúdo decodificado)</h4>
                            </div>
                        </div>
                        <?php d($inputContent); ?>
                        <div>
                            <div class="content-viewer-title">
                                <h4  class="text-center alert-info">Conteúdo HTML do e-mail</h4>
                            </div>
                            <?php
                                $startContent = strpos($inputContent, '<!DOCTYPE');
                                if (!$startContent): ?>
                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <div>
                                            <i class="bi bi-info-circle me-2"></i>
                                            <?= $inputContent ?>
                                        </div>
                                    </div>
                                    <br>
                                <?php
                                endif;
                                $startContent += strlen('<!DOCTYPE');
                                $endContent = strpos($inputContent, '</html>', $startContent) - $startContent;
                                $content = '<!DOCTYPE ';
                                $content .= substr($inputContent, $startContent, $endContent);
                                $content .= '</html>';
                                echo $content;
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <button class="btn-climba mt-3 mb-5" onclick="window. history. back()">
                <i class="bi bi-backspace me-2"></i>
                Voltar
            </button>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>
</html>