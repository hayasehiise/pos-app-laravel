<!DOCTYPE html>
<html lang='id'>

<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                background: white;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
                /* untuk kompatibilitas */
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
