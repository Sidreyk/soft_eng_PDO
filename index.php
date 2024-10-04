<?php require_once 'dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>List of 15 Customers Who Ordered a Specific Item (Burger)</h1>
    <?php
    $stmt = $pdo->prepare("SELECT Customers.first_name AS First_Name, 
		Customers.last_name AS Last_Name, 
        Menu_items.item_name AS Item_Name
         
        FROM Customers

        JOIN Orders ON Customers.customer_id = Orders.customer_id
        JOIN OrderItems ON Orders.order_id = OrderItems.order_id
        JOIN Menu_items ON OrderItems.item_id = Menu_items.item_id
        
        WHERE Menu_items.item_name = 'Burger'
        LIMIT 15;
");
        
    $executeQuery = $stmt->execute();

    if($executeQuery){
        $customers = $stmt->fetchAll();
    } else {
        echo "Query Failed";
        exit; // Stops further execution if query fails
    }
    ?>

    <table> 
        <tr>
            <th>First_name</th>
            <th>Last Name</th>
            <th>Item_Name</th>
        </tr>
        
    <?php if (!empty($customers)): ?>
        <?php foreach ($customers as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['First_Name']); ?></td>
            <td><?php echo htmlspecialchars($row['Last_Name']); ?></td>
            <td><?php echo htmlspecialchars($row['Item_Name']); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No data found</td>
        </tr>
    <?php endif; ?>
    </table>
</body>
</html>
