

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Glow Cosmetics</title>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="script.js" defer></script>
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <h2>Glow Cosmetics</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active" onclick="showPanel('dashboard')"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#" onclick="showPanel('products')"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="#" onclick="showPanel('customers')"><i class="fas fa-users"></i> Customers</a></li>
            <li><a href="#" onclick="showPanel('orders')"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="admin-header">
            <h1>Welcome, Admin</h1>
            <div class="header-icons">
                <a href="#"><i class="fas fa-bell"></i></a>
                <a href="#"><i class="fas fa-user-circle"></i></a>
            </div>
        </header>

        <!-- Dashboard Widgets -->
        <section class="dashboard-widgets" id="dashboard">
            <div class="widget">
                <i class="fas fa-box"></i>
                <div>
                    <h3>120</h3>
                    <p>Total Products</p>
                </div>
            </div>
            <div class="widget">
                <i class="fas fa-users"></i>
                <div>
                    <h3>75</h3>
                    <p>Total Customers</p>
                </div>
            </div>
            <div class="widget">
                <i class="fas fa-shopping-cart"></i>
                <div>
                    <h3>45</h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="widget">
                <i class="fas fa-dollar-sign"></i>
                <div>
                    <h3>$12,345</h3>
                    <p>Total Sales</p>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section class="content-table" id="products" style="display: none;">
            <h2>Products</h2>
            <table>
                <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>#P1001</td>
                    <td>Foundation</td>
                    <td>$25</td>
                    <td>150</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>#P1002</td>
                    <td>Lipstick</td>
                    <td>$15</td>
                    <td>200</td>
                    <td>Active</td>
                </tr>
                <!-- More rows can go here -->
                </tbody>
            </table>
        </section>

        <!-- Customers Section -->
        <section class="content-table" id="customers" style="display: none;">
            <h2>Customers</h2>
            <table>
                <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>#C1001</td>
                    <td>Jane Doe</td>
                    <td>jane@example.com</td>
                    <td>(123) 456-7890</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>#C1002</td>
                    <td>John Smith</td>
                    <td>john@example.com</td>
                    <td>(987) 654-3210</td>
                    <td>Active</td>
                </tr>
                <!-- More rows can go here -->
                </tbody>
            </table>
        </section>

        <!-- Orders Section -->
        <section class="content-table" id="orders" style="display: none;">
            <h2>Recent Orders</h2>
            <table>
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>#1001</td>
                    <td>Jane Doe</td>
                    <td>Sept 28, 2024</td>
                    <td>Completed</td>
                    <td>$100</td>
                </tr>
                <tr>
                    <td>#1002</td>
                    <td>John Smith</td>
                    <td>Sept 27, 2024</td>
                    <td>Pending</td>
                    <td>$200</td>
                </tr>
                <!-- More rows can go here -->
                </tbody>
            </table>
        </section>
    </main>
</div>

<script>
    function showPanel(panelId) {
        // Hide all panels
        const panels = document.querySelectorAll('.content-table, .dashboard-widgets');
        panels.forEach(panel => {
            panel.style.display = 'none';
        });

        // Remove active class from all links
        const links = document.querySelectorAll('.sidebar-menu li a');
        links.forEach(link => {
            link.classList.remove('active');
        });

        // Show the selected panel and add active class to the link
        document.getElementById(panelId).style.display = 'block';
        document.querySelector(`a[onclick="showPanel('${panelId}')"]`).classList.add('active');
    }

    // Initialize the dashboard to show the dashboard panel by default
    document.addEventListener('DOMContentLoaded', () => {
        showPanel('dashboard');
    });

</script>
</body>

<style>
    /* Add this to your existing CSS if needed for table styles */
    .content-table {
        margin-top: 40px;
    }

    .content-table h2 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table thead {
        background-color: #34495e;
        color: white;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tbody tr:hover {
        background-color: #ecf0f1;
    }

    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background-color: #f4f4f4;
        display: flex;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: white;
        height: 100vh;
        position: fixed;
    }

    .logo {
        padding: 20px;
        text-align: center;
        background-color: #34495e;
    }

    .sidebar-menu {
        list-style-type: none;
        padding: 0;
    }

    .sidebar-menu li {
        padding: 15px 20px;
    }

    .sidebar-menu li a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .sidebar-menu li a:hover {
        background-color: #34495e;
    }

    .sidebar-menu li i {
        margin-right: 10px;
    }

    /* Main Content Styles */
    .main-content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
        background-color: white;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .admin-header h1 {
        color: #2c3e50;
    }

    .header-icons a {
        color: #2c3e50;
        margin-left: 15px;
    }

    .header-icons i {
        font-size: 24px;
    }

    /* Dashboard Widgets */
    .dashboard-widgets {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 20px;
    }

    .widget {
        display: flex;
        align-items: center;
        background-color: #ecf0f1;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .widget i {
        font-size: 36px;
        margin-right: 15px;
        color: #3498db;
    }

    .widget h3 {
        margin: 0;
        font-size: 24px;
    }

    .widget p {
        color: #7f8c8d;
    }

    /* Table Styles */
    .content-table {
        margin-top: 40px;
    }

    .content-table h2 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table thead {
        background-color: #34495e;
        color: white;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tbody tr:hover {
        background-color: #ecf0f1;
    }

</style>
</html>
