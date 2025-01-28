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
                <nav>
                    <div class="breadcrumb">
                        <ul>
                            <li class='active'>View Student Loan a Book</li>
                        </ul>
                    </div>
                </nav>
                
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button class="btn btn-close" data-bs-dismiss="alert"></button>
                    {{session('success')}}
                </div>
                @endif

                <div class="card">
                    <div class="card-content">
                        <div class="card-header bg-custom p-3">
                            Book || Loans
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Registration Number</th>
                                            <th>Book Title</th>
                                            <th>Request Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $loans as $loan )
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$loan->student->student->first_name }} {{ucwords($loan->student->student->last_name )}}</td>
                                            <td>{{$loan->student->reg_no}}</td>
                                            <td class="text-primary">{{$loan->book->title}}</td>
                                            <td>{{$loan->loan_date}}</td>
                                            <td>{{$loan->return_date}}</td>
                                            <td>
                                                @if (now() > $loan->return_date)
                                                <p class="badge bg-danger">Over Due</p>
                                                @else
                                                <p class="badge bg-success">Valid</p>
                                                @endif
                                            </td>

                                            <td class="d-flex gap-3">
                                                @if (now() > $loan->return_date)
                                                <a href="{{route('loans.show' , $loan->id)}}" class="btn btn-primary btn-sm">re-view</a>
                                                @else
                                                <form action="{{route('loans.destroy' , $loan->id)}}" method="post"
                                                    onsubmit="return confirm('Is the book Returned? please confirm')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                @endif

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="p-5 text-warning text-center">No Book Taken</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>