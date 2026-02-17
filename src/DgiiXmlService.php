<?php

namespace PlatinumPlace\LaravelDgii;

use Illuminate\Support\Facades\View;

class DgiiXmlService
{
    /**
     * Renderiza un e-CF (Factura Electrónica).
     *
     * @param string $type El tipo de e-CF (ej: 31, 32, 33, 34, 41, 43, 44, 45, 46, 47)
     * @param array $data Los datos para el blade
     * @return string
     */
    public function renderEcf(string $type, array $data): string
    {
        return View::make("dgii::ecf.ecf_{$type}", $data)->render();
    }

    /**
     * Renderiza un Anulación de e-CF (ANECF).
     *
     * @param array $data Los datos para el blade
     * @return string
     */
    public function renderAnecf(array $data): string
    {
        return View::make("dgii::anecf.xml", $data)->render();
    }

    /**
     * Renderiza un Aprobación Comercial de e-CF (ACECF).
     *
     * @param array $data Los datos para el blade
     * @return string
     */
    public function renderAcecf(array $data): string
    {
        return View::make("dgii::acecf.xml", $data)->render();
    }

    /**
     * Renderiza un Reporte de Facturación de Consumo Electrónico (RFCE).
     *
     * @param array $data Los datos para el blade
     * @return string
     */
    public function renderRfce(array $data): string
    {
        return View::make("dgii::rfce.xml", $data)->render();
    }

    /**
     * Renderiza un Acuse de Recibo de e-CF (ARECF).
     *
     * @param array $data Los datos para el blade
     * @return string
     */
    public function renderArecf(array $data): string
    {
        return View::make("dgii::arecf.xml", $data)->render();
    }

    /**
     * Alias para renderizar cualquier vista del paquete.
     *
     * @param string $view
     * @param array $data
     * @return string
     */
    public function render(string $view, array $data = []): string
    {
        return View::make("dgii::{$view}", $data)->render();
    }
}
