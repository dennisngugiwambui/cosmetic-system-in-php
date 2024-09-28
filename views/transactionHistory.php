<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow Cosmetics - Transaction History</title>
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

        h1 {
            color: #ff69b4;
            text-align: center;
            margin-bottom: 2rem;
        }

        .transaction-list {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .transaction-item {
            padding: 1.5rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .order-number {
            font-weight: bold;
            color: #ff69b4;
        }

        .order-date {
            color: #888;
        }

        .order-details {
            margin-bottom: 1rem;
        }

        .order-total {
            font-weight: bold;
        }

        .view-details {
            display: inline-block;
            background-color: #ff69b4;
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .view-details:hover {
            background-color: #ff1493;
        }

        .no-transactions {
            text-align: center;
            padding: 2rem;
            color: #888;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Your Transaction History</h1>
    <div class="transaction-list">
        <div class="transaction-item">
            <div class="transaction-header">
                <span class="order-number">Order #12345</span>
                <span class="order-date">September 28, 2024</span>
            </div>
            <div class="order-details">
                <p>Glow Foundation x1, Radiant Lipstick x2</p>
                <p class="order-total">Total: $69.97</p>
            </div>
            <a href="#" class="view-details">View Details</a>
        </div>
        <div class="transaction-item">
            <div class="transaction-header">
                <span class="order-number">Order #12344</span>
                <span class="order-date">September 15, 2024</span>
            </div>
            <div class="order-details">
                <p>Luminous Eyeshadow Palette x1, Velvet Blush x1</p>
                <p class="order-total">Total: $54.98</p>
            </div>
            <a href="#" class="view-details">View Details</a>
        </div>
        <div class="transaction-item">
            <div class="transaction-header">
                <span class="order-number">Order #12343</span>
                <span class="order-date">August 30, 2024</span>
            </div>
            <div class="order-details">
                <p>Hydrating Face Mist x2, Glow Serum x1</p>
                <p class="order-total">Total: $79.97</p>
            </div>
            <a href="#" class="view-details">View Details</a>
        </div>
        <!-- Add more transaction items as needed -->
    </div>
</div>
</body>
</html>