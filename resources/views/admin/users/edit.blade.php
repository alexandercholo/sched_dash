<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Staff Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            line-height: 1.5;
        }

        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
        }

        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
            margin: 1rem;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            padding: 1rem;
            text-align: left;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .editable-cell {
            position: relative;
        }

        .editable-cell input,
        .editable-cell select {
            width: 100%;
            padding: 0.75rem;
            font-size: 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            display: none;
            background-color: white;
        }

        .editable-cell.editing input,
        .editable-cell.editing select {
            display: block;
        }

        .editable-cell.editing .cell-content {
            display: none;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-primary {
            background-color: #347928;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: white;
            color: black;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .btn-icon {
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            background: none;
        }

        .btn-edit {
            color: #347928;
        }

        .btn-edit:hover {
            background-color: #f0fdf4;
        }

        .edit-actions {
            display: none;
            gap: 0.5rem;
        }

        .btn-save,
        .btn-cancel {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
        }

        .btn-save {
            background-color: #347928;
            color: white;
        }

        .btn-cancel {
            background-color: #6b7280;
            color: white;
        }

        .flash-message {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .flash-success {
            background-color: #347928;
        }

        .flash-error {
            background-color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Staff Management</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add New Staff
            </a>
        </div>

        <div class="card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="fade-in" data-user-id="{{ $user->id }}">
                            <td class="editable-cell" data-field="username">
                                <div class="cell-content">{{ $user->username }}</div>
                                <input type="text" value="{{ $user->username }}" class="edit-input" required>
                            </td>
                            <td class="editable-cell" data-field="first_name">
                                <div class="cell-content">{{ $user->first_name }}</div>
                                <input type="text" value="{{ $user->first_name }}" class="edit-input" required>
                            </td>
                            <td class="editable-cell" data-field="middle_name">
                                <div class="cell-content">{{ $user->middle_name }}</div>
                                <input type="text" value="{{ $user->middle_name }}" class="edit-input">
                            </td>
                            <td class="editable-cell" data-field="last_name">
                                <div class="cell-content">{{ $user->last_name }}</div>
                                <input type="text" value="{{ $user->last_name }}" class="edit-input" required>
                            </td>
                            <td class="editable-cell" data-field="email">
                                <div class="cell-content">{{ $user->email }}</div>
                                <input type="email" value="{{ $user->email }}" class="edit-input" required>
                            </td>
                            <td class="editable-cell" data-field="role">
                                <div class="cell-content">{{ ucfirst($user->role) }}</div>
                                <select class="edit-input" required>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </td>
                            <td class="action-buttons">
                                <button class="btn-icon btn-edit" onclick="startEditing(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <div class="edit-actions">
                                    <button class="btn-save" onclick="saveChanges(this)" title="Save">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn-cancel" onclick="cancelEditing(this)" title="Cancel">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function startEditing(button) {
            const row = button.closest('tr');
            const cells = row.getElementsByClassName('editable-cell');
            
            Array.from(cells).forEach(cell => {
                cell.classList.add('editing');
            });
            
            button.style.display = 'none';
            row.querySelector('.edit-actions').style.display = 'flex';
        }

        function cancelEditing(button) {
            const row = button.closest('tr');
            const cells = row.getElementsByClassName('editable-cell');
            
            Array.from(cells).forEach(cell => {
                cell.classList.remove('editing');
                const input = cell.querySelector('.edit-input');
                const content = cell.querySelector('.cell-content');
                input.value = content.textContent.trim();
            });
            
            row.querySelector('.btn-edit').style.display = 'inline-flex';
            row.querySelector('.edit-actions').style.display = 'none';
        }

        function saveChanges(button) {
            const row = button.closest('tr');
            const userId = row.dataset.userId;
            const data = {};
            
            row.querySelectorAll('.editable-cell').forEach(cell => {
                const field = cell.dataset.field;
                const input = cell.querySelector('.edit-input');
                data[field] = input.value;
            });

            fetch(`/admin/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.querySelectorAll('.editable-cell').forEach(cell => {
                        const content = cell.querySelector('.cell-content');
                        const input = cell.querySelector('.edit-input');
                        content.textContent = input.value;
                    });
                    
                    cancelEditing(button);
                    showMessage('User updated successfully', 'success');
                } else {
                    showMessage('Error updating user', 'error');
                }
            })
            .catch(error => {
                showMessage('Error updating user', 'error');
                console.error('Error:', error);
            });
        }

        function showMessage(message, type) {
            const flashMessage = document.createElement('div');
            flashMessage.className = `flash-message flash-${type}`;
            flashMessage.textContent = message;
            document.body.appendChild(flashMessage);
            
            setTimeout(() => {
                flashMessage.style.opacity = '0';
                setTimeout(() => flashMessage.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>