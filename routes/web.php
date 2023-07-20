<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\SetController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::prefix('')->group(function () {
    Route::get('/', [App\Http\Controllers\User\GetController::class, 'index'])->name('user.index');
    Route::get('/à-propos', [App\Http\Controllers\User\GetController::class, 'about'])->name('user.about');
    Route::get('/contact', [App\Http\Controllers\User\GetController::class, 'contact'])->name('user.contact');
    Route::get('/services', [App\Http\Controllers\User\GetController::class, 'services'])->name('user.services');
    Route::get('/produits', [App\Http\Controllers\User\GetController::class, 'produits'])->name('user.produits');
    Route::get('/panier', [App\Http\Controllers\User\GetController::class, 'paniers'])->name('user.paniers');
    Route::get('/mes-commandes', [App\Http\Controllers\User\GetController::class, 'mes_commandes'])->name('user.commandes')->middleware('auth:web');

    /* Panier Start */
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('/checkout', [SetController::class, 'checkout'])->name('users.checkout')->middleware('auth:web');
    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');


    /* Panier End */
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/maps', [App\Http\Controllers\User\GetController::class, 'maps'])->name('maps');
});
Route::group(['prefix' => 'vendeur','middleware' => ['auth:vendor']], function () {
    Route::get('/', [App\Http\Controllers\Vendor\GetController::class, 'index'])->name('vendor.index');
    Route::get('/profile', [App\Http\Controllers\Vendor\GetController::class, 'profile'])->name('vendor.profile');
    Route::get('/Nouvelle-Vente', [App\Http\Controllers\Vendor\GetController::class, 'nouvelle_vente'])->name('vendor.nouvelle_vente');
    Route::get('/Ancienne-Vente', [App\Http\Controllers\Vendor\GetController::class, 'ancienne_vente'])->name('venor.ancienne_ventes');
    Route::get('/Commandes', [App\Http\Controllers\Vendor\GetController::class, 'commandes'])->name('vendor.commandes');
    Route::get('/Commandes-ِConsulter{id}', [App\Http\Controllers\Vendor\GetController::class, 'Consulter_commandes'])->name('vendor.Consulter_commandes');
    Route::post('/Ajouter-Annonce', [App\Http\Controllers\Vendor\SetController::class, 'store_annonce'])->name('vendor.store.annonce');
    Route::post('/Modifier-Quantite-Cmd{id}', [App\Http\Controllers\Vendor\UpdateController::class, 'update_quantity_cmd'])->name('vendor.update.quantite');
    Route::post('/Cloture-Vente{id}', [App\Http\Controllers\Vendor\UpdateController::class, 'update_state_cmd'])->name('vendor.update.state');
    Route::post('/Changer-etat-produit{id}', [App\Http\Controllers\Vendor\UpdateController::class, 'update_state_product'])->name('vendor.update.status.product');
    Route::get('/Consulter-Produit{id}', [App\Http\Controllers\Vendor\GetController::class, 'show_product'])->name('vendor.show.product');
    Route::post('/Modifier-Produit{id}', [App\Http\Controllers\Vendor\UpdateController::class, 'update_product'])->name('vendor.update.product');


});
Route::get('Login_Vendeur', [LoginController::class, 'ShowloginVendor'])->name('vendor.login.show');
Route::post('Login_Vendeur', [LoginController::class, 'loginVendor'])->name('vendor.login.submit');
Route::get('Regsiter_Vendeur', [RegisterController::class, 'ShowRegsiterVendor'])->name('vendor.regsiter.show');
Route::post('Regsiter_Vendeur', [RegisterController::class, 'RegsiterVendor'])->name('vendor.regsiter.submit');
