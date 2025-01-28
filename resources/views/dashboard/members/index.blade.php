<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-lg font-bold mb-4">Library Management</h2>
            @include('components.left-nav')
        </aside>


        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-6 custom-flow">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Members | Students </li>
                </ol>
            </nav>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-header bg-custom text-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Members</h5>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-student">Add Student</button>

                                    <!-- <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-author">Add Author</button>

                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-book">Add Book</button> -->

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table  table-striped table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>##</th>
                                        <th>Registration number</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $student->reg_no }}</td>
                                        <td>{{ $student->student->first_name }} {{ $student->student->last_name }}</td>
                                        <td>{{ $student->student->email }}</td>
                                        <td>
                                            {!!$student->status == 'pending' ? '<p class="badge bg-warning">pending</p>' : '<p class="badge bg-success">approved</p>' !!}
                                        </td>
                                        <td class="text-center d-flex justify-content-center gap-3">

                                            {!!
                                            $student->status == 'pending'
                                            ? '<a href="' . route('students.approve', $student->id) . '" class="btn btn-info btn-sm"><i class="fas fa-check"></i> Approve</a>'
                                            : '<a href="' . route('students.restrict', $student->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-ban"></i> Restrict</a>'
                                            !!}


                                            <form action="{{route('students.destroy' , $student->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student details?  This can\'t be reversed...')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </main>
    </div>

    <div class="modal fade" id="add-student">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <p class="text-left">Add New Student</p>
                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>

                <div class="modal-body">
                    <form action="{{route('students.store')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input :value="old('reg_no')" type="text" class="form-control" id="reg_no" name="reg_no" placeholder="Registration Number">
                                    <label for="reg_no">Registration Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input :value="old('first_name')" type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input :value="old('last_name')" type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                    <label for="last_name">Last Nam</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input :value="old('email')" type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="roles" value="student">
                        <input type="hidden" id="password" name="password">


                        <div class="d-flex justify-conteSorry, your session has expired. Please refresh the page and try again.nt-end gap-4 ">
                            <button class="btn btn-primary w-25">Add</button>
                            <button class="btn btn-danger w-25" type="button" data-bs-dismiss="modal">Exit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    const lastname = document.getElementById('lastname');
    const password = document.getElementById('password');

    lastname.addEventListener('input', function() {
        password.value = lastname.value;
    });
</script>