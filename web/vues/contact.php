<!doctype html>
<html lang="en">

    <?php include('./vues/common/header.html'); ?>
    
    <body class="d-flex flex-column h-100 text-white text-bg-dark">
        
    <!-- Begin Navbar -->
    <?php include('./vues/common/nav.php'); ?>


    <!-- Begin page content -->
    <main class=" flex-shrink-0">
        <div class="container">
            <div class="card w-100 text-bg-secondary " >
                <div class="card-header">
                    Contact
                </div>
                <div class="card-body">
                

                    <form>
                            <?php foreach ($colonnes as $colonne): 
                                $attr = $colonne['nom'];?>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label"><?= $colonne['denom'] ?></label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" value="<?= $contact->$attr ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                            </form>

                
                </div>
            </div>
        </div>
    </main>

    <!-- Begin Footer -->
    <?php include('./vues/common/footer.html'); ?>


    <?php include('./vues/common/bootstrap.html'); ?>
  </body>
</html>
