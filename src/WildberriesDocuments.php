<?php

namespace Filippi4\Wildberries;

class WildberriesDocuments extends WildberriesDocumentsClient
{
    /**
     * Получение списка документов.
     *
     * @param string|null $dateFrom Дата начала (в формате, поддерживаемом API)
     * @param string|null $dateTo Дата окончания
     * @return mixed
     */
    public function getDocumentsList(?string $dateFrom = null, ?string $dateTo = null): mixed
    {
        $params = [];
        if ($dateFrom !== null) {
            $params['dateFrom'] = $dateFrom;
        }
        if ($dateTo !== null) {
            $params['dateTo'] = $dateTo;
        }

        $response = $this->getRequest('api/v1/documents/list', $params);
        return $response->json();
    }

    /**
     * Скачивание конкретного документа по заданному сервисному имени и расширению.
     *
     * @param string $serviceName Имя сервиса документа, например, "actutil-2387514"
     * @param string $extension Расширение файла, например, "xlsx"
     * @return mixed
     */
    public function downloadDocument(string $serviceName, string $extension): mixed
    {
        $params = [
            'serviceName' => $serviceName,
            'extension' => $extension,
        ];

        $response = $this->getRequest('api/v1/documents/download', $params);
        return $response->json();
    }
}
