@extends('frontend-dashboard.user-dashboard.dashboard')
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
                        <li>Heure</li>
                    </ul>
                </div>

                <hr class="w-full lg:mb-6 md:mt-2 md:mb-4 mb-6" />

                @foreach ($orderItemsNotifications as $orderItemsNotification)
                  @if ($orderItemsNotification->read_at == null)
                    <div class="w-full xl:flex flex rounded-md items-center message bg-purple-600 py-2  bg-opacity-75">
                        <div class="w-full mx-3">
                            <ul class="xl:flex block justify-between text-base font-mono">
                                @if ($orderItemsNotification->type === 'App\Notifications\TransactionNotification')
                                 <li>Transactions</li>
                                @elseif ($orderItemsNotification->type === 'App\Notifications\OrderItemNotification')
                                 <li>Commandes</li>
                                @endif
                                @foreach ($orderItemsNotification['data'] as $k => $v)
                                 <li class="text-justify">{{ $k }} : {{ $v }}</li>
                                @endforeach
                               <li class="text-white text-opacity-75">{{ Carbon::parse($orderItemsNotification->updated_at)->diffForHumans() }}</li>
                            </ul>
                        </div>
                    </div>
                   @else 
                    <!-- No Commandes -->
                     <p class="font-mono text-sm text-purple-600">Pas de notification pour les commandes</p>
                   @endif
                @endforeach
            </div>         
        </div>
    </div>
  <div class="mx-8 my-3">
   {{ $orderItemsNotifications->links() }}
  </div>   
@endsection 