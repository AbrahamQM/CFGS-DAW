(: El nombre de los artistas que nacieron antes de 1500. :)
for $artista in doc("artistas.xml")/artistas/artista
(:Selecciono solo aquellos cuyo nacimiento es menor a 1500:)
where number($artista/nacimiento) < 1500
(:Devuelvo solo el nombre:)
return data($artista/nombreCompleto)