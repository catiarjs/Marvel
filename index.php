<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teste Técnico - InnovareTi</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Teste Técnico</a>
        <form class="form-inline" method="POST">
            
            <input type="text" name="txtNome" class="form-control" size="30" placeholder="pesquisa de personages"/>
            <button type="submit" class="btn btn-secondary">Pesquisar</button>
           
        </form>
        
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <br>
      <!-- Page Heading -->
      <div class="row">
<?php
        require 'marvel.class.php';
        
        $marvel = new Marvel();
        echo $marvel->getCards();
      
?>
          
    </div>      
    <!-- /.row -->
    
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Catia Regina 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
