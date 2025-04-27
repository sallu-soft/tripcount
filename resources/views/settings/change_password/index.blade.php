<x-app-layout>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4 w-[100%] lg:w-[100%] font-bold text-2xl">Change Password</h1>

        <div class="change_password w-[60%] lg:w-[40%] bg-white p-5 shadow-lg rounded-lg">
            
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')
        
                <div>
                    <x-input-label for="current_password" :value="__('Current Password')" />
                    <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
        
                <div>
                    <x-input-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
        
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
        
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
        
                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>

        {{-- <div class="bg-white shadow-md p-6 my-3 w-full md:w-[60%] mx-auto">
            <form method="GET" action="{{ route('type.index') }}" class=" flex justify-end mb-3">
                <div class="flex items-center gap-3">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="bg-black px-5 py-1.5 rounded text-white">Search</button>
                </div>
            </form>
            <table class="table table-striped table-hover no-wrap " id="typetable">
                <thead class="bg-[#5dc8cc]">
                    <tr>
                        <th scope="col" class="px-4 py-2 ">Serial</th>
                        <th scope="col" class="px-4 py-2 ">Name</th>
                        
                        <th scope="col" class="px-4 py-2 flex justify-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $index => $type)
                        <tr>
                            <th scope="row" class="px-4 py-2">{{ $type->id}}</th>
                            <td class="px-4 py-2 ">{{ $type->name }}</td>
                            <td class="px-4 py-2 flex justify-center">
                                <a href="{{ route('type.edit', ['id' => encrypt($type->id)]) }}" class=""><i class="text-xl fa fa-pencil fa-fw"></i></a>
                                <a href="{{ route('type.delete', ['id' => $type->id]) }}" class=""><i class="text-xl fa fa-trash-o fa-fw"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $types->links() }}
        </div> --}}

    </div>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });
    
            $('.select2').select2({
                theme:'classic',
            });

            // $('#typetable').DataTable();

        
        });

        
    </script>
</x-app-layout>