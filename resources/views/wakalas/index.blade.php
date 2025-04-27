{{-- <x-app-layout> --}}
    <!-- Button to toggle Wakala entry form -->
{{-- <button onclick="toggleWakalaContainer()" 
class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
Wakala Entry
</button> --}}
@php
    use App\Models\Agent;
    use App\Models\Supplier;

    $agentsname = Agent::where('user', Auth::id())
        ->where('is_delete', 0)
        ->where('is_active', 1)
        ->pluck('name', 'id')
        ->toArray();

    // Get suppliers as ID => Name pairs
    $suppliersname = Supplier::where('user', Auth::id())
        ->where('is_delete', 0)
        ->where('is_active', 1)
        ->pluck('name', 'id')
        ->toArray();

    // dd($agentsname);
@endphp

    <div class=" mx-auto px-4 py-8 hidden" id="wakalacontainer">
        <div class=" mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Wakala Record</h2>
            
            <form id="wakalaForm" action="{{ route('wakalas.store') }}" method="POST" class="space-y-6 grid grid-cols-2">
                @csrf
                
                <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-2 border-b border-gray-200">Wakala Information</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Invoice -->
                        <div class="col-span-1">
                            <label for="invoice" class="block text-sm font-medium text-gray-700 mb-2">Invoice Number</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="text" name="invoice" id="invoice" required readonly
                                    value="{{ $nextInvoiceNumber }}"
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
                                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <!-- Visa -->
                        <div class="col-span-1">
                            <label for="visa" class="block text-sm font-medium text-gray-700 mb-2">Visa</label>
                            <input type="text" name="visa" id="visa" required
                                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <!-- ID Number -->
                        <div class="col-span-1">
                            <label for="id_no" class="block text-sm font-medium text-gray-700 mb-2">ID Number</label>
                            <input type="text" name="id_no" id="id_no" required
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
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }} (ID: {{ $agent->id }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Supplier -->
                        <div class="col-span-1">
                            <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                            <select name="supplier" id="supplier" required
                                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Supplier</option>
                                <optgroup label="Suppliers">
                                    @foreach($suppliers as $supplier)
                                        <option value="supplier_{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Agents">
                                    @foreach($agents as $agent)
                                        <option value="agent_{{ $agent->id }}">{{ $agent->name }}</option>
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
                                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <!-- Buying Price -->
                        <div class="col-span-1">
                            <label for="buying_price" class="block text-sm font-medium text-gray-700 mb-2">Buying Price</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="text" name="buying_price" id="buying_price" required
                                    class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <!-- Multi Currency -->
                        <div class="col-span-1">
                            <label for="multi_currency" class="block text-sm font-medium text-gray-700 mb-2">Currency Rate</label>
                            <input type="number" name="multi_currency" id="multi_currency" required value="1.00" step="0.01" min="0"
                                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <!-- Total Price -->
                        <div class="col-span-1">
                            <label for="total_price" class="block text-sm font-medium text-gray-700 mb-2">Total Price</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="text" name="total_price" id="total_price" required readonly
                                    class="block w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        
                        <!-- Selling Price -->
                        <div class="col-span-1">
                            <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-2">Selling Price</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="text" name="selling_price" id="selling_price" required
                                    class="block w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <!-- Country -->
                        <div class="col-span-1">
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <input type="text" name="country" id="country"
                                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <!-- Sales By -->
                        <div class="col-span-1">
                            <label for="sales_by" class="block text-sm font-medium text-gray-700 mb-2">Sales By</label>
                            <input type="text" name="sales_by" id="sales_by" required
                                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-end mt-6">
                    <!-- Cancel Button -->
                    <button 
                        type="button" 
                        onclick="toggleWakalaContainer()" 
                        class="px-6 h-fit py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
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
                            <span>Create Wakala</span>
                        </div>
                    </button>
                </div>
            </form>
          
        </div>
    </div>

    <div class="mx-auto px-4 py-8 mt-4">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Wakala Records</h2>
                <button onclick="toggleWakalaContainer()" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors">
                    + New Wakala
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="wakalatable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Invoice
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Agent
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Supplier
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($wakalas as $wakala)
                        <tr class="bg-blue-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $wakala->invoice }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($wakala->date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                   
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                                {{ $agentsname[$wakala->agent] ?? 'N/A' }}       
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                            <span class="text-blue-600">{{ strtoupper(substr($wakala->agent_supplier, 0, 1)) }}</span>
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            @if($wakala->agent_supplier == 'agent')
                                                {{ $agentsname[$wakala->supplier] ?? 'N/A' }}
                                            @else
                                              
                                                {{ $suppliersname[$wakala->supplier] ?? 'N/A' }}
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ ucfirst($wakala->agent_supplier) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $wakala->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                    <span class="text-xs mr-1">{{ $wakala->multi_currency }}</span>
                                    {{ number_format($wakala->total_price, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="#" onclick="openEditModal('{{ route('wakalas.edit', $wakala->id) }}')" class="text-blue-600 hover:text-blue-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('wakalas.destroy', $wakala->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                    <a href="#" 
                                        class="text-gray-600 hover:text-gray-900" 
                                        onclick="openViewModalWakala({{ $wakala->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                 
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- After (working version) -->
            @if($wakalas instanceof \Illuminate\Pagination\AbstractPaginator && $wakalas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $wakalas->links() }}
            </div>
            @endif
        </div>
    </div>
    
    
    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg p-6 z-10 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-green-600">Success!</h3>
                <button onclick="document.getElementById('successModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-gray-700 mb-4">Wakala record has been created successfully.</p>
            <div class="flex justify-end">
                <button onclick="document.getElementById('successModal').classList.add('hidden')" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    OK
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Wakala Record</h3>
                
                <!-- Form will be loaded here -->
                <div id="editFormContainer"></div>
                
                <div class="flex justify-end mt-4">
                    <button onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md mr-2">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- view modal --}}
    <div id="viewWakalaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <h2 class="text-lg font-bold mb-4">Wakala Details</h2>
                <div id="wakalaDetails" class="space-y-2">
                    <!-- Wakala details will be injected here -->
                </div>
                <button onclick="closeViewModalWakala()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>
            </div>
        </div>
    </div>

      
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Include DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



    <script>
        function openViewModalWakala(id) {
            fetch(`/wakalas/show/${id}`)
                .then(response => response.json())
                .then(data => {
                    const detailsDiv = document.getElementById('wakalaDetails');
                    
                    detailsDiv.innerHTML = `
                        <p><strong>Invoice:</strong> ${data.invoice}</p>
                        <p><strong>Date:</strong> ${data.date}</p>
                        <p><strong>Visa:</strong> ${data.visa}</p>
                        <p><strong>ID No:</strong> ${data.id_no}</p>
                        <p><strong>Agent:</strong> ${data.agentname}</p>
                        <p><strong>Supplier:</strong> ${data.suppliername}</p>
                        <p><strong>Quantity:</strong> ${data.quantity}</p>
                        <p><strong>Buying Price:</strong> ${data.buying_price}</p>
                        <p><strong>Total Price:</strong> ${data.total_price}</p>
                        <p><strong>Country:</strong> ${data.country ?? 'N/A'}</p>
                        <p><strong>Sales By:</strong> ${data.sales_by}</p>
                    `;

                    document.getElementById('viewWakalaModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Failed to load details:', error);
                    alert('Failed to load details.');
                });
        }

        function closeViewModalWakala() {
            const modal = document.getElementById('viewWakalaModal');
            
            if (modal) {
                modal.style.opacity = 0;  // Fade out
                modal.style.visibility = 'hidden';  // Hide the modal after fading out
                modal.style.transition = 'opacity 0.5s ease';  // Add transition for fade effect
            } else {
                console.error('Modal not found: viewWakalaModal');
            }
        }



    </script>

    <script>
        function openEditModal(url) {
            // Show modal
            document.getElementById('editModal').classList.remove('hidden');
            
            fetch(url)
                .then(response => {
                    // console.log(response.wakala);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    console.log('Received HTML:', html); // Debugging
                    document.getElementById('editFormContainer').innerHTML = html;
                    
                    // Initialize any scripts needed for the form
                    initEditForm();
                })
                .catch(error => {
                    console.error('Error loading edit form:', error);
                    // Show error to user
                    document.getElementById('editFormContainer').innerHTML = `
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            Error loading form: ${error.message}
                        </div>
                    `;
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editFormContainer').innerHTML = '';
        }

        
        function initEditForm() {
            const form = document.getElementById('editWakalaForm');
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(form);
                    formData.append('_method', 'PUT'); // 🛠 Add _method=PUT manually

                    fetch(form.action, {
                        method: 'POST', // 🛠 Use POST, not PUT
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeEditModal();
                            alert('Record updated successfully!');
                            location.reload();
                        } else {
                            console.error('Validation Errors:', data.errors);
                            alert('Failed to update record.');
                        }
                    })

                    .catch(error => console.error('Error:', error));
                });

                // 🛠 Your calculateTotalPrice script
                const buyingPrice = document.getElementById('buying_price_edit');
                const currencyRate = document.getElementById('multi_currency_edit');
                const totalPrice = document.getElementById('total_price_edit');

                function calculateTotalPrice() {
                    const price = parseFloat(buyingPrice.value) || 0;
                    const rate = parseFloat(currencyRate.value) || 1;
                    totalPrice.value = (price * rate).toFixed(2);
                }

                if (buyingPrice && currencyRate) {
                    buyingPrice.addEventListener('input', calculateTotalPrice);
                    currencyRate.addEventListener('input', calculateTotalPrice);
                    calculateTotalPrice(); // initialize once
                }
            }

        }

    </script>

    <script>
        function toggleWakalaContainer(parameter = null) {
            if(parameter == null){
                const container = document.getElementById('wakalacontainer');
                container.classList.toggle('hidden');
                
                // Optional: Scroll to the container when shown
                if (!container.classList.contains('hidden')) {
                    container.scrollIntoView({ behavior: 'smooth' });
                }
            }
            if(parameter == 'hide'){
                const container = document.getElementById('wakalacontainer');
                container.classList.toggle('hidden');
                
                // Optional: Scroll to the container when shown
                if (!container.classList.contains('hidden')) {
                    container.scrollIntoView({ behavior: 'smooth' });
                }
            }
        
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buyingPrice = document.getElementById('buying_price');
            const currencyRate = document.getElementById('multi_currency');
            const totalPrice = document.getElementById('total_price');
            
            function calculateTotalPrice() {
                const price = parseFloat(buyingPrice.value) || 0;
                const rate = parseFloat(currencyRate.value) || 1;
                const total = (price * rate).toFixed(2);
                totalPrice.value = isNaN(total) ? '0.00' : total;
            }
            
            // Calculate on input changes
            buyingPrice.addEventListener('input', calculateTotalPrice);
            currencyRate.addEventListener('input', calculateTotalPrice);
            
            // Initial calculation
            calculateTotalPrice();
        });
    </script>
    
    <script>
        document.getElementById('wakalaForm').addEventListener('submit', function(e) {
        e.preventDefault();
    
    // Show loading state if needed
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Processing...';

    fetch(this.action, {
        method: this.method,
        body: new FormData(this),
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Show success modal
            document.getElementById('successModal').classList.remove('hidden');
            
            // Redirect after delay
            setTimeout(() => {
                window.location.href = "{{ route('order.view') }}";
            }, 2000);
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        let errorHtml = '<ul class="text-red-600">';
                        for (const [field, message] of Object.entries(data.errors)) {
                            errorHtml += `<li>${message}</li>`;
                            // Highlight problematic fields
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('border-red-500');
                            }
                        }
                        errorHtml += '</ul>';
                        
                        // Show errors in a div with id "formErrors"
                        const errorContainer = document.getElementById('formErrors');
                        if (errorContainer) {
                            errorContainer.innerHTML = errorHtml;
                            errorContainer.classList.remove('hidden');
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.error || 'An error occurred');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Submit';
            });
        });
    </script>
