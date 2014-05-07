<?php ob_start(); ?>
<h1>Non enim, si omnia non sequebatur, idcirco non erat ortus illinc.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Legimus tamen Diogenem, Antipatrum, Mnesarchum, Panaetium, multos alios in primisque familiarem nostrum Posidonium. Plane idem, inquit, et maxima quidem, qua fieri nulla maior potest. Duo Reges: constructio interrete. Et quod est munus, quod opus sapientiae? <a href='http://loripsum.net/' target='_blank'>Primum divisit ineleganter;</a> </p>
<?php echo json_encode([
    'html' => ob_get_clean(),
]);