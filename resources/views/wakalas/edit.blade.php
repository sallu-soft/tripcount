<form id="editWakalaForm" action="{{ route('wakalas.update', $wakala->id) }}" method="POST" class="space-y-6 grid grid-cols-2">
    @csrf
    @method('PUT')
    
    <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
        <h2 class="text-lg font-medium text-gray-900 mb-6 pb-2 border-b border-gray-200">Wakala Information</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Invoice -->
            <div class="col-span-1">
                <label for="invoice" class="block text-sm font-medium text-gray-700 mb-2">Invoice Number</label>
                <div class="relative rounded-md shadow-sm">
                    <input type="text" name="invoice" id="invoice" required readonly
                        value="{{ $wakala->invoice }}"
                        class="block w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 text-gray-700 focus:border-blue-500 focus:ring-blue-500">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Date -->
            <div class="col-span-1">
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <div class="relative rounded-md shadow-sm">
                    <input type="date" name="date" id="date" required
                        value="{{ \Carbon\Carbon::parse($wakala->date)->format('Y-m-d') }}"
                        class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
            
            <!-- Visa -->
            <div class="col-span-1">
                <label for="visa" class="block text-sm font-medium text-gray-700 mb-2">Visa</label>
                <input type="text" name="visa" id="visa" required
                    value="{{ $wakala->visa }}"
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <!-- ID Number -->
            <div class="col-span-1">
                <label for="id_no" class="block text-sm font-medium text-gray-700 mb-2">ID Number</label>
                <input type="text" name="id_no" id="id_no" required
                    value="{{ $wakala->id_no }}"
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
        <h2 class="text-lg font-medium text-gray-900 mb-6 pb-2 border-b border-gray-200">Agent & Supplier Details</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Agent -->
            <div class="col-span-1">
                <label for="agent" class="block text-sm font-medium text-gray-700 mb-2">Agent</label>
                <select name="agent" id="agent" required
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select Agent</option>
                    @foreach($agents as $id => $name)
                        <option value="{{ $id }}" {{$wakala->agent == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Supplier -->
            <div class="col-span-1">
                <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                <select name="supplier" id="supplier" required
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select Supplier/Agent</option>
                    <optgroup label="Suppliers">
                        @foreach($suppliers as $id => $name)
                            <option value="supplier_{{ $id }}" {{ $wakala->agent_supplier == 'supplier' && $wakala->supplier == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Agents">
                        @foreach($agents as $id => $name)
                            <option value="agent_{{ $id }}" {{ $wakala->agent_supplier == 'agent' && $wakala->supplier == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
        <h2 class="text-lg font-medium text-gray-900 mb-6 pb-2 border-b border-gray-200">Financial Details</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Quantity -->
            <div class="col-span-1">
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" required min="1"
                    value="{{ $wakala->quantity }}"
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <!-- Buying Price -->
            <div class="col-span-1">
                <label for="buying_price" class="block text-sm font-medium text-gray-700 mb-2">Buying Price</label>
                <div class="relative rounded-md shadow-sm">
                    <input type="text" name="buying_price" id="buying_price_edit" required
                        value="{{ $wakala->buying_price }}"
                        class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
            
            <!-- Multi Currency -->
            <div class="col-span-1">
                <label for="multi_currency" class="block text-sm font-medium text-gray-700 mb-2">Currency Rate</label>
                <input type="number" name="multi_currency" id="multi_currency_edit" required value="{{ $wakala->multi_currency }}" step="0.01" min="0"
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <!-- Total Price -->
            <div class="col-span-1">
                <label for="total_price" class="block text-sm font-medium text-gray-700 mb-2">Total Price</label>
                <div class="relative rounded-md shadow-sm">
                    <input type="text" name="total_price" id="total_price_edit" required readonly
                        value="{{ $wakala->total_price }}"
                        class="block w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
            
            
            <!-- Total Price -->
            <div class="col-span-1">
                <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-2">Selling Price</label>
                <div class="relative rounded-md shadow-sm">
                    <input type="text" name="selling_price" id="selling_price_edit" required
                        value="{{ $wakala->selling_price }}"
                        class="block w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
            
            <!-- Country -->
            <div class="col-span-1">
                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                <input type="text" name="country" id="country"
                    value="{{ $wakala->country }}"
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <!-- Sales By -->
            <div class="col-span-1">
                <label for="sales_by" class="block text-sm font-medium text-gray-700 mb-2">Sales By</label>
                <input type="text" name="sales_by" id="sales_by" required
                    value="{{ $wakala->sales_by }}"
                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>
    </div>
    
    <div class="flex flex-col sm:flex-row gap-4 justify-end mt-6">
        <!-- Cancel Button -->
        <button 
            type="button" 
            onclick="closeEditModal()" 
            class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 h-fit transition-all duration-200"
        >
            <div class="flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                <span>Cancel</span>
            </div>
        </button>
        
        <!-- Submit Button -->
        <button 
            type="submit" 
            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 h-fit"
        >
            <div class="flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <span>Update Wakala</span>
            </div>
        </button>
    </div>
</form>

    
    