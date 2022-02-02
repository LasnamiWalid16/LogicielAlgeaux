<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Dompdf\Dompdf;



class FournisseurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {



        $fournisseurs=DB::select(" select id,nom,total 
                                from fournisseurs 
                                where visible =1
                                ");

        return view('fournisseur',compact('fournisseurs'));
    }
    

    public function Addfournisseur(Request $request)
    {
        $this->validate($request,[

            'nom' => 'required|max:500'

        ]);

    
        $nom=$request->input('nom');

        $testnom=$request->input('nom');
        $info=DB::select("select count(*) as number from fournisseurs where nom='$testnom'")[0]->number;
       
        

         if ($info>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce Nom de Fournisseur existe déja  !!! ');

                return redirect()->back(); 
               }

        $activite=$request->input('activite');

      

        DB::insert("insert into fournisseurs (nom,activite,total) values('$nom','$activite','0') ");
        

        return redirect('/fournisseurs')->with('success','Fournisseur enregistré avec succée');

    }

    public function ModifierFournisseur(Request $request,$id)
    {
        $this->validate($request,[
            'nom' => 'required|max:500',
            'tele' => 'required|max:500',
            'adresse' => 'required|max:500'
        ]);

    
        $nom=$request->input('nom'); 
        $tele=$request->input('tele');
        $adresse=$request->input('adresse');     

        DB::update("update fournisseurs d set  nom=' $nom', tele='$tele',adresse= '$adresse' where d.id='$id'  ");
        

        return redirect('/fournisseurs')->with('success','Fournisseur Modifié avec succée');

    }

    public function Supprimerfournisseur(Request $request,$id)
    {
    
        DB::update("update fournisseurs d set visible='0' where d.id='$id'  ");

        return redirect('/fournisseurs')->with('success','Fournisseur supprimé avec succée');

    }



    public function achats()
    {
        $now = Carbon::now()->format('Y');
        $achats=DB::select(" select a.id,a.npaiement,a.bc,a.direction,f.nom,a.action,a.montant, a.DatePaiement,a.designation,d.direction
            from achats a,fournisseurs f,directions d
            where a.fournisseur=f.id 
            and a.direction=d.id 
            and EXTRACT(YEAR FROM DatePaiement) like '%$now%'
            ORDER BY a.DatePaiement DESC ");

        $fournisseurs=DB::select('select * from fournisseurs where visible =1');


        $directions=DB::select('select * from directions');

        return view('achats',compact('achats','directions','fournisseurs'));
    }


        public function AddAchat(Request $request)
    {
        /* $this->validate($request,[

            'nom' => 'required|max:500',
            

        ]);
        */
    
        $npaiement=$request->input('npaiement');
        $bc=$request->input('bc');
        $direction=$request->input('direction');
        $fournisseur=$request->input('fournisseur');
        $action=$request->input('action');
        $montant=$request->input('montant');
        $DatePaiement=$request->input('DatePaiement');
        $designation=$request->input('designation');

      

        DB::insert("insert into achats (npaiement,bc,direction,fournisseur,action,montant,DatePaiement,designation) values('$npaiement','$bc','$direction','$fournisseur','$action','$montant','$DatePaiement','$designation') ");
        
        $total=DB::select("select total from fournisseurs where id='$fournisseur' ")[0]->total;

        $total=$total+$montant;

        DB::update("update fournisseurs d set total='$total' where d.id='$fournisseur'  ");


        return redirect('/achats')->with('success','Achat enregistré avec succée');

    }



    /* ********************** MODIFICATION d'UN ACHAT************************s */


    public function Modifierachat(Request $request,$id)
    {
         /* $this->validate($request,[

            'nom' => 'required|max:500',
            

        ]);
        */
    
        $npaiement=$request->input('npaiement');
        $bc=$request->input('bc');
        $direction=$request->input('direction');
        $fournisseur=$request->input('fournisseur');
        $action=$request->input('action');
        $montant=$request->input('montant');
        $DatePaiement=$request->input('DatePaiement');
        $designation=$request->input('designation');

        $OldFournisseur=DB::select("select fournisseur from achats where id='$id' ")[0]->fournisseur;

        $NewFournisseur=$fournisseur;

        
        if ($OldFournisseur==$NewFournisseur) 
        {
           

            $OldPriAchat=DB::select("select montant from achats where id='$id' ")[0]->montant;

            $OldTotal=DB::select("select total from fournisseurs where id='$fournisseur' ")[0]->total;

            $NewTotal=$OldTotal-$OldPriAchat+$montant;

            DB::update("update fournisseurs d set total='$NewTotal' where d.id='$fournisseur'  ");

        }

        else
        {
            $total=DB::select("select total from fournisseurs where id='$fournisseur' ")[0]->total;

            $total=$total+$montant;

            DB::update("update fournisseurs d set total='$total' where d.id='$fournisseur'  ");


        }

        


        DB::update("update achats d 
            set  montant=' $montant', npaiement='$npaiement',bc= '$bc', direction='$direction',fournisseur='$fournisseur',action='$action',DatePaiement='$DatePaiement',designation='$designation'
            where d.id='$id'  ");
        

        return redirect('/achats')->with('success','Achat Modifié avec succée');

    }

    public function Supprimerachat(Request $request,$id)
    {
        
        $OldPriAchat=DB::select("select montant from achats where id='$id' ")[0]->montant;

        $fournisseur=DB::select("select fournisseur from achats where id='$id' ")[0]->fournisseur;

        $total=DB::select("select total from fournisseurs where id='$fournisseur' ")[0]->total;

        $total=$total-$OldPriAchat;

        DB::update("update fournisseurs d set total='$total' where d.id='$fournisseur'  ");

        DB::delete("delete from  achats  where id='$id'  ");




        return redirect('/achats')->with('success','Achat supprimé avec succée');

    }

    public function AchatsFournisseur(Request $request,$id)
    {
    
        $achats=DB::select("select * from fournisseurs f,achats a 
            where a.fournisseur=f.id and f.id='$id' ");

        $Fournissuer=DB::select("select nom from fournisseurs where id='$id' ");

        return view('AchatsFournisseur',compact('achats','Fournissuer'));

    }

    public function ChercherAchat(Request $request)
    {
        $this->validate($request,[

            'chercher' => 'required|max:500'

        ]);

    
        $chercher=$request->input('chercher');


        $info=DB::select("select count(*) as number from achats where bc='$chercher'")[0]->number;
       
        

         if ($info < 1) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Ce BC n existe PAS  !!! ');

                return redirect()->back(); 
               }

        else
        {
            $achats=DB::select("select a.id,a.npaiement,a.bc,a.direction,f.nom,a.action,a.montant, a.DatePaiement,a.designation,d.direction
            from achats a,fournisseurs f,directions d
            where a.fournisseur=f.id 
            and a.direction=d.id 
            and a.bc='$chercher'
            ORDER BY a.DatePaiement DESC ");

       

        return view('chercher',compact('achats'));
        }

      }

      public function MontantsFournisseur(Request $request,$id)
    {
    
        $montants=DB::select("select f.nom,EXTRACT(YEAR FROM a.DatePaiement) as annee,sum(a.montant) as TotalAnnee
            from fournisseurs f,achats a 
            where a.fournisseur=f.id 
            and f.id='$id' 
            group by f.nom,EXTRACT(YEAR FROM a.DatePaiement)");


        return view('MontantsFournisseur',compact('montants'));

    }

    public function TelechargerFournisseurCaracteristique($IdFournisseur)
    {


        $fournisseur=DB::select("select * from fournisseurs where id='$IdFournisseur' ");

        $achats=DB::select(" select *,d.direction as DIR 
            from fournisseurs f,achats a,directions d 
            where a.fournisseur=f.id and f.id='$IdFournisseur' and a.direction=d.id
            order by DatePaiement ");
        
        $dompdf = new Dompdf();

        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Fournisseur Informations </title>
        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
            }
            tfoot tr td{
                font-weight: bold;
            }
            .gray {
                background-color: lightgray;
            }
            tbody {
                width: 100%;
            }
        </style>
        </head>
        <body>
          <table width="100%">
            <tr>
                <td valign="top"></td>
                <td align="left">

                    <h1><B> ALGEAUX SPA</B></h1>
                      <h2 style="text-align: center;">Achats  du Fournisseur</h2>
                      <h3 style="text-align: center;">Raison: '.$fournisseur[0]->nom.'   </h3>
                     

                </td>
                <td align="right">
                    <img src=""  />
                </td>
            </tr>
          </table>
          
          <br/>
          <table width="100%">
            <thead style="background-color: lightgray;">
              <tr>
                  <th><B>N°DP</B></th>
                  <th><B>BC</B></th>
                  <th><B>DR</B></th>
                  <th><B>Action</B></th>
                  <th><B>Montant</B></th>
                  <th><B>Date</B></th>
                
              </tr>
            </thead>
            <tbody>';
           
            foreach ($achats as $achat) 
            {
                
                        
                    $html.='<tr class="item">
                    
                    <td>
                    
                        '.$achat->npaiement.'
                    </td>
                    <td>
                    
                        '.$achat->bc.'
                    </td>
                    <td>
                    
                        '.$achat->DIR.'
                    </td>
                    <td>
                    
                        '.$achat->action.'
                    </td>
                    <td>
                    
                        '.$achat->montant.'
                    </td>
                    <td>
                    
                        '.$achat->DatePaiement.'
                    </td>
                  
                   
                </tr>';

               
            }

            

           

        $html.='
            </tbody>
            <tfoot>';
           
            
            $html.='</tfoot>
          </table>
          

        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("DetailFournisseur", array('Attachment'=>1));


    }



}
