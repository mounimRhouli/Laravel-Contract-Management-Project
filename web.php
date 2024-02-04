<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\Admin\contratController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['auth','can:admin-access'])->group(function () {
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    // return what you want
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');

    Route::get('/reset-password', 'AdminController@reset_password')->name('reset-password');
    Route::put('/update-password', 'AdminController@update_password')->name('update-password');
    Route::get('/document/print/{depense_id}', 'AdminController@print_document')->name('depense.print');
    Route::get('/document/sendMail/{appeloffre_id}', 'DepenseController@sendEmail')->name('document.sendmail');
    Route::get('/document/sendMailToValidators/{depense_id}', 'DepenseController@sendMailToValidators')->name('document.sendMailToValidators');
    Route::get('/document/sendMailRejet/{depense_id}', 'DepenseController@sendEmailRejet')->name('document.sendEmailRejet');
    //Route::post('/changer-utilisateur', 'AdminController@changerUtilisateur')->name('changer-utilisateur');

    // Routes for Employés //
    Route::get('/utilisateurs/liste-utilisateurs', 'EmployeController@index')->name('employes.index');
    Route::get('/utilisateurs/ajout-utilisateur', 'EmployeController@create')->name('employes.create');
    Route::post('/utilisateurs', 'EmployeController@store')->name('employes.store');
    Route::delete('/utilisateurs/{employe_id}', 'EmployeController@destroy')->name('employes.delete');
    Route::put('/utilisateurs', 'EmployeController@update')->name('employes.update');
    Route::put('/utilisateurs/{employe_id}', 'EmployeController@update')->name('employes.update');
    Route::get('/utilisateurs/Modifier/{employe_id}', 'EmployeController@edit')->name('employes.edit');
    // Routes for Employés //

    // Routes for Appels d'offres //
    Route::get('/appels-offres/liste-appels-offres', 'AppelOffreController@index')->name('appelsoffres.index');
    Route::get('/appels-offres/ajout-appel-offre', 'AppelOffreController@create')->name('appelsoffres.create');
    Route::post('/appels-offres', 'AppelOffreController@store')->name('appelsoffres.store');
    Route::delete('/appels-offres/{appeloffre_id}', 'AppelOffreController@destroy')->name('appelsoffres.delete');
    Route::put('/appels-offres', 'AppelOffreController@update')->name('appelsoffres.update');
    Route::put('/appels-offres/{appeloffre_id}', 'AppelOffreController@update')->name('appelsoffres.update');
    Route::get('/appels-offres/Modifier/{appeloffre_id}', 'AppelOffreController@edit')->name('appelsoffres.edit');

    Route::post('/appels-offres/fileupload', 'AppelOffreController@fileupload')->name('appelsoffres.upload');
    Route::get('/appels-offres/listnatures/{typedocument_id}', 'AppelOffreController@listnatures')->name('appelsoffres.listnatures');

    Route::post('/appels-offres/telecharger-dossier', 'AppelOffreController@download')->name('appelsoffres.download');
    Route::get('/appels-offres/telecharger-dossier/{appeloffre_id}', 'AppelOffreController@download')->name('appelsoffres.download');

    Route::post('/appels-offres/supprimer-document/{aodocument_id}', 'AppelOffreController@destroydocument')->name('aodocument.delete');
    // Routes for Appels d'offres //

    // Routes for Marchés //
    Route::get('/marches/liste-marches', 'MarcheController@index')->name('marches.index');
    Route::get('/marches/ajout-marche', 'MarcheController@create')->name('marches.create');
    Route::post('/marches', 'MarcheController@store')->name('marches.store');
    Route::delete('/marches/{marche_id}', 'MarcheController@destroy')->name('marches.delete');
    Route::put('/marches', 'MarcheController@update')->name('marches.update');
    Route::put('/marches/{marche_id}', 'MarcheController@update')->name('marches.update');
    Route::get('/marches/Modifier/{marche_id}', 'MarcheController@edit')->name('marches.edit');

    Route::post('/marches/fileupload', 'MarcheController@fileupload')->name('marches.upload');
    Route::get('/marches/listnatures/{typedocument_id}', 'MarcheController@listnatures')->name('marches.listnatures');

    Route::post('/marches/telecharger-dossier', 'MarcheController@download')->name('marches.download');
    Route::get('/marches/telecharger-dossier/{marche_id}', 'MarcheController@download')->name('marches.download');

    Route::post('/marches/supprimer-document/{aodocument_id}', 'MarcheController@destroydocument')->name('aodocument.delete');
    // Routes for Marchés //

    // Routes for Habilitations //
    Route::get('/autorisations/habilitations', 'HabilitationController@index')->name('habilitations.index');
    Route::get('/autorisations/habilitations/{utilisateur_id}', 'HabilitationController@listedroits')->name('habilitations.listedroits');
    Route::post('/habilitations/updateauthorisation', 'HabilitationController@updateauthorisation')->name('habilitations.updateauthorisation');
    // Routes for Habilitations //




    // Routes Documents //
    Route::any('/documents/liste-documents', 'DocumentController@index')->name('documents.index');
    Route::get('/documents/ajout-document', 'DocumentController@create')->name('documents.create');
    Route::post('/documents', 'DocumentController@store')->name('documents.store');
    Route::delete('/documents/{document_id}', 'DocumentController@destroy')->name('documents.delete');
    Route::put('/documents', 'DocumentController@update')->name('documents.update');
    Route::put('/documents/{document_id}', 'DocumentController@update')->name('documents.update');
    Route::get('/documents/Modifier/{document_id}', 'DocumentController@edit')->name('documents.edit');
    Route::get('/documents/listenatures/{typedocument}', 'DocumentController@getNatures');
    Route::get('/documents/downloadfile/{document_id}', 'DocumentController@downloadfile')->name('documents.download');
    // Fin Routes Documents //


    // Routes Requettes //
    Route::get('/requetes/liste-requetes', 'DepenseController@requettes')->name('requettes.liste');
    Route::get('/requetes/fraiscarburant', 'DepenseController@fraiscarburant')->name('requettes.fraiscarburant');
    Route::post('/requetes/fraiscarburant', 'DepenseController@FraisCarburantParUtilisateur')->name('requettes.fraiscarburant');
    Route::get('/requetes/detailsfraiscarburant/{user_id}', 'DepenseController@detailsfraiscarburant')->name('requettes.detailsfraiscarburant');
    // Routes Requettes //


    // Routes for Projets //
    Route::get('/projets/liste-projets', 'ProjetController@index')->name('projets.index');
    Route::get('/projets/ajout-projet', 'ProjetController@create')->name('projets.create');
    Route::post('/projets', 'ProjetController@store')->name('projets.store');
    Route::delete('/projets/{projet_id}', 'ProjetController@destroy')->name('projets.delete');
    Route::put('/projets', 'ProjetController@update')->name('projets.update');
    Route::put('/projets/{projet_id}', 'ProjetController@update')->name('projets.update');
    Route::get('/projets/Modifier/{projet_id}', 'ProjetController@edit')->name('projets.edit');

    Route::post('/projets/supprimer-document/{projet_id}', 'ProjetController@destroyProjets')->name('projets.delete');
    // Routes for Projets //



    // Routes pour Motos //
    Route::get('/motos/liste-motos', 'MotoController@index')->name('motos.index');
    Route::get('/motos/ajout-moto', 'MotoController@create')->name('motos.create');
    Route::get('/motos/edit-moto/{moto_id}', 'MotoController@edit')->name('motos.edit');
    Route::post('/motos', 'MotoController@store')->name('motos.store');
    Route::post('/motos/{moto_id}', 'MotoController@update')->name('motos.update');
    Route::get('/motos/print/notice/{moto_id}', 'MotoController@imprimer_notice_descriptive')->name('motos.printnotice');
    // Routes pour Motos //


    // Routes pour Véhicules //
    Route::get('/vehicules/liste-vehicules', 'VehiculeController@index')->name('vehicules.index');
    Route::get('/vehicules/ajout-vehicule', 'VehiculeController@create')->name('vehicules.create');
    Route::get('/vehicules/edit-vehicule/{vehicule_id}', 'VehiculeController@edit')->name('vehicules.edit');
    Route::post('/vehicules', 'VehiculeController@store')->name('vehicules.store');
    Route::post('/vehicules/{vehicule_id}', 'VehiculeController@update')->name('vehicules.update');
    Route::get('/vehicules/print/{vehicule_id}', 'VehiculeController@imprimer')->name('vehicules.print');
    Route::get('/vehicules/visitetechniqueemail', 'UserController@verification_vehicules');
    // Routes pour Véhicules //

    
    //Routes pour Gestion des contrats//

    Route::get('/contrats/liste-contrats', 'contratController@index')->name('contrats.index');
    Route::get('/contrats/ajout-contrat', 'contratController@create')->name('contrats.create');
    Route::get('/contrats/edit-contrat/{contrat_id}', 'contratController@edit')->name('contrats.edit');
    Route::post('/contrats', 'contratController@store')->name('contrats.store');
    Route::post('/update', 'contratController@update')->name('contrats.update');
    Route::get('/contrats/index/{contrat_id}', 'contratController@destroycontrat')->name('contrats.destroycontrat');
    Route::get('/contrats/{id}/download-pdf', 'contratController@downloadPDF')->name('contrats.download-pdf');
    Route::get('/contrats/Analyse-Data','contratController@graph')->name('contrats.graph');
    Route::get('/details/{id}','contratController@details')->name('contrats.details');

    //Routes pour Gestion des contrats//
});
