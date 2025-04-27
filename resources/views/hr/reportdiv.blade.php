<div class="reportdiv mt-5" id="reportdiv">
    <table class="table table-striped table-hover no-wrap " id="typetable">
        <thead class="bg-[#5dc8cc]">
            <tr>
                <th scope="col" class="px-4 py-2 ">Serial</th>
                <th scope="col" class="px-4 py-2 ">Ref ID</th>
                <th scope="col" class="px-4 py-2 ">Name</th>
                <th scope="col" class="px-4 py-2 ">Date</th>
                <th scope="col" class="px-4 py-2 ">Month</th>
                <th scope="col" class="px-4 py-2 ">Year</th>
                <th scope="col" class="px-4 py-2 ">Remark</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $index => $salary)
                <tr>
                    <th scope="row" class="px-4 py-2">{{ $index + 1 }}</th>
                    <td class="px-4 py-2 ">{{ $salary->ref_id }}</td>
                    <td class="px-4 py-2 ">{{ $salary->employee }}</td>
                    <td class="px-4 py-2 ">{{ $salary->date }}</td>
                    <td class="px-4 py-2 ">{{ $salary->month }}</td>
                    <td class="px-4 py-2 ">{{ $salary->year }}</td>
                    <td class="px-4 py-2 ">{{ $salary->remarks }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>