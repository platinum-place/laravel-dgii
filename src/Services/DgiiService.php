<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\CancellationRanges\Orchestrators\SubmitCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CommercialApprovals\Orchestrators\SubmitCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\ReceiveInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SignXmlInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SubmitInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\ValidateInvoiceStatusAction;
use PlatinumPlace\LaravelDgii\Actions\Seeds\Orchestrators\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\SeedRepository;
use PlatinumPlace\LaravelDgii\Repositories\StatusRepository;

class DgiiService
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected SubmitCancellationRangeAction $submitCancellationRange,
        protected SubmitCommercialApprovalAction $submitCommercialApproval,
        protected SubmitInvoiceAction $submitInvoice,
        protected ValidateInvoiceStatusAction $validateInvoiceStatus,
        protected SendInvoiceAction $sendInvoice,
        protected StorageInvoiceAction $storageInvoice,
        protected SignInvoiceAction $signInvoice,
        protected SignXmlInvoiceAction $signXmlInvoice,
        protected ReceiveInvoiceAction $receiveInvoice,
        protected ReceiveSeedAction $receiveSeed,
        protected SeedRepository $seedRepository,
        protected StatusRepository $statusRepository,
    ) {
        //
    }

    /**
     * Envía un rango de anulación a la DGII.
     *
     * @param  array  $data  Los datos del rango de anulación.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     * @throws \InvalidArgumentException
     */
    public function sendCancellationRange(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        return $this->submitCancellationRange->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * Envía una aprobación comercial a la DGII.
     *
     * @param  string  $token  Token de acceso.
     * @param  string  $signed  XML firmado de la aprobación.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     * @throws \InvalidArgumentException
     */
    public function sendCommercialApproval(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        return $this->submitCommercialApproval->handle($token, $signed, $env, $certPath, $certPassword);
    }

    /**
     * Envía una factura electrónica a la DGII.
     *
     * @param  array  $data  Los datos de la factura.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     * @throws \InvalidArgumentException
     */
    public function submitInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->submitInvoice->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * Valida el estado de una factura en la DGII.
     *
     * @param  string  $path  Ruta local del archivo XML.
     * @param  string|null  $trackId  ID de seguimiento de la DGII.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     * @throws \InvalidArgumentException
     */
    public function validateInvoiceStatus(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->validateInvoiceStatus->handle($path, $trackId, $env, $certPath, $certPassword);
    }

    /**
     * Envía un archivo XML de factura ya existente a la DGII.
     *
     * @param  string  $path  Ruta local del archivo XML.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     * @throws \InvalidArgumentException
     */
    public function sendInvoice(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->sendInvoice->handle($path, $env, $certPath, $certPassword);
    }

    /**
     * Almacena una factura firmada localmente.
     *
     * @param  string  $signed  Contenido del XML firmado.
     * @param  string|null  $env  El entorno de la DGII.
     *
     * @throws \InvalidArgumentException
     */
    public function storageInvoice(string $signed, ?string $env = null): InvoiceData
    {
        return $this->storageInvoice->handle($signed, $env);
    }

    /**
     * Firma los datos de una factura y devuelve el objeto de datos.
     *
     * @param  array  $data  Los datos de la factura.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws \InvalidArgumentException
     */
    public function signInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->signInvoice->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * Firma un XML de factura y devuelve el objeto de datos.
     *
     * @param  string  $xml  Contenido XML.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws \InvalidArgumentException
     */
    public function signXmlInvoice(string $xml, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->signXmlInvoice->handle($xml, $env, $certPath, $certPassword);
    }

    /**
     * Procesa la recepción de una factura (intercambio de tokens y envío).
     *
     * @param  string  $token  Token de acceso.
     * @param  string  $signed  XML firmado.
     * @param  string|null  $env  El entorno de la DGII.
     * @param  string|null  $certPath  Ruta al certificado digital.
     * @param  string|null  $certPassword  Contraseña del certificado digital.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     * @throws \InvalidArgumentException
     */
    public function receiveInvoice(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->receiveInvoice->handle($token, $signed, $env, $certPath, $certPassword);
    }

    /**
     * Solicita una semilla (seed) a la DGII.
     *
     * @param  string|null  $env  El entorno de la DGII.
     *
     * @throws ConnectionException
     */
    public function requestSeed(?string $env = null): string
    {
        return $this->seedRepository->getSeed($env);
    }

    /**
     * Intercambia una semilla firmada por un token de acceso.
     *
     * @param  string  $xml  XML de la semilla firmada.
     * @param  string|null  $env  El entorno de la DGII.
     */
    public function receiveSeed(string $xml, ?string $env = null): array
    {
        return $this->receiveSeed->handle($xml, $env);
    }

    /**
     * Solicita un token de acceso a partir de un archivo de semilla firmada.
     *
     * @param  string  $path  Ruta al archivo firmado.
     * @param  string|null  $env  El entorno de la DGII.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     */
    public function requestToken(string $path, ?string $env = null): array
    {
        return $this->seedRepository->getToken($path, $env);
    }

    /**
     * Obtiene el estado general de los servicios de la DGII.
     *
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     */
    public function getServiceStatus(): array
    {
        return $this->statusRepository->getServiceStatus();
    }

    /**
     * Obtiene las ventanas de mantenimiento programadas de la DGII.
     *
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->statusRepository->getMaintenanceWindows();
    }

    /**
     * Obtiene el estado de un entorno específico de la DGII.
     *
     * @param  string  $env  El entorno a consultar.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(string $env): array
    {
        return $this->statusRepository->getEnvironmentStatus($env);
    }
}
