<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('404 not found') }}
        </h2>
    </x-slot>
    @if(Session::has('status'))
        <div class="text-center p-6 max-w-screen bg-gray-300">
            <h1 class="text-blue-600">{{ Session::get('status') }}</h1>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <h1 class="text-2xl">The requested URL was not found on this server.</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
