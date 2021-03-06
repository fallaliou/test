<?php
use App\Helpers\SnNameGenerators as SnmG;
use Illuminate\Support\Str;
$factory->define(App\Region::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'nom' => $faker->word,
    ];
});

$factory->define(App\Type::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'name' => $faker->name,
    ];
});

// $factory->define(App\Gestionnaire::class, function (Faker\Generator $faker) {
//     return [
//         'uuid' => $faker->uuid,
//         'matricule' => $faker->word,
//         'users_id' => function () {
//              return factory(App\User::class)->create()->id;
//         },
//     ];
// });
$factory->define(App\Gestionnaire::class, function (Faker\Generator $faker) {
    return [
        $Role=App\Role::where('name','Gestionnaire')->first()->id,
        'matricule' => "GEST".$faker->word,
        'users_id' => function () use ($role_id) {
             return factory(App\User::class)->create(["roles_id"=>$role_id])->id;
        },
    ];
});

$factory->define(App\Village::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'nom' => $faker->word,
        'chef_id' => $faker->randomNumber(),
        'communes_id' => function () {
             return factory(App\Commune::class)->create()->id;
        },
    ];
});

$factory->define(App\Consommation::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'date' => $faker->dateTimeBetween(),
        'valeur' => $faker->word,
        'compteurs_id' => function () {
             return factory(App\Compteur::class)->create()->id;
        },
        'factures_id' => function () {
             return factory(App\Facture::class)->create()->id;
        },
        'agents_id' => function () {
             return factory(App\Agent::class)->create()->id;
        },
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'matricule' => $faker->word,
        'village_id' => function () {
             return factory(App\Village::class)->create()->id;
        },
        'gestionnaires_id' => function () {
             return factory(App\Gestionnaire::class)->create()->id;
        },
        'users_id' => function () {
             return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Administrateur::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'matricule' => $faker->word,
        'users_id' => function () {
             return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'name' => $faker->name,
    ];
});

$factory->define(App\Departement::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'nom' => $faker->word,
        'regions_id' => function () {
             return factory(App\Region::class)->create()->id;
        },
    ];
});

$factory->define(App\Commune::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'nom' => $faker->word,
        'arrondissements_id' => function () {
             return factory(App\Arrondissement::class)->create()->id;
        },
    ];
});

$factory->define(App\Comptable::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'matricule' => $faker->word,
        'users_id' => function () {
             return factory(App\User::class)->create()->id;
        },
    ];
});

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'uuid' => $faker->uuid,
//         'firstname' => $faker->firstName,
//         'name' => $faker->name,
//         'telephone' => $faker->word,
//         'email' => $faker->safeEmail,
//         'email_verified_at' => $faker->dateTimeBetween(),
//         'password' => bcrypt($faker->password),
//         'roles_id' => function () {
//              return factory(App\Role::class)->create()->id;
//         },
//     ];
// });
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => SnmG::getfirstName(),
        'name' => $faker->name,
        'telephone' => $faker->phoneNumber,
        'email' => Str::random(5).".".$faker->safeEmail,
        'email_verified_at' => $faker->dateTimeBetween(),
        'password' => bcrypt('secret'),
        'roles_id' => function () {
             return factory(App\Role::class)->create()->id;
        },
    ];
});

$factory->define(App\Reglement::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'date' => $faker->dateTimeBetween(),
        'montant' => $faker->randomFloat(),
        'types_id' => function () {
             return factory(App\Type::class)->create()->id;
        },
        'factures_id' => function () {
             return factory(App\Facture::class)->create()->id;
        },
        'comptables_id' => function () {
             return factory(App\Comptable::class)->create()->id;
        },
    ];
});

$factory->define(App\Agent::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'matricule' => $faker->word,
        'users_id' => function () {
             return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Facture::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'date_limite' => $faker->dateTimeBetween(),
        'details' => $faker->word,
        'montant' => $faker->randomFloat(),
        'debut_consommation' => $faker->dateTimeBetween(),
        'fin_consommation' => $faker->dateTimeBetween(),
    ];
});

$factory->define(App\Compteur::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'numero_serie' => $faker->word,
        'administrateurs_id' => function () {
             return factory(App\Administrateur::class)->create()->id;
        },
    ];
});

$factory->define(App\Abonnement::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'details' => $faker->word,
        'clients_id' => function () {
             return factory(App\Client::class)->create()->id;
        },
        'compteurs_id' => function () {
             return factory(App\Compteur::class)->create()->id;
        },
    ];
});

$factory->define(App\Arrondissement::class, function (Faker\Generator $faker) {
    return [
        'uuid' => $faker->uuid,
        'nom' => $faker->word,
        'departements_id' => function () {
             return factory(App\Departement::class)->create()->id;
        },
    ];
});

