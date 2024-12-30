@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
<div>
  <div class="flex justify-end pr-1 mb-6">
    <a href="{{ route('admin.create') }}" class="flex items-center justify-between cursor-pointer px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
      Create card-game
      <span class="ml-2" aria-hidden="true">+</span>
    </a>
  </div>
</div>
<div class="w-full ml-3 mb-4 overflow-hidden rounded-lg shadow-xs">
  <div class="w-full overflow-x-auto">
    <table class="w-full whitespace-no-wrap">
      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
          <th class="px-4 py-3">Cards</th>
          <th class="px-4 py-3">chemin Image</th>
          <th class="px-4 py-3">Date</th>
          <th class="px-4 py-3">Actions</th>
        </tr>
      </thead>
      
      <tbody
      class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
      >
        @if ($Allcardgames->isEmpty())
          <tr class="w-full text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-center text-purple-600">
             Aucune carte de jeux n'est trouvé appuyer sur Create card game pour en ajouter !
            </td>
          </tr>
        @endif
        @foreach ($Allcardgames as $cardgames)
        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3">
              <div class="flex items-center cursor-pointer text-sm">
                  <!-- Avatar with inset shadow -->
                  <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <a href="{{ $cardgames->ImageUrl() }}">
                           <img
                             class="object-cover w-full h-full rounded-full"
                             src="{{$cardgames->ImageUrl()}}"
                             alt=""
                             loading="lazy"
                           />
                           <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true">
                           </div> 
                      </div>
      
                      <div>
                        <p class="font-semibold">{{ $cardgames->nom }}</p>
                      </div>
                  </a>
              </div>
          </td>
  
          <td class="px-4 py-3 text-sm">
            <a href="{{ $cardgames->ImageUrl() }}">{{ $cardgames->chemin_image }}</a>
          </td>
  
          <td class="px-4 py-3 text-sm">
            {{ $cardgames->created_at }}
          </td>
          <td class="px-4 py-3">
            <div class="flex items-center space-x-4 text-sm">
              <form action="{{ route('admin.edit', $cardgames) }}" method="get">
                @csrf
                <button
                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                  aria-label="Edit"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                    ></path>
                  </svg>
                </button>
              </form>
  
              <form action="{{ route('admin.destroy', $cardgames) }}" method="post">
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
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>  
<!-- Pagination -->
<div class="m-3">
{{ $Allcardgames->links() }}
</div>
@endsection