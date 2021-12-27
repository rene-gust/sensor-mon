<?php declare(strict_types=1);

namespace App\Serializer\Denormalizer;

use App\Entity\Sensor;
use App\Entity\SensorRecord;
use App\Entity\SensorRecordUnit;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class SensorRecordDenormalizer implements ContextAwareDenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    private const ALREADY_CALLED = 'USER_DENORMALIZER_ALREADY_CALLED';

    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        if (isset($context[self::ALREADY_CALLED])) {
            return false;
        }
        return SensorRecord::class === $type;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $sensor = $this->doctrine->getRepository(Sensor::class)->findOneBy(['id' => $data['sensorId']]);

        if (!$sensor) {
            throw new BadRequestException(
                sprintf('sensor with id %s is unknown', $data['id'])
            );
        }

        if ($data['password'] !== $sensor->getPassword()) {
            throw new BadRequestException(
                sprintf('wrong sensor password')
            );
        }

        $unit = $this->doctrine->getRepository(SensorRecordUnit::class)->findOneBy(['siBaseUnit' => $data['unit']]);
        
        if (!$unit) {
            throw new BadRequestException(
                sprintf('unit %s is unknown', $data['unit'])
            );
        }

        if (empty($data['value'])) {
            throw new BadRequestException(
                sprintf('value invalid')
            );
        }

        $sensorRecord = new SensorRecord();
        $sensorRecord->setSensor($sensor);
        $sensorRecord->setUnit($unit);
        $sensorRecord->setValue($data['value']);
        $sensorRecord->setDateTime(new \DateTimeImmutable());

        $context[self::ALREADY_CALLED] = true;

        return $sensorRecord;
    }


}
