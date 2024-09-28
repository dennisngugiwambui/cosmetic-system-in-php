<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow Cosmetics - User Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #fff1f8;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        h1, h2 {
            color: #ff69b4;
            margin-bottom: 1rem;
        }

        .dashboard {
            display: flex;
            gap: 2rem;
        }

        .sidebar {
            flex: 1;
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .main-content {
            flex: 3;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .nav-list {
            list-style-type: none;
        }

        .nav-list li {
            margin-bottom: 1rem;
        }

        .nav-list a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .nav-list a:hover, .nav-list a.active {
            color: #ff69b4;
        }

        .profile-info {
            margin-bottom: 2rem;
        }

        .profile-info p {
            margin-bottom: 0.5rem;
        }

        .edit-profile-form {
            display: none;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #ff69b4;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff1493;
        }

        .dashboard-section {
            display: none;
        }

        .dashboard-section.active {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: left;
        }

        th {
            background-color: #fff1f8;
            color: #ff69b4;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>User Dashboard</h1>
    <div class="dashboard">
        <aside class="sidebar">
            <nav>
                <ul class="nav-list">
                    <li><a href="#profile" class="nav-link active" data-section="profile">My Profile</a></li>
                    <li><a href="#orders" class="nav-link" data-section="orders">Order History</a></li>
                    <li><a href="#wishlist" class="nav-link" data-section="wishlist">Wishlist</a></li>
                    <li><a href="#settings" class="nav-link" data-section="settings">Account Settings</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <section id="profile" class="dashboard-section active">
                <h2>My Profile</h2>
                <div class="profile-info">
                    <p><strong>Name:</strong> Jane Doe</p>
                    <p><strong>Email:</strong> jane.doe@example.com</p>
                    <p><strong>Address:</strong> 123 Glow Street, Beauty City, BC 12345</p>
                    <button onclick="toggleEditForm()">Edit Profile</button>
                </div>
                <form class="edit-profile-form" id="editProfileForm">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="Jane Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="jane.doe@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="123 Glow Street, Beauty City, BC 12345" required>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" id="confirm-password" name="confirm-password">
                    </div>
                    <button type="submit">Save Changes</button>
                </form>
            </section>

            <section id="orders" class="dashboard-section">
                <h2>Order History</h2>
                <table>
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#1001</td>
                        <td>2024-09-15</td>
                        <td>$75.99</td>
                        <td>Delivered</td>
                    </tr>
                    <tr>
                        <td>#1002</td>
                        <td>2024-09-20</td>
                        <td>$45.50</td>
                        <td>Processing</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <section id="wishlist" class="dashboard-section">
                <h2>Wishlist</h2>
                <ul>
                    <li>Glow Serum</li>
                    <li>Radiant Blush</li>
                    <li>Hydrating Face Mask</li>
                </ul>
            </section>

            <section id="settings" class="dashboard-section">
                <h2>Account Settings</h2>
                <form>
                    <div class="form-group">
                        <label for="newsletter">
                            <input type="checkbox" id="newsletter" name="newsletter" checked>
                            Receive newsletter
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="notifications">
                            <input type="checkbox" id="notifications" name="notifications" checked>
                            Enable notifications
                        </label>
                    </div>
                    <button type="submit">Save Settings</button>
                </form>
            </section>
        </main>
    </div>
</div>

<script>
    function toggleEditForm() {
        var profileInfo = document.querySelector('.profile-info');
        var editForm = document.querySelector('.edit-profile-form');
        if (editForm.style.display === 'none') {
            profileInfo.style.display = 'none';
            editForm.style.display = 'block';
        } else {
            profileInfo.style.display = 'block';
            editForm.style.display = 'none';
        }
    }

    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically send the form data to your server
        alert('Profile updated successfully!');
        toggleEditForm();
    });

    // Navigation functionality
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove 'active' class from all links and sections
            document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.dashboard-section').forEach(el => el.classList.remove('active'));

            // Add 'active' class to clicked link and corresponding section
            this.classList.add('active');
            document.getElementById(this.dataset.section).classList.add('active');
        });
    });
</script>
</body>
</html>