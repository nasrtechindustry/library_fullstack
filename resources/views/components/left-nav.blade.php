<nav class="navigation ">
    <ul>
        <li class="mb-2">
            <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('books.index') }}" class="block px-4 py-2 hover:bg-gray-700 rounded"><i class="fas fa-book"></i>  Books</a>
        </li>
        <li class="mb-2">
            <a href="/members" class="block px-4 py-2 hover:bg-gray-700 rounded"> <i class="fas fa-users"></i> Members</a>
        </li>
        <li class="mb-2">
            <a href="/loans" class="block px-4 py-2 hover:bg-gray-700 rounded"><i class="fas fa-book-open"></i> Loans</a>
        </li>
        <!-- <li class="mb-2">
            <a href="/returns" class="block px-4 py-2 hover:bg-gray-700 rounded"><i class="fas fa-undo"></i>  Returns</a>
        </li> -->
        <!-- <li class="mb-2">
            <a href="/reports" class="block px-4 py-2 hover:bg-gray-700 rounded"><i class="fas fa-chart-bar"></i>Reports</a>
        </li> -->
        <li class="mb-2">
            <a href="{{ route('profile.edit')}}" class="block px-4 py-2 hover:bg-gray-700 rounded"><i class="fas fa-user"></i>Profile</a>
        </li>
    </ul>
</nav>