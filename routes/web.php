<?php

use Illuminate\Support\Facades\Route;

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

// --> Para internet - cookies, sessions

/*
    Entendendo:
    A) Route:método(nome, função que será executada)
    Ex:
    Route::get('/', function () {
        return view('welcome');
    });
*/

//redirecionamento automático -> da raiz, será direcionado p/ /teste
//Route::redirect('/', '/teste');

//Carrega uma view
Route::view('/teste', 'teste'); // (nome da rota, nome da view)

//Redireciona para outra rota
Route::view('/destino', 'welcome');
Route::redirect('/redirect', '/destino'); // url da req, url de destino

//Rotas com parâmetros
Route::get('/noticia/{slug}', function ($slug){
    echo "Slug: ". $slug;
});
Route::get('/noticia/{slug}/comentario/{id}', function ($slug, $id){
    echo "Mostrando o comentário ".$id." da notícia ".$slug;
});

//Rotas com Regex (expressões regulares)
Route::get('user/{name}', function ($name){
    echo "Mostrando usuário de NOME ".$name;
})->where('name', '[a-z]+');

//Provider(padronizar expressões regulares -> app->providers->RouteServiceProvider)
Route::get('user/{id}', function ($id){
    echo "Mostrando usuário de ID ".$id;
});

//Grupo de Rotas + Rotas com nome + redirect
Route::prefix('/config')->group(function (){
    Route::get('/', function (){ //o próprio prefix /config ou /config/
        echo "Configurações";

        $info = route('info');
        $permissoes = route('permissoes');

        echo "<br><a href='$info'>info</a>";
        echo "<br><a href='$permissoes'>permissoes</a>";
    });

    Route::get('info', function (){
        echo "Configurações Info";
    })->name('info');

    Route::get('/permissoes', function (){
        //return redirect()->route('info');
        echo "Configurações Permissoes";
    })->name('permissoes');
});
//Fim Grupo de Rotas + Rotas com nome + redirect

//Rotas + Controllers
Route::prefix('/config_controller')->group(function (){

    Route::get('/', 'ConfigController@index');
    Route::get('info', 'ConfigController@info');
    Route::get('permissoes', 'ConfigController@permissoes');

});
//Fim Rotas + Controllers

Route::get('/', 'HomeController'); //usando método invoke

//Controllers em outras pastas
Route::get('/admin', 'Admin\AdminController@index');


//Configurando página não encontrada
Route::fallback(function (){
    return view('404');
});
