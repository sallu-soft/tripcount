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


<div id="sideNav"
    class="text-white lg:block hidden w-64 min-h-screen h-auto rounded-none border-none overflow-y-scroll no-scrollbar bg-gray-800">
    

    <div class="flex items-center flex-wrap  justify-between w-full px-3 mt-3" href="#">
        <div class="flex items-center flex-col justify-center w-full">
            {{-- <img src="{{ 'public/' . Auth::user()->company_logo }}" alt="logo" width="100px" height="69px"/> --}}
            <img src="{{ url(Auth::user()->company_logo) }}" alt="logo" width="150px" height="100px"/>
            <span class="ml-2 text-sm font-bold">{{ Auth::user()->name }}</span>
            {{-- <p class="ml-2 text-sm font-bold w-full">{{ Auth::user()->company_logo }}</p> --}}
        </div>
    </div>

    <div class="w-full px-2">

        <div class="flex flex-col items-center w-full mt-3 border-t border-gray-700 gap-y-1">

            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5h4m-4 0a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17h6M9 12h6M9 7h6" />
                </svg>
                {{ __('Dashboard') }}
            </x-nav-link>
            <li class="w-full list-none">
                <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                    aria-controls="dropdown-master" data-collapse-toggle="dropdown-master">
                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 18V5a2 2 0 012-2h6a2 2 0 012 2v13M9 18c0 2.21 1.79 4 4 4s4-1.79 4-4M5 14h.01M5 17h.01M5 10h.01M19 14h.01M19 17h.01M19 10h.01" />
                    </svg>
                    <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Master</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </p>
                <ul id="dropdown-master" class="hidden divide-y-2 text-white bg-gray-700 ml-7 rounded-lg">
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('agent.view')" :active="request()->routeIs('agent.view')">
                             <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Agent') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('supplier.view')" :active="request()->routeIs('supplier.view')">
                             <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Supplier') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('transaction.view')" :active="request()->routeIs('transaction.view')">
                             <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Transaction Method') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('airline.view')" :active="request()->routeIs('airline.view')">
                             <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Add Air Lines') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('type.index')" :active="request()->routeIs('type.index')">
                             <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Invoice Types') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('moneytransfer.view')" :active="request()->routeIs('moneytransfer.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Contra') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('expanditure.view')" :active="request()->routeIs('expanditure.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Expanditure') }}
                        </x-nav-link>
                    </li>
                   
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('type.index')" :active="request()->routeIs('type.index')">
                             <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Year Close') }}
                        </x-nav-link>
                    </li>
                  
                </ul>
            </li>
           
           
            
            
            <x-nav-link :href="route('order.view')" :active="request()->routeIs('order.view')">
                <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16M8 6v12M12 6v12M16 6v12" />
                </svg>
                {{ __('Service Entry') }}
            </x-nav-link>
            
            <li class="w-full list-none">
                <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                    aria-controls="dropdown-RP" data-collapse-toggle="dropdown-RP">
                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm0 0v3m0 0h3m-3-3H9m3 3c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4zm0 0v3m0 0h3m-3-3H9m7.5 7.5c3.58 0 6.5 2.92 6.5 6.5h-13c0-3.58 2.92-6.5 6.5-6.5zm0 0v3m0 0h3m-3-3H9m0 0c0-3.86 3.14-7 7-7s7 3.14 7 7m-10.5-1v1.5m-3-1.5v1.5m0-1.5H3m18 1.5h-3m3-1.5v4m-3-4v4" />
                    </svg>
                    <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Receive Payment</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </p>
                <ul id="dropdown-RP" class="hidden divide-y-2 text-white bg-gray-700 ml-7 rounded-lg">
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('receive.index')" :active="request()->routeIs('receive.index')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Receive') }}
                        </x-nav-link>
                    </li>
                    <li class=" font-semibold">
                        <x-nav-link :href="route('payment.form')" :active="request()->routeIs('payment.form')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Payment') }}
                        </x-nav-link>
                    </li>
                  
                </ul>
            </li>
            @if($role != 'employee')
            <li class="w-full list-none">
                <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                    aria-controls="dropdown-example1" data-collapse-toggle="dropdown-example1">
                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm0 0v3m0 0h3m-3-3H9m3 3c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4zm0 0v3m0 0h3m-3-3H9m7.5 7.5c3.58 0 6.5 2.92 6.5 6.5h-13c0-3.58 2.92-6.5 6.5-6.5zm0 0v3m0 0h3m-3-3H9m0 0c0-3.86 3.14-7 7-7s7 3.14 7 7m-10.5-1v1.5m-3-1.5v1.5m0-1.5H3m18 1.5h-3m3-1.5v4m-3-4v4" />
                    </svg>
                    <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>HR</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </p>
                <ul id="dropdown-example1" class="hidden divide-y-2 text-white bg-gray-700 ml-7 rounded-lg">
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('pay_salary.view')" :active="request()->routeIs('pay_salary.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Pay Salary') }}
                        </x-nav-link>
                    </li>
                    <li class=" font-semibold">
                        <x-nav-link :href="route('stuff_details.view')" :active="request()->routeIs('stuff_details.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Stuff Details') }}
                        </x-nav-link>
                    </li>
                
                </ul>
            </li>
        @endif
            
            {{-- <li class="w-full list-none">
                <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                    aria-controls="dropdown-finance" data-collapse-toggle="dropdown-finance">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Finance</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </p>
                <ul id="dropdown-finance" class="hidden divide-y-2 text-white bg-gray-700 ml-7 rounded-lg">
                    <li class=" font-semibold">
                        <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Transaction') }}
                        </x-nav-link>
                    </li>
                    
                    <li class=" font-semibold">
                        <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Payment Voucher') }}
                        </x-nav-link>
                    </li>
                    <li class=" font-semibold">
                        <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Journal Voucher') }}
                        </x-nav-link>
                    </li>
                    <li class=" font-semibold">
                        <x-nav-link :href="route('deportee.index')" :active="request()->routeIs('deportee.index')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Voucher Adjustment') }}
                        </x-nav-link>
                    </li>
                    <li class="w-full list-none">
                        <p class="flex items-center w-full h-12 px-3 hover:text-white rounded hover:bg-[#00959E]"
                            aria-controls="dropdown-daybook" data-collapse-toggle="dropdown-daybook">
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Day Book</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </p>
                        <ul id="dropdown-daybook" class="hidden divide-y-2 text-white bg-black rounded-lg">
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Journal Book') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Cash Book') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Bank Book') }}
                                </x-nav-link>
                            </li>
                            
                           
                           
                           
                        </ul>
                    </li>
                   
                   
                </ul>
            </li> --}}
            <li class="w-full list-none">
                <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Ticket Invoice</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </p>
                <ul id="dropdown-example" class="hidden divide-y-2  bg-gray-700 ml-7 rounded-lg">
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Tickets Invoicing') }}
                        </x-nav-link>
                    </li>
                    {{-- <li class="text-white font-semibold flex items-center">
                        <x-nav-link :href="route('refund_ticket.view')" :active="request()->routeIs('refund_ticket.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Ticket Refund') }}
                        </x-nav-link>
                    </li> --}}
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('refund_ticket')" :active="request()->routeIs('refund_ticket')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M12 6v12m-6-6h12" />
                        </svg>
                            {{ __('Refund') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('reissue.view')" :active="request()->routeIs('reissue.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Reissue') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('void.view')" :active="request()->routeIs('void.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('Void') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('adm.view')" :active="request()->routeIs('adm.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v12m-6-6h12" />
                            </svg>
                            {{ __('ADM') }}
                        </x-nav-link>
                    </li>
                    <li class="text-white font-semibold">
                        <x-nav-link :href="route('deportee.index')" :active="request()->routeIs('deportee.index')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M12 6v12m-6-6h12" />
                        </svg>
                            {{ __('Deportee') }}
                        </x-nav-link>
                    </li>
                    
                   
                </ul>
            </li>
            
            <li class="w-full list-none">
                <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                    aria-controls="dropdown-report" data-collapse-toggle="dropdown-report">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Report</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </p>
                <ul id="dropdown-report" class="hidden divide-y-2 text-white bg-gray-700 ml-7 rounded-lg">
                    <li class="w-full list-none">
                        <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                            aria-controls="dropdown-sales_report" data-collapse-toggle="dropdown-sales_report">
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Sales Report</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </p>
                        <ul id="dropdown-sales_report" class="hidden divide-y-2 text-white bg-black rounded-lg">
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Sales Report(Ticket)') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('sales_ticket')" :active="request()->routeIs('sales_ticket')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Sales Report(Ticket)') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Sales Report(Visa)') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('sales_visa')" :active="request()->routeIs('sales_visa')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Sales Report(Visa)') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Sales Executive Report') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('sales_exicutive_stuff')" :active="request()->routeIs('sales_exicutive_stuff')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Staff Sales Report') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Sales Analysis Report') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('sales_analysis')" :active="request()->routeIs('sales_analysis')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Sales Analysis Report') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Flight Report(Ticket)') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('flight_ticket')" :active="request()->routeIs('flight_ticket')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Flight Report(Ticket)') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('refund_ticket_report.view')" :active="request()->routeIs('refund_ticket_report.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Refund Report') }}
                                </x-nav-link>
                            </li>
                            {{-- <li class="text-white font-semibold flex items-center">
                                <x-nav-link :href="route('refund_ticket.view')" :active="request()->routeIs('refund_ticket.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Refund Report(Ticket)') }}
                                </x-nav-link>
                            </li> --}}
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('void_ticket')" :active="request()->routeIs('void_ticket')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Void Report') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('reissue_ticket')" :active="request()->routeIs('reissue_ticket')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Reissue Report') }}
                                </x-nav-link>
                            </li>
                            {{-- <li class="text-white font-semibold">
                                <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Deportee Report') }}
                                </x-nav-link>
                            </li> --}}
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('deportee.index')" :active="request()->routeIs('deportee.index')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('ADM Report') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('segment.view')" :active="request()->routeIs('segment.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Segment Report') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('ait_report_index')" :active="request()->routeIs('ait_report_index')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('AIT Report') }}
                                </x-nav-link>
                            </li>
                            
                            
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('payment_report_index')" :active="request()->routeIs('payment_report_index')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Payment Report') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('receive_report_index')" :active="request()->routeIs('receive_report_index')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Receive Report') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('sector_city.view')" :active="request()->routeIs('sector_city.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Sector/City Report') }}
                                </x-nav-link>
                            </li>
                           
                        </ul>
                    </li>
                    <li class="w-full list-none">
                        <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                            aria-controls="dropdown-finance_report" data-collapse-toggle="dropdown-finance_report">
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Finance Report</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </p>
                        <ul id="dropdown-finance_report" class="hidden divide-y-2 text-white bg-black rounded-lg">
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('general_ledger')" :active="request()->routeIs('general_ledger')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('General Ledger') }}
                                </x-nav-link>
                            </li>
                       
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline " title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Trial Balance') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('trialbalance.view')" :active="request()->routeIs('trialbalance.view')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Trial Balance') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline " title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Profit Loss Statement') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('profit_loss.view')" :active="request()->routeIs('profit_loss.view')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Profit Loss Statement') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Income Statement') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('income_statement.index')" :active="request()->routeIs('income_statement.index')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Income Statement') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Journal Book') }}
                                </x-nav-link>
                            </li>
                          
                            
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('cash_book.view')" :active="request()->routeIs('cash_book.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Cash Book') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('bank_book.view')" :active="request()->routeIs('bank_book.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Bank Book') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                <x-nav-link :href="route('dailystate.view')" :active="request()->routeIs('dailystate.view')">
                                    <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ __('Daily Statement') }}
                                </x-nav-link>
                            </li>
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Profit Report') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('profitreport.view')" :active="request()->routeIs('profitreport.view')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Profit Report') }}
                                    </x-nav-link>
                                @endif
                            </li>
                            
                            <li class="text-white font-semibold">
                                @if(session('employee'))
                                    <div class="flex items-center cursor-not-allowed w-full h-12 px-3 rounded text-sm text-white font-light no-underline" title="Not permitted">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Expenditure Report') }}
                                    </div>
                                @else
                                    <x-nav-link :href="route('expenditure.report')" :active="request()->routeIs('expenditure.report')">
                                        <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        {{ __('Expenditure Report') }}
                                    </x-nav-link>
                                @endif
                            </li>
                           
                           
                        </ul>
                    </li>
                    
                   
                </ul>
            </li>
            {{-- <x-nav-link :href="route('report.view')" :active="request()->routeIs('report.view')">
                <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('Reports') }}
            </x-nav-link> --}}
            <x-nav-link :href="route('due_reminder')" :active="request()->routeIs('due_reminder')">
                <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('Due Reminder') }}
            </x-nav-link>
            
            
            @if($role != 'employee')
                <li class="w-full list-none">
                    <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                        aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Settings</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </p>
                    <ul id="dropdown-example2" class="hidden divide-y-2 text-white bg-gray-700 ml-7 rounded-lg">
                        <li class=" font-semibold">
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                {{ __('Company Profile') }}
                            </x-nav-link>
                        </li>
                        <li class=" font-semibold">
                            <x-nav-link :href="route('changePass')" :active="request()->routeIs('changePass')">
                                <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                {{ __('Change Password') }}
                            </x-nav-link>
                        </li>
                    
                    </ul>
                </li>
            @endif
            <li class="w-full list-none">
                <p class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-[#00959E]"
                    aria-controls="dropdown-support" data-collapse-toggle="dropdown-support">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left text-sm" sidebar-toggle-item>Support</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </p>
                <ul id="dropdown-support" class="hidden divide-y-2 text-white bg-gray-700 ml-7 rounded-lg">
                    <li class=" font-semibold">
                        <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Taining') }}
                        </x-nav-link>
                    </li>
                    <li class=" font-semibold">
                        <x-nav-link :href="route('ticket.view')" :active="request()->routeIs('ticket.view')">
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('0181215760') }}
                        </x-nav-link>
                    </li>
                    <li class="py-2 px-3 text-sm hover:bg-[#00959E] hover:text-white">
                        <a href='https://anydesk.com/en' class="flex decoration-none no-underline items-center hover:text-white" target="_blanck" >
                            <svg class="w-6 h-6 mr-3 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <p class="text-sm">Download Anydesk</p>
                        </a>
                    </li>
                  
                </ul>
            </li>



        </div>
        {{-- <div class="flex flex-col items-center w-full mt-2 border-t border-gray-700">

            <a class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-indigo-700" href="#">
                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
                <span class="ml-2 text-sm font-medium">Settings</span>
            </a>
            <a class="relative flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-indigo-700" href="#">
                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                <span class="ml-2 text-sm font-medium">Messages</span>
                <span class="absolute top-0 left-0 w-2 h-2 mt-2 ml-2 bg-indigo-500 rounded-full"></span>
            </a>
        </div> --}}
    </div>

</div>
