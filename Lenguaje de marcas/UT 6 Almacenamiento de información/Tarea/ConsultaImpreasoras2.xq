(: Marca y modelo de las impresoras con más de un tamaño.:)
for $imp in doc("impresoras.xml")/impresoras/impresora
(:Selecciono las que el conteo de tamaño es mas de 1:)
where count($imp/tamaño) > 1 
return (
  data($imp/marca), data($imp/modelo)
)