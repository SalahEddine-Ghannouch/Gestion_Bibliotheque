<?php
session_start();
if(!isset($_SESSION['user']))
       header("location: index.php?Message=Connectez-vous pour continuer");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <title>Bibliothéque | Lycée Prince Moulay Rachid</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

    <style>  
        @media only screen and (width: 768px) { body{margin-top:150px;}}
        @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
        .tag {display:inline;float:left;padding:2px 5px;width:auto;background:#F5A623;color:#fff;height:23px;}
        .tag-side{display:inline;float:left;}
        #books {border:1px solid #DEEAEE; margin-bottom:20px;padding-top:30px;padding-bottom:20px;background:#fff; margin-left:10%;margin-right:10%;}
        #description {border:1px solid #DEEAEE; margin-bottom:20px;padding:20px 50px;background:#fff;margin-left:10%;margin-right:10%;}
        #description hr{margin:auto;}
        #service{background:#fff;padding:20px 10px;width:112%;margin-left:-6%;margin-right:-6%;}
        .glyphicon {color:#D67B22;}
    </style>

</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/logo.png"  style="width: 127px;margin: 0px;height:50px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <?php
                  if(isset($_SESSION['user']))
                    {
                      echo'
                    <li><a href="cart.php" class="btn btn-md"><span class="glyphicon glyphicon-shopping-cart">Carte</span></a></li>
                    <li><a href="destroy.php" class="btn btn-md"> <span class="glyphicon glyphicon-log-out">Se déconnecter</span></a></li>
                         ';
                    }
               ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div id="top" >
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
            <div>
                <form role="search" action="Result.php" method="post">
                    <input type="text" name="keyword" class="form-control" placeholder="Rechercher un livre, un auteur ou une catégorie" style="width:80%;margin:20px 10% 20px 10%;">
                </form>
            </div>
        </div>
   </div>


    <?php
    include "dbconnect.php";
    $PID=$_GET['ID'];
    $query = "SELECT * FROM products WHERE PID='$PID'";
    $result = mysqli_query ($con,$query)or die(mysql_error());

        if(mysqli_num_rows($result) > 0) 
        {   
            while($row = mysqli_fetch_assoc($result)) 
            {
            $path="img/books/".$row['PID'].".jpg";
            $target="cart.php?ID=".$PID."&";
echo '
  <div class="container-fluid" id="books">
    <div class="row">
      <div class="col-sm-10 col-md-6">
                         
                         <img class="center-block img-responsive" src="'.$path.'" height="550px" style="padding:20px;">
      </div>
      <div class="col-sm-10 col-md-4 col-md-offset-1">
        <h2> '. $row["Title"] . '</h2>
                                <span style="color:#00B9F5;">
                                 #'.$row["Author"].'&nbsp &nbsp #'.$row["Publisher"].'
                                </span>
        <hr>            
                                <span style="font-weight:bold;"></span>';
                              //   echo'<select id="quantity">';
                              //      for($i=1;$i<=$row['Available'];$i++)
                              //         //  echo '<option value="'.$i.'">'.$i.'</option>';
                              //  echo ' </select>';
echo'                           <br><br><br>
                                <a id="buyLink" href="'.$target.'" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;"> 
                                AJOUTER AU CARTE <br>
                                 </a> 

      </div>
    </div>
          </div>
     ';
echo '
          <div class="container-fluid" id="description">
    <div class="row">
      <h2> Description </h2> 
                        <p>'.$row['Description'] .'</p>
                        <pre style="background:inherit;border:none;">
   PRODUIT CODE  '.$row["PID"].'   <hr> 
   TITRE         '.$row["Title"].' <hr> 
   AUTEUR(E)        '.$row["Author"].' <hr>
   DISPONIBLE     '.$row["Available"].' <hr> 
   ÉDITEUR     '.$row["Publisher"].' <hr> 
   EDITION       '.$row["Edition"].' <hr>
   LANGUE      '.$row["Language"].' <hr>
   PAGES         '.$row["page"].' <hr>
   POIDS        '.$row["weight"].' <hr>
                        </pre>
    </div>
  </div>
';

            
            }
        }
    echo '</div>';
    ?>



<div class="container-fluid" id="service">
      <div class="row">
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-heart"></span> <br>
               PMR Se soucier <br>
               Heureux d'aider PMR, appelez-nous au 0611847363 ou cliquez ici
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <!-- <span class="glyphicon glyphicon-ok"></span> <br> -->
                <br>
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <!-- <span class="glyphicon glyphicon-check"></span> <br> -->
                <br>
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-tags"></span> <br>
               PMR Se soucier <br>
               nous espérons votre bonheur.Si nous ne répondons pas à vos attentes, donnez-nous un conseil.
          </div>
      </div>
</div>
 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<script>
            $(function () {
                var link = $('#buyLink').attr('href');
                $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
                $('#quantity').on('change', function () {
                    $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
                });
            });
    </script>
</body>
</html>       
