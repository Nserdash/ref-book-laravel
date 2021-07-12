<div class="pt-12 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 flex flex-row">
            <div class="hidden space-x-8 sm:-my-px sm:mr-10 sm:flex">
                <x-nav-link :href="route('journal')" :active="Route::is('journal' ) ? 'active' : ''">
                {{ __('Справочник') }}
                </x-nav-link>
            </div>

            
            <div class="hidden space-x-8 sm:-my-px sm:mr-10 sm:flex">
                <x-nav-link :href="route('authors')" :active="Route::is('authors','authors.sortby' ) ? 'active' : ''" >
                {{ __('Авторы') }}
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:mr-10 sm:flex">
                <x-nav-link :href="route('journals.notpublicated')" :active="Route::is('journals.notpublicated' ) ? 'active' : ''" >
                {{ __('Черновики') }}
                </x-nav-link>
            </div>

        </div>
</div>