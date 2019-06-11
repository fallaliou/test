<?php
use Illuminate\database\Seeder; 
class GestionnairesTableSeeder extends Seeder
{
    

public function run(){
    factory(App\Gestionnaire::class,10)->create();

}
}
?>