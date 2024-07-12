<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.stockType.update',$stock->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                            <div class="flex flex-col space-y-2">
                                <label for="name" class="text-gray-700 select-none font-medium">Stock Name</label>
                                <input id="name" type="text" name="name" value="{{ old('stock',$stock->name) }}" placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="limit_quantity" class="text-gray-700 select-none font-medium">Limit quantity</label>
                                <input id="limit_quantity" type="text" name="limit_quantity" value="{{ old('stock', $stock->limit_quantity ) }}" placeholder="Enter stock" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>
                        
                        <div class="text-center mt-10 mb-10">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Update Product</button>
                        </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>