<?php
$filteredList = [];
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

foreach ($hotels as $hotel){
    if(!empty($_GET['parking']) || !empty($_GET['review'])){
        $pushElement = true;

        if(!empty($_GET['parking'])){
            if($hotel['parking'] != $_GET['parking']){
                    $pushElement = false;
            }
        }

        if(!empty($_GET['review'])){
            if($_GET['review'] < 0){
                $_GET['review'] = 0;
            }
            if($_GET['review'] > 5){
                $_GET['review'] = 5;
            }
            if($_GET['review'] > $hotel['vote']){
                $pushElement = false;
            }
        }

        if($pushElement){
            $filteredList[] = $hotel;
        }
    }else{
        $filteredList = $hotels;
    }
}

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Hotels</title>
</head>

<body>
    <main>
        <h1 class="text-center pt-3">Lista Hotel</h1>

        <div class="container">


            <div class="row row-col-6">
                <!-- parte dei filtri  -->
                <div class="col">

                    <form class="p-4" action="" method="GET">
                        <div class="row mb-3">
                            <div class="col-6 ">
                                <label class="form-label">Hotel con parcheggio</label></br>
                                <input type="checkbox" name="parking" class="form-check-input">
                            </div>
                            <div class="col-6">
                                <label class="form-label">filtra per voto</label>
                                <input name="review" type="number" class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-primary">Cerca</button>
                        <button class="btn btn-danger" type="reset">reset</button>
                    </form>


                </div>
                <!-- parte della visualizzazione Hotel -->
                <div class="col overflow-auto">
                    <div class="row row-col-6 g-5">
                        <?php foreach ($filteredList as $hotel) { ?>

                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h2><?php echo $hotel["name"] ?></h2>
                                    </div>
                                    <div class="card-body">

                                        <ul class="text-start">
                                            <li>
                                                <p class="mb-2"><?php echo $hotel["description"] ?></p>

                                            </li>
                                            <li>
                                                <p class="card-text">Distanza dal centro: <?php echo $hotel["distance_to_center"] ?>m</p>
                                            </li>
                                            <li>
                                                <p class="card-text">Parcheggio:
                                                    <?php
                                                    if ($hotel["parking"]) {
                                                        echo 'disponibile';
                                                    } else {
                                                        echo 'non disponibile ';
                                                    }
                                                    ?>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <?php
                                        for ($i = 0; $i < $hotel["vote"]; $i++) {
                                            echo '<i class="fa-solid fa-star text-primary"></i>';
                                        }
                                        for ($i = 0; $i < (5 - $hotel["vote"]); $i++) {
                                            echo '<i class="fa-regular fa-star text-primary"></i>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        <?php }; ?>
                    </div>


                </div>



            </div>

        </div>






    </main>
</body>

</html>