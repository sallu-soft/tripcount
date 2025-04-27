<x-app-layout>

    <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
        
        <button id="printButton" class="text-white bg-red-600 font-bold text-md py-2 px-4">Print</button>
        
        <button class="text-white bg-black font-bold text-md py-2 px-4" onclick="goBack()">GO BACK</button>
    </div> 
    <div id="printSection" class=" py-10">
        <div class="flex-1 mt-3 mx-auto max-w-[1060px] bg-white shadow-xl border-gray-200 px-6 py-2 pb-10">

            <div class="flex justify-between items-center pb-2">
                <img class="" src="{{ asset(Auth::user()->company_logo) }}" alt="Company Logo" height="150px" width="180px" />
                <div>
                    <h3 class="company-name font-bold text-3xl ">{{Auth::user()->name}}</h3>
                    <p class="company-address text-lg font-medium">{{Auth::user()->company_address}}</p>
                    <p class="company-phone text-lg font-medium">Tel : {{Auth::user()->mobile_no}}</p>
                    <p class="company-email text-lg font-medium">Email : {{Auth::user()->email}}</p>
                </div>
            </div>
            <hr class="h-[2px] bg-gray-600" />
            <h1 class="text-2xl font-bold text-center my-3">Pay Slip</h1>
            <div class="flex justify-between items-center">
                <div>
                    <div><span class="font-semibold">Date</span> : {{(new DateTime())->format('d-m-Y')}}</div>
                    <div><span class="font-semibold">Receipt No</span> : {{ $salary->ref_id }}</div>
                </div>
               
            </div>
            <table class="w-full my-3 border-y border-black">
                <thead class="border-y border-black bg-gray-50">
                    <tr>

                        <th class="text-lg">Particulars</th>
                        <th class="text-lg text-center">Amount</th>
                    </tr>
                </thead>
                <tbody class="h-[50px]">
                    <tr class=" py-2">
                        <td class="text-xl">{{ $salary->name }}</td>
                        <td class="text-xl text-center">{{ number_format($salary->amount, 0, '.', ',') }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="w-full flex justify-between">
                <div>Amount in Words : <span class="">@php function numberToWords($number)
                    {
                        $words = [
                            0 => 'Zero',
                            1 => 'One',
                            2 => 'Two',
                            3 => 'Three',
                            4 => 'Four',
                            5 => 'Five',
                            6 => 'Six',
                            7 => 'Seven',
                            8 => 'Eight',
                            9 => 'Nine',
                            10 => 'Ten',
                            11 => 'Eleven',
                            12 => 'Twelve',
                            13 => 'Thirteen',
                            14 => 'Fourteen',
                            15 => 'Fifteen',
                            16 => 'Sixteen',
                            17 => 'Seventeen',
                            18 => 'Eighteen',
                            19 => 'Nineteen',
                            20 => 'Twenty',
                            30 => 'Thirty',
                            40 => 'Forty',
                            50 => 'Fifty',
                            60 => 'Sixty',
                            70 => 'Seventy',
                            80 => 'Eighty',
                            90 => 'Ninety',
                            100 => 'Hundred',
                            1000 => 'Thousand',
                            1000000 => 'Million',
                            1000000000 => 'Billion',
                            1000000000000 => 'Trillion',
                            1000000000000000 => 'Quadrillion',
                            1000000000000000000 => 'Quintillion',
                        ];

                        if (!is_numeric($number)) {
                            return false;
                        }

                        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
                            // overflow
                            trigger_error(
                                'numberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                                E_USER_WARNING,
                            );
                            return false;
                        }

                        if ($number < 0) {
                            return '-' . numberToWords(abs($number));
                        }

                        $string = $fraction = null;

                        if (strpos($number, '.') !== false) {
                            [$number, $fraction] = explode('.', $number);
                        }

                        switch (true) {
                            case $number < 21:
                                $string = $words[$number];
                                break;
                            case $number < 100:
                                $tens = ((int) ($number / 10)) * 10;
                                $units = $number % 10;
                                $string = $words[$tens];
                                if ($units) {
                                    $string .= '-' . $words[$units];
                                }
                                break;
                            case $number < 1000:
                                $hundreds = $number / 100;
                                $remainder = $number % 100;
                                $string = $words[$hundreds] . ' ' . $words[100];
                                if ($remainder) {
                                    $string .= ' ' . numberToWords($remainder);
                                }
                                break;
                            default:
                                $baseUnit = pow(1000, floor(log($number, 1000)));
                                $numBaseUnits = (int) ($number / $baseUnit);
                                $remainder = $number % $baseUnit;
                                $string = numberToWords($numBaseUnits) . ' ' . $words[$baseUnit];
                                if ($remainder) {
                                    $string .= $remainder < 100 ? ' and ' : ', ';
                                    $string .= numberToWords($remainder);
                                }
                                break;
                        }

                        if (null !== $fraction && is_numeric($fraction)) {
                            $string .= ' point';
                            $words = [];
                            foreach (str_split((string) $fraction) as $number) {
                                $words[] = $number;
                            }
                            $string .= ' ' . implode(' ', $words);
                        }

                        return $string;
                    }

                    // Example usage:
                    $amount = $salary->amount;
                    $amountInWords = numberToWords($amount);
                echo $amountInWords; @endphp Only</span></div>
                
            </div>
            <div class="flex justify-between mt-[80px]">
                <p class="border-t border-gray-400 border-dashed px-4">Employer Signature</p>
                <p class="border-t border-gray-400 border-dashed px-4">Employee Signature</p>
            </div>
        </div>
    </div>
    <script>
        // Function to print the content of the reportdiv
        function printReport() {
            var printContents = document.getElementById("printSection").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    
        // Add event listener to the "Print" button
        document.querySelector("#printButton").addEventListener("click", function() {
            printReport();
        });
    </script>
</x-app-layout>