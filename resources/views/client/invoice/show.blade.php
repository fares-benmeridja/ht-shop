<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
{{--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>--}}

    <title>invoice</title>

{{--    <!-- Styles -->--}}
    <link href="{{ mix('css/invoice.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <div id="logo">
        <img src="{{ asset('img/logo.png') }}" alt="logo">
    </div>
    <h1>FACTURE</h1>
    <div class="columns">
        <p id="project">
            <span>Client</span>{{ $order->user->full_name }}<br>
            <span>Wilaya</span>{{ $order->commune->wilaya }}<br>
            <span>Numéro</span>{{ $order->user->phone }}<br>
            <span>Adresse</span>{{ $order->address }}<br>
            <span>Email</span> <a href="mailto:malak.kheznadji7@gmail.com">{{ $order->email }}</a><br>
            <span>Date</span>{{ $order->created_at->format('d M Y') }}<br>
        </p>
        <p id="company">RedArt<br>+213 782 20 66 52<br><a href="{{ "mailto:".env('EMAIL') }}">{{ env('EMAIL') }}</a><br>
    </div>

</header>
<main>
    <table>
        <thead>
        <tr>
            <th class="id">#</th>
            <th class="article">Article</th>
            <th class="unit">Catégorie</th>
            <th class="qty">Prix unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $product)
        <?php
            if ($loop->first)
                $grandtotal = 0;

            $total = $product->price * $product->pivot->quantity;
            $grandtotal += $total;
        ?>

        <tr>
            <td class="id">{{ $loop->iteration }}</td>
            <td class="article">{{ $product->title }}</td>
            <td class="cat" style="text-align: center">{{ $product->category->name }}</td>
            <td class="price">{{ $product->formated_price }}</td>
            <td class="qty">{{ $product->pivot->quantity }}</td>
            <td class="total">{{ number_format($total, 0, ',', ' ')." DZA" }}</td>
        </tr>

        @endforeach
        <tr>
            <td colspan="4" class="grand total">Grand total</td>
            <td class="grand total" colspan="2">{{ number_format($grandtotal, 0, ',', ' ')." DZA" }}</td>
        </tr>
        </tbody>
    </table>
</main>
    <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print" style="margin-right: 8px"></i>Imprimer</button>
<footer>
    <div>
        <a href="https://www.facebook.com/RedArt.dz" target="_blank"><i class="fa fa-facebook"> RedArt</i></a>
        <a href="https://instagram.com/redart_dz?igshid=dcjv9wcvvjcm" target="_blank"><i class="fa fa-instagram"> redart_dz
            </i></a>
        <a><i class="fa fa-whatsapp"> +213 782 20 66 52</i></a>
    </div>
</footer>
</body>
</html>