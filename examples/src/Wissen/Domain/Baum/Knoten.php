<?php

namespace App\Wissen\Domain\Baum;

use Becklyn\Ddd\Events\Domain\EventProvider;
use Becklyn\Ddd\Events\Domain\EventProviderCapabilities;
use Doctrine\ORM\Mapping as ORM;

#[Orm\Entity]
#[Orm\Table(name: "wissen_knoten")]
class Knoten implements EventProvider
{
    use EventProviderCapabilities;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id", type: "integer", options: ["unsigned" => true])]
    private ?int $internalId = null;

    #[ORM\Column(name: "uuid", type: "string", length: 36, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(type: "datetime_immutable", nullable: false, columnDefinition: "DATETIME(6) NOT NULL COMMENT '(DC2Type:datetime_immutable)' DEFAULT CURRENT_TIMESTAMP(6)")]
    private \DateTimeImmutable $createdTs;

    #[ORM\Column(type: "datetime_immutable", nullable: false, columnDefinition: "DATETIME(6) NOT NULL COMMENT '(DC2Type:datetime_immutable)' DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)")]
    private \DateTimeImmutable $updatedTs;

    public static function erzeugen(
        KnotenId $id
    ): self {
        // TODO add additional properties

        $knoten = new self($id);
        $knoten->raiseEvent(
            new KnotenErzeugt(
                $knoten->nextEventIdentity(),
                new \DateTimeImmutable(),
                $id
            )
        );
        return $knoten;
    }

    private function __construct(KnotenId $id)
    {
        // TODO add additional properties

        $this->id = $id->asString();
    }

    public function id(): KnotenId
    {
        return KnotenId::fromString($this->id);
    }
}
