<!DOCTYPE html>
<html lang='id'>

<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
            /* atur margin biar konten tidak ketimpa */
        }

        body {
            font-family: sans-serif;
            font-size: 14px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        h2 {
            margin-top: 30px;
            margin-bottom: 10px;
        }

        @media print {
            body {
                background: white;
            }
        }
    </style>
</head>

<body>
    {{ $slot }}
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
