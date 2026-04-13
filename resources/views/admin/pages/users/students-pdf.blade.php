<h2>Student Report</h2>
<p>Total Students: {{ $total }}</p>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ ucfirst($student->role) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
