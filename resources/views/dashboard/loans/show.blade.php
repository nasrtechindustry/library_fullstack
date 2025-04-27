<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-lg font-bold mb-4">Library Management</h2>
            @include('components.left-nav')
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-6 custom-flow">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('loans.index') }}">View Students Loan a Book</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <div class="card shadow-lg mb-5 " id="loan-card">
                    <div class="card-header card-custom text-white text-center py-4">
                        <h4 class="card-title mb-0">Loan Details</h4>
                        <p class="small mb-0">Here are the details of the loaned book</p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <fieldset class="border p-4 rounded shadow-sm">
                                    <legend class="float-none w-auto px-3 text-custom fw-bold">Student Details</legend>
                                    <p><strong>First Name:</strong> <span class="text-dark">{{ $loan->student->student->first_name }}</span></p>
                                    <p><strong>Last Name:</strong> <span class="text-dark">{{ $loan->student->student->last_name }}</span></p>
                                    <p><strong>Registration Number:</strong> <span class="badge bg-info text-dark">{{ $loan->student->reg_no }}</span></p>
                                    <p><strong>Email:</strong> <a href="mailto:{{ $loan->student->student->email }}" class="text-decoration-none text-secondary">{{ $loan->student->student->email }}</a></p>
                                </fieldset>

                            </div>
                            <div class="col-md-6">
                                <fieldset class="border p-4 rounded shadow-sm">
                                    <legend class="float-none w-auto px-3 text-custom fw-bold">Book Details</legend>
                                    <p><strong>Title:</strong> <span class=" fw-semibold">{{ $loan->book->title }}</span></p>
                                    <p><strong>Genre:</strong> <span class="badge bg-secondary">{{ $loan->book->genre->genre_name }}</span></p>
                                    <p><strong>Author:</strong> {{ $loan->book->authors[0]->lastname }}</p>
                                    <p><strong>Publication Year:</strong> {{ $loan->book->publication_year }}</p>
                                </fieldset>

                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row my-3">
                            <div class="col-md-6">
                                <p><strong>Loan Date:</strong> {{ $loan->loan_date }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Return Date:</strong> {{ $loan->return_date }}</p>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-md-12">
                                @if (now()->greaterThan($loan->return_date))
                                @php
                                $overdueDays = now()->diffInDays($loan->return_date);
                                $paymentamount = 5000 * $overdueDays;
                                @endphp
                                <p class="text-danger"><strong>Overdue:</strong> {{ ceil(abs($overdueDays)) }} day(s)</p>
                                @else
                                <p class="text-success"><strong>Status:</strong> No overdue</p>
                                @endif

                                <p class="text-success">Required to pay {{number_format(ceil(abs($paymentamount)))}} Tsh</p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class=" my-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0 p-3">Overdue Payment</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('payment.overdue' , $loan->id)}}" method="POST"
                            onsubmit="return confirm('Is Student Pay His / Her over due fine in order to record it')">
                                @csrf

                                <div class="mb-3">
                                    <label for="amountDue" class="form-label"><strong>Amount Due (in Tsh)</strong></label>
                                    <input type="text" class="form-control" id="amountDue" name="fine_amount"
                                        value="{{ number_format(ceil(abs($paymentamount))) }}"
                                        placeholder="Enter payment amount" readonly>

                                </div>

                                <div class="d-flex gap-3 align-items-center justify-content-end">
                                    <a href="{{ route('loans.index') }}" class="btn btn-info btn-sm me-2">
                                        <i class="fas fa-arrow-left"></i> Back to Loans
                                    </a>
                                    <button type="button" onclick="printCard()" class="btn btn-secondary  btn-sm">Print Statement</button>

                                    <button type="submit" class="btn btn-primary btn-sm ">Submit Payment</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>





            </div>
        </main>
    </div>
</x-app-layout>

<script>
    function printCard() {
        var card = document.getElementById('loan-card'); // Get the card element
        var printWindow = window.open('', '', 'height=600,width=800'); // Open a new window
        printWindow.document.write('<html><head><title>Loan Details</title>'); // Set up the page title
        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">'); // Optionally include Bootstrap for styling
        printWindow.document.write('</head><body>');
        printWindow.document.write(card.innerHTML); // Write the content of the card into the new window
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // Close the document stream
        printWindow.print(); // Trigger the print dialog
    }
</script>