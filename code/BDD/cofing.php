<?php
header('Content-Type: application/json');

$host = 'mysql';
$dbname = 'appdb';
$user = 'user';
$password = 'password';

try {
 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT e.id, e.name, e.address, s.salary
                         FROM employes e
                         INNER JOIN salaires s ON e.id = s.employes_id
                         ORDER BY s.salary");
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($employees) === 0) {
        echo json_encode(['error' => 'Aucun employé trouvé']);
        exit;
    }

    $salaries = array_column($employees, 'salary');
    $count = count($salaries);

    $median = ($count % 2 === 0) ?
        ($salaries[$count / 2 - 1] + $salaries[$count / 2]) / 2 :
        $salaries[floor($count / 2)];

    echo json_encode([
        'employees' => $employees,
        'median' => $median
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion à la base de données']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Employees Details</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody id="employeeTable">
            <!-- Les données des employés seront insérées ici -->
        </tbody>
    </table>

    <h2>Médiane des salaires</h2>
    <div id="medianSalary">Calcul en cours...</div>

    <script>
        // Récupérer les données des employés
        fetch('employees.php')
            .then(response => response.json())
            .then(data => {
                const employeeTable = document.getElementById('employeeTable');
                const medianSalaryDiv = document.getElementById('medianSalary');

                if (data.error) {
                    medianSalaryDiv.textContent = data.error;
                } else {
                    // Insérer les employés dans la table
                    data.employees.forEach((employee, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${employee.name}</td>
                            <td>${employee.address}</td>
                            <td>${employee.salary}</td>
                        `;
                        employeeTable.appendChild(row);
                    });

                    // Afficher la médiane
                    medianSalaryDiv.textContent = `Médiane des salaires : ${data.median}`;
                }
            })
            .catch(err => {
                document.getElementById('medianSalary').textContent = 'Erreur lors du chargement des données.';
                console.error(err);
            });
    </script>
</body>
</html>