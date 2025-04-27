<x-app-layout>
    <style>
        #reportdiv {
            background-color: white !important;
            box-shadow: none !important; /* Ensure no shadows are rendered */
        }
        * {
            box-shadow: none !important;
        }
        html, body {
        overflow-x: hidden; /* Hide any unnecessary horizontal scrolling */
        }


    </style>
    <div class="bg-white shadow-lg py-3 px-3 rounded-lg">
        <form autocomplete="off" id="reportForm" action="{{ route('general_ledger_report') }}" method="POST">
            @csrf
            <div class="flex flex-wrap sm:flex-nowrap gap-4 items-center">
                <!-- Agent/Supplier -->
                <div class="w-[250px] flex flex-col gap-1">
                    <label for="agent" class="font-semibold text-[14px] text-[#22262e]">
                        Agent/Supplier <span class="text-red-500">*</span>
                    </label>
                    <select id="agent_supplier" name="agent_supplier"
                        class="text-gray-900 text-sm bg-gray-50 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 w-full p-2"
                        required>
                        <option value="">Select One</option>
                        <option value="agent">Agent</option>
                        <option value="supplier">Supplier</option>
                    </select>
                </div>
        
                <!-- Candidate -->
                <div class="w-[250px] flex flex-col gap-1">
                    <label for="supplier" class="font-semibold text-[14px] text-[#22262e]">Candidate
                        <span class="text-red-500">*</span>
                    </label>
                    <select id="agent_supplier_id" name="agent_supplier_id"
                        class="text-gray-900 text-sm bg-gray-50 border border-gray-300 focus:ring-blue-500 focus:border-blue-500  p-2 select2"
                        required>
                        <option value="">Select One</option>
                    </select>
                </div>
        
                <!-- Start Date -->
                <div class="w-[180px] flex flex-col gap-1">
                    <label for="start_date" class="font-semibold text-[14px] text-[#22262e]">From</label>
                    <input type="text" class="form-control datepicker w-full p-2 border border-gray-300" name="start_date" id="start_date"
                        placeholder="Start Date" />
                </div>
        
                <!-- End Date -->
                <div class="w-[180px] flex flex-col gap-1">
                    <label for="end_date" class="font-semibold text-[14px] text-[#22262e]">To</label>
                    <input type="text" class="form-control datepicker w-full p-2 border border-gray-300" name="end_date" id="end_date"
                        placeholder="End Date" />
                </div>
        
                <!-- Submit Button -->
                <div class="w-auto mt-auto">
                    <button type="submit" class="bg-black text-md px-6 py-2 rounded-sm text-white font-bold">
                        Submit
                    </button>
                </div>
            </div>
        </form>
        
    </div>
    

    <div class="buttons justify-end flex gap-3 p-5">

        <button onclick="downloadReport()" class="text-white bg-blue-600 font-bold text-md py-2 px-4">Download Report</button>

        <button id="printButton" class="text-white bg-red-600 font-bold text-md py-2 px-4">Print</button>
        
        <button class="text-white bg-black font-bold text-md py-2 px-4" onclick='goBack()'>GO BACK</button>
    </div> 
    
    <div class="reportdiv " id="reportdiv">

    </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <!-- Load html2canvas and jsPDF libraries before the function -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>



    <script>
        $(document).ready(function() {
            $("#agent_supplier").change(function() {
                var selectedValue = $(this).val();
                if (selectedValue) {
                    $.ajax({
                        url: "/get_agent_supplier",
                        method: "GET",
                        data: {
                            who: selectedValue
                        },
                        success: function(response) {
                            updateOptions(response);
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });
                }
            });

            function updateOptions(options) {
                var selectElement = $("#agent_supplier_id");
                selectElement.empty();
                selectElement.append("<option value=''>Select One</option>");
                options.forEach(function(option) {
                    selectElement.append("<option value='" + option.id + "'>" + option.name + "</option>");
                });
            }
            $('.datepicker').datepicker({
                autoclose: true,
                format: "mm/dd/yyyy", // Customize date format
                todayHighlight: true, // Highlight today
               
            });


            $('.select2').select2();

            // $('#ordertable').DataTable();

            $('#reportForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Update the reportdiv with the response
                        $('#reportdiv').html('');
                        $('#reportdiv').html(response.html);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        // Function to print the content of the reportdiv
        // function printReport() {
        //     var printContents = document.getElementById("reportdiv").innerHTML;
        //     var originalContents = document.body.innerHTML;
        //     document.body.innerHTML = printContents;
        //     window.print();
        //     document.body.innerHTML = originalContents;
        // }

        function printReport() {
            var printContents = document.getElementById("reportdiv").innerHTML;
            var printWindow = window.open("", "", "width=900,height=700");

            printWindow.document.write(`
                <html>
                    <head>
                        <title>Print Report</title>
                        <link rel="stylesheet" href="path/to/your/styles.css">
                    </head>
                    <body>${printContents}</body>
                </html>
            `);

            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }

    
        // Add event listener to the "Print" button
        document.querySelector("#printButton").addEventListener("click", function() {
            printReport();
        });

        function downloadReport() {
            var { jsPDF } = window.jspdf; // Access jsPDF
            var reportDiv = document.getElementById("reportdiv");

            html2canvas(reportDiv, {
                backgroundColor: "#ffffff", // Ensure a white background
                scale: 2, // Increase resolution for better quality
            }).then((canvas) => {
                var imgData = canvas.toDataURL("image/png"); // Convert canvas to image
                var pdf = new jsPDF("p", "mm", "a4"); // Initialize PDF
                var imgWidth = 190; // Set image width for PDF
                var pageHeight = pdf.internal.pageSize.height; // PDF page height
                var imgHeight = (canvas.height * imgWidth) / canvas.width; // Calculate image height
                var heightLeft = imgHeight;
                var position = 0;

                // Add the first page
                pdf.addImage(imgData, "PNG", 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                // Add additional pages if content overflows
                while (heightLeft > 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, "PNG", 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save("report.pdf"); // Save the PDF
            });
        }

        $('.select2').select2({
                width: '100%',
                placeholder: "Select an option",
                allowClear: true
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
