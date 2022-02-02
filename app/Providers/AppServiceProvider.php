<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder; 
use DB;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        $nbproduits = DB::select("select id from produits where visible=1");
        $nbproduits = count($nbproduits);
        config(['config.nbproduits' => $nbproduits]);

        $rupture = DB::select("select id from produits where quantite < 2 and visible=1");
        $rupture = count($rupture);
        config(['config.rupture' => $rupture]);

        $now = Carbon::now()->format('y-m-d');
        $stocker= DB::select("select * from stocks where date like '%$now%' ");
        $stocker = count($stocker);
        config(['config.stocker' => $stocker]);

        $destocker= DB::select("select * from destocks where date like '%$now%' ");
        $destocker = count($destocker);
        config(['config.destocker' => $destocker]);*/

        Builder::defaultStringLength(191); // Update defaultStringLength
    }
}
