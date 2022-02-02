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
            <h1 style="text-align: center;color: black;" >
              <B>
                  Liste Des Achats du Fournisseur 
                  @foreach($Fournissuer as $f)
                          {{$f->nom}}
                  @endforeach
                   
              </B>
            </h1>
      <br>

        
                    

    </div>

     <br>
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

                  

                </tr>
                @endforeach
              </tbody>
      
            </table>
       </div>
      </div>
    </div>
    


@endsection
