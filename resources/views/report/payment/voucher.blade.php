<x-app-layout>

    <div
        class="buttons justify-end flex gap-3 shadow-2xl py-2 border-2 border-stale-300 px-4 max-w-[1060px] mt-5 mx-auto">
        
        <button id="printBtn" class="text-white bg-red-600 font-bold text-md py-1 px-4">Print</button>
        <button onclick="goBack()" class="text-white bg-black font-bold text-md py-1 px-4">Go Back</button>
        
    </div>
    <main id="printSection" class="flex-1 m-4 mx-auto bg-white max-w-[1060px] shadow-3xl border-gray-200 px-6 py-9">

        <div class="flex justify-between items-center pb-2">
            <img src="{{ url(Auth::user()->company_logo) }}" alt="logo" width="220px" height="200px"/>
            <div class="w-[350px]">
                <h3 class="company-name font-bold text-3xl ">{{Auth::user()->name}}</h3>
                <p class="company-address text-lg font-medium">{{Auth::user()->company_address}}</p>
                <p class="company-phone text-lg font-medium">Mob : {{Auth::user()->mobile_no}}</p>
                <p class="company-email text-lg font-medium">Email : {{Auth::user()->email}}</p>
            </div>
        </div>
        <hr class="h-[2px] bg-gray-600" />
        <h1 class="text-2xl font-bold text-center my-7">Payment Voucher</h1>
        <div class="flex justify-between items-center">
            <div>
                <div><span class="font-semibold">Date</span> : <?php echo date('d-m-Y', strtotime($payment_voucher->date)); ?></div>
                <div><span class="font-semibold">Service Type</span> : Ticket Booking</div>
            </div>
            <div class="flex flex-col gap-y-1 max-w-[360px]">
                <h3 class="font-bold text-xl">Client Details</h3>
                <p class="text-lg"><span class="font-semibold">Client Name</span> : {{ $supplier->name }}</p>
                <p class="text-lg"><span class="font-semibold">Client Address :</span> {{ $supplier->address }}</p>
                <p class="text-lg"><span class="font-semibold">Email :</span> {{ $supplier->email }}</p>
                <p class="text-lg"><span class="font-semibold">Mob :</span> {{ $supplier->phone }}</p>
            </div>
        </div>
        <table class=" w-full my-3 border-y border-black">
            <thead class="border-y border-black bg-amber-300">
                <tr>
                    <th class="text-lg">Service Details</th>
                    <th class="text-lg">Payment Mode</th>
                    <th class="text-lg">Remark</th>
                    <th class="text-lg">Payment Amount</th>
                </tr>
            </thead>
            <tbody class="h-[90px]">
                <tr class=" py-5">
                    <td class="text-xl">Ticket Booking</td>
                    <td class="text-xl">{{ $payment_voucher->method }}</td>
                    <td class="text-xl">{{ $payment_voucher->remark }}</td>
                    <td class="text-xl">{{ number_format($payment_voucher->amount, 0, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>

    </main>
    <script type="text/javascript">
        const originalDate = new Date("2024-01-30 11:37:18");
        const day = originalDate.getDate().toString().padStart(2, '0');
        const month = (originalDate.getMonth() + 1).toString().padStart(2, '0'); // Note: Months are zero-based
        const year = originalDate.getFullYear();

        const formattedDate = `${day}-${month}-${year}`;
    </script>
    <script>
        var payment_form = "{{ route('payment.form') }}"; // Laravel generates the URL for the route

        function goBack(){
            window.location.href = payment_form;
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the "Print" button
            const printButton = document.getElementById('printBtn');
            const printSection = document.getElementById('printSection');

            // Attach a click event listener to the "Print" button
            printButton.addEventListener('click', function() {
                // Open the print dialog for the printSection
                window.print();
            });
        });
    </script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                padding: 10px;
                /* Adjust padding as needed */
            }
        }
    </style>
</x-app-layout>
