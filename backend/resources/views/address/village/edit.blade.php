<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.village.update',$village->id)}}">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">commune Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name',$village->name) }}" placeholder="Enter name" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">commune Name</label>
                            <select name="commune_id" id="" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                @foreach($communes as $commune)
                                <option value="{{$commune->id}}" @if($commune->id == $village->commune_id) selected @endif>{{$commune->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center mt-16 mb-16">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Update village</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>