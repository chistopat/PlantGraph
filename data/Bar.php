<?php

declare(strict_types=1);

namespace App\Service\DriverAnketa;

use App\Exceptions\Entity\InvalidEntityFieldException;
use App\Exceptions\Repository\EntitySaveException;
use App\Service\DriverAnketa\Entity\DriverAnketa;
use App\Service\DriverAnketa\Entity\Enumeration\CarType;
use App\Service\DriverAnketa\Entity\Enumeration\DriverAnketaStatus;
use App\Service\DriverAnketa\Entity\Enumeration\DriverType;
use App\Service\DriverAnketa\Entity\Enumeration\LeadStatus;
use App\Service\DriverAnketa\Exception\UpdateFromLeadsflowException;
use App\Service\DriverAnketa\Repository\DriverAnketaRepository;
use Driver;
use Monolog\Logger;

class Bar
{
}