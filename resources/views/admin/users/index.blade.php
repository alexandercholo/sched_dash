<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Staff Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #64748b;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
            --background: #f8fafc;
            --surface: #ffffff;
            --text: #0f172a;
            --text-light: #64748b;
            --border: #e2e8f0;
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            line-height: 1.5;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background-color: var(--surface);
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: var(--shadow);
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #347928;
            color: white;
        }

        .btn-primary:hover {
            background-color: white;
            color: black;
            border-radius: 0.5rem;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .card {
            background-color: var(--surface);
            border-radius: 1rem;
            box-shadow: var(--shadow);
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
            color: var(--text-light);
            border-bottom: 2px solid var(--border);
            white-space: nowrap;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .badge-admin {
            background-color: #e0f2fe;
            color: var(--primary);
        }

        .badge-user {
            background-color: #f1f5f9;
            color: var(--secondary);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
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
            color: var(--primary);
        }

        .btn-edit:hover {
            background-color: #e0f2fe;
        }

        .btn-delete {
            color: var(--danger);
        }

        .btn-delete:hover {
            background-color: #fee2e2;
        }

        .signature-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .signature-link:hover {
            text-decoration: underline;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            padding: 1.5rem;
            background-color: var(--surface);
            border-top: 1px solid var(--border);
        }

        .pagination a {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: var(--text);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination a:hover {
            background-color: #e0f2fe;
            color: var(--primary);
        }

        .pagination .active {
            background-color: var(--primary);
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background-color: var(--surface);
            padding: 2rem;
            border-radius: 1rem;
            max-width: 400px;
            width: 90%;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: scale(1);
        }

        .modal-header {
            margin-bottom: 1rem;
        }

        .modal-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text);
        }

        .modal-body {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .modal-footer {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .flash-message {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            background-color: var(--surface);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            z-index: 1000;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .flash-success {
            background-color: #dcfce7;
            color: var(--success);
        }

        .flash-error {
            background-color: #fee2e2;
            color: var(--danger);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(1rem);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    .badge-program {
            background-color: #f0fdf4;
            color: #15803d;
        }

        .editable-cell {
            position: relative;
        }

        .editable-content {
            padding: 0.5rem;
            border-radius: 0.375rem;
        }

        .editable-cell.editing .editable-content {
            background-color: #f8fafc;
            border: 2px solid #0ea5e9;
        }

        .editable-input {
            width: 100%;
            padding: 0.5rem;
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: inherit;
            color: inherit;
            outline: none;
        }

        .btn-save {
            background-color: var(--success);
            color: white;
        }

        .btn-save:hover {
            background-color: #15803d;
        }

        .btn-cancel {
            background-color: var(--secondary);
            color: white;
        }

        .btn-cancel:hover {
            background-color: #475569;
        }

        /* Hide inputs by default */
        .editable-input {
            display: none;
        }

        .editable-cell.editing .editable-input {
            display: block;
        }

        .editable-cell.editing .editable-text {
            display: none;
        }
        
    </style>
</head>
<body>
    <div class="container">
    @include('layouts\admin') 
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
                            <th>Name</th>
                            <th>Program</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Signature</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
        @foreach($users as $user)
        <tr class="fade-in" data-user-id="{{ $user->id }}">
            <td class="editable-cell" data-field="username">
                <div class="editable-content">
                    <span class="editable-text">{{ $user->username }}</span>
                    <input type="text" class="editable-input" value="{{ $user->username }}">
                </div>
            </td>
            <td class="editable-cell" data-field="fullname">
                <div class="editable-content">
                    <span class="editable-text">{{ $user->fullname }}</span>
                    <input type="text" class="editable-input" value="{{ $user->fullname }}">
                </div>
            </td>
            <td class="editable-cell" data-field="program">
    <div class="editable-content">
        <span class="editable-text">
            <span class="badge badge-program">
                {{ $user->program ? config('programs')[$user->program] ?? $user->program : 'Not Assigned' }}
            </span>
        </span>
        <select class="editable-input">
            <option value="">Not Assigned</option>
            <option value="bpa" {{ $user->program === 'bpa' ? 'selected' : '' }}>Bachelor of Performing Arts</option>
            <option value="bpubad" {{ $user->program === 'bpubad' ? 'selected' : '' }}>Bachelor of Public Administration</option>
            <option value="bsbio" {{ $user->program === 'bsbio' ? 'selected' : '' }}>Bachelor of Science in Biology</option>
            <option value="bsenv" {{ $user->program === 'bsenv' ? 'selected' : '' }}>Bachelor of Science in Environmental Science</option>
            <option value="bsess" {{ $user->program === 'bsess' ? 'selected' : '' }}>Bachelor of Science in Exercise Sports and Sciences</option>
            <option value="bsmath" {{ $user->program === 'bsmath' ? 'selected' : '' }}>Bachelor of Science in Mathematics</option>
            <option value="bssw" {{ $user->program === 'bssw' ? 'selected' : '' }}>Bachelor of Science in Social Work</option>
            <option value="lap" {{ $user->program === 'lap' ? 'selected' : '' }}>Liberal Arts Program</option>
        </select>
    </div>
</td>
            <td class="editable-cell" data-field="email">
                <div class="editable-content">
                    <span class="editable-text">{{ $user->email }}</span>
                    <input type="email" class="editable-input" value="{{ $user->email }}">
                </div>
            </td>
            <td class="editable-cell" data-field="role">
                <div class="editable-content">
                    <span class="editable-text">
                        <span class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </span>
                    <select class="editable-input">
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
            </td>
            <td>{{ $user->created_at->format('M d, Y') }}</td>
            <td class="action-buttons">
                <button class="btn-icon btn-edit" onclick="toggleEdit(this)" data-user-id="{{ $user->id }}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon btn-delete" onclick="showDeleteModal('{{ $user->id }}')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Deletion</h2>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button onclick="closeDeleteModal()" class="btn btn-primary">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        function showDeleteModal(userId) {
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
            deleteForm.action = `/admin/users/${userId}`;
        }

        function closeDeleteModal() {
            modal.classList.add('hidden');
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                closeDeleteModal();
            }
        }

        function toggleEdit(button) {
            const row = button.closest('tr');
            const userId = row.dataset.userId;
            const isEditing = row.classList.contains('editing');
            const editableCells = row.querySelectorAll('[data-field]');

            if (!isEditing) {
                row.classList.add('editing');
                editableCells.forEach(cell => {
                    const input = cell.querySelector('input, select');
                    const text = cell.querySelector('.editable-text');
                    input.classList.remove('hidden');
                    text.classList.add('hidden');
                });
                
                button.innerHTML = '<i class="fas fa-save"></i>';
                button.classList.remove('text-blue-600', 'hover:bg-blue-50');
                button.classList.add('text-green-600', 'hover:bg-green-50');
                
                const deleteButton = row.querySelector('.text-red-600');
                deleteButton.innerHTML = '<i class="fas fa-times"></i>';
                deleteButton.classList.remove('text-red-600', 'hover:bg-red-50');
                deleteButton.classList.add('text-slate-600', 'hover:bg-slate-50');
                deleteButton.onclick = () => cancelEdit(row);
            } else {
                saveChanges(row);
            }
        }

        function showFlashMessage(message, type) {
            const flash = document.createElement('div');
            flash.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
            } transition-opacity duration-300`;
            flash.textContent = message;
            document.body.appendChild(flash);

            setTimeout(() => {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 300);
            }, 3000);
        }
        
        window.onclick = function(event) {
            if (event.target === modal) {
                closeDeleteModal();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.1}s`;
            });

            // Flash messages
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    setTimeout(() => {
                        message.remove();
                    }, 300);
                }, 3000);
            });
        });

        // Handle mobile responsiveness
        function adjustTableResponsiveness() {
            const table = document.querySelector('table');
            const windowWidth = window.innerWidth;
            
            if (windowWidth < 768) {
                table.classList.add('mobile-view');
            } else {
                table.classList.remove('mobile-view');
            }
        }

        window.addEventListener('resize', adjustTableResponsiveness);
        adjustTableResponsiveness();

     
         function toggleEdit(button) {
        const row = button.closest('tr');
        const userId = row.dataset.userId;
        const isEditing = row.classList.contains('editing');
        const editButton = button;
        const deleteButton = row.querySelector('.btn-delete');
        const editableCells = row.querySelectorAll('.editable-cell');

        if (!isEditing) {
            // Start editing
            row.classList.add('editing');
            editableCells.forEach(cell => cell.classList.add('editing'));
            
            // Change button icons and classes
            editButton.innerHTML = '<i class="fas fa-save"></i>';
            editButton.classList.remove('btn-edit');
            editButton.classList.add('btn-save');
            
            deleteButton.innerHTML = '<i class="fas fa-times"></i>';
            deleteButton.classList.remove('btn-delete');
            deleteButton.classList.add('btn-cancel');
            deleteButton.onclick = () => cancelEdit(row);
        } else {
            // Save changes
            saveChanges(row);
        }
    }

    function cancelEdit(row) {
        // Reset all inputs to original values
        const editableCells = row.querySelectorAll('.editable-cell');
        editableCells.forEach(cell => {
            const input = cell.querySelector('.editable-input');
            const text = cell.querySelector('.editable-text');
            input.value = text.textContent.trim();
            cell.classList.remove('editing');
        });

        // Reset buttons
        resetButtons(row);
        row.classList.remove('editing');
    }

    function resetButtons(row) {
        const editButton = row.querySelector('.btn-save');
        const cancelButton = row.querySelector('.btn-cancel');

        editButton.innerHTML = '<i class="fas fa-edit"></i>';
        editButton.classList.remove('btn-save');
        editButton.classList.add('btn-edit');

        cancelButton.innerHTML = '<i class="fas fa-trash"></i>';
        cancelButton.classList.remove('btn-cancel');
        cancelButton.classList.add('btn-delete');
        cancelButton.onclick = () => showDeleteModal(row.dataset.userId);
    }

    function saveChanges(row) {
        const userId = row.dataset.userId;
        const updatedData = {};

        // Collect data from inputs
        row.querySelectorAll('.editable-cell').forEach(cell => {
            const field = cell.dataset.field;
            const input = cell.querySelector('.editable-input');
            updatedData[field] = input.value;
        });

        // Send AJAX request to update user
        fetch(`/admin/users/${userId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(updatedData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the displayed values
                row.querySelectorAll('.editable-cell').forEach(cell => {
                    const field = cell.dataset.field;
                    const text = cell.querySelector('.editable-text');
                    const input = cell.querySelector('.editable-input');
                    
                    if (field === 'role') {
                        const badge = text.querySelector('.badge');
                        badge.className = `badge badge-${input.value}`;
                        badge.textContent = input.value.charAt(0).toUpperCase() + input.value.slice(1);
                    } else if (field === 'program') {
                        const badge = text.querySelector('.badge');
                        badge.textContent = input.value || 'Not Assigned';
                    } else {
                        text.textContent = input.value;
                    }
                    
                    cell.classList.remove('editing');
                });

                // Reset buttons and row state
                resetButtons(row);
                row.classList.remove('editing');

                // Show success message
                showFlashMessage('Changes saved successfully!', 'success');
            } else {
                showFlashMessage('Error saving changes.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showFlashMessage('Error saving changes.', 'error');
        });
    }

    function showFlashMessage(message, type) {
        const flash = document.createElement('div');
        flash.className = `flash-message flash-${type} fade-in`;
        flash.textContent = message;
        document.body.appendChild(flash);

        setTimeout(() => {
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 300);
        }, 3000);
    }
    </script>

    <script>
function saveChanges(row) {
    const userId = row.dataset.userId;
    const updatedData = {};

    // Collect data from inputs
    row.querySelectorAll('.editable-cell').forEach(cell => {
        const field = cell.dataset.field;
        const input = cell.querySelector('.editable-input');
        
        if (field === 'program') {
            const select = input;
            updatedData[field] = select.value;
            // Get the selected option's text for display
            const selectedText = select.options[select.selectedIndex].text;
            cell.querySelector('.badge').textContent = select.value ? selectedText : 'Not Assigned';
        } else {
            updatedData[field] = input.value;
        }
    });

    // Send AJAX request to update user
    fetch(`/admin/users/${userId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the displayed values
            row.querySelectorAll('.editable-cell').forEach(cell => {
                const field = cell.dataset.field;
                const text = cell.querySelector('.editable-text');
                const input = cell.querySelector('.editable-input');
                
                if (field === 'role') {
                    const badge = text.querySelector('.badge');
                    badge.className = `badge badge-${input.value}`;
                    badge.textContent = input.value.charAt(0).toUpperCase() + input.value.slice(1);
                } else if (field === 'program') {
                    // Program badge is already updated above
                    cell.classList.remove('editing');
                } else {
                    text.textContent = input.value;
                }
                
                cell.classList.remove('editing');
            });

            // Reset buttons and row state
            resetButtons(row);
            row.classList.remove('editing');

            // Show success message
            showFlashMessage('Changes saved successfully!', 'success');
        } else {
            showFlashMessage('Error saving changes.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showFlashMessage('Error saving changes.', 'error');
    });
}
</script>
</body>
</html>