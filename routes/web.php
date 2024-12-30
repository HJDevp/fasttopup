<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Avatars\AvatarsController;
use App\Http\Controllers\CardGames\CardGamesController;
use App\Http\Controllers\Descriptions\DescriptionsController;
use App\Http\Controllers\Faqs\FaqsController;
use App\Http\Controllers\FreeFireCards\FreeFireCardsController;
use App\Http\Controllers\Notifications\NotificationsController;
use App\Http\Controllers\OrderItems\OrderItemsController;
use App\Http\Controllers\PrivacyPolicy\PrivacyPolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TermsAndConditions\TermsAndConditionsController;
use App\Http\Controllers\Transactions\TransactionController;
use App\Http\Controllers\Users\UserController;
use App\Models\Faqs;
use App\Models\Transactions;
use Illuminate\Support\Facades\Route;

$RegexCard = '[0-9]+';
Route::get('/', [CardGamesController::class, 'home'])->name('home');

// Privacy policy
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'privacyPolicy'])
->name('privacy-policy');

// Terms And Conditions
Route::get('terms-and-conditions/', [TermsAndConditionsController::class, 'termsAndConditions'])
->name('terms-and-conditions');

// Dashboard user 
Route::prefix('/user/dashboard/')->middleware(['auth', 'verified', 'role:utilisateur'])
  ->group( function () {
  
  Route::get('commandes', [UserController::class, 'orderItems'])->name('dashboard');
  
  Route::get('transactions', [UserController::class, 'transactions'])
  ->name('transactions');

  Route::get('checkout/{freefirecard}', [UserController::class, 'checkout'])
  ->name('checkout');

  Route::get('process-paiement/{freefirecard}', [UserController::class, 'process'])
  ->name('process');

  Route::post('transactions/search-transactions-by-month', 
  [UserController::class, 'searchTransactionsByMonth'])->name('search-transaction-by-month');
  Route::post('paiement-presucces/{freefirecard}', 
  [TransactionController::class, 'controlTransaction'])
  ->name('controlTransaction');

  // Free Fire cards
  Route::get('Freefire/allcards', [FreeFireCardsController::class, 'home'])
  ->name('freefire.cards.home');


  // Notifications For User
  Route::get('notifications/allnotifications', [NotificationsController::class, 'userIndex'])
  ->name('user.notification.index');
  
  Route::get('notifications/orderItems', [NotificationsController::class, 'userOrderItemsNotifications'])
  ->name('user.orderItemsNotifications');

  Route::get('notifications/transactions', [NotificationsController::class, 'userTransactionsNotifications'])
  ->name('user.transactionsNotifications');

  Route::post('notifications/', [NotificationsController::class, 'markAsRead'])
  ->name('user.markAsRead');

});

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard Admin
Route::prefix('admin/dashboard/')->middleware(['auth', 'verified', 'role:super~administrateur'])
  ->name('admin.')->group( function (){
  Route::get('', [AdminController::class, 'home'])->name('home.dashboard');
  Route::get('', [AdminController::class, 'AllCardComponents'])->name('home.dashboard');

  // Avatar for user
  Route::get('avatar/', [AvatarsController::class, 'index'])->name('avatar.index');
  Route::get('avatar/create', [AvatarsController::class, 'create'])->name('avatar.create');
  Route::post('avatar', [AvatarsController::class, 'store'])->name('avatar.store');

  Route::get('avatar/avatar/{avatar}/edit', [AvatarsController::class, 'edit'])->name('avatar.edit');
  Route::put('avatar/{avatar}', [AvatarsController::class, 'update'])->name('avatar.update');
  Route::delete('avatar/{avatar}', [AvatarsController::class, 'destroy'])->name('avatar.destroy');

  // Faqs
  Route::get('faqs/', [FaqsController::class, 'index'])->name('faqs.index');
  Route::get('faqs/create', [FaqsController::class, 'create'])->name('faqs.create');
  Route::post('faqs', [FaqsController::class, 'store'])->name('faqs.store');

  Route::get('faqs/faqs/{faqs}', [FaqsController::class, 'edit'])->name('faqs.edit');
  Route::put('faqs/{faqs}', [FaqsController::class, 'update'])->name('faqs.update');
  Route::delete('faqs/{faqs}', [FaqsController::class, 'destroy'])->name('faqs.destroy');


  // Card games
  Route::get('card-games/',[CardGamesController::class, 'index'])->name('cardgame.index');
  Route::get('create-card-game', [CardGamesController::class, 'create'])->name('create');
  Route::post('card-game', [CardGamesController::class, 'store'])->name('store');

  Route::get('card-game/cardgame/{cardgames}/edit', [CardGamesController::class, 'edit'])
  ->name('edit');
  Route::put('card-game/{cardgames}', [CardGamesController::class, 'update'])
  ->name('update');
  Route::delete('card-game/{cardgames}', [CardGamesController::class, 'destroy'])
  ->name('destroy');

  // Descriptions for cards games
  Route::get('description/', [DescriptionsController::class, 'index'])
  ->name('description.index');
  // Route::get('description/create', [DescriptionsController::class, 'create'])->name('description.create');
  Route::post('description', [DescriptionsController::class, 'store'])
  ->name('description.store');

  Route::get('description/description/{description}', [DescriptionsController::class, 'edit'])
  ->name('description.edit');
  Route::put('description/{description}', [DescriptionsController::class, 'update'])
  ->name('description.update');
  Route::delete('description/{description}', [DescriptionsController::class, 'destroy'])
  ->name('description.destroy');

  // Free Fire card Games
  Route::get('Freefire', [FreeFireCardsController::class, 'index'])
  ->name('freefire.cards.index');
  Route::get('Freefire/create', [FreeFireCardsController::class, 'create'])
  ->name('freefire.create');
  Route::post('Freefire', [FreeFireCardsController::class, 'store'])
  ->name('freefire.store');
  
  Route::get('Freefire/freefire/{freeFireCard}/edit', [FreeFireCardsController::class, 'edit'])
  ->name('freefire.edit');
  Route::put('Freefire/{freeFireCard}', [FreeFireCardsController::class, 'update'])
  ->name('freefire.update');
  Route::delete('Freefire/{freeFireCard}', [FreeFireCardsController::class, 'destroy'])
  ->name('freefire.destroy');
 
})->where([
  'cardgames'    => $RegexCard,
  'freeFireCard' => $RegexCard,
  'description'  => $RegexCard,
  'avatar'       => $RegexCard,
  'faqs'         => $RegexCard,
]);


// Route pour les transactions et commandes
Route::prefix('admin/dashboard/')->middleware(['auth', 'verified', 'role:super~administrateur'])
  ->name('admin.')->group( function (){
  Route::get('transactions/index', [TransactionController::class, 'index'])
  ->name('transaction.index');
  
  Route::post('transactions/{transaction}/pending', 
  [TransactionController::class, 'pending'])
  ->name('transaction.pending');

  Route::post('transactions/{transaction}/successfully', 
  [TransactionController::class, 'successfully'])
  ->name('transaction.successfully');

  Route::post('transactions/{transaction}/failed', [TransactionController::class, 'failed'])
  ->name('transaction.failed');
  
  Route::delete('transaction/{transaction}', [TransactionController::class, 'destroy'])
  ->name('transaction.destroy');


  // Commandes
  Route::get('commandes/index', [OrderItemsController::class, 'index'])
  ->name('commande.index');

  Route::post('commandes/{orderItem}/pending', [OrderItemsController::class, 'pending'])
  ->name('commande.pending');

  Route::post('commandes/{orderItem}/successfully', [OrderItemsController::class, 'successfully'])
  ->name('commande.successfully');

  Route::post('commandes/{orderItem}/failed', [OrderItemsController::class, 'failed'])
  ->name('commande.failed');

  Route::post('commandes/{orderItem}/remboursé', [OrderItemsController::class, 'refund'])
  ->name('commande.refund');

  Route::delete('commande/{orderItem}', [OrderItemsController::class, 'destroy'])
  ->name('commande.destroy');

  // Notifications
  Route::get('notifications/allnotifications', [NotificationsController::class, 'index'])
  ->name('notification.index');
  
  Route::get('notifications/orderItems', [NotificationsController::class, 'orderItemsNotifications'])
  ->name('orderItemsNotifications');

  Route::get('notifications/transactions', [NotificationsController::class, 'transactionsNotifications'])
  ->name('transactionsNotifications');

  Route::post('notifications/', [NotificationsController::class, 'markAsRead'])
  ->name('markAsRead');

})->where([
  'transaction' => $RegexCard,
  'orderItem'    => $RegexCard,
]);


require __DIR__.'/auth.php';
