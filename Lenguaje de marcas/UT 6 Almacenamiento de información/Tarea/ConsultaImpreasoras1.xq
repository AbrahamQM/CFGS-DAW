(: Modelo de las impresoras de tipo “láser”.:)
for $imp in doc("impresoras.xml")/impresoras/impresora
where $imp/@tipo = "láser" (:Selecciono las que son tipo láser:)
return data($imp/modelo)