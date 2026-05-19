<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planify Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
            color: #1f2937;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #111827;
            color: white;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
        }

        .logo span {
            color: #60a5fa;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu a {
            text-decoration: none;
            color: #d1d5db;
            padding: 14px 16px;
            border-radius: 12px;
            transition: 0.3s;
            font-size: 15px;
            font-weight: 500;
        }

        .menu a:hover,
        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .title p {
            color: #6b7280;
        }

        .admin {
            background: white;
            padding: 12px 18px;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            font-weight: 600;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .card h3 {
            color: #6b7280;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .card .number {
            font-size: 32px;
            font-weight: 700;
        }

        .table-wrapper {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 22px;
        }

        .search {
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            width: 260px;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        table th {
            color: #6b7280;
            font-weight: 600;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .approved {
            background: #dcfce7;
            color: #166534;
        }

        .premium {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .standard {
            background: #ede9fe;
            color: #6d28d9;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            border: none;
            padding: 10px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-approve {
            background: #22c55e;
            color: white;
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media(max-width: 900px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .table-header {
                flex-direction: column;
                gap: 14px;
                align-items: flex-start;
            }

            .search {
                width: 100%;
            }
        }

         .image-modal{
             position: fixed;
             inset: 0;
             background: rgba(0,0,0,0.8);
             display: none;
             justify-content: center;
             align-items: center;
             z-index: 9999;
         }

        .image-modal img{
            max-width: 90%;
            max-height: 90%;
            border-radius: 20px;
            background: white;
        }

        .close-modal{
            position: absolute;
            top: 30px;
            right: 40px;
            font-size: 40px;
            color: white;
            cursor: pointer;
        }

        .rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        #modalImages{
            display:flex;
            gap:20px;
            flex-wrap:wrap;
            justify-content:center;
            max-width:90%;
        }

        #modalImages img{
            width:300px;
            border-radius:20px;
            background:white;
        }
        .admin-dropdown{
            position: relative;
        }

        .admin{
            background: white;
            padding: 12px 18px;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            font-weight: 600;
            cursor: pointer;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .dropdown-menu{
            position:absolute;
            top:60px;
            right:0;
            background:white;
            border-radius:14px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
            padding:10px;
            display:none;
            min-width:140px;
        }

        .dropdown-menu button{
            width:100%;
            border:none;
            background:none;
            padding:12px;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
            text-align:left;
        }

        .dropdown-menu button:hover{
            background:#f3f4f6;
        }

        .search-box{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .refresh-btn{
            width:48px;
            height:48px;
            border:none;
            border-radius:12px;
            background:#2563eb;
            color:white;
            font-size:20px;
            cursor:pointer;
            transition:0.3s;
        }

        .refresh-btn:hover{
            background:#1d4ed8;
            transform: rotate(180deg);
        }

        .btn-chat{
            background:#3b82f6;
            color:white;
        }

        .chat-modal{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.6);

            display:none;

            align-items:center;
            justify-content:center;

            z-index:100000;
        }

        .chat-box{
            width: 900px;
            height: 85vh;
            background: white;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        @media(max-width: 950px){

            .chat-box{
                width: 95%;
                height: 90vh;
            }

        }

        .chat-header{
            padding:20px;
            border-bottom:1px solid #e5e7eb;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .chat-header span{
            cursor:pointer;
            font-size:28px;
        }

        .chat-messages{
            flex:1;
            padding:20px;
            overflow-y:auto;
        }

        .chat-input-box{
            padding:20px;
            border-top:1px solid #e5e7eb;
            display:flex;
            gap:10px;
        }

        .chat-input-box input{
            flex:1;
            padding:14px;
            border:1px solid #d1d5db;
            border-radius:12px;
            outline:none;
        }

        .chat-input-box button{
            border:none;
            background:#2563eb;
            color:white;
            padding:14px 20px;
            border-radius:12px;
            cursor:pointer;
        }

        .message{
            padding:12px 16px;
            border-radius:18px;
            margin-bottom:14px;
            max-width:70%;
            width:fit-content;
            word-wrap: break-word;
            font-size:14px;
        }

        .message.user{
            background:#f3f4f6;
            color:#111827;
            margin-right:auto;
            border-bottom-left-radius:4px;
        }

        .message.admin{
            background:#2563eb;
            color:white;
            margin-left:auto;
            border-bottom-right-radius:4px;
        }

    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">Plan<span>ify</span></div>

    <div class="menu">
        <a href="#" class="active">Dashboard</a>
{{--        <a href="#">Subscriptions</a>--}}
{{--        <a href="#">Payments</a>--}}
{{--        <a href="#">Users</a>--}}
{{--        <a href="#">Tariffs</a>--}}
{{--        <a href="#">Settings</a>--}}
    </div>
</aside>

<main class="main">

    <div class="topbar">
        <div class="title">
            <h1>Admin Dashboard</h1>
            <p>Planify subscription management panel</p>
        </div>

        <div class="admin-dropdown">

            <div class="admin" id="adminButton">
                <span id="adminName">Admin</span>
                ▼
            </div>

            <div class="dropdown-menu" id="dropdownMenu">

                <button onclick="logout()">
                    Logout
                </button>

            </div>

        </div>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Total Subscriptions</h3>
            <div class="number" id="totalSubscriptions">1,248</div>
        </div>

        <div class="card" >
            <h3>Approved Subscriptions</h3>
            <div class="number" id="approvedSubscriptions">24</div>
        </div>

        <div class="card">
            <h3>Rejected Subscriptions</h3>
            <div class="number" id="rejectedSubscriptions">486</div>
        </div>

        <div class="card">
            <h3>Total Revenue</h3>
            <div class="number">$8,420</div>
        </div>
    </div>

    <div class="table-wrapper">

        <div class="table-header">
            <h2>Latest Subscriptions</h2>
            <div class="search-box">

                <input
                    type="text"
                    class="search"
                    placeholder="Search user..."
                    id="searchInput"
                >

                <button
                    class="refresh-btn"
                    onclick="refreshSubscriptions()"
                >
                    ↻
                </button>

            </div>
        </div>

        <table>
            <thead>
            <tr>
                <th>User</th>
                <th>Phone</th>
                <th>Tariff</th>
                <th>Check</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody id="subscriptionsTable">

            </tbody>
        </table>
    </div>

</main>
<div class="image-modal" id="imageModal">

    <span class="close-modal" onclick="closeModal()">
    ×
    </span>

    <div id="modalImages"></div>

</div>

<div class="chat-modal" id="chatModal">

    <div class="chat-box">

        <div class="chat-header">
            <h3 id="chatUserName">Chat</h3>

            <span onclick="closeChat()">
                ×
            </span>
        </div>

        <div class="chat-messages" id="chatMessages">

        </div>

        <div class="chat-input-box">

            <input
                type="text"
                id="chatInput"
                placeholder="Write message..."
            >

            <button onclick="sendChatMessage()">
                Send
            </button>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    const token = localStorage.getItem('token');

    // subscriptions load
    async function loadSubscriptions(){

        try {

            const response = await fetch('/api/subscription', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });

            const data = await response.json();

            const table = document.getElementById('subscriptionsTable');

            table.innerHTML = '';

            data.subscription.forEach(subscription => {
                const latestFile = subscription.files?.[0];

                let tariffBadge = '';
                let statusBadge = '';

                // tariff
                if(subscription.tariff === 'standard'){

                    tariffBadge = `
                        <span class="badge standard">
                            Standard
                        </span>
                    `;
                }

                if(subscription.tariff === 'premium'){

                    tariffBadge = `
                        <span class="badge premium">
                            Premium
                        </span>
                    `;
                }

                // status
                if(subscription.status === 'pending'){

                    statusBadge = `
                        <span class="badge pending">
                            Pending
                        </span>
                    `;
                }

                if(subscription.status === 'approved'){

                    statusBadge = `
                        <span class="badge approved">
                            Approved
                        </span>
                    `;
                }

                if(subscription.status === 'rejected'){

                    statusBadge = `
                        <span class="badge rejected">
                            Rejected
                        </span>
                    `;
                }

                table.innerHTML += `
                    <tr>

                        <td>${subscription.name}</td>

                        <td>${subscription.phone}</td>

                        <td>${tariffBadge}</td>

                       <td>

                        ${
                                        latestFile
                                            ?
                                            `
                                <div
                                    onclick='openModal(${JSON.stringify(subscription.files)})'
                                    style="
                                        display:flex;
                                        flex-direction:column;
                                        align-items:center;
                                        gap:6px;
                                        cursor:pointer;
                                    "
                                >

                                    <img
                                        src="/storage/${latestFile.file_path}"
                                        alt="check"
                                        width="70"
                                        height="70"
                                        style="
                                            object-fit: cover;
                                            border-radius: 12px;
                                            border: 1px solid #e5e7eb;
                                        "
                                    >

                                    <span
                                        style="
                                            font-size:12px;
                                            color:#6b7280;
                                            font-weight:600;
                                        "
                                    >
                                        ${subscription.files.length} files
                                    </span>

                                </div>
                            `
                                            :
                                            `
                                <span style="color:#9ca3af;">
                                    No check
                                </span>
                            `
                                    }

                    </td>

                        <td>${statusBadge}</td>

                        <td>

                            <div class="actions">

                                <button
                                    class="btn btn-approve"
                                    onclick="approveSubscription(${subscription.id})"
                                >
                                    Approve
                                </button>

                                <button
                                    class="btn btn-reject"
                                    onclick="rejectSubscription(${subscription.id})"
                                >
                                    Reject
                                </button>
                            </div>

                        </td>

                    </tr>
                `;
            });

        } catch(error){

            console.log(error);

        }
    }

    // approve
    async function approveSubscription(subscriptionId){

        try {

            const response = await fetch(
                `/api/subscription/approve/${subscriptionId}`,
                {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                }
            );

            const data = await response.json();

            if(response.ok){

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Subscription approved',
                    showConfirmButton: false,
                    timer: 2000
                });

                loadSubscriptions();

            } else {

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: data.message || 'Approve failed',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

        } catch(error){

            console.log(error);

        }
    }

    // reject
    async function rejectSubscription(subscriptionId){

        try {

            const response = await fetch(
                `/api/subscription/reject/${subscriptionId}`,
                {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                }
            );

            const data = await response.json();

            if(response.ok){

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Subscription rejected',
                    showConfirmButton: false,
                    timer: 2000
                });

                loadSubscriptions();

            } else {

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: data.message || 'Reject failed',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

        } catch(error){

            console.log(error);

        }
    }

    async function loadStatistics(){

        try {

            const response = await fetch('/api/subscription/statistic', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });

            const data = await response.json();

            if(response.ok){

                document.getElementById('totalSubscriptions').innerText =
                    data.subscriptions;

                document.getElementById('approvedSubscriptions').innerText =
                    data.approved;

                document.getElementById('rejectedSubscriptions').innerText =
                    data.rejected;
            }

        } catch(error){

            console.log(error);
        }
    }

    document
        .getElementById('searchInput')
        .addEventListener('input', async function(){

            const phone = this.value;

            // bo'sh bo'lsa hammasini qayta chiqaradi
            if(phone.trim() === ''){

                loadSubscriptions();

                return;
            }

            try {

                const response = await fetch(
                    '/api/subscription/search',
                    {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            phone: phone
                        })
                    }
                );

                const data = await response.json();

                const table = document.getElementById('subscriptionsTable');

                table.innerHTML = '';

                data.subscriptions.forEach(subscription => {

                    const latestFile = subscription.files?.[0];

                    let tariffBadge = '';
                    let statusBadge = '';

                    // tariff
                    if(subscription.tariff === 'standard'){

                        tariffBadge = `
                        <span class="badge standard">
                            Standard
                        </span>
                    `;
                    }

                    if(subscription.tariff === 'premium'){

                        tariffBadge = `
                        <span class="badge premium">
                            Premium
                        </span>
                    `;
                    }

                    // status
                    if(subscription.status === 'pending'){

                        statusBadge = `
                        <span class="badge pending">
                            Pending
                        </span>
                    `;
                    }

                    if(subscription.status === 'approved'){

                        statusBadge = `
                        <span class="badge approved">
                            Approved
                        </span>
                    `;
                    }

                    if(subscription.status === 'rejected'){

                        statusBadge = `
                        <span class="badge rejected">
                            Rejected
                        </span>
                    `;
                    }

                    table.innerHTML += `
                    <tr>

                        <td>${subscription.name}</td>

                        <td>${subscription.phone}</td>

                        <td>${tariffBadge}</td>

                        <td>

                            ${
                        latestFile
                            ?
                            `
                                    <div
                                        onclick='openModal(${JSON.stringify(subscription.files)})'
                                        style="
                                            display:flex;
                                            flex-direction:column;
                                            align-items:center;
                                            gap:6px;
                                            cursor:pointer;
                                        "
                                    >

                                        <img
                                            src="/storage/${latestFile.file_path}"
                                            alt="check"
                                            width="70"
                                            height="70"
                                            style="
                                                object-fit: cover;
                                                border-radius: 12px;
                                                border: 1px solid #e5e7eb;
                                            "
                                        >

                                        <span
                                            style="
                                                font-size:12px;
                                                color:#6b7280;
                                                font-weight:600;
                                            "
                                        >
                                            ${subscription.files.length} files
                                        </span>

                                    </div>
                                `
                            :
                            `
                                    <span style="color:#9ca3af;">
                                        No check
                                    </span>
                                `
                    }

                        </td>

                        <td>${statusBadge}</td>

                        <td>

                            <div class="actions">

                                <button
                                    class="btn btn-approve"
                                    onclick="approveSubscription(${subscription.id})"
                                >
                                    Approve
                                </button>

                            </div>

                        </td>

                    </tr>
                `;
                });

            } catch(error){

                console.log(error);

            }

        });

    // admin name
    const adminName = localStorage.getItem('admin_name');

    if(adminName){

        document.getElementById('adminName').innerText =
            adminName;
    }

    // dropdown
    document
        .getElementById('adminButton')
        .addEventListener('click', function(){

            const menu =
                document.getElementById('dropdownMenu');

            if(menu.style.display === 'block'){

                menu.style.display = 'none';

            } else {

                menu.style.display = 'block';
            }
        });

    // logout
    function logout(){

        localStorage.removeItem('token');

        localStorage.removeItem('admin_name');

        window.location.href = '/login';
    }

    // modal open
    function openModal(files){

        const modal = document.getElementById('imageModal');

        const modalImages = document.getElementById('modalImages');

        modal.style.display = 'flex';

        modalImages.innerHTML = '';

        files.forEach(file => {

            modalImages.innerHTML += `
            <img
                src="/storage/${file.file_path}"
                alt="check"
            >
        `;
        });
    }

    // modal close
    function closeModal(){

        document.getElementById('imageModal').style.display = 'none';
    }

    function refreshSubscriptions(){

        document.getElementById('searchInput').value = '';

        loadSubscriptions();

        loadStatistics();

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Refreshed',
            showConfirmButton: false,
            timer: 1500
        });
    }

    let currentTelegramId = null;

    function openChat(telegramId, name){
        currentTelegramId = telegramId;
        document.getElementById('chatUserName').innerText = name;
        document.getElementById('chatMessages').innerHTML = ''; // chatni tozalash
        document.getElementById('chatModal').style.display = 'flex';
    }

    function closeChat(){

        const modal =
            document.getElementById('chatModal');

        modal.style.display = 'none';
    }

    async function sendChatMessage(){

        const input =
            document.getElementById('chatInput');

        const message = input.value;

        if(message.trim() === ''){
            return;
        }

        try {

            await fetch('/api/chat/send', {
                method:'POST',
                headers:{
                    'Authorization': `Bearer ${token}`,
                    'Content-Type':'application/json',
                    'Accept':'application/json'
                },
                body: JSON.stringify({
                    telegram_id: currentTelegramId,
                    message: message
                })
            });

            document.getElementById('chatMessages').innerHTML += `
            <div style="
                background:#2563eb;
                color:white;
                padding:12px;
                border-radius:14px;
                margin-bottom:10px;
                margin-left:auto;
                width:fit-content;
                max-width:80%;
            ">
                ${message}
            </div>
        `;

            input.value = '';

        } catch(error){

            console.log(error);
        }
    }

    // start
    loadSubscriptions();
    loadStatistics();

</script>
</body>
</html>
