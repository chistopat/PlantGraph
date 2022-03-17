<?php

declare(strict_types=1);

namespace App\Service\Lmt;

use App\Exceptions\DriverAnketaNotFoundException;
use App\Helpers\Logs\SherlockHelper;
use App\Helpers\MoneyHelper;
use App\Service\DriverAnketa\Entity\DriverAnketa;
use App\Service\DriverAnketa\Entity\Enumeration\CarType;
use App\Service\DriverAnketa\Entity\Enumeration\DriverType;
use App\Service\DriverAnketa\Exception\DriverAnketaIncorrectDataException;
use App\Service\DriverAnketa\Notify\LeadListenerInterface;
use App\Service\Lmt\Entity\LmtCompany;
use App\Service\Lmt\Entity\LmtDistribution;
use App\Service\Lmt\Entity\LmtLeadDistributionHistory;
use App\Service\Lmt\Enumeration\LeadCarType;
use App\Service\Lmt\Enumeration\LeadDistributionMethod;
use App\Service\Lmt\Enumeration\LeadLocation;
use App\Service\Lmt\Enumeration\LeadType;
use App\Service\Lmt\Exception\LmtCompany\LmtCompanyNotFoundException;
use App\Service\Lmt\Exception\LmtDistribution\LmtDistributionNotFoundException;
use App\Service\Lmt\Exception\LmtException;
use App\Service\Lmt\Exception\LmtFallbackException;
use App\Service\Lmt\Repository\LmtLeadDistributionHistoryRepositoryInterface;
use App\Service\ServiceLocator;
use App\Utils\Sherlock\Group;
use Citymobil\Base\Enumeration\Exception\EnumerationClassNotFound;
use Citymobil\Base\Enumeration\Exception\NotValidEnumerationValue;
use Citymobil\FinTech\Billing\Lead\LeadWriteOffRequest;
use Citymobil\FinTech\Billing\Lead\LeadWriteOffService;
use Exception;
use Psr\Log\LoggerInterface;
use Throwable;

final class Buzz
{

}