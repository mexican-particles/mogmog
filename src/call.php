<?php

declare(strict_types=1);

use Src\Domain\DataResource\Interface\LevelDataResourceInterface;
use Src\Domain\DataResource\User\UserRowDataGateway;
use Src\Domain\Model\Level\Interface\LevelInterface;
use Src\Domain\Model\User\UserActiveRecord;
use Src\Domain\Service\Gateway\LevelUpViaRowDataGatewayService;
use Src\Domain\Service\Gateway\LevelUpViaTableDataGatewayService;
use Src\Domain\Service\Mapper\LevelUpViaActiveRecordService;
use Src\Domain\Service\Mapper\LevelUpViaDataMapperService;
use Src\DataResource\Gateway\UserTableDataGateway;
use Src\DataResource\Mapper\UserDataMapper;

$levelDataResource = new class implements LevelDataResourceInterface {
    public function findByExp(int $exp): LevelInterface
    {
        return new class implements LevelInterface {
            public function getLevel(): int
            {
                return 1;
            }
        };
    }
};

$rowDataGateway = new UserRowDataGateway(1, 1, 1);
$rowDataGateway::findAll();
$activeRecord = new UserActiveRecord(1, 1, 1);
$activeRecord::findAll();
$tableDataGateway = new UserTableDataGateway();
$dataMapper = new UserDataMapper();

$rowDataGatewayService = new LevelUpViaRowDataGatewayService($levelDataResource);
$activeRecordService = new LevelUpViaActiveRecordService($levelDataResource);
$tableDataGatewayService = new LevelUpViaTableDataGatewayService($levelDataResource, $tableDataGateway);
$dataMapperService = new LevelUpViaDataMapperService($levelDataResource, $dataMapper);
