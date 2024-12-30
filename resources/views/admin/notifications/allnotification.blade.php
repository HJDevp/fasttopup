@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
    @php
       use Illuminate\Support\Carbon;
    @endphp
    <div class="mx-8">
        <div class="rounded-lg bg-white shadow-xs border-black transform hover:-translate-y-1 border-2 border-solid">
            <div class="block space-y-4 xl:p-12 p-6">
                <div>
                    <ul class="uppercase flex xl:flex justify-between items-center"">
                        <li>Type</li>
                        <li>Ids</li>
                        <li>Status</li>
                        <li>Lus le</li>
                        <li>Heure</li>
                    </ul>
                </div>

                <hr class="w-full lg:mb-6 md:mt-2 md:mb-4 mb-6" />

                <form action="{{ route('admin.markAsRead') }}" method="post" class="space-y-4">
                    @csrf
                    <div class="buttons flex justify-between">
                            <div class="mark-all flex items-center gap-4">
                                <div>
                                  @include('shared.check-box', ['class' => 'text-purple-600 focus:border-purple-400
                                  focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
                                  'type' => 'checkbox', 'label' => 'flex items-center dark:text-gray-400', 
                                  'name' => 'markAsRead', 'value' => 'tous_lus'])
                                </div>
                                <button type="submit" title="maquer tous comme lus" class="border-transparent outline-none underline cursor-pointer text-sm
                                ">
                                    Tous comme lus
                                </button>
                            </div>
                            
                            <div class="flex gap-2 items-center">
                                <button type="submit" name="lus" value="mettre_comme_lus" title="maquer comme lus"  class="underline cursor-pointer text-sm border-white outline-none
                                ">
                                    lus
                                </button>
            
                                <button type="submit" name="non_lus" value="mettre_comme_non_lus" title="maquer comme non lus" class="underline cursor-pointer text-sm border-white outline-none
                                ">
                                    non lus
                                </button>
        
                                <button type="submit" name="supprimer" value="supprimer" title="supprimer" class="underline cursor-pointer text-sm border-white outline-none
                                ">
                                    supprimer
                                </button>
                            </div>    
                    </div>
                
                
                    @foreach ($allnotifications as $allnotification)
        
                        <div class="flex justify-between items-center gap-4">
                           <div>
                             @include('shared.check-box', ['class' => 'text-purple-600 focus:border-purple-400
                             focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
                             'type' => 'checkbox', 'label' => 'flex items-center dark:text-gray-400', 
                             'value' => $allnotification->id, 'name' => 'allnotis'])
                           </div>
                           <div class="w-full xl:flex flex rounded-md items-center message bg-purple-600 py-2  bg-opacity-75">
                              <div class="w-full mx-3">
                                  <ul class="xl:flex block justify-between text-base font-mono">
                                       @if ($allnotification->type === 'App\Notifications\TransactionNotification')
                                        <li>Transactions</li>
                                       @elseif ($allnotification->type === 'App\Notifications\OrderItemNotification')
                                        <li>Commandes</li>
                                       @endif
                                       @foreach ($allnotification['data'] as $k => $v)
                                        <li class="text-justify">{{ substr($k, 20) }} {{ $v }}</li>
                                       @endforeach
                                       @if (is_null($allnotification->read_at))
                                         <li>non lus</li>
                                       @else 
                                         <li>lus</li> 
                                      @endif
                                     <li class="text-white text-opacity-75">{{ Carbon::parse($allnotification->updated_at)->diffForHumans() }}</li>
                                  </ul>
                              </div>
                           </div>
                        </div>
                        
                    @endforeach

                    <div class="delete-all flex items-center gap-4">
                        <div>
                          @include('shared.check-box', ['class' => 'text-purple-600 focus:border-purple-400
                          focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray',
                          'type' => 'checkbox', 'label' => 'flex items-center dark:text-gray-400', 
                          'name' => 'tout_supprimer', 'value' => 'tout_supprimer'])
                        </div>
                        <button type="submit"  title="tout supprimé" class="border-transparent outline-none underline cursor-pointer text-sm
                        ">
                            Tout supprimé
                        </button>
                    </div>
                </form>    
            </div>         
        </div>
    </div>

<div class="mx-8 my-3">
 {{ $allnotifications->links() }}
</div>   
@endsection 