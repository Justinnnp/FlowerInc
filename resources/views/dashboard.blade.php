<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                <h1 class="mb-2">Welkom {{ Auth::user()->name }}, leuk dat je er bent!</h1>
                <button type="button" onclick="window.location='/'" class="text-blue-600 border-2 rounded p-2">Home</button>
                <button type="button" onclick="window.location='{{ route("stocks.index") }}'" class="text-blue-600 border-2 rounded p-2">Stocks</button>
                <button type="button" onclick="window.location='{{ route("users.index") }}'" class="text-blue-600 border-2 rounded p-2">Users</button>
            </div>
        </div>
    </div>
</x-app-layout>
