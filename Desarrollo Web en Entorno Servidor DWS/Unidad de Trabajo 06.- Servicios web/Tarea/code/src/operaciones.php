<?php
// Clase para el servicio SOAP de operaciones de inventario

namespace Abraham\Code;

class Operaciones
{

    // Array asociativo de ejemplo con productos y tiendas para pruebas
    private $productos = [
        "P1" => [
            "nombre" => "Portátil HP",
            "pvp" => 750,
            "stock" => [
                "T1" => 5,
                "T2" => 2
            ]
        ],
        "P2" => [
             "nombre" => "Auriculares Sony WH-1000XM4",
            "pvp" => 299,
            "stock" => [
                "T1" => 6,
                "T2" => 3
            ]
        ],
        "P3" => [
            "nombre" => "Teclado Mecánico Corsair",
            "pvp" => 95,
            "stock" => [
                "T1" => 10,
                "T2" => 7
            ]
        ]
    ];


    /**
     *  Esta función recbe como parámetro el código de un producto
     *  @param string $codigoProducto Código del producto
     *  @return string El PVP o "Producto no encontrado"
     */
    public function getPVP(string $codigoProducto): string
    {
        if (isset($this->productos[$codigoProducto])) {
            return "El PVP de {$this->productos[$codigoProducto]['nombre']} es {$this->productos[$codigoProducto]['pvp']} €";
        }
        return "Producto no encontrado";
    }

    /**
     *  Esta función recibe dos parámetros:
     *  el código de un producto y el código de una tienda.
     *  @param string $codigoProducto Código del producto
     *  @param string $codigoTienda Código de la tienda
     *  @return string Stock o "Producto o tienda no encontrados"
     */
    public function getStock(string $codigoProducto, string $codigoTienda): string
    {
        if (isset($this->productos[$codigoProducto]['stock'][$codigoTienda])) {
            $stock = $this->productos[$codigoProducto]['stock'][$codigoTienda];
            return "Stock de {$this->productos[$codigoProducto]['nombre']} en tienda $codigoTienda: $stock unidades";
        }
        return "Producto no encontrado o tienda inexistente para ese artículo";
    }
}
