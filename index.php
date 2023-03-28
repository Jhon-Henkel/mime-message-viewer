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
    <?php require_once __DIR__.'/vendor/autoload.php';

    if (isset($_POST['acao']) && $_POST['acao'] == 'parsing') {
        $inputContent = json_decode($_POST['content'])->MIMEMessage;
    ?>
    <div>
        <div class="text-center alert-info">
            <hr>
            <h4>Debug (conteúdo decodificado)</h4>
            <hr>
        </div>
        <div>
        <?php
            d($inputContent);

            echo '<h4  class="text-center alert-info">Conteúdo HTML do e-mail</h4>';
            $startContent = strpos($inputContent, '<!DOCTYPE');
            if ($startContent == 0){
                return '';
            }
            $startContent += strlen('<!DOCTYPE');
            $endContent = strpos($inputContent, '</html>', $startContent) - $startContent;

            $html = '<!DOCTYPE ';
            $html .= substr($inputContent, $startContent, $endContent);
            $html .= '</html>';
            echo $html;
            die();
        }
        ?>
        </div>
    </div>
    <body class="bg-primary text-white">
    <div class="container text-center mt-5">
        <div>
            <h1>Mime Message Viewer</h1>
        </div>
        <form class="form-text mt-5" method="post" action="#">
            <label class="text-white" for="content">
                Conteúdo Mime Message (Json)
            </label>
            <textarea class="form-control" type="text" name="content" id="content" rows="20" placeholder='{"MIMEMessage": "Date: ...conteúdo... \n"}'></textarea>
            <input type="hidden" name="acao" value="parsing">
            <button class="btn btn-success mt-3" type="submit">
                <i class="bi bi-chat-right-text me-2"></i>
                Ver Mensagem
            </button>
        </form>
    </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>
</html>