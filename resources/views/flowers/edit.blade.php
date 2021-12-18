<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Flower
        </h2>
    </x-slot>
    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('flowers.update', ['stock' => $stock, 'flower' => $flower]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">name</label>
                            <input type="text" name="name" id="name"
                                   class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('name', $flower->name) }}"/>
                            @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="photo_url" class="block font-medium text-sm text-gray-700 text-xl mt-5 text-blue-600 opacity-50">upload photo <i class="fas fa-upload"></i></label>
                            <input type="file" name="photo_url" id="photo_url"
                                   class="form-input rounded-md shadow-sm mt-1 block w-full opacity-0"
                                   value="{{ old('photo_url', '') }}"/>
                            @error('photo_url')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <img src="{{ asset('storage/images/' . $flower->photo_url) }}" alt="weep">
                            <label for="total" class="block font-medium text-sm text-gray-700">total</label>
                            <input type="number" name="total" id="total"
                                   class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('total', $total->total) }}"/>
                            @error('total')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
