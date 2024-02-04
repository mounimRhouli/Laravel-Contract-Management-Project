                            the views
view contrat :"responsable de la contrat telechargé lorsqque ve qlique sure le le button télecharger
view create: La  route est Route::get('/contrats/ajout-contrat', 'contratController@create')->name('contrats.create');
view index:La route est Route::get('/contrats/liste-contrats', 'contratController@index')->name('contrats.index');,Représente la page de la liste des contrats.
view details: La route  route est  Route::get('/details/{id}','contratController@details')->name('contrats.details');, si vos clique sur le button Voir contrat détails cette cet viw  sera afichier
view edit: La route est Route::get('/contrats/edit-contrat/{contrat_id}', 'contratController@edit')->name('contrats.edit');
view graph: La route  est Route::get('/contrats/Analyse-Data','contratController@graph')->name('contrats.graph');
view emailS : la vue qui représente le contenu du courriel de la notification,
dans resources/views/email.

             Les identifiants de modèle dans la table 'menus'
26:Contrats
27:Gestion des Contrats

                         Les modèles créés
 TypeContrat:pour la table "typecontrats"
 contrats:pour la table "contrats"

                    Les fichiers utilisés pour envoyer les notifications
sendEmail:dans app/console/commands.
EmailSend:dans app/Mail.

