<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css"/>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><i class="fas fa-user-secret"></i> TAhri</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
              </ul>
            
            </div>
          </nav>
    </header>
        <section class="container py-5">
            <!-- row Numero 1 -->
                  <div class="row">
                    <div class="col-lg-8 col-sm mb-5 mx-auto">
                        <h1 class="fs-4 text-center lead text-primary">CRUD PHP MYSQL</h1>
                    </div>
                  </div>
                  <div class="dropdown-divider border-warning"></div>
            <!-- row Numero 2 -->
                    <div class="row">
                        <div class="col-md-6">   
                            <h5 class="fw-bold mb-0">Liste des factures</h5>  
                        </div>

                            <div class="col-md-6">   
                              <div class="d-flex justify-content-end">  
                                <button class="btn btn-primary btn-sm me-3"  data-bs-toggle="modal" data-bs-target="#createmodal"><i class="fas fa-folder-plus"></i>  NOUVEAU</button>  
                                <a href="/process.php?action=export"   class="btn btn-success btn-sm"><i id="export" class="fas fa-table">Exporte</i></a>
                            </div>
                        </div>
                  </div>
                  <hr>
            <!-- row Numero 3 -->      
                      <div class="dropdown-divider border-warning"></div>
                      <div class="row">
                        <div class="table-responsive" id="orderTable"> 
                          <h3 class="text-success text-center">Chargement des factures....</h3>
                      </div>

                  </div>
        </section>
            <!-- Button trigger modal -->
              
                <!-- Modal AJout-->
                <div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="createmodal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="createmodal">Nouvel Facture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                          
                                    <form   id="formOrder" action="" method="post">
                                      <div class="mb-3 mt-3" >
                                        <input  placeholder="Nom du client"  id="customer" name="customer" type="text" class="form-control">
                                      </div>
                                    
                                      <div class="mb-3 mt-3">
                                      <input  placeholder="Nom du caissier" id="cashier" name="cashier" type="text" class="form-control">
                                      </div>

                                      <div class="mb-3 mt-3">
                                        <div class="row">
                                          <div class="col-4"><input  id="amount" name="amount" placeholder="Montant" type="text" class="form-control"></div>
                                          <div class="col-4"><input  id="received" name="received" placeholder="Montant reçu" type="text" class="form-control"></div>
                                          <div class="col-4">
                                          <select id="etat" name="etat" class="form-select">
                                              <option>Facturée</option>
                                              <option>Payée</option>
                                              <option>Annulée</option>
                                              
                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Annuler</button>
                                              <button type="submit" id="create" class="btn btn-primary">Ajouter <i class="fas fas-plus"></i></button>
                                          </div>

                                    </form>  

                      </div>

                      
                    
                    </div>
                  </div>
                </div>

                <!-- Modal Modif-->
                <div class="modal fade" id="updatmodal" tabindex="-1" aria-labelledby="updatmodal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="updatmodaltitre">Modifier Facture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                      
                                    <form   id="formupdate" action="" method="post">
                                      <div class="mb-3 mt-3" >
                                        <input type="hidden" name="id_facture" id="id_facture">
                                        <input  placeholder="Nom du client"  id="updatcustomer" name="updatcustomer" type="text" class="form-control">
                                      </div>
                                      
                                      <div class="mb-3 mt-3">
                                        <input  placeholder="Nom du caissier" id="updatcashier" name="updatcashier" type="text" class="form-control">
                                      </div>

                                      <div class="mb-3 mt-3">
                                        <div class="row">
                                          <div class="col-4"><input  id="updatamount" name="updatamount" placeholder="Montant" type="text" class="form-control"></div>
                                          <div class="col-4"><input  id="updatreceived" name="updatreceived" placeholder="Montant reçu" type="text" class="form-control"></div>
                                          <div class="col-4">
                                          <select id="updatetat" name="updatetat" class="form-select">
                                              <option>Facturée</option>
                                              <option>Payée</option>
                                              <option>Annulée</option>
                                              
                                              
                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" id="updat_btn"  class="btn btn-primary">Mettre à jour </button> <i class="bi bi-arrow-repeat"></i>
                                          </div>

                                    </form>  

                                    
                        ...



                      </div>

                      
                    
                    </div>
                  </div>
                </div>













               
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="process.js"></script>
</body>
</html>