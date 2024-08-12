<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pos</title>
</head>
<style>
    table {
        border-collapse: collapse;
        /* untuk menghilangkan jarak antar border */
        width: 100%;
    }

    table,
    th,
    td {
        padding: 8px;
        /* menambahkan jarak di dalam sel */
        text-align: center;
        /* untuk menengahkan teks */
    }
</style>

<body>
    <h3 class="mb-0 text-uppercase">
        <center>Point Of Sales</center>
    </h3>
    <h5 class="mb-0 text-uppercase">
        <center>Rancamanyar</center>
    </h5>
    <h5 class="mb-0 text-uppercase">
        <center>Telpon:xxx</center>
    </h5>
    <hr>
    <center>
        <div class="product-table">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        @foreach ($cetakStruk as $data)
                            <tr>
                                <td>{{ $data->menu }}</td>
                                <td style="padding-left: 180px">
                                    <strong>Rp.{{ number_format($data->total, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>

        <br>
        <table>
            <tbody>
                <tr>
                    <td>Subtotal</td>
                    <td>:</td>
                    <td><strong>Rp.{{ number_format($data->subtotal, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td>pajak</td>
                    <td>:</td>
                    <td><strong>Rp.{{ number_format($data->pajak, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td>:</td>
                    <td><strong>Rp.{{ number_format($data->total, 0, ',', '.') }}</strong></td>
                </tr>

            </tbody>
        </table>
        <br>
        <br>
        <br>
        <hr>
        <p>{{ $data->created_at }}</p>
    @break
    @endforeach
</center>
<script type="text/javascript">
    window.print();
</script>
</body>

</html>
