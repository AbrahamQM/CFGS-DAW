(: Marca y modelo de las impresoras con tamaño A3 como único tamaño. :)
for $imp in doc("impresoras.xml")/impresoras/impresora
(:Selecciono las que tienen tamaño A3 y el conteo de tamaño devuelve solo 1:)
where data($imp/tamaño) = "A3" and count($imp/tamaño) = 1
return (
  data($imp/marca), data($imp/modelo)
)