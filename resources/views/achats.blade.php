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
            <h1 style="text-align: center;color: black;" ><B>Liste Des Achats </B></h1>
      <br>

         <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-user-plus"></i>  Ajouter Un Achat
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouvel Achat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/AddAchat" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">

                              <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip01"><B>N° Demande de Paiement </B></label>
                                        <input type="text"  name="npaiement" class="form-control"  required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip01"><B>N° BC </B></label>
                                        <input type="text"  name="bc" class="form-control"  required>
                                    </div>
                                    
                                    
                              </div>

                            

                              <div class="form-row" >

                               <div class="col-md-12 mb-6">

                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B>Service demandeur</B></label>
                                    <select name="direction" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($directions as $direction)
                                     <option value="{{$direction->id}}"> {{  $direction->direction  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                              </div> 

                            </div>

                            <div class="form-row" >

                               <div class="col-md-12 mb-6">
                                
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B>Fournisseur</B></label>
                                    <select name="fournisseur" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($fournisseurs as $fournisseur)
                                     <option value="{{$fournisseur->id}}"> {{  $fournisseur->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                              </div> 

                            </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Action </B></label>
                                        <input type="text"  name="action" class="form-control"  required>
                                    </div>
                                   
                              </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Montant </B></label>
                                        <input type="text"  name="montant" class="form-control"  required>
                                    </div>
                                   
                              </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Date de demande de paiement </B></label>
                                        <input type="date"  name="DatePaiement" class="form-control"  required>
                                    </div>
                                   
                              </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Désignation </B></label>
                                        <input type="text"  name="designation" class="form-control"  required>
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
     
     <form class="needs-validation" novalidate action="/ChercherAchat" method="POST">
                        {{ csrf_field()}}
        <div class="modal-body">
           <div class="form-row">

                    <div class="col-md-6 mb-3">
                        <label for="validationTooltip01"><B>Chercher par BC </B></label>
                        <input type="text" placeholder="123" name="chercher" class="form-control"  required>
                    </div>
                                   
            </div>
            <div class="col-md-6 mb-3">
                            
                            <button type="submit" class="btn-sm btn btn-primary">Chercher</button>
            </div>
        </div>
    </form>

     <br>

     <div class="card-body">
      <div class="table-responsive">
        <div class="card card-body">
            <table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th scope="col"><B>N°DP</B></th>
                  <th scope="col"><B>BC</B></th>
                  <th scope="col"><B>DR</B></th>
                  <th scope="col"><B>Fournisseur</B></th>
                  <th scope="col"><B>Action</B></th>
                  <th scope="col"><B>Montant</B></th>
                  <th scope="col"><B>Date</B></th>
                  <th scope="col"><B>Dés</B></th>
                  <th scope="col"><B>Mdf</B></th>
                  <th scope="col"><B>Sup</B></th>
            
                </tr>
              </thead>
              <tbody>

                @foreach($achats as $achat)
               
                <tr>
                  <td scope="row"><B>{{$achat->npaiement }}</B></td>
                  <td scope="row"><B>{{$achat->bc}}</B></td>
                  <td scope="row"><B>{{$achat->direction}}</B></td>
                  <td scope="row"><B>{{$achat->nom  }}</B></td>
                  <td scope="row"><B>{{$achat->action}}</B></td>
                  <td scope="row"><B>{{$achat->montant}}</B></td>
                  <td scope="row"><B>{{$achat->DatePaiement}}</B></td>
                  <td scope="row"><B>{{$achat->designation}}</B></td>

                   <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$achat->id}}">
                    <i class="fas fa-edit"></i>
                        </button>

                        <!-- Boutom d'Ajouter une Maman -->
                        <div class="modal fade" id="exampleModal{{$achat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$achat->id}}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{$achat->id}}">Nouvelles Infos de {{$achat->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        <form class="needs-validation" novalidate action="Modifierachat/{{$achat->id}}" method="POST">
                            {{ csrf_field()}}
                           <div class="modal-body">

                              <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip01"><B>N° Demande de Paiement </B></label>
                                        <input type="text"  name="npaiement" class="form-control" value="{{$achat->npaiement}}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip01"><B>N° BC </B></label>
                                        <input type="text"  name="bc" class="form-control"  value="{{$achat->bc}}" required>
                                    </div>
                                    
                                    
                              </div>

                              
                              <div class="form-row" >

                               <div class="col-md-12 mb-6">

                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B>Service demandeur</B></label>
                                    <select name="direction" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($directions as $direction)
                                     <option value="{{$direction->id}}"> {{  $direction->direction  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                              </div> 

                            </div>

                            <div class="form-row" >

                               <div class="col-md-12 mb-6">
                                
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B>Fournisseur</B></label>
                                    <select name="fournisseur" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($fournisseurs as $fournisseur)
                                     <option value="{{$fournisseur->id}}"> {{  $fournisseur->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                              </div> 

                            </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Action </B></label>
                                        <input type="text"  name="action" class="form-control" value="{{$achat->action}}" required>
                                    </div>
                                   
                              </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Montant </B></label>
                                        <input type="text"  name="montant" class="form-control" value="{{$achat->montant}}"  required>
                                    </div>
                                   
                              </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Date de demande de paiement </B></label>
                                        <input type="date"  name="DatePaiement" class="form-control" value="{{$achat->DatePaiement}}" required>
                                    </div>
                                   
                              </div>

                              <div class="form-row">

                                    <div class="col-md-12 mb-6">
                                        <label for="validationTooltip01"><B>Désignation </B></label>
                                        <input type="text"  name="designation" class="form-control" value="{{$achat->designation}}"  required>
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
                      <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMER{{$achat->id}}">
                    <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Boutom d'Ajouter une Maman -->
                        <div class="modal fade" id="exampleModalSUPPRIMER{{$achat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer Cet Achat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        <form class="needs-validation" novalidate action="/Supprimerachat/{{$achat->id}}" method="POST">
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
