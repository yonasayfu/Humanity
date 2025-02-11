<!DOCTYPE html>
<html>
<head>
    <title>Supporters Export</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Supporters Export</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Contribution Amount</th>
                <th>Joined Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $supporter)
                <tr>
                    <td>{{ $supporter->id }}</td>
                    <td>{{ $supporter->name }}</td>
                    <td>{{ $supporter->type }}</td>
                    <td>{{ $supporter->phone_number }}</td>
                    <td>{{ $supporter->email }}</td>
                    <td>{{ $supporter->contribution_amount }}</td>
                    <td>{{ $supporter->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>