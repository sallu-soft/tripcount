<x-app-layout>
    @if(session('employee'))
    @php
        $employee = session('employee');
        // dd($employee['permission']);
        $permissionString = $employee['permission'];
        $permissionsArray = explode(',', $permissionString);
        $role = $employee['role'];
        // dd($role, $employee);
    @endphp
    @else
        @php
            $permissionsArray = ['entry', 'edit', 'delete', 'print', 'view'];
            $role = 'admin';
        @endphp
    @endif
    <div class="">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


    </div>


    
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div x-data="{ tab: 'home' }">
  <!-- Tabs -->
  <ul class="flex border-b">
    <li class="mr-1">
      <button
        @click="tab = 'home'"
        :class="tab === 'home' ? 'bg-white border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-gray-500 hover:text-blue-500'"
        class="px-4 py-2"
      >Invoice</button>
    </li>
    <li class="mr-1">
      <button
        @click="tab = 'profile'"
        :class="tab === 'profile' ? 'bg-white border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-gray-500 hover:text-blue-500'"
        class="px-4 py-2"
      >Contract</button>
    </li>
    <li class="mr-1">
      <button
        @click="tab = 'contact'"
        :class="tab === 'contact' ? 'bg-white border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-gray-500 hover:text-blue-500'"
        class="px-4 py-2"
      >Wakala</button>
    </li>
  </ul>

  <!-- Tab Contents -->
  <div class="p-4 border border-t-0">
    <div x-show="tab === 'home'">
        <div id="tab1">
            <div class="mb-2">
                <button class="py-2 px-7 border-green-700 hover:bg-green-700 hover:text-white duration-300 border-2 text-green-700  rounded-2xl font-bold" onchange="toggleVisibility()" id="addnew">Add
                    New
                </button>
            </div>
            <h2 class="text-2xl py-4 flex  w-full mx-auto font-bold
            px-2  text-gray-900">
            Invoicing
            </h2>
            @if(in_array('entry', $permissionsArray))
                <form action="/addorder" method="POST" id="addorder" class="w-[80%] p-5 bg-white shadow-lg" id="addorder">
                    @csrf
                    <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="invoice" class="block w-full md:w-[40%] text-gray-700 text-sm mb-2">Invoice
                                No.</label>
                            <input type="text" id="invoice" readonly
                                class="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                name="invoice">
                        </div>
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="date" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Invoice
                                Date</label>
                            <input type="date" id="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                                name="date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
    
                    </div>
                    <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
    
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="date" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Quantity
                            </label>
                            <input type="number" id="num"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                                name="">
                        </div>
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="type" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Invoice
                                Type</label>
    
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1 w-auto select2"
                                name="type" id="type" placeholder="Select type" required>
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
    
    
                    <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
    
    
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="agent" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Client
                                Name</label>
    
                            <select name="agent" id="agent" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500  focus:border-blue-500 block w-auto p-1 select2">
                                <option value="">Select Client</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
    
                        </div>
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="seller" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Supplier</label>
    
                            <select name="supplier" id="supplier" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block max-w-full select2 p-1">
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="supplier_{{ $supplier->id }}">{{ $supplier->name }} {{ $supplier->company }}</option>
                                @endforeach
                                @foreach ($agents as $agent)
                                    <option value="agent_{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
    
    
                    <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="name" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Passenger
                                Name</label>
                            <input type="text" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                                name="name[]">
                        </div>
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="passport_no" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Passport
                                No</label>
    
                            <input type="text" maxlength="9" id="passport_no"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                                name="passport_no[]">
                        </div>
                    </div>
    
    
    
                    <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="contact_amount" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Agent
                                Price</label>
                            <input type="text" id="contact_amount"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                                name="contact_amount" required>
                        </div>
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="payable_amount" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Supplier
                                Price</label>
                            <input type="text" id="payable_amount"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                                name="payable_amount" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="country" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Country</label>
                            <select required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-auto p-1 select2 "
                                name="country" id="country" required>
                                <option value="">Select Country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czechia">Czechia</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Eswatini">Eswatini</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Greece">Greece</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Holy See">Holy See</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="North Korea">North Korea</option>
                                <option value="North Macedonia">North Macedonia</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestine State">Palestine State</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                                </option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Korea">South Korea</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States of America">United States of America</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City">Vatican City</option>
                            </select>
                        </div>
                        <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                            <label for="remark" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Remark</label>
                            <textarea id="remark"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                                name="remark"></textarea>
                        </div>
    
                    </div>
                    <div class="col-span-2 gap-4 px-8 flex justify-end">
    
                        <button type="submit" id="submit_invoice"
                            class="bg-black text-xl text-white font-medium py-2 px-5 rounded">Submit</button>
                    </div>
    
    
                </form>
                @else
                <div class="alert alert-warning">
                    Don't have permission to entry
                </div>
            @endif
    
                <div class="p-6 rounded-lg mt-5 bg-white py-3">
                    <table class="table divide-y divide-gray-200 table-hover no-wrap" id="ordertable">
                        <thead class="bg-[#7CB0B2]">
                            <tr class="text-md font-normal">
                                <th class="">S.L</th>
                                <th class="">Inv No</th>
                                <th class="">Booking Date</th>
                                <th class="">Passenger Name</th>
                                <th class="">Passport No</th>
                                <th class="">Country</th>
                                <th class="">Client</th>
                                <th class="">Supplier</th>
                                <th class="">Client Amount</th>
                                <th class="">Supplier Amount</th>
                                <th class="">Remark</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr class="text-md">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->invoice }}</td>
                                    <td class="text-sm w-[150px]">{{ $order->date }}</td>
                                    <td class="w-[180px]">{{ $order->name }}</td>
                                    <td class="w-[75px]">{{ $order->passport_no }}</td>
                                    <td class="text-sm w-[150px]">{{ $order->country }}</td>
                                    <td>
                                        @foreach ($agents as $agent)
                                            @if ($order->agent == $agent->id)
                                                {{ $agent->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-sm w-[150px]">
                                        @if (isset($order->who) && Str::startsWith($order->who, 'agent_'))
                                            @php
                                                $agentId = intval(explode('_', $order->who)[1]); // Extract the agent ID from 'agent_14'
                                                $agent = $agents->firstWhere('id', $agentId); // Find the agent from the collection
                                            @endphp
                                            @if ($agent)
                                                {{ $agent->name }}
                                            @endif
                                        @else
                                            @foreach ($suppliers as $supplier)
                                                @if ($order->supplier == $supplier->id)
                                                    {{ $supplier->name }} <span class="">{{ $supplier->company }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $order->contact_amount }}</td>
                                    <td>{{ $order->payable_amount }}</td>
                                    <td>{{ $order->remark }}</td>
                                    <td>
                                        <section class="flex gap-2 text-lg">
                                            @if(in_array('edit', $permissionsArray))
                                                <a href="{{ route('order.edit', ['id' => encrypt($order->id)]) }}"><i class="fa fa-pencil fa-fw"></i> </a>
                                            @endif
                                            @if(in_array('delete', $permissionsArray))
                                                <a href="{{ route('order.delete', ['id' => $order->id]) }}" id="deleteOrderLink"
                                                    data-toggle="modal" data-target="#confirmDeleteModal"><i class="fa fa-trash-o fa-fw"></i></a>
                                            @endif
                                            @if(in_array('view', $permissionsArray))
                                                <a href="{{ route('order.viewInv', ['id' => $order->id]) }}"
                                                    class=" hover:text-green-700 mr-1">
                                                    <i class="fa fa-eye fa-fw text-xl"></i>
                                                </a>
                                            @endif
                                        </section>
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
    
                </div>
    
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog " role="document" style="max-width: 1200px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="tableContainer"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
    
                        <!-- Confirm Delete Modal -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this order?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div x-show="tab === 'profile'" x-cloak>
        <div class="mb-2">
            <button class="py-2 px-7 border-green-700 hover:bg-green-700 hover:text-white duration-300 border-2 text-green-700  rounded-2xl font-bold" onchange="toggleVisibilitycontract()" id="addnewcontract">Add
                New Contract
            </button>
        </div>
        <h2 class="text-2xl py-4 flex  w-full mx-auto font-bold
        px-2  text-gray-900">
        Contracts
        </h2>
        @if(in_array('entry', $permissionsArray))
        <div class="bg-white shadow-md rounded-lg p-6 mb-10" id="contractform">
            {{-- <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Contract</h2> --}}
            <form action="{{ route('contracts.store') }}" method="POST" class="space-y-6">
                @csrf
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Invoice -->
                    <div>
                        <label for="invoice" class="block text-sm font-medium text-gray-700 mb-1">Invoice</label>
                        <input type="text" name="invoice" id="invoice" value="{{ $contract_invoice }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required readonly>
                    </div>
            
                    <!-- Agent -->
                    <div>
                        <label for="agent_id" class="block text-sm font-medium text-gray-700 mb-1">Agent</label>
                        <select name="agent_id" id="agent_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <!-- Total Amount -->
                    <div>
                        <label for="total_amount" class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount" step="0.01"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
            
                    <!-- Contract Date -->
                    <div>
                        <label for="contract_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="contract_date" id="contract_date"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
            
                    <!-- Passport No -->
                    <div>
                        <label for="passport_no" class="block text-sm font-medium text-gray-700 mb-1">Passport No</label>
                        <input type="text" name="passport_no" id="passport_no" maxlength="13"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
            
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    {{-- country --}}
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <input type="text" name="country" id="country"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            
                <!-- Notes (Full Width) -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
            
                <!-- Submit Button -->
                <div class="pt-4 text-right">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow-md transition">
                        Create Contract
                    </button>
                </div>
            </form>
            
        </div>
        @else
            <div class="alert alert-warning">
                Don't have permission to entry
            </div>
        @endif
        <div class="bg-white shadow-md rounded-lg p-6 mt-4">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">All Contracts</h3>
            <div class="overflow-x-auto">
                <table id="contracts-table" class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">SL</th>
                            <th class="px-4 py-2">Agent</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Total Amount</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Note</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($contracts as $key => $contract)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $key + 1 }}</td>
                                <td class="px-4 py-2">{{ $contract->agent_name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $contract->name ?? '' }}
                                    <br><strong class="text-sm">{{$contract->passport_no}}</strong>
                                </td>
                                <td class="px-4 py-2">{{ number_format($contract->total_amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $contract->contract_date }}</td>
                                <td class="px-4 py-2">{{ $contract->notes }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="#" 
                                            data-modal-id="modal_{{ $contract->id }}" 
                                            onclick="openUniqueModal('{{ $contract->id }}')" 
                                            class="text-blue-600 hover:text-blue-800 font-medium">
                                            View
                                        </a>
                                                                            
                                        <button onclick="openModal('{{ $contract->id }}', '{{ $contract->total_amount }}', '{{ $contract->notes }}')" 
                                                class="text-blue-600 hover:underline text-sm font-medium">
                                            Edit
                                        </button>
                                    
                                    
                                    </div>
                                </td>
                            </tr>
                              {{-- modal for view contract --}}
                            <div id="modal_{{ $contract->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-auto relative p-6">
                                    <!-- Close Button -->
                                    <button onclick="closeViewModal('modal_{{ $contract->id }}')" class="absolute top-3 right-4 text-gray-400 hover:text-red-600 text-2xl font-bold focus:outline-none">
                                        &times;
                                    </button>
                            
                                    <!-- Modal Header -->
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Contract Details</h2>
                            
                                    <!-- Static Info -->
                                    <div class="space-y-2 mb-4">
                                        <p><span class="font-medium text-gray-700">Total Amount:</span> <span class="text-blue-600 font-semibold">{{ $contract->total_amount }}</span></p>
                                        <p><span class="font-medium text-gray-700">Notes:</span> <span class="text-gray-600">{{ $contract->notes }}</span></p>
                                    </div>
                            
                                    <!-- AJAX Content Placeholder -->
                                    <div class="modal-content space-y-3 text-sm text-gray-700">
                                        <div class="text-center text-gray-400">Loading service details...</div>
                                        <!-- Contract services will be dynamically injected here -->
                                    </div>
                            
                                    <!-- Optional Footer -->
                                    <div class="mt-6 text-right">
                                        <button onclick="closeViewModal('modal_{{ $contract->id }}')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-md">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                            

                         
                        @endforeach
                       
                    </tbody>
                </table>
                 
               
                 <!--Edit Modal Contract-->
                <div id="contractModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center z-50 overflow-y-auto">
                    <div class="bg-white w-full max-w-3xl max-h-[90vh] rounded-lg shadow-lg p-6 relative overflow-hidden">

                        <!-- Close Button -->
                        <button onclick="document.getElementById('contractModal').classList.add('hidden')" 
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>

                        <!-- Scrollable Body -->
                        <div class="overflow-y-auto max-h-[75vh] pr-2">
                            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit Contract</h2>

                            <!-- Hidden ID field for editing the contract -->

                            <form action="{{ route('contracts.update') }}" method="POST">
                                @csrf
                                {{-- @method('PUT') --}}
                            
                                <!-- Total Amount -->
                                <input type="hidden" id="contract_id" name="contract_id">

                                <div class="mb-4">
                                    <label for="total_amount" class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                                    <input type="number" name="total_amount" id="total_amount_edit" step="0.01" required
                                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            
                                <!-- Notes -->
                                <div class="mb-4">
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                                    <textarea name="notes" id="notes_edit" rows="3"
                                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                </div>
                            
                                <!-- Service Breakdown -->
                                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-4">Service Breakdown</h3>
                                <div id="serviceContainer" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    @foreach($types as $type)
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input 
                                                    id="type_{{ $type->id }}" 
                                                    name="types[]" 
                                                    type="checkbox" 
                                                    value="{{ $type->id }}"
                                                    class="service-checkbox focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                                    onchange="toggleServiceDetails(this)"
                                                >
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="type_{{ $type->id }}" class="font-medium text-gray-700">
                                                    {{ $type->name }}
                                                </label>
                                                @if($type->description)
                                                    <p class="text-gray-500">{{ $type->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="serviceDetailsContainer" class="mt-6 space-y-4"></div>

                            
                                <!-- Submit Button -->
                                <div class="mt-6 text-right">
                                    <button type="submit"
                                            class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition duration-200">
                                        Update Contract
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
   
            </div>
        </div>


    </div>
    
    <div x-show="tab === 'contact'" x-cloak>
        @include('wakalas.index', [
            'wakalas' => App\Models\Wakala::where('user', auth()->id())->get(),
            'agents' => App\Models\Agent::where('user', auth()->id())->get(),
            'suppliers' => App\Models\Supplier::where('user', auth()->id())->get(),
            'nextInvoiceNumber' => App\Models\Wakala::generateNextInvoiceNumber()
        ])
    </div>
  </div>
</div>


<script>
    window.allServiceTypes = @json($types); // All possible service types
    window.suppliers = @json($suppliers); // All suppliers
    window.agents = @json($agents); // All agents
</script>
    
<script>

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
     // Modify your toggle functions to accept a second parameter for initialization
    function toggleServiceDetailsWakala(checkbox, isInitializing = false, initialData = null) {
    
        if (typeof checkbox === 'object' && checkbox.detail) {
        // Called via event
            const { isInitializing: init, initialData: data } = checkbox.detail;
            isInitializing = init;
            initialData = data;
            checkbox = document.getElementById('type_wakala'); // Get the actual checkbox
        }

        // console.log("Toggle received:", { isInitializing, initialData });
        const serviceId = 'wakala';
        const serviceName = 'Wakala Service';
        const container = document.getElementById('serviceDetailsContainer');
        const existingDiv = document.getElementById(`service_${serviceId}`);

        // Handle uncheck case
        if (!checkbox.checked) {
            if (existingDiv) existingDiv.remove();
            return;
        }

        // Remove existing div if present (we'll recreate it)
        if (existingDiv) existingDiv.remove();

        // Create new div with fields
        const wakalaDiv = document.createElement('div');
        wakalaDiv.id = `service_${serviceId}`;
        wakalaDiv.className = 'p-4 border rounded-lg bg-gray-50 mb-4';

        // Generate the HTML content
        wakalaDiv.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg font-semibold text-gray-800">${serviceName}</h4>
                <button type="button" onclick="removeServiceDetail('${serviceId}')" 
                        class="text-red-500 hover:text-red-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Column 1 -->
                <div>
                    <label for="wakala_visa_no" class="block text-sm font-medium text-gray-700 mb-1">Visa No</label>
                    <input type="text" id="wakala_visa_no" name="wakala_visa_no" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.wakala_visa_no || '') : ''}">
                </div>
                
                <div>
                    <label for="wakala_id_no" class="block text-sm font-medium text-gray-700 mb-1">ID No</label>
                    <input type="text" id="wakala_id_no" name="wakala_id_no" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.wakala_id_no || '') : ''}">
                </div>
                
                <div>
                    <label for="wakala_buying_price" class="block text-sm font-medium text-gray-700 mb-1">Buying Price</label>
                    <input type="number" step="0.01" id="wakala_buying_price" name="wakala_buying_price" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 calculate-total"
                        placeholder="0.00"
                        value="${initialData ? (initialData.wakala_buying_price || '') : ''}">
                </div>
                
                <!-- Column 2 -->
                <div>
                    <label for="wakala_multi_currency" class="block text-sm font-medium text-gray-700 mb-1">Multi-Currency Rate</label>
                    <input type="number" step="0.0001" id="wakala_multi_currency" name="wakala_multi_currency" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 calculate-total"
                        placeholder="1.0000" 
                        value="${initialData ? (initialData.wakala_multi_currency || '1.0000') : '1.0000'}">
                </div>
                
                <div>
                    <label for="wakala_total_price" class="block text-sm font-medium text-gray-700 mb-1">Total Price</label>
                    <input type="number" step="0.01" id="wakala_total_price" name="wakala_total_price" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        readonly
                        value="${initialData ? (initialData.amount || '') : ''}">
                </div>
                
                <div>
                    <label for="wakala_supplier" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                    <select id="wakala_supplier" name="wakala_supplier" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Supplier</option>
                        ${generateSupplierOptions('wakala', initialData ? `${initialData.agent_supplier}_${initialData.supplier}` : '')}
                    </select>
                </div>
                
                <div>
                    <label for="wakala_sales_by" class="block text-sm font-medium text-gray-700 mb-1">Sales By</label>
                    <input type="text" id="wakala_sales_by" name="wakala_sales_by" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.wakala_sales_by || '') : ''}">
                </div>
            
                
                <div>
                    <label for="wakala_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" id="wakala_date" name="wakala_date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.wakala_date || '') : ''}">
                </div>
            
                
                <div class="md:col-span-2">
                    <label for="wakala_note" class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                    <textarea id="wakala_note" name="wakala_note" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">${initialData ? (initialData.note || '') : ''}</textarea>
                </div>
            </div>
        `;

        container.appendChild(wakalaDiv);

        document.getElementById('wakala_buying_price').addEventListener('input', calculateWakalaTotal);
        document.getElementById('wakala_multi_currency').addEventListener('input', calculateWakalaTotal);

        // Calculate total if we have initial data
        if (initialData) {
            calculateWakalaTotal();
        }
    }
    
    function toggleServiceDetailsTicket(checkbox, isInitializing = false, initialData = null) {
        let actualCheckbox = checkbox;
        let actualInitializing = isInitializing;
        let actualData = initialData;
    
        if (checkbox && checkbox.detail) {
            actualCheckbox = checkbox.target;
            actualInitializing = checkbox.detail.isInitializing;
            actualData = checkbox.detail.initialData;
        }
    
        // console.log("--- TICKET FUNCTION EXECUTING ---");
        // console.log("Checkbox:", actualCheckbox);
        // console.log("isInitializing:", actualInitializing);
        // console.log("initialData:", actualData);
    
        const serviceId = 'ticket';
        const serviceName = 'Ticket Service'; // Fixed name or can be dynamic
        const container = document.getElementById('serviceDetailsContainer');
    
        const existingDiv = document.getElementById(`service_${serviceId}`);
        if (existingDiv) existingDiv.remove();
    
        if (!actualCheckbox.checked) return;
        
        const ticketDiv = document.createElement('div');
        ticketDiv.id = `service_${serviceId}`;
        ticketDiv.className = 'p-4 border rounded-lg bg-gray-50 mb-4';

        ticketDiv.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg font-semibold text-gray-800">${serviceName}</h4>
                <button type="button" onclick="removeServiceDetail('${serviceId}')" 
                        class="text-red-500 hover:text-red-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Column 1 -->
                <div>
                    <label for="ticket_invoice_date" class="block text-sm font-medium text-gray-700 mb-1">Invoice Date</label>
                    <input type="date" id="ticket_invoice_date" name="ticket_invoice_date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.ticket_invoice_date || '') : ''}">
                </div>
                
                <div>
                    <label for="ticket_travel_date" class="block text-sm font-medium text-gray-700 mb-1">Travel Date</label>
                    <input type="date" id="ticket_travel_date" name="ticket_travel_date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.ticket_travel_date || '') : ''}">
                </div>
                
                <div>
                    <label for="ticket_sector" class="block text-sm font-medium text-gray-700 mb-1">Sector</label>
                    <input type="text" id="ticket_sector" name="ticket_sector" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.ticket_sector || '') : ''}">
                </div>
                
                <!-- Column 2 -->
                <div>
                    <label for="ticket_number" class="block text-sm font-medium text-gray-700 mb-1">Ticket Number</label>
                    <input type="text" id="ticket_number" name="ticket_number" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.ticket_number || '') : ''}">
                </div>
                
                <div>
                    <label for="ticket_passenger_name" class="block text-sm font-medium text-gray-700 mb-1">Passenger Name</label>
                    <input type="text" id="ticket_passenger_name" name="ticket_passenger_name" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.ticket_passenger_name || '') : ''}">
                </div>
                
                <div>
                    <label for="ticket_airline" class="block text-sm font-medium text-gray-700 mb-1">Airline</label>
                    <input type="text" id="ticket_airline" name="ticket_airline" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.ticket_airline || '') : ''}">
                </div>
                
                <div>
                    <label for="ticket_selling_price" class="block text-sm font-medium text-gray-700 mb-1">Selling Price</label>
                    <input type="number" step="0.01" id="ticket_selling_price" name="ticket_selling_price" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="${initialData ? (initialData.amount || '') : ''}">
                </div>
                
                <div>
                    <label for="ticket_supplier" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                    <select id="ticket_supplier" name="ticket_supplier" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Supplier</option>
                        ${generateSupplierOptions('ticket', initialData ? `${initialData.agent_supplier}_${initialData.supplier}` : '')}
                    </select>
                </div>
                
                <div class="md:col-span-2">
                    <label for="ticket_note" class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                    <textarea id="ticket_note" name="ticket_note" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">${initialData ? (initialData.note || '') : ''}</textarea>
                </div>
            </div>
        `;

        container.appendChild(ticketDiv);
    }

   
    function populateExtraServiceFields(serviceType, data) {
        // console.log("Populating:", serviceType, data);
        const checkbox = document.getElementById(`type_${serviceType}`);
        if (!checkbox) {
            console.error("Checkbox not found for type:", serviceType);
            return;
        }

        checkbox.checked = true;
        
        const funcName = `toggleServiceDetails${capitalizeFirstLetter(serviceType)}`;
        // console.log("Function to call:", funcName);
  
        if (typeof window[funcName] !== 'function') {
            console.error("Function not found in window scope:", funcName);
            return;
        }

        const event = {
            target: checkbox,
            detail: {
                isInitializing: true,
                initialData: data
            }
        };

        try {
        
            window[funcName](event);
            
            window[funcName](checkbox, true, data);
            
            // console.log("Function called successfully");
        } catch (e) {
            console.error("Error calling function:", e);
        }
    }

    function openModal(id, totalAmount, notes) {
        // Set basic contract info
        document.getElementById('contract_id').value = id;
        document.getElementById('total_amount_edit').value = totalAmount;
        document.getElementById('notes_edit').value = notes;

        // Reset containers
        document.getElementById('serviceContainer').innerHTML = '';
        document.getElementById('serviceDetailsContainer').innerHTML = '';

        // Show modal
        document.getElementById('contractModal').classList.remove('hidden');

        // Load contract services
        $.ajax({
            url: `/contracts_service/details/${id}`,
            method: 'GET',
            success: function(response) {
                const allServiceTypes = window.allServiceTypes || [];
                const existingServices = response.services || {};
                const existingServiceIds = Object.keys(existingServices);
                const extraServiceTypes = response.extraServiceTypes || [];
                
                // Render regular services
                allServiceTypes.forEach(serviceType => {
                    const isChecked = existingServiceIds.includes(serviceType.id.toString());
                    const existingData = existingServices[serviceType.id]?.[0];
                    
                    const checkboxDiv = document.createElement('div');
                    checkboxDiv.className = 'flex items-start';
                    checkboxDiv.innerHTML = `
                        <div class="flex items-center h-5">
                            <input 
                                id="type_${serviceType.id}" 
                                name="types[]" 
                                type="checkbox" 
                                value="${serviceType.id}"
                                class="service-checkbox focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                ${isChecked ? 'checked' : ''}
                                onchange="toggleServiceDetails(this)"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="type_${serviceType.id}" class="font-medium text-gray-700">
                                ${serviceType.name}
                            </label>
                            ${serviceType.description ? `<p class="text-gray-500">${serviceType.description}</p>` : ''}
                        </div>
                    `;
                    document.getElementById('serviceContainer').appendChild(checkboxDiv);
                    
                    if (isChecked && existingData) {
                        renderServiceDetails(serviceType.id, existingData);
                    }
                });

                const extraServicesContainer = document.createElement('div');
                extraServicesContainer.className = 'mt-4';

                // Default extra service types that should always be available
                const defaultExtraServiceTypes = ['wakala', 'ticket']; // Add all your possible types here

                // Generate checkboxes for extra services (always shown)
                let extraServicesCheckboxes = '';
                defaultExtraServiceTypes.forEach(extraType => {
                    // Check if this type exists in response data
                    const isChecked = extraServiceTypes.includes(extraType) ? 'checked' : '';
                    
                    extraServicesCheckboxes += `
                        <div class="flex items-center">
                            <div class="flex items-center h-5">
                                <input 
                                    id="type_${extraType}" 
                                    name="extra_types[]" 
                                    type="checkbox" 
                                    value="${extraType}"
                                    class="service-checkbox focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                    onchange="toggleServiceDetails${capitalizeFirstLetter(extraType)}(this)"
                                    ${isChecked}
                                >
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="type_${extraType}" class="font-medium text-gray-700">
                                    ${capitalizeFirstLetter(extraType)}
                                </label>
                            </div>
                        </div>
                    `;
                });

                extraServicesContainer.innerHTML = `
                    <button 
                        type="button" 
                        onclick="showExtraServices()"
                        class="inline-flex items-start px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        + Hide Extra Services
                    </button>
                    <div id="extraServicesOptions" class="mt-2">
                        <div class="flex flex-wrap gap-4">
                            ${extraServicesCheckboxes}
                        </div>
                    </div>
                `;

                document.getElementById('serviceContainer').appendChild(extraServicesContainer);
                // If there are existing extra services, populate their data
                if (response.extraServices && response.extraServices.length > 0) {
                    document.getElementById('extraServicesOptions').classList.remove('hidden');
                    
                    response.extraServices.forEach(extraService => {
                        const checkbox = document.getElementById(`type_${extraService.extratype}`);
                        if (checkbox) {
                            checkbox.checked = true;
                            populateExtraServiceFields(extraService.extratype, extraService);
                        }
                    });
                }

            },
            error: function(xhr, status, error) {
                console.error('Error loading services:', error);
                alert('Failed to load service details');
            }
        });
    }

    function showExtraServices() {
        document.getElementById('extraServicesOptions').classList.toggle('hidden');
        const button = event.target;
        button.textContent = button.textContent.includes('Add') ? 
            'Hide Extra Services' : '+ Add Extra Services';
    }

    function renderServiceDetails(serviceTypeId, serviceData) {
        const container = document.getElementById('serviceDetailsContainer');
        const detailDiv = document.createElement('div');
        detailDiv.id = `service_${serviceTypeId}`;
        detailDiv.className = 'p-4 border rounded-lg bg-gray-50 mb-4';
        detailDiv.innerHTML = `
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <!-- Header with title and close button -->
                        <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                            <h4 class="font-semibold text-gray-800 text-base">${serviceData.service_name}</h4>
            
                            <button type="button" onclick="removeServiceDetail('${serviceTypeId}')" class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div class = "space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="date_${serviceTypeId}" class="block text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" id="date_${serviceTypeId}" name="service_dates[${serviceTypeId}]" 
                                            value="${serviceData.date}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                                    </div>
                                    <div>
                                        <label for="supplier_${serviceTypeId}" class="block text-sm font-medium text-gray-700">Supplier</label>
                                        <select id="supplier_${serviceTypeId}" name="service_suppliers[${serviceTypeId}]" class="block w-full pl-7 pr-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                                            <option value="">Select Supplier</option>
                                            ${generateSupplierOptions(serviceData)}
                                        </select>
                                    </div>
                                    <div>
                                        <label for="amount_${serviceTypeId}" class="block text-sm font-medium text-gray-700">Amount</label>
                                        <input type="number" step="0.01" id="amount_${serviceTypeId}" name="service_amounts[${serviceTypeId}]" 
                                            value="${serviceData.allocated_amount}" class="block w-full pl-7 pr-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                                    </div>
                                    <div>
                                        <label for="note_${serviceTypeId}" class="block text-sm font-medium text-gray-700">Note</label>
                                        <input type="text" id="note_${serviceTypeId}" name="service_notes[${serviceTypeId}]" 
                                            value="${serviceData.note}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                                    </div>
                                </div>
                        </div>
                
            </div>
        
        `;
        container.appendChild(detailDiv);
        
        // Set the selected supplier
        const supplierSelect = document.getElementById(`supplier_${serviceTypeId}`);
        if (supplierSelect) {
            supplierSelect.value = `${serviceData.agent_or_supplier}_${serviceData.supplier}`;
        }
    }

    function removeServiceDetail(serviceTypeId) {
        // Uncheck the checkbox
        const checkbox = document.getElementById(`type_${serviceTypeId}`);
        if (checkbox) checkbox.checked = false;
        
        // Remove the details div
        const detailDiv = document.getElementById(`service_${serviceTypeId}`);
        if (detailDiv) detailDiv.remove();
    }
</script>

<script>
   
    // function toggleServiceDetailsTicket(checkbox) {
    //     const serviceId = 'ticket'; // Fixed for Ticket service
    //     const serviceName = 'Ticket Service'; // Fixed name or can be dynamic
    //     const container = document.getElementById('serviceDetailsContainer');
    //     const existingDiv = document.getElementById(`service_${serviceId}`);

    //     // Remove if already exists
    //     if (existingDiv) {
    //         existingDiv.remove();
    //         return;
    //     }

    //     // Only proceed if checkbox is checked
    //     if (!checkbox.checked) return;

    //     // Create Ticket service details div
    //     const ticketDiv = document.createElement('div');
    //     ticketDiv.id = `service_${serviceId}`;
    //     ticketDiv.className = 'p-4 border rounded-lg bg-gray-50 mb-4';
    //     ticketDiv.innerHTML = `
    //         <div class="flex justify-between items-center mb-4">
    //             <h4 class="text-lg font-semibold text-gray-800">${serviceName}</h4>
    //             <button type="button" onclick="removeServiceDetail('${serviceId}')" 
    //                     class="text-red-500 hover:text-red-700 focus:outline-none">
    //                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
    //                     <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
    //                 </svg>
    //             </button>
    //         </div>
            
    //         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    //             <!-- Column 1 -->
    //             <div>
    //                 <label for="ticket_invoice_date" class="block text-sm font-medium text-gray-700 mb-1">Invoice Date</label>
    //                 <input type="date" id="ticket_invoice_date" name="ticket_invoice_date" 
    //                     class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    //             </div>
                
    //             <div>
    //                 <label for="ticket_travel_date" class="block text-sm font-medium text-gray-700 mb-1">Date of Travel</label>
    //                 <input type="date" id="ticket_travel_date" name="ticket_travel_date" 
    //                     class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    //             </div>
                
    //             <div>
    //                 <label for="ticket_sector" class="block text-sm font-medium text-gray-700 mb-1">Sector</label>
    //                 <input type="text" id="ticket_sector" name="ticket_sector" 
    //                     class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
    //                     placeholder="e.g., DAC-DXB">
    //             </div>
                
    //             <div>
    //                 <label for="ticket_number" class="block text-sm font-medium text-gray-700 mb-1">Ticket No</label>
    //                 <input type="text" id="ticket_number" name="ticket_number" 
    //                     class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    //             </div>
                
    //             <!-- Column 2 -->
    //             <div>
    //                 <label for="ticket_passenger_name" class="block text-sm font-medium text-gray-700 mb-1">Passenger Name</label>
    //                 <input type="text" id="ticket_passenger_name" name="ticket_passenger_name" 
    //                     class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    //             </div>
                
    //             <div>
    //                 <label for="ticket_airline" class="block text-sm font-medium text-gray-700 mb-1">Airline</label>
    //                 <input type = "text" id="ticket_airline" name="ticket_airline" 
    //                         class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    //             </div>
                
    //             <div>
    //                 <label for="ticket_supplier" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
    //                 <select id="ticket_supplier" name="ticket_supplier" 
    //                         class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    //                     <option value="">Select Supplier</option>
    //                     ${generateSupplierOptions('ticket')}
    //                 </select>
    //             </div>
                
    //             <div>
    //                 <label for="ticket_selling_price" class="block text-sm font-medium text-gray-700 mb-1">Selling Price</label>
    //                 <input type="number" step="0.01" id="ticket_selling_price" name="ticket_selling_price" 
    //                     class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
    //                     placeholder="0.00">
    //             </div>
                
    //             <div class="md:col-span-2">
    //                 <label for="ticket_note" class="block text-sm font-medium text-gray-700 mb-1">Note</label>
    //                 <textarea id="ticket_note" name="ticket_note" rows="2"
    //                         class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
    //             </div>
    //         </div>
    //     `;

    //     container.appendChild(ticketDiv);
    // }

    // Auto-calculation function for Wakala
    function calculateWakalaTotal() {
        const buyingPrice = parseFloat(document.getElementById('wakala_buying_price').value) || 0;
        const multiCurrency = parseFloat(document.getElementById('wakala_multi_currency').value) || 1;
        const totalPrice = buyingPrice * multiCurrency;
        document.getElementById('wakala_total_price').value = totalPrice.toFixed(2);
    }

    // function generateSupplierOptions(serviceData) {
    //     const suppliers = window.suppliers || []; // Array of supplier objects
    //     const agents = window.agents || []; // Array of agent objects
        
    //     // Combine both agents and suppliers into one array with type indicators
    //     const allOptions = [
    //         ...agents.map(agent => ({
    //             id: agent.id,
    //             name: agent.name,
    //             type: 'agent'
    //         })),
    //         ...suppliers.map(supplier => ({
    //             id: supplier.id,
    //             name: supplier.name,
    //             type: 'supplier'
    //         }))
    //     ];

    //     // Generate options HTML
    //     return allOptions.map(option => {
    //         const isSelected = (option.id == serviceData.supplier && 
    //                         option.type == serviceData.agent_or_supplier);
    //         return `
    //             <option value="${option.type}_${option.id}" ${isSelected ? 'selected' : ''}>
    //                 ${option.name} (${option.type === 'agent' ? 'Agent' : 'Supplier'})
    //             </option>
    //         `;
    //     }).join('');
    // }
    function generateSupplierOptions(type, selectedValue = '') {
        const suppliers = window.suppliers || [];
        const agents = window.agents || [];
        
        const allOptions = [
            ...agents.map(agent => ({
                id: agent.id,
                name: agent.name,
                type: 'agent'
            })),
            ...suppliers.map(supplier => ({
                id: supplier.id,
                name: supplier.name,
                type: 'supplier'
            }))
        ];

        return allOptions.map(option => {
            let isSelected = false;
            
            if (typeof selectedValue === 'string') {
                isSelected = selectedValue === `${option.type}_${option.id}`;
            } else if (typeof selectedValue === 'object' && selectedValue !== null) {
                isSelected = (option.id == selectedValue.supplier && 
                            option.type == selectedValue.agent_or_supplier);
            }

            return `
                <option value="${option.type}_${option.id}" ${isSelected ? 'selected' : ''}>
                    ${option.name} (${option.type === 'agent' ? 'Agent' : 'Supplier'})
                </option>
            `;
        }).join('');
    }
</script>

<script>
    function openUniqueModal(contractId) {
        const modalId = `modal_${contractId}`;
        const modalElement = document.getElementById(modalId);

        // Show the modal with loading state
        modalElement.classList.remove('hidden');
        const contentContainer = modalElement.querySelector('.modal-content');
        contentContainer.innerHTML = `
            <div class="flex justify-center items-center h-64">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
            </div>
        `;

        $.ajax({
            url: `/contracts_service/details/${contractId}`,
            method: 'GET',
            success: function(data) {
                let html = '';

                if (Object.keys(data.services).length === 0) {
                    html = `
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No services found</h3>
                            <p class="mt-1 text-gray-500">This contract doesn't have any services yet.</p>
                        </div>
                    `;
                } else {
                    html = `
                        <div class="space-y-6 p-{4}">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 px-3 py-2">Contract Services</h2>
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300 ">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier/Agent</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                    `;

                    let totalAmount = 0;
                    $.each(data.services, function(serviceType, entries) {
                        entries.forEach(item => {
                            totalAmount += parseFloat(item.allocated_amount) || 0;
                        });
                    });

                    $.each(data.services, function(serviceType, entries) {
                        entries.forEach((item, index) => {
                            html += `
                                <tr class="${index % 2 === 0 ? 'bg-white' : 'bg-gray-50'} hover:bg-gray-100">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ${item.service_name}
                                        ${item.note ? `
                                        <p class="text-xs text-gray-500 mt-1 whitespace-normal break-words">
                                            Note: ${item.note}
                                        </p>
                                        ` : ''}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${item.agent_or_supplier === 'agent' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'}">
                                                ${item.agent_or_supplier === 'agent' ? 'Agent' : 'Supplier'}
                                            </span>
                                        </div>
                                        <span class="ml-2">${item.supplier_name}</span>

                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        ${formatCurrency(item.allocated_amount)}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        ${item.date ? formatDateDMY(item.date) : 'N/A'}
                                    </td>
                                </tr>
                            `;
                        });
                    });
                    html += `
                        <tfoot>
                            <tr class="bg-gray-50 font-medium">
                                <td class="px-4 py-3 text-sm text-gray-900" colspan="3">Total Amount</td>
                                <td class="px-4 py-3 text-sm text-gray-900">${formatCurrency(totalAmount)}</td>
                            </tr>
                        </tfoot>
                    `;
                    html += `
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;
                }

                contentContainer.innerHTML = html;
            },
            error: function(xhr, status, error) {
                contentContainer.innerHTML = `
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Failed to load services</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>${error}</p>
                                    <p class="mt-1">Please try again later.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        });
    }

    function closeViewModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Helper function to format currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'BDT',
            minimumFractionDigits: 2
        }).format(amount);
    }
    function formatDateDMY(dateString) {
        const date = new Date(dateString);
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are 0-indexed
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
</script>
    

<script>
    function toggleServiceDetails(checkbox) {
        const container = document.getElementById('serviceDetailsContainer');
        const typeId = checkbox.value;
        const typeName = checkbox.parentElement.nextElementSibling.querySelector('label').textContent;
        
        if (checkbox.checked) {
            // Create new service details section
            const detailDiv = document.createElement('div');
            detailDiv.id = `service_${typeId}`;
            detailDiv.className = 'p-4 border rounded-lg bg-gray-50';
            detailDiv.innerHTML = `
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <!-- Header with title and close button -->
                    <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                        <h4 class="font-semibold text-gray-800 text-base">${typeName}</h4>
                        <button type="button" onclick="removeServiceDetail('${typeId}')" 
                                class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Input fields grid -->
                    <div class="space-y-4">
                        <!-- Date and Supplier row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Date input -->
                            <div class="space-y-1">
                                <label for="date_${typeId}" class="block text-sm font-medium text-gray-700">Date</label>
                                <input type="date" id="date_${typeId}" name="service_dates[${typeId}]" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                            </div>
                            
                            <!-- Supplier dropdown -->
                            <div class="space-y-1">
                                <label for="supplier_${typeId}" class="block text-sm font-medium text-gray-700">Supplier</label>
                                <select id="supplier_${typeId}" name="service_suppliers[${typeId}]" 
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="supplier_{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                    @foreach($agents as $agent)
                                        <option value="agent_{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Amount and Note row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Amount input -->
                            <div class="space-y-1">
                                <label for="amount_${typeId}" class="block text-sm font-medium text-gray-700">Amount</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                       
                                    </div>
                                    <input type="number" step="0.01" id="amount_${typeId}" name="service_amounts[${typeId}]" 
                                        class="block w-full pl-7 pr-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                                </div>
                            </div>
                            
                            <!-- Note input -->
                            <div class="space-y-1">
                                <label for="note_${typeId}" class="block text-sm font-medium text-gray-700">Note</label>
                                <input type="text" id="note_${typeId}" name="service_notes[${typeId}]" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(detailDiv);
        } else {
            // Remove service details section
            const detailDiv = document.getElementById(`service_${typeId}`);
            if (detailDiv) {
                container.removeChild(detailDiv);
            }
        }
    }
    
    function removeServiceDetail(typeId) {
        const checkbox = document.getElementById(`type_${typeId}`);
        if (checkbox) {
            checkbox.checked = false;
            toggleServiceDetails(checkbox);
        }
    }
</script>
    

<script type="text/javascript">
    var addnew = document.getElementById('addnew');
    var addnewcontract = document.getElementById('addnewcontract');
    var addorder = document.getElementById('addorder');
    var contractform = document.getElementById('contractform');
    
    addorder.style.display = 'none';
    contractform.style.display = 'none';

    addnew.addEventListener('click', function() {
        toggleVisibility();
    });
    addnewcontract.addEventListener('click', function() {
        toggleVisibilitycontract();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Your code here
        document.getElementById('deleteOrderLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevents the default link behavior (navigating to the href)

            var isConfirmed = confirm('Are you sure you want to delete this order?');
            // If user confirms, navigate to the delete route
            if (isConfirmed) {
                window.location.href = document.getElementById('deleteOrderLink').getAttribute('href');
            }
        });
    });

            // Capture the delete link and pass it to the modal's delete button
    $(document).on('click', '#deleteOrderLink', function (e) {
        e.preventDefault(); // Prevent default link action

        // Get the delete link
        var deleteUrl = $(this).attr('href');

        // When the delete button in the modal is clicked
        $('#confirmDeleteButton').on('click', function () {
            // Redirect to the delete route
            window.location.href = deleteUrl;
        });

        // Show the modal (this should already work if you have Bootstrap properly initialized)
        $('#confirmDeleteModal').modal('show');
    });



    function toggleVisibility() {
        if (addorder.style.display === 'none') {
            addorder.style.display = 'block';
        } else {
            addorder.style.display = 'none';
        }

        
    }
    function toggleVisibilitycontract(){
        if(contractform.style.display === 'none'){
            contractform.style.display = 'block';
        } else{
            contractform.style.display = 'none';
        }
    }
</script>

    <script>
       
       
        $(document).ready(function() {
            $("#type").select2({
                width: '100%'
            });
            $("#country").select2({
                width: '100%'
            });
            $('.datepicker').datepicker({
                autoclose: true
            });

            $('.select2').select2();

            // $('#ordertable').DataTable();
            new DataTable('#ordertable', {
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                }
            });
            $('#num').on('change', function(event) {
                var number = parseInt($('#num').val());
                if (number > 1) {
                    $('#name').prop('disabled', true);
                } else {
                    $('#name').prop('disabled', false);
                }
            });  
            function generateRandomString() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/get-last-id-order', // Replace with the actual URL to fetch the last ID
                        method: 'GET',
                        success: function(response) {
                            console.log(response);
                            let invoice = response.invoice;
                            
                            resolve(invoice);
                        },
                        error: function(error) {
                            console.error('Error fetching last ID:', error);
                            // Reject the promise with the error
                            reject(error);
                        }
                    });
                });
            }

            // Example usage:
            generateRandomString()
                .then(randomString => {
                    $('#invoice').val(randomString);
                    // Do something with the random string here
                })
                .catch(error => {
                    console.error('Failed to generate random string:', error);
            });


        });
        
            $('#ticket_code').on('change', function() {
                var ticketCodeValue = $(this).val();

                // Make an AJAX call
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: ticketCodeValue
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                            $('#airlines_name').val(response.airline.Full);
                            $('#airlines_code').val(response.airline.Short);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });
            $('#num').on('change', function(event) {
                var number_of_orders = parseInt($('#num').val());
                if (number_of_orders > 1) {
                    $('#name').prop('disabled', true);
                    $('#passport_no').prop('disabled', true);
                    $('#name').addClass('bg-gray-300');
                    $('#passport_no').addClass('bg-gray-300');
                } else {
                    $('#name').prop('disabled', false);
                    $('#name').removeClass('bg-gray-300');
                    $('#passport_no').removeClass('bg-gray-300');
                    $('#passport_no').removeClass('bg-gray-300');
                }
            });

            $('#submit_invoice').on('click', function(event) {

                event.preventDefault();
                var invoiceNo = $("#invoice").val();
                var invoiceDate = $("#date").val();
                var invoiceType = $("#type").val();
                var clientName = $("#agent").val();
                var invoiceNumber = $("#num").val();
                var passengerName = $("#name").val();
                var passportNo = $("#passport_no").val();
                var country = $("#country").val();
                var supplier = $("#supplier").val();
                var agentPrice = $("#contact_amount").val();
                var supplierPrice = $("#payable_amount").val();
                var remark = $("#remark").val();

                // console.log("qdw");
                if (invoiceNumber == 1 || invoiceNumber == '') {
                    $("#addorder").submit();
                } else if (invoiceNumber > 1) {

                    if (invoiceNo && invoiceDate && invoiceType && clientName &&
                        country && supplier && agentPrice &&
                        supplierPrice) {

                        var csrfToken = "{{ csrf_token() }}";
                        var tableHtml =
                            '<form id="visa_form" method="post" action="{{ route('addorder.multiple') }}">';
                        tableHtml += '<input type="hidden" name="_token" value="' + csrfToken + '">';
                        tableHtml += '<table class="table">';
                        tableHtml += '<thead>';
                        tableHtml += '<tr>';
                        tableHtml += '<th>Invoice No</th>';
                        tableHtml += '<th>Invoice Date</th>';
                        tableHtml += '<th>Invoice Type</th>';
                        tableHtml += '<th>Pessanger</th>';
                        tableHtml += '<th>Passport</th>';
                        tableHtml += '<th>Agent Price</th>';
                        tableHtml += '<th>Supplier Price</th>';
                        tableHtml += '<th>Remark</th>';
                        // Add more headers as needed
                        tableHtml += '</tr>';
                        tableHtml += '</thead>';
                        tableHtml += '<tbody>';

                        // Populate table rows with data
                        for (var i = 0; i < parseInt(invoiceNumber); i++) {
                            tableHtml += '<tr>';

                            tableHtml += '<td>' + invoiceNo + '</td>';
                            tableHtml += '<td>' + invoiceDate + '</td>';
                            tableHtml += '<td>' + invoiceType + '</td>';

                            tableHtml += '<td>' +
                                '<input type="text" class="form-control" name="passenger[]" id="passenger_' +
                                i + '"></td>';
                            tableHtml += '<td>' +
                                '<input type="text" class="form-control" maxlength="10" name="passport[]" id="passport' +
                                i +
                                '" value=""></td>';

                            tableHtml += '<td>' + agentPrice + '</td>';
                            tableHtml += '<td>' + supplierPrice + '</td>';
                            tableHtml += '<td>' + remark + '</td>';
                            // Add more cells as needed
                            tableHtml += '</tr>';
                        }
                        tableHtml += '<input type="hidden" name="agent" value="' + clientName + '">';
                        tableHtml += '<input type="hidden" name="remark" value="' + remark + '">';
                        tableHtml += '<input type="hidden" name="supplier" value="' + supplier + '">';
                        tableHtml += '<input type="hidden" name="agent_price" value="' + agentPrice + '">';
                        tableHtml += '<input type="hidden" name="supplier_price" value="' + supplierPrice +
                            '">';
                        tableHtml += '<input type="hidden" name="country" value="' + country + '">';
                        tableHtml += '<input type="hidden" name="invoice_no" value="' + invoiceNo +
                            '">';
                        tableHtml += '<input type="hidden" name="invoice_type" value="' + invoiceType +
                            '">';
                        tableHtml += '<input type="hidden" name="invoice_date" value="' + invoiceDate + '">';

                        tableHtml += '</tbody>';
                        tableHtml += '</table>';
                        tableHtml += '<td colspan="10" class="text-center">';
                        tableHtml +=
                            '<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">';
                        tableHtml += 'Submit';
                        tableHtml += '</button>';
                        tableHtml += '</td>';
                        tableHtml += '</form>';

                        $('#tableContainer').html(tableHtml);

                        $('#myModal').modal('show');

                    } else {}
                }

            });
    </script>

</x-app-layout>
