<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>{{ $titulo }}</title>
<style>
    body { font-family: DejaVu Sans, sans-serif; }
    table { width: 100%; border-collapse: collapse; margin-top:20px; }
    th, td { border: 1px solid #444; padding: 8px; text-align: left; }
    th { background: #eee; }
</style>
</head>
<body>

<h2>{{ $titulo }}</h2>

<table>
    <thead>
        <tr>
            @foreach (array_keys((array)$dados->first()) as $coluna)
                <th>{{ ucfirst(str_replace('_', ' ', $coluna)) }}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        @foreach ($dados as $linha)
            <tr>
                @foreach ((array)$linha as $valor)
                    <td>{{ $valor }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
