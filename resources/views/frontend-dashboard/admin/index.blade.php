@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
<!-- Cards -->
<div class="grid gap-6 mx-8 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card Total clients-->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                </path>
            </svg>
        </div>

        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total clients
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
               <a href="">{{ $TotalClients }}</a> 
            </p>
        </div>
    </div>

    <!-- Balance total -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Balance du compte
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
               <a href="">{{ $TotalBalance }} HTG</a> 
            </p>
        </div>
    </div>

    <!-- Le nombre de Commandes -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                </path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Commandes
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="{{ route('admin.commande.index') }}">{{ $TotalCommandes }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre Total de Transactions -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Transactions
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="{{ route('admin.transaction.index') }}">{{ $TotalTransactions }}</a>
            </p>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Le nombre Total de cartes -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total cartes
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="{{ route('admin.cardgame.index') }}">{{ $TotalCards }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre Total de transactions validé -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Transactions validé
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ $TotalTransactionSuccess }}</a>
            </p>
        </div>
    </div>
    
    <!-- Le nombre Total de transactions echoué -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
           
            </div>
            <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Transactions echoué
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ $TotalTransactionFailed }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre Total de transactions en attente -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Transactions en attente
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ $TotalTransactionPending }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre Total de transactions remboursé -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Transactions remboursé
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ $TotalTransactionRefund }}</a>
            </p>
        </div>
    </div>
    
    <!-- Le nombre Total de commandes validé -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Commandes reussi
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ $TotalCommandesSuccess }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre Total de commandes echoué -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Commandes echoué
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ $TotalCommandesFailed }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre Total de commandes en cours -->
    <div class="flex items-center p-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Commandes en cours
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ $TotalCommandesPending }}</a>
            </p>
        </div>
    </div>
</div>

<!--  Separations des composants -->
<hr class="text-2xl text-white m-8">

<div class="grid gap-6 mx-8 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Le nombre total de freefire cards -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte freefire
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
               <a href="{{ route('admin.freefire.cards.index') }}">{{ $TotalFreeFireCards }}</a> 
            </p>
        </div>
    </div>

    <!-- Le nombre total de carte pubg mobile -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4  text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte PUBG MOBILE
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
               <a href="">{{ 0 }}</a>
            </p>
        </div>
    </div>
    <!-- Le nombre total de carte steam -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4  text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte steam
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ 0 }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre total de carte netflix -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte netflix
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ 0 }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre total de carte google pay -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4  text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte google pay
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ 0 }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre total de carte xbox-game pass -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4  text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte xbox game pass
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ 0 }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre total de carte visa -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4  text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte visa
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ 0 }}</a>
            </p>
        </div>
    </div>

    <!-- Le nombre total de carte maestro -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4  text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">
           
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Carte maestro
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                <a href="">{{ 0 }}</a>
            </p>
        </div>
    </div>
</div>
@endsection
