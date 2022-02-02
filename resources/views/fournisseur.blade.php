@extends('layouts.admine')

@section('content')

@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p style=" text-align : center; ">{{ \Session::get('success') }}</p>
                        </div>
                    @endif

                    @if (count($errors)>0)
                        <ul>
                          @foreach($errors->all() as $error)
                          <li class="alert alert-danger">{{$error}}</li>
                          @endforeach
                        </ul>
                    @endif
                    <div class="container">
                      @if(session()->has('notif'))
                      <div class="row">
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
                          <strong>Notification</strong>{{session()->get('notif') }}
                        </div>
                      </div>
                      @endif
    <div>
            <h1 style="text-align: center;color: black;" ><B>Liste Des Fournisseurs </B></h1>
      <br>

         <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-user-plus"></i>  Ajouter Un Fournisseur
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouveau Fournisseur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/Addfournisseur" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Raison </B></label>
                                        <input type="text"  name="nom" class="form-control"  required>
                                    </div>
                                    
                                    
                              </div>
                             
                             
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Ajouter</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

    </div>

     <br>
     <br>

     <div class="card-body">
      <div class="table-responsive">
        <div class="card card-body">
            <table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th scope="col"><B>Raison</B></th>
                  <th scope="col"><B>Montant</B></th>
                  <th scope="col"><B>Montant</B></th>
                  <th scope="col"><B>Achats</B></th>
                  <th scope="col"><B>Telecharger</B></th>
                  <th scope="col"><B>Modifier</B></th>
                  <th scope="col"><B>Supprimer</B></th>
                </tr>
              </thead>
              <tbody>

                @foreach($fournisseurs as $fournisseur)
               
                <tr>
                  <td scope="row"><B>{{$fournisseur->nom}}</B></td>
                  <td scope="row"><B>{{$fournisseur->total}}</B></td>
                  <td scope="row">
                    <B><a href="MontantsFournisseur/{{$fournisseur->id}}">Montants</a></B>
                  </td>
                  <td scope="row">
                    <B><a href="AchatsFournisseur/{{$fournisseur->id}}">Achats</a></B>
                  </td>
                  <td scope="row">
                    <B><a href="TelechargerFournisseurCaracteristique/{{$fournisseur->id}}">Achats</a></B>
                  </td>
                  
                  <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$fournisseur->id}}">
                    <i class="fas fa-edit"></i>
                        </button>

                        <!-- Boutom d'Ajouter une Maman -->
                        <div class="modal fade" id="exampleModal{{$fournisseur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$fournisseur->id}}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{$fournisseur->id}}">Nouvelles Infos de {{$fournisseur->nom}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        <form class="needs-validation" novalidate action="ModifierFournisseur/{{$fournisseur->id}}" method="POST">
                            {{ csrf_field()}}
                              <div class="modal-body">
                                  <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                      <label for="validationTooltip01"><B>NV Raison </B></label>
                                      <input type="text"  name="nom" class="form-control" value="{{$fournisseur->nom}}"  required>
                                    </div>

                                   

                                  
                                  </div>

                                 
                              
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn-sm btn btn-primary">Modifier</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>

                    </td>
                    
                    <td>
                      <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMER{{$fournisseur->id}}">
                    <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Boutom d'Ajouter une Maman -->
                        <div class="modal fade" id="exampleModalSUPPRIMER{{$fournisseur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer {{$fournisseur->nom}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        <form class="needs-validation" novalidate action="/Supprimerfournisseur/{{$fournisseur->id}}" method="POST">
                            {{ csrf_field()}}
                              
                              <div class="modal-footer">
                                <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn-sm btn btn-danger">Supprimer</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
      
            </table>
       </div>
      </div>
    </div>
    


@endsection
