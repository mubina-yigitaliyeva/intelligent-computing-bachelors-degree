<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Student Information - Arrays</h1>

    <?php
    // indexed array
    $subjects = ['PHP', "SQL", 'HTML'];
    ?>
    <p>$subjects[0]: <?php echo $subjects[0];?></p>
    <p>$subjects[2]: <?php echo $subjects[2];?></p>

    <?php
    // associative array
    $student1 = [
        'name' => "Mubina",
        'university' => "Dong-eui University",
        'major' => 'Intelligence Computing'
    ];
    $student2 = [
        'name' => "Mubina",
        'university' => "Dong-eui University",
        'major' => 'Intelligence Computing'
    ];

    // multilevel array
    $students = [$student1, $student2];

    $students[1]['major'] = 'Data Scientist';

    ?>
    <p>Name: <?php echo $student1['name'];?></p>
    <p>Major: <?php echo $student2['major'];?></p>
    
</body>
</html>