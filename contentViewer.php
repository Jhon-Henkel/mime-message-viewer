<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Mime Message Viewer</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </head>
    <body>
        <?php require_once __DIR__.'/vendor/autoload.php';
            if (isset($_POST['acao']) && $_POST['acao'] == 'parsing') {
                $inputContent = json_decode($_POST['content'])->MIMEMessage;
        ?>
        <div class="container">
            <div class="text-center alert-info">
                <hr>
                <h4>Debug (conteúdo decodificado)</h4>
                <hr>
            </div>
            <?php d($inputContent); ?>
            <div>
                <hr>
                <h4  class="text-center alert-info">Conteúdo HTML do e-mail</h4>
                <hr>
                <?php
                    $startContent = strpos($inputContent, '<!DOCTYPE');
                    if ($startContent == 0){
                        return '';
                    }
                    $startContent += strlen('<!DOCTYPE');
                    $endContent = strpos($inputContent, '</html>', $startContent) - $startContent;

                    $content = '<!DOCTYPE ';
                    $content .= substr($inputContent, $startContent, $endContent);
                    $content .= '</html>';
                    echo $content;
                    die();
                }
                ?>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>
</html>