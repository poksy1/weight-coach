<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Meal Plan PDF</title>

    <style>

        body{
            font-family: sans-serif;
            padding:40px;
        }

        h1{
            color:#065f46;
        }

        .meal{
            border:1px solid #ddd;
            border-radius:12px;
            padding:16px;
            margin-bottom:16px;
        }

    </style>
</head>
<body>

<h1>Rencana Makan {{ $client->name }}</h1>

<p>
    Target Kalori:
    {{ $client->calorie_target }} kkal
</p>

<hr>

@foreach($mealPlans as $meal)

    <div class="meal">

        <h3>{{ $meal->meal_name }}</h3>

        <p>Hari: {{ $meal->day }}</p>

        <p>Tipe: {{ $meal->meal_type }}</p>

        <p>Kalori: {{ $meal->calories }} kkal</p>

    </div>

@endforeach

</body>
</html>