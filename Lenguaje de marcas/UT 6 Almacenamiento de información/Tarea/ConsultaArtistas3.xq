(: Nombre de los artistas para los que no hay año de fallecimiento. :)
for $artista in doc("artistas.xml")/artistas/artista
(:Selecciono solo aquellos que no tienen la etiqueta fallecimiento:)
where not($artista/fallecimiento)
return data($artista/nombreCompleto)