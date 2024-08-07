<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.seller.update',$user->id)}}">
                        @csrf
                        @method('put')
                        <div class="flex gap-4 mt-5">
                            <div class="flex flex-col" style="width: 500px;">
                                <label for="category_id" class="text-gray-700 select-none font-medium">Duration Type</label>
                                <select name="limit_duration_type_id" id="limit_duration_type_id" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                    @foreach($limitDurationType as $type)
                                    <option value="{{$type->id}}">{{$type['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col" style="width: 500px;">
                                <label for="start_date" class="text-gray-700 select-none font-medium">Start Date</label>
                                <input type="date" name="start_date" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                            </div>
                        </div>
                        <div class="text-center mt-10 mb-10">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Update to Premiun</button>
                        </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var total = document.getElementById('limit_duration_type_id');
        console.log(total);
    })
</script>