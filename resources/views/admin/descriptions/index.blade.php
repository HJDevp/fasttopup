@extends('frontend-dashboard.admin.dashboard')

@section('main-principal')
<div>
    <div class="flex justify-end pr-1 mb-6">
        <button
          @click="openModal"
          class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
          Add Description
        </button>
    </div> 
    <div class="w-full ml-3 mb-4 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">ID</th>
                      <th class="px-4 py-3">Nom de la description</th>
                      <!-- <th class="px-4 py-3">Association</th> -->
                      <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                @if ($descriptions->isEmpty())
                  <tr class="w-full text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-center text-purple-600">
                     Aucune description n'est trouvé appuyer sur Add description pour en ajouter !
                    </td>
                  </tr>
                @else
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    @foreach ($descriptions as $description)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        {{ $description->id }}
                      </td>
                      
                      <td class="px-4 py-3 text-sm">
                        {{ $description->nom }}
                      </td>
    
                      <!-- <td class="px-4 py-3 text-sm"> 
                        {{ nl2br($description->description) }}
                      </td> -->
    
                      <td class="px-4 py-3 text-sm">
                        {{ $description->created_at }}
                      </td>
    
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <form action="{{ route('admin.description.edit', $description) }}" method="get">
                              @csrf  
                              
                              <button @click="openModal"
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
    
                            <form action="{{ route('admin.description.destroy', $description) }}" method="post">
                              @csrf
                              @method('DELETE')  
                             <button
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
                @endif
            </table>
        </div>
    </div>
    {{ $descriptions->links() }}

    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div
        x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      >
    <!-- Modal -->
    <div
      x-show="isModalOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0  transform translate-y-1/2"
      @click.away="closeModal"
      @keydown.escape="closeModal"
      class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
      role="dialog"
      id="modal"
    >
      <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
    <header class="flex justify-end">
      <button
        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
        aria-label="close"
        @click="closeModal"
      >
        <svg
          class="w-4 h-4"
          fill="currentColor"
          viewBox="0 0 20 20"
          role="img"
          aria-hidden="true"
        >
          <path
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"
            fill-rule="evenodd"
          ></path>
        </svg>
      </button>
    </header>
    <!-- Modal body -->
    <div class="mt-4 mb-6">
      <!-- Modal title -->
      <p
        class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
      >
       Add Description
      </p>
      <!-- Modal description -->
       
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form action="{{ route($description_->exists ? 'admin.description.update' : 'admin.description.store', $description_) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method($description_->exists ? 'put' : 'post')
                <!-- Nom de la description -->
                <div>
                    @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                    'name' => 'nom', 'label' => 'block text-sm', 'value' => $description_->nom ])  
                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                </div>
        
                <!-- Description -->
                <div>
                    @include('shared.input', ['class' => 'block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 
                    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray',
                    'name' => 'description', 'label' => 'block text-sm', 'type' => 'textarea', 'value' => $description_->description ])  
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
              
            
                <footer
                  class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
                >
                  <!-- Button -->
                    <div>
                        <button type="submit"
                            class="block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            @if($description_->exists)
                              Modifier
                            @else
                             Creer
                            @endif
                        </button>
                    </div>
                </footer>
            </form>
    </div>
</div>

@endsection

