(: Una lista HTML con el nombre de los artistas nacidos en España. :)
(:Etiquetas de apertura de lista, seguido de recorrer los elementos
seleccionando aquellos cullo país es España,
Devuelvo: 
*etiqueta de apertura de elemento de la lista 
*nombre del artista
*etiqueta de cierre de elemento de la lista
Después de recorrer los elementos, devuelvo la etiqueta de cierre de la lista
:)
<ul>
  {
    for $artista in doc("artistas.xml")/artistas/artista
    where $artista/pais = "España"
    return
    <li>
      {$artista/nombreCompleto/text()}      
    </li>
  }
</ul>
