<!DOCTYPE html>
<html>
<head>
    <title>Admin Feedback</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #dff7fb;
        }

        /* NAVBAR */
        .navbar {
            background: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 40px;
        }

        .menu a {
            margin-left: 30px;
            text-decoration: none;
            color: black;
            font-weight: 500;
            font-size: 14px;
        }

        .menu a:hover {
            color: #5b4bc4;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout {
            background: crimson;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout:hover {
            background: #d32f2f;
        }

        /* CONTAINER */
        .container {
            padding: 30px 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        /* SEARCH & FILTER */
        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            align-items: center;
        }

        .search-bar input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .search-bar input::placeholder {
            color: #999;
        }

        /* TABLE */
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f5f5f5;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #666;
            font-size: 13px;
            border-bottom: 2px solid #e0e0e0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: #333;
        }

        tr:hover {
            background: #f9f9f9;
        }

        /* NUMBER COLUMN */
        .number {
            font-weight: 600;
            color: #999;
            width: 60px;
        }

        /* TITLE & ACCOUNT */
        .title-cell {
            font-weight: 500;
            color: #333;
        }

        .account-name {
            font-size: 12px;
            color: #999;
            margin-top: 3px;
        }

        /* CATEGORY */
        .category {
            color: #666;
        }

        /* FEEDBACK TEXT */
        .feedback-text {
            color: #777;
            max-width: 400px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* STATUS BADGE */
        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-align: center;
        }

        .status-complete {
            background: #e3f2fd;
            color: #1976d2;
        }

        .status-complete:hover {
            background: #bbdefb;
        }

        .status-progress {
            background: #fff3e0;
            color: #f57c00;
        }

        .status-progress:hover {
            background: #ffe0b2;
        }

        /* PAGINATION */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f9f9f9;
            border-top: 1px solid #e0e0e0;
        }

        .pagination-info {
            font-size: 13px;
            color: #666;
        }

        .pagination-buttons {
            display: flex;
            gap: 5px;
        }

        .pagination-buttons a,
        .pagination-buttons button {
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            color: #666;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-buttons a:hover,
        .pagination-buttons button:hover {
            background: #f0f0f0;
        }

        .pagination-buttons a.active {
            background: #5b4bc4;
            color: white;
            border-color: #5b4bc4;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state p {
            font-size: 16px;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .modal-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .modal-btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
        }

        .modal-btn-primary {
            background: #5b4bc4;
            color: white;
        }

        .modal-btn-primary:hover {
            background: #4637a5;
        }

        .modal-btn-secondary {
            background: #e0e0e0;
            color: #333;
        }

        .modal-btn-secondary:hover {
            background: #d0d0d0;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="navbar-brand">
        <img src="{{ asset('logo.png') }}" alt="Logo">
        <span>Merdeka Aspirasi Website</span>
    </div>

    <div class="menu">
        <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        <a href="{{ route('admin.feedback') }}" style="color: #5b4bc4; font-weight: bold;">Feedback</a>
        <a href="#">Student</a>
        <a href="#">Logs</a>
    </div>

    <div class="user-section">
        <span style="font-size: 14px;">{{ Auth::user()->full_name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button class="logout">Logout</button>
        </form>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="container">
    <div class="page-title">Feedback</div>

    <!-- SEARCH BAR -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterTable()">
    </div>

    <!-- TABLE -->
    @if($feedbacks->count() > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">NUMBER</th>
                        <th style="width: 200px;">NAME FEEDBACK</th>
                        <th style="width: 150px;">CATEGORY</th>
                        <th style="width: 350px;">FEEDBACK</th>
                        <th style="width: 120px;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $index => $feedback)
                        <tr>
                            <td class="number">{{ ($feedbacks->currentPage() - 1) * $feedbacks->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="title-cell">{{ $feedback->feedback_title }}</div>
                                <div class="account-name">{{ $feedback->user->full_name }}</div>
                            </td>
                            <td class="category">{{ $feedback->category->name }}</td>
                            <td class="feedback-text">{{ $feedback->details }}</td>
                            <td>
                                <button 
                                    class="status-badge {{ $feedback->status === 'complete' ? 'status-complete' : 'status-progress' }}"
                                    onclick="openStatusModal({{ $feedback->id }}, '{{ $feedback->status }}')">
                                    {{ $feedback->status === 'complete' ? 'Complete' : 'In progress' }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- PAGINATION -->
            <div class="pagination-container">
                <div class="pagination-info">
                    1-{{ $feedbacks->count() }} of {{ $feedbacks->total() }}
                </div>
                <div class="pagination-buttons">
                    @if($feedbacks->onFirstPage())
                        <button disabled>Previous</button>
                    @else
                        <a href="{{ $feedbacks->previousPageUrl() }}">Previous</a>
                    @endif

                    @for($i = 1; $i <= $feedbacks->lastPage(); $i++)
                        @if($i == $feedbacks->currentPage())
                            <button class="active">{{ $i }}</button>
                        @else
                            <a href="{{ $feedbacks->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor

                    @if($feedbacks->hasMorePages())
                        <a href="{{ $feedbacks->nextPageUrl() }}">Next</a>
                    @else
                        <button disabled>Next</button>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="table-container">
            <div class="empty-state">
                <p>No feedbacks found</p>
            </div>
        </div>
    @endif
</div>

<!-- STATUS MODAL -->
<div class="modal" id="statusModal">
    <div class="modal-content">
        <div class="modal-title">Change Status</div>
        <form id="statusForm" method="POST">
            @csrf
            <input type="hidden" id="feedbackId" name="feedback_id">
            
            <label style="display: block; margin-bottom: 15px; font-size: 14px; color: #333;">
                <input type="radio" name="status" value="complete" style="margin-right: 8px;">
                Complete
            </label>

            <label style="display: block; margin-bottom: 20px; font-size: 14px; color: #333;">
                <input type="radio" name="status" value="on_progress" style="margin-right: 8px;">
                In Progress
            </label>

            <div class="modal-buttons">
                <button type="submit" class="modal-btn modal-btn-primary">Save</button>
                <button type="button" class="modal-btn modal-btn-secondary" onclick="closeStatusModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function filterTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.querySelector('table tbody');
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}

function openStatusModal(feedbackId, currentStatus) {
    document.getElementById('statusModal').classList.add('active');
    document.getElementById('feedbackId').value = feedbackId;
    document.querySelector(`input[name="status"][value="${currentStatus}"]`).checked = true;
    
    const form = document.getElementById('statusForm');
    form.action = `/admin/feedback/${feedbackId}/status`;
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.remove('active');
}

// Close modal when clicking outside
document.getElementById('statusModal').addEventListener('click', function(e) {
    if(e.target === this) {
        closeStatusModal();
    }
});
</script>

</body>
</html>
