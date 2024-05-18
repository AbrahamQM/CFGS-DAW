(: El número de artistas nacidos antes de 1600. :)
(:Recorro los artistas seleccionando 
aquellos que nacimiento es anterior a 1600:)
let $a := 
  for $artista in doc("artistas.xml")/artistas/artista
  where $artista/nacimiento < 1600
  return $artista
(: devuelvo el recuento del resultado:)
return count($a)