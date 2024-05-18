(:Modelo de las impresoras en red.:)
for $imp in doc("impresoras.xml")/impresoras/impresora
where $imp/enred (:Solo las que tienen la etiqueta enred:)
return data($imp/modelo)
