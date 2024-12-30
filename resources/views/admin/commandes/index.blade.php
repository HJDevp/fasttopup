@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')

<div class="w-full ml-3 mb-4 overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                  class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                  <th class="px-4 py-3">Users/infoorderItems</th>
                  <th class="px-4 py-3">Qty Dia</th>
                  <th class="px-4 py-3">Montant</th>
                  <th class="px-4 py-3">Status</th>
                  <th class="px-4 py-3 text-center">Actions</th>
                  <th class="px-4 py-3 text-center">Super~Admin</th>
                </tr>
            </thead>
            @php
              use App\Models\Avatars;
            @endphp 
            @if ($orderItems->isEmpty())
              <tr class="w-full text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-center text-purple-600">
                 Aucune commande n'est trouvé !
                </td>
              </tr>
            @else
            <tbody
                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
              >
                @foreach ($orderItems as $orderItem)
                <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                      <!-- Avatar with inset shadow -->
                      <div
                        class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                      >
                        @php
                            $avatar_id = $orderItem->user->avatars_id;
                            if(empty($avatar_id)){
                             $lottery_start = 1;
                             $lottery_end   = 8;
                             $random        = rand($lottery_start, $lottery_end);
                             $avatar_id     = $random;
                            } 
                            $avatar = Avatars::findOrFail($avatar_id);
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
                        <p class="font-semibold">{{ $orderItem->user->nom }} {{ $orderItem->user->prenom }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         {{ $orderItem->user->email }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         Date_c :{{ $orderItem->created_at }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         Date_m :{{ $orderItem->updated_at }}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                         Id :{{ $orderItem->user->id }}
                        </p>
                      </div>
                    </div>
                  </td>
                    <!-- Id player
                    <td class="px-4 py-3 text-xs">
                     {{ $orderItem->player_id }}
                    </td> -->

                    <!-- Qty Diamants -->
                    <td class="px-4 py-3 text-xs">
                     {{ $orderItem->FreeFireCard->quantite_diamons }}
                    </td>
                  
                    <!-- Montant -->
                    <td class="px-4 py-3 text-xs">
                       {{ $orderItem->FreeFireCard->prix }} HTG
                    </td>
                    
                    @if ($orderItem->status === 'en cours')
                        <td class="px-4 py-1 text-xs">
                          <span class="px-2 py-1 font-semibold leading-tight text-white bg-blue-600 rounded-full
                         dark:bg-blue-700 dark:text-gray-300">
                          {{ $orderItem->status }}
                          </span>
                        </td>
                    @elseif ($orderItem->status === 'reussi')
                        <td class="px-4 py-1 text-xs">
                          <span class="px-2 py-1 font-semibold leading-tight text-white bg-green-400 rounded-full
                         dark:bg-green-500 dark:text-gray-300">
                          {{ $orderItem->status }}
                          </span>
                        </td>
                    @elseif ($orderItem->status === 'échoué')
                        <td class="px-4 py-1 text-xs">
                          <span class="px-2 py-1 font-semibold leading-tight text-white bg-red-500 rounded-full
                         dark:bg-red-600 dark:text-gray-300">
                          {{ $orderItem->status }}
                          </span>
                        </td>
                    @elseif ($orderItem->status === 'remboursé')
                        <td class="px-4 py-1 text-xs">
                          <span class="px-2 py-1 font-semibold leading-tight text-white bg-teal-400 rounded-full
                         dark:bg-teal-500 dark:text-gray-300">
                          {{ $orderItem->status }}
                          </span>
                        </td>
                    @endif


                  <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                      <!-- Cas si la orderItem est mise en attente  -->
                        @if ($orderItem->status === 'en cours')
                          <!-- desactivation en attente -->
                          <form action="{{ route('admin.commande.pending', $orderItem) }}" method="post">
                            @csrf  
                            <button disabled
                              class="flex bg-opacity-50 items-center hover:bg-blue-600 justify-between px-2 py-2 text-xs font-medium bg-blue-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="pending"
                            >
                              en cours
                            </button>
                          </form>  
                          <!-- activation successfully -->
                          <form action="{{ route('admin.commande.successfully', $orderItem) }}" method="post">
                            @csrf 
                            <button
                             class="flex items-center hover:bg-green-600 justify-between px-2 py-2 text-xs font-medium bg-green-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="successfully"
                            >
                             reussi
                            </button>
                          </form>
                          <!-- activation failed -->
                          <form action="{{ route('admin.commande.failed', $orderItem) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center hover:bg-red-700 justify-between px-2 py-2 text-xs font-medium bg-red-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            échoué
                           </button>
                          </form>

                          <!-- activation rembourse -->
                          <form action="{{ route('admin.commande.refund', $orderItem) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center hover:bg-teal-500 justify-between px-2 py-2 text-xs font-medium bg-teal-400 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            remboursé
                           </button>
                          </form>

                          <!-- Cas si la orderItem est validé -->
                        @elseif ($orderItem->status === 'reussi')    
                          <!-- activation en attente -->
                          <form action="{{ route('admin.commande.pending', $orderItem) }}" method="post">
                            @csrf  
                            <button
                              class="flex items-center hover:bg-blue-500 justify-between px-2 py-2 text-xs font-medium bg-blue-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="pending"
                            >
                              en cours
                            </button>
                          </form>  
                          <!-- desactivation successfully -->
                          <form action="{{ route('admin.commande.successfully', $orderItem) }}" method="post">
                            @csrf 
                            <button disabled
                             class="flex items-center bg-opacity-50 hover:bg-green-600 justify-between px-2 py-2 text-xs font-medium bg-green-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="successfully"
                            >
                             reussi
                            </button>
                          </form>
                          <!-- activation failed -->
                          <form action="{{ route('admin.commande.failed', $orderItem) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center hover:bg-red-700 justify-between px-2 py-2 text-xs font-medium bg-red-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            échoué
                           </button>
                          </form>

                          <!-- activation rembourse -->
                          <form action="{{ route('admin.commande.refund', $orderItem) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center hover:bg-teal-500 justify-between px-2 py-2 text-xs font-medium bg-teal-400 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            remboursé
                           </button>
                          </form>

                          <!-- Cas si la orderItem a connue une echéc  -->
                        @elseif ($orderItem->status === 'échoué')
                          <!-- activation en attente -->
                          <form action="{{ route('admin.commande.pending', $orderItem) }}" method="post">
                            @csrf  
                            <button
                              class="flex items-center hover:bg-blue-500 justify-between px-2 py-2 text-xs font-medium bg-blue-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="pending"
                            >
                              en cours
                            </button>
                          </form>  
                          <!-- activation successfully -->
                          <form action="{{ route('admin.commande.successfully', $orderItem) }}" method="post">
                            @csrf 
                            <button
                             class="flex items-center hover:bg-green-600 justify-between px-2 py-2 text-xs font-medium bg-green-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="successfully"
                            >
                             reussi
                            </button>
                          </form>
                          <!-- desactivation failed -->
                          <form action="{{ route('admin.commande.failed', $orderItem) }}" method="post">
                            @csrf 
                           <button disabled
                             class="flex items-center bg-opacity-50 hover:bg-red-700 justify-between px-2 py-2 text-xs font-medium bg-red-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            échoué
                           </button>
                          </form>

                          <!-- desactivation rembourse -->
                          <form action="{{ route('admin.commande.refund', $orderItem) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center  hover:bg-teal-500 justify-between px-2 py-2 text-xs font-medium bg-teal-400 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            remboursé
                           </button>
                          </form>
                          <!--  cas ou la commande a connue une remboursement -->
                        @elseif ($orderItem->status === 'remboursé')
                          <!-- activation en attente -->
                          <form action="{{ route('admin.commande.pending', $orderItem) }}" method="post">
                            @csrf  
                            <button
                              class="flex items-center hover:bg-blue-500 justify-between px-2 py-2 text-xs font-medium bg-blue-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="pending"
                            >
                              en cours
                            </button>
                          </form>  
                          <!-- activation successfully -->
                          <form action="{{ route('admin.commande.successfully', $orderItem) }}" method="post">
                            @csrf 
                            <button
                             class="flex items-center hover:bg-green-600 justify-between px-2 py-2 text-xs font-medium bg-green-500 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="successfully"
                            >
                             reussi
                            </button>
                          </form>
                          <!-- activation failed -->
                          <form action="{{ route('admin.commande.failed', $orderItem) }}" method="post">
                            @csrf 
                           <button
                             class="flex items-center hover:bg-red-700 justify-between px-2 py-2 text-xs font-medium bg-red-600 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            échoué
                           </button>
                          </form>

                          <!-- desactivation rembourse -->
                          <form action="{{ route('admin.commande.refund', $orderItem) }}" method="post">
                            @csrf 
                           <button disabled
                             class="flex items-center bg-opacity-50 hover:bg-teal-500 justify-between px-2 py-2 text-xs font-medium bg-teal-400 leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                             aria-label="failed"
                           >
                            remboursé
                           </button>
                          </form>
                        @endif

                    </div>
                  </td>
                  @can('delete', $orderItem)
                  <td class="px-4 py-3">
                    <div class="flex justify-center items-center space-x-4 text-sm">
                      <form action="{{ route('admin.commande.destroy', $orderItem)}}" method="post">
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
{{ $orderItems->links() }}
</div>
@endsection

