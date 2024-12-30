@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')

<div class="w-full ml-3 mb-4 overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                  class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                  <th class="px-4 py-3">Users/infoTransactions</th>
                  <!-- <th class="px-4 py-3">Qty Dia</th> -->
                  <th class="px-4 py-3">Montant</th>
                  <th class="px-4 py-3">Telephone</th>
                  <th class="px-4 py-3">Capture du paiement</th>
                  <th class="px-4 py-3">Status</th>
                  <th class="px-4 py-3 text-center">Actions</th>
                  <th class="px-4 py-3 text-center">Super~admin</th>
                </tr>
            </thead>
            @php
              use App\Models\Avatars;
              use App\Models\FreeFireCard;
            @endphp 
            @if ($transactions->isEmpty())
              <tr class="w-full text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-center text-purple-600">
                 Aucune transaction n'est trouvé !
                </td>
              </tr>
            @else
            <tbody
                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
              >
                @foreach ($transactions as $transaction)
                <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                      <!-- Avatar with inset shadow -->
                      <div
                        class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                      >
                        @php
                            $avatar_id = $transaction->user->avatars_id;
                            if(empty($avatar_id)){
                             $lottery_start = 1;
                             $lottery_end   = 8;
                             $random        = rand($lottery_start, $lottery_end);
                             $avatar_id     = $random;
                            } 
                            $avatar = Avatars::findOrFail($avatar_id);

                             //FreeFireCard
                             $freefirecard_id = $transaction->free_fire_card_id;
                             $freefirecard = FreeFireCard::findOrFail($freefirecard_id);
                        @endphp
                        <img
                          class="object-cover w-full h-full rounded-full"
                          src="{{ $avatar->avatarUrl() }}"
                          alt=""
                          loading="lazy"
                        />
                        <div
                          class="absolute inset-0 rounded-full shadow-inner"
                          aria-hidden="true"
                        ></div>
                      </div>
                      <div>
                        <p class="font-semibold">{{ $transaction->nom }} {{ $transaction->prenom }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         {{ $transaction->user->email }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         player id : {{ $transaction->player_id }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         Qty : {{ $transaction->FreeFireCard->quantite_diamons }} diamants
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         date_c : {{ $transaction->created_at }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         date_m : {{ $transaction->updated_at }}
                        </p>
                      </div>
                    </div>
                  </td>
                    <!-- Id player
                    <td class="px-4 py-3 text-xs">
                     {{ $transaction->player_id }}
                    </td> -->

                    <!-- Qty Diamants -->
                    <!-- <td class="px-4 py-3 text-xs">
                     {{ $transaction->FreeFireCard->quantite_diamons }}
                    </td> -->
                  
                    <!-- Montant -->
                    <td class="px-4 py-3 text-xs">
                       {{ $transaction->montant }} HTG
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         {{ $transaction->methode_de_paiement }}
                        </p>
                    </td>

                    <!-- Telephone -->
                    <td class="px-4 py-3 text-xs">
                       {{ $transaction->telephone }}
                    </td>

                    <td class="px-4 py-3 text-xs">
                      <a href="{{ $transaction->captureTransaction() }}" class="cursor-pointer underline text-purple-600" >Voir la capture</a>
                    </td>
                    
                    @if ($transaction->status === 'en attente')
                        <td class="px-4 py-1 text-xs">
                          <span class="px-2 py-1 font-semibold leading-tight text-white bg-yellow-300 rounded-full
                         dark:bg-yellow-400 dark:text-gray-300">
                          {{ $transaction->status }}
                          </span>
                        </td>
                    @elseif ($transaction->status === 'validé')
                        <td class="px-4 py-1 text-xs">
                          <span class="px-2 py-1 font-semibold leading-tight text-white bg-green-400 rounded-full
                         dark:bg-green-500 dark:text-gray-300">
                          {{ $transaction->status }}
                          </span>
                        </td>
                    @elseif ($transaction->status === 'echoué')
                        <td class="px-4 py-1 text-xs">
                          <span class="px-2 py-1 font-semibold leading-tight text-white bg-red-500 rounded-full
                         dark:bg-red-600 dark:text-gray-300">
                          {{ $transaction->status }}
                          </span>
                        </td>
                    @endif


                  <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                      <!-- Cas si la transaction est mise en attente  -->
                        @if ($transaction->status === 'en attente')
                          <!-- desactivation en attente -->
                          <form action="{{ route('admin.transaction.pending', $transaction) }}" method="post">
                            @csrf  
                            <button disabled
                              class="flex bg-opacity-50 items-center hover:bg-yellow-400 justify-between px-2 py-2 text-xs font-medium bg-yellow-300 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="pending"
                            >
                              en attente
                            </button>
                          </form>  
                          <!-- activation successfully -->
                          <form action="{{ route('admin.transaction.successfully', $transaction) }}" method="post">
                            @csrf 
                            <button
                             class="flex items-center hover:bg-green-600 justify-between px-2 py-2 text-xs font-medium bg-green-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="successfully"
                            >
                             success
                            </button>
                          </form>
                          <!-- activation failed -->
                          <form action="{{ route('admin.transaction.failed', $transaction) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center hover:bg-red-700 justify-between px-2 py-2 text-xs font-medium bg-red-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            échoué
                           </button>
                          </form>

                          <!-- Cas si la transaction est validé -->
                        @elseif ($transaction->status === 'validé')    
                          <!-- activation en attente -->
                          <form action="{{ route('admin.transaction.pending', $transaction) }}" method="post">
                            @csrf  
                            <button
                              class="flex items-center hover:bg-yellow-400 justify-between px-2 py-2 text-xs font-medium bg-yellow-300 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="pending"
                            >
                              en attente
                            </button>
                          </form>  
                          <!-- desactivation successfully -->
                          <form action="{{ route('admin.transaction.successfully', $transaction) }}" method="post">
                            @csrf 
                            <button disabled
                             class="flex items-center bg-opacity-50 hover:bg-green-600 justify-between px-2 py-2 text-xs font-medium bg-green-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="successfully"
                            >
                             success
                            </button>
                          </form>
                          <!-- activation failed -->
                          <form action="{{ route('admin.transaction.failed', $transaction) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center hover:bg-red-700 justify-between px-2 py-2 text-xs font-medium bg-red-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            échoué
                           </button>
                          </form>

                          <!-- Cas si la transaction a connue une echéc  -->
                        @elseif ($transaction->status === 'echoué')
                          <!-- activation en attente -->
                          <form action="{{ route('admin.transaction.pending', $transaction) }}" method="post">
                            @csrf  
                            <button
                              class="flex items-center hover:bg-yellow-400 justify-between px-2 py-2 text-xs font-medium bg-yellow-300 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="pending"
                            >
                              en attente
                            </button>
                          </form>  
                          <!-- activation successfully -->
                          <form action="{{ route('admin.transaction.successfully', $transaction) }}" method="post">
                            @csrf 
                            <button
                             class="flex items-center hover:bg-green-600 justify-between px-2 py-2 text-xs font-medium bg-green-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="successfully"
                            >
                             success
                            </button>
                          </form>
                          <!-- desactivation failed -->
                          <form action="{{ route('admin.transaction.failed', $transaction) }}" method="post">
                            @csrf 
                           <button disabled
                             class="flex items-center bg-opacity-50 hover:bg-red-700 justify-between px-2 py-2 text-xs font-medium bg-red-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            échoué
                           </button>
                          </form>
                        @endif

                    </div>
                  </td>

                  @can('delete', $transaction)
                  <td class="px-4 py-3">
                    <div class="flex justify-center items-center space-x-4 text-sm">
                      <form action="{{ route('admin.transaction.destroy', $transaction) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                          aria-label="Delete"
                        >
                          <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </form>
                    </div>
                  </td>
                  @endcan
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="m-3 mb-20">
{{ $transactions->links() }}
</div>
@endsection

