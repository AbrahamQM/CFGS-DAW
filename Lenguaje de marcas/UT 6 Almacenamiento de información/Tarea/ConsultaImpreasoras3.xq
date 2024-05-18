(: Marca y modelo de las impresoras con tamaño A3 (pueden tener otros). :)
for $imp in doc("impresoras.xml")/impresoras/impresora
(:Selecciono todas las que contienen el tamaño A3:)
where data($imp/tamaño) = "A3" 
return (
  data($imp/marca), data($imp/modelo)
)