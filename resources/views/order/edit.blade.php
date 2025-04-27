<x-app-layout>
    <div class="">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>
    
    <div >
        
        <h3 class="font-bold text-2xl py-3">Order Details Update</h3>
        <form action="{{ route('order.update', ['id' => $order->id]) }}" autocomplete="off" method="POST" id="editorder" class="w-[80%] p-5 bg-white shadow-lg">
            @csrf
            
            <input type="hidden" name="id" value="{{ $order->id }}" />
            <input type="hidden" name="prev_agent_amount" value="{{ $order->contact_amount }}" />
            <input type="hidden" name="prev_supplier_amount" value="{{ $order->payable_amount }}" />

            <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="invoice" class="block w-full md:w-[40%] text-gray-700 text-sm mb-2">Invoice
                        No.</label>
                    <input type="text" id="invoice" readonly
                        class="text-center text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        name="invoice" value={{$order->invoice}}>
                </div>
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="date" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Invoice
                        Date</label>
                    <input type="date" id="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                        name="date" value={{$order->date}}>
                </div>
                
            </div>

            <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="type" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Invoice Type</label>
                    {{-- <input type="text" id="type"
                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                        name="type"> --}}
                        <select
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1 w-auto select2"
                        name="type" id="type" placeholder="Select type" required >
                          @foreach($types as $type)
                              <option value="{{ $type->id }}" @if($order->type == $type->id) selected @endif>
                                  {{ $type->name }}
                              </option>
                          @endforeach
                    </select>
                </div>
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="agent" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Client Name</label>
                  
                      <select name="agent" id="agent" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500  focus:border-blue-500 block w-auto p-1 select2">
                          @foreach($agents as $agent)
                              <option value="{{ $agent->id }}" @if($order->agent == $agent->id) selected @endif>
                                  {{ $agent->name }}
                              </option>
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
                        name="name" value="{{$order->name}}">
                </div>
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="passport_no" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Passport No</label>
                    
                        <input type="text" maxlength="9" id="passport_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="passport_no" value="{{$order->passport_no}}">
                </div>
            </div>
            
            <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="country" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Country</label>
                    <select required 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-auto p-1 select2 "
                        name="country" id="country" required>
                        <option value={{$order->country}}>{{$order->country}}</option>
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
                    <label for="seller" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Supplier</label>

                    <select required name="supplier" id="supplier"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-auto p-1 select2">
                       
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @if($order->supplier == $supplier->id) selected @endif>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                        @foreach ($agents as $agent)
                            <option value="agent_{{ $agent->id }}" 
                                @if($order->who == "agent_{$agent->id}") selected @endif>
                                {{ $agent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap gap-x-10 -mx-4 mb-4">
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="contact_amount" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Agent
                        Price</label>
                    <input type="text" id="contact_amount"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                        name="contact_amount" required value={{$order->contact_amount}}>
                </div>
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="payable_amount" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Supplier
                        Price</label>
                    <input type="text" id="payable_amount"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                        name="payable_amount" required value={{$order->payable_amount}}>
                </div>
            </div>
            <div class="flex flex-wrap gap-x-6 -mx-4 mb-4">
                
                <div class="w-full md:w-[47%] px-4 mb-2 flex items-center">
                    <label for="remark" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">Remark</label>
                    <textarea id="remark"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                        name="remark">{{$order->remark}}</textarea>
                </div>

            </div>
            <div class="col-span-2 gap-4 px-8 flex justify-end">
                
                <button type="submit" id="submit_ticket"
                    class="bg-black text-xl text-white font-medium py-2 px-5 rounded">Submit</button>
            </div>

        </form>
        
    </div>

    <script>
       
        $(document).ready(function() {
            // $("#type").select2({ width: '100%' });
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
            // $('#invoice').val(generateRandomString());

            function generateRandomString(length = 10) {
                const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                let randomString = '';

                for (let i = 0; i < length; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    randomString += characters.charAt(randomIndex);
                }

                return randomString;
            }
        });
    </script>

</x-app-layout>
