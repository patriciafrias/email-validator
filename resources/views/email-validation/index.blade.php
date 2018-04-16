<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .content {
            text-align: center;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .content table {
            border-collapse: collapse;
        }
        .content td, .content th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .content th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        .content tr:hover {background-color: #ddd;}
        .content tr:nth-child(even){background-color: #f2f2f2;}
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Email Validator Report</h1>
            <table align="center">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Valid Emails</th>
                    <th>Invalid Emails</th>
                    <th>Total Emails</th>
                </tr>
                </thead>
                <tbody>
                    @if(isset($data['emailValidationsReport']))
                        @foreach($data['emailValidationsReport'] as $item)
                            <tr>
                                <td>{{ $item['short_date'] }}</td>
                                <td>{{ $item['valid_emails']}}</td>
                                <td>{{ $item['invalid_emails'] }}</td>
                                <td>{{ $item['valid_emails'] + $item['invalid_emails'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
