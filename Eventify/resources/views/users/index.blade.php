<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Register Date</th>
            <th>Role</th>
            <th>Verified</th>
            <th>Activated</th>
            <th>Deleted</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->verified ? 'Yes' : 'No' }}</td>
                <td>{{ $user->activated ? 'Yes' : 'No' }}</td>
                <td>{{ $user->deleted ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}">🔍</a>
                    <a href="{{ route('users.edit', $user->id) }}">✏️</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">🗑️</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>