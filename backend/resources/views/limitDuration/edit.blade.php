<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.limitDuration.update',$limitDuration->id)}}">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">Name Duration</label>
                            <input id="name" type="text" value="{{ old('name',$limitDuration->price) }}" name="price" placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">Name Duration</label>
                            <input id="name" type="number" value="{{old('durations', $limitDuration->durations)}}" name="durations" placeholder="Enter duration" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">Duration name</label>
                            <select id="limit_duration_type_id" name="limit_duration_type_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                @foreach($durationType as $type)
                                <option value="{{$type->id}}" {{ $type->id == old('limit_duration_type_id', $limitDuration->limit_duration_type_id) ? 'selected' : '' }}>{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center mt-10 mb-10">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Update</button>
                        </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>