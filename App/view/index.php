<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>FSN | Cronograma de Estudos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    
    <body>
        
        <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= URL_BASE ?>">CRONOGRAMA DE ESTUDOS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav"></div>
                <span class="navbar-text">
                    FSN
                </span>
            </div>
        </nav>

        <div class="container mt-3">
            
            <h1 class="text-dark mb-3">Cursos</h1>

            <div class="mt-3 mb-3 form-group">
                
                <select class="form-control" id='select_formacoes'>
                    <option disabled selected>Selecione uma formação</option>
                    <option value="">Todas as formações</option>
                    <option value="Backend">Backend</option>
                    <option value="DataScience">DataScience</option>
                    <option value="DevOps">DevOps</option>
                    <option value="Frontend">Frontend</option>
                    <option value="Gestão">Gestão</option>
                    <option value="IA">IA</option>
                    <option value="Mobile">Mobile</option>
                    <option value="UX">UX</option>
                </select>
            
            </div>
            <div id="tabelaCursos"><!-- Tabela construida com JS --></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= URL_BASE . 'assets/js/main.js' ?>"></script>
    </body>

</html>