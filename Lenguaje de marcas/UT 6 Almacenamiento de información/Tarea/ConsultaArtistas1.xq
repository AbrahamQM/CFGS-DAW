(: Nombre y país de todos los artistas. :)
for $artista in doc("artistas.xml")/artistas/artista
return (
  (:Devuelvo el nombre y el pais de cada uno:)
  data($artista/nombreCompleto), data($artista/pais)
)